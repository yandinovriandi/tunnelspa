<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Tunnel;
use App\Models\User;
use App\Repositories\RouterOsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use RouterOS\Exceptions\BadCredentialsException;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\ConnectException;
use RouterOS\Exceptions\QueryException;

class TunnelController extends Controller
{
    private RouterOsRepository $routerOsRepository;

    public function __construct(RouterOsRepository $routerOsRepository)
    {
        $this->routerOsRepository = $routerOsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tunnels = Tunnel::where('user_id',auth()->user()->id)->paginate(5);
        return view('tunnel.index',[
            'tunnels' => SpladeTable::for($tunnels)
                ->column('username',
                    sortable: true
                )->withGlobalSearch(columns: ['username', 'server'])
                ->column('username')
                ->column('domain')
                ->column('server')
                ->column('auto_renew')
                ->column('status')
                ->column('expired')
                ->column('actions')
//                ->paginate(5)
            ,

        ]);
    }
    public function async()
    {
        return view('tunnel.async',[
            'tunnels' => SpladeTable::for(Tunnel::class)
                ->column('username',
                    sortable: true
                )->withGlobalSearch(columns: ['username', 'server'])
                ->column('username')
                ->column('domain')
                ->column('server')
                ->column('auto_renew')
                ->column('status')
                ->column('expired')
                ->column('actions')
                ->paginate(5)
            ,

        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $servers = Server::pluck('name','id')->toArray();
        return view('tunnel.create',[
            'servers' => $servers
       ]);
    }



public function store(Request $request)
{
    $server = Server::where('id', $request->server_id)->first();
    $previousPorts = Tunnel::pluck('api')->merge(Tunnel::pluck('web'))->merge(Tunnel::pluck('winbox'))->toArray();
    $portapi = generatePort(4, $previousPorts);
    $portwinbox = generatePort(4, $previousPorts);
    $portweb = generatePort(4, $previousPorts);

    $iptunnel = '10.10.11.' . rand(40, 253);
    $localaddress = '10.10.11.1';

    $autoRenew = $request->input('auto_renew');
    $debit = auth()->user()->balances()->where('balance', '>=', 0)->get('balance')->sum('balance');
    $credit = auth()->user()->balances()->where('balance', '<', 0)->get('balance')->sum('balance');
    $balance = $debit + $credit;

    if (empty($request->username)) {
        throw ValidationException::withMessages([
            'server_id' => 'Pilih server terlebih dahulu',
            'username' => 'Username tidak boleh kosong Silahkan isi username',
            'password' => 'Password tidak boleh kosong',
        ]);
    }

    if ($balance <= 0) {
        Toast::title('Gagal membuat tunnel!.')
            ->message('Balance anda tidak mencukupi.')
            ->warning()
            ->backdrop()
            ->autoDismiss(5);
        return to_route('tunnels.create');
    }

    $request->validate([
        'server_id' => ['required'],
        'username' => ['required', Rule::unique('tunnels', 'username')],
        'password' => ['required', 'min:6'],
    ]);
    $mainprofile = 'default';

    try {
        DB::beginTransaction();
        auth()->user()->tunnels()->create([
            'username' => $name = $request->username,
            'password' => $pass = $request->password,
            'ip_server' => $server->host,
            'server_id' => $request->server_id,
            'server' => $server->name,
            'auto_renew' => $autoRenew,
            'local_addrss' => $localaddress,
            'ip_tunnel' => $remoteadress = $iptunnel,
            'domain' => $server->domain,
            'api' => $portapi,
            'winbox' => $portwinbox,
            'to_ports_api' => '8728',
            'to_ports_winbox' => '8291',
            'to_ports_web' => '80',
            'web' => $portweb,
            'expired' => now()->addMonth()
        ]);

        auth()->user()->transactions()->create([
            'amount' => 5000,
            'reference' => 'TUN' . time(),
            'merchant_ref' => 'TINV-' . time(),
            'type' => 'Order Layanan Tunnel',
            'status' => 'PAID',
        ]);

        auth()->user()->balances()->create([
            'balance' => -5000,
        ]);
        $this->routerOsRepository->addTunnel($server,$name, $pass, $localaddress, $remoteadress, $mainprofile);
        $this->routerOsRepository->addFirewallNatApi($server,$name, $remoteadress, $portapi);
        $this->routerOsRepository->addFirewallNatWinbox($server,$name, $remoteadress, $portwinbox);
        $this->routerOsRepository->addFirewallNatWeb($server,$name, $remoteadress, $portweb);

        DB::commit();
        Toast::title('Tunnel remote berhasil di buat.')
            ->message('Anda berhasil membuat tunnel remote.')
            ->backdrop()
            ->autoDismiss(3);
        return to_route('tunnels.index');

    } catch (\Exception $e) {
        DB::rollback();
        throw $e;
    }

}
    /**
     * Display the specified resource.
     */
    public function show(Tunnel $tunnel)
    {
        return view('tunnel.show',[
            'tunnel' => $tunnel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tunnel $tunnel)
    {
        return view('tunnel.edit',[
            'tunnel' => $tunnel
        ]);
    }
    public function sync(Tunnel $tunnel)
    {
        $servers = Server::get();
        $users = User::get();
        return view('tunnel.sync',[
            'tunnel' => $tunnel,
            'servers' => $servers,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tunnel $tunnel)
    {
        $sid = $tunnel->server_id;
        $server = Server::where('id', $sid)->first();
        $request->validate([
            'password' => ['required'],
        ]);
        $password = $request->password;
        $to_ports_web = $request->to_ports_web;
        $to_ports_api = $request->to_ports_api;
        $to_ports_winbox = $request->to_ports_winbox;
//        $tunnel = Tunnel::where('username', $tunnel->username)->first();
        $tunnel->update([
            'password' => $password,
            'to_ports_web' =>  $to_ports_web,
            'to_ports_api' =>  $to_ports_api,
            'to_ports_winbox' =>  $to_ports_winbox
        ]);

        $username = $tunnel->username;

        // ==============api================
        $rapi = $request->api;
        $pap = $tunnel->api;
        $this->routerOsRepository->updatePortApi($rapi, $pap,$server);
        // ==============api================

        // ==============winbox================
        $pwin = $request->winbox;
        $win = $tunnel->winbox;
         $this->routerOsRepository->updatePortWinbox($pwin, $win,$server);
        // ==============winbox================

        // ==============web================
        $pweb = $request->web;
        $web = $tunnel->web;
        $this->routerOsRepository->updatePortWeb($pweb, $web,$server);
        // ==============web================
        $this->routerOsRepository->updatePassPpp($username, $password,$server);

        Toast::title('Updated Tunnel.')
            ->message('Anda berhasil mengupdate tunnel remote.')
            ->backdrop()
            ->autoDismiss(2);
        return to_route('tunnels.show', $tunnel);
    }

    public function reasync(Request $request, Tunnel $tunnel)
    {
        $sid = $request->server_id;
        $server = Server::where('id', $sid)->first();
        $request->validate([
            'password' => ['required'],
        ]);
        $uid = $request->user_id;
        $password = $request->password;
        $to_ports_web = $request->to_ports_web;
        $to_ports_api = $request->to_ports_api;
        $to_ports_winbox = $request->to_ports_winbox;
//        $tunnel = Tunnel::where('username', $tunnel->username)->first();
        $tunnel->update([
            'server_id' => $sid,
            'user_id' => $uid,
            'password' => $password,
            'to_ports_web' =>  $to_ports_web,
            'to_ports_api' =>  $to_ports_api,
            'to_ports_winbox' =>  $to_ports_winbox,

            'username' => $tunnel->username,
            'ip_server' => $server->host,
            'server' => $server->name,
            // Menambahkan logika kondisional di sini
            'auto_renew' => (!empty($tunnel->auto_renew)) ? $tunnel->auto_renew : 'ya',
            'local_addrss' => $tunnel->local_addrss,
            'ip_tunnel' => $tunnel->ip_tunnel,
            'domain' => $server->domain,
            'api' => $tunnel->api,
            'winbox' => $tunnel->winbox,
            'expired' => $tunnel->expired,
            'web' => $tunnel->web,
        ]);

        $username = $tunnel->username;

        // ==============api================
        $rapi = $request->api;
        $pap = $tunnel->api;
        $this->routerOsRepository->updatePortApi($rapi, $pap,$server);
        // ==============api================

        // ==============winbox================
        $pwin = $request->winbox;
        $win = $tunnel->winbox;
        $this->routerOsRepository->updatePortWinbox($pwin, $win,$server);
        // ==============winbox================

        // ==============web================
        $pweb = $request->web;
        $web = $tunnel->web;
        $this->routerOsRepository->updatePortWeb($pweb, $web,$server);
        // ==============web================
        $this->routerOsRepository->updatePassPpp($username, $password,$server);

        Toast::title('Success reasync Tunnel.')
            ->message('Anda berhasil mengupdate tunnel remote.')
            ->backdrop()
            ->autoDismiss(2);
        return to_route('tunnels.show', $tunnel);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tunnel $tunnel)
    {
        $sid = $tunnel->server_id;
        $server = Server::where('id', $sid)->first();
        $username = $tunnel->username;
        $pap = $tunnel->api;
        $win = $tunnel->winbox;
        $web = $tunnel->web;
        $this->routerOsRepository->disablePpp($server,$username);
        $this->routerOsRepository->deletePortApi($server, $pap);
        $this->routerOsRepository->deletePortWeb($server, $web);
        $this->routerOsRepository->deletePortWinbox($server, $win);
        $this->routerOsRepository->deletePppSecret($username,$server);
        $this->routerOsRepository->deleteActiveSecret($server, $username);
        $tunnel->delete();
        Toast::title('Success deleted.')
            ->message('Tunnel berhasil di hapus.')
            ->backdrop()
            ->autoDismiss(2);
        return to_route('tunnels.index');
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function removeActive(Tunnel $tunnel)
    {
        $sid = $tunnel->server_id;
        $server = Server::where('id', $sid)->first();
        $username = $tunnel->username;
        $this->routerOsRepository->deleteActiveSecret($server, $username);

        $tunnel->update([
            'status' => 'nonaktif'
        ]);
        Toast::title('Success disabled.')
            ->message('Tunnel berhasil di nonaktifkan.')
            ->backdrop()
            ->autoDismiss(2);
        return back();
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function cekExpiredTunnels()
    {
        $tunnels = Tunnel::get();
        foreach ($tunnels as $tunnel) {
            $server = Server::where('id',$tunnel->server_id)->first();
            $this->routerOsRepository->disableWithSch($server);
            // gunakan $routerOsRepository untuk melakukan koneksi dan pengaturan pada Mikrotik
        }
    }
}
