<?php

namespace App\Repositories;

use App\Models\Tunnel;
use App\Models\UserBalace;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\BadCredentialsException;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\ConnectException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class RouterOsRepository
{
    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     * @throws \Exception
     */
    public function getMikrotik($server): Client
    {
        $mikrotik = $server;
        if (! $mikrotik) {
            throw new \Exception('Mikrotik not found.');
        }

        $config = (new Config())
            ->set('host', $mikrotik->host)
            ->set('port', (int) $mikrotik->port)
            ->set('pass', $mikrotik->password)
            ->set('user', $mikrotik->username);

        return new Client($config);
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function getUserSecret($server, $username)
    {
        $client = $this->getMikrotik($server);
        $query = new Query('/ppp/active/print');
        $query->where('name', $username);

        return $client->query($query)->read();
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function addTunnel($server, $name, $pass, $localaddress, $remoteadress, $mainprofile)
    {
        $client = $this->getMikrotik($server);
        $query = new Query('/ppp/secret/add');
        $query->equal('name', $name);
        $query->equal('password', $pass);
        $query->equal('local-address', $localaddress);
        if (! empty($localaddress)) {
            $query->equal('local-address', $localaddress);
        }
        if (! empty($remoteadress)) {
            $query->equal('remote-address', $remoteadress);
        }
        $query->equal('comment', strtoupper($name));
        $query->equal('profile', $mainprofile);
        $query->equal('service', 'any');

        return $client->query($query)->read();
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function addFirewallNatApi($server, $name, $remoteadress, $portapi): array
    {
        $client = $this->getMikrotik($server);
        $api = (new Query('/ip/firewall/nat/add'))
            ->equal('chain', 'dstnat')
            ->equal('chain', 'dstnat')
            ->equal('action', 'dst-nat')
            ->equal('to-addresses', $remoteadress)
            ->equal('to-ports', '8728')
            ->equal('protocol', 'tcp')
            ->equal('dst-port', $portapi)
            ->equal('comment', strtoupper($name.'-NAT-API'))
            ->equal('disabled', 'no');

        return $client->qr($api);
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function addFirewallNatWinbox($server, $name, $remoteadress, $portwinbox): array
    {
        $client = $this->getMikrotik($server);
        $winbox = (new Query('/ip/firewall/nat/add'))
            ->equal('chain', 'dstnat')
            ->equal('chain', 'dstnat')
            ->equal('action', 'dst-nat')
            ->equal('to-addresses', $remoteadress)
            ->equal('to-ports', '8291')
            ->equal('protocol', 'tcp')
            ->equal('dst-port', $portwinbox)
            ->equal('comment', strtoupper($name.'-NAT-WINBOX'))
            ->equal('disabled', 'no');

        return $client->qr($winbox);
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function addFirewallNatWeb($server, $name, $remoteadress, $portweb): array
    {
        $client = $this->getMikrotik($server);
        $web = (new Query('/ip/firewall/nat/add'))
            ->equal('chain', 'dstnat')
            ->equal('chain', 'dstnat')
            ->equal('action', 'dst-nat')
            ->equal('to-addresses', $remoteadress)
            ->equal('to-ports', '80')
            ->equal('protocol', 'tcp')
            ->equal('dst-port', $portweb)
            ->equal('comment', strtoupper($name.'-NAT-WEB'))
            ->equal('disabled', 'no');

        return $client->qr($web);
    }

//    update tunnel
    // ==============api================
    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function updatePortApi($rapi, $pap, $server)
    {
        $client = $this->getMikrotik($server);
        $updatePortApi = new Query('/ip/firewall/nat/print');
        $updatePortApi->where('dst-port', $pap);
        $upas = $client->query($updatePortApi)->read();

        foreach ($upas as $upa) {
            $updatePortWinbox = (new Query('/ip/firewal/nat/set'))
                ->equal('.id', $upa['.id'])
                ->equal('to-ports', $rapi);
            $client->query($updatePortWinbox)->read();
        }
    }
    // ==============api================

    // ==============winbox================
    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function updatePortWinbox($pwin, $win, $server)
    {
        $client = $this->getMikrotik($server);
        $updatePortWinbox = new Query('/ip/firewall/nat/print');
        $updatePortWinbox->where('dst-port', $win);
        $wins = $client->query($updatePortWinbox)->read();

        foreach ($wins as $win) {
            $updatePortWinbox = (new Query('/ip/firewal/nat/set'))
                ->equal('.id', $win['.id'])
                ->equal('to-ports', $pwin);
            $client->query($updatePortWinbox)->read();
        }
    }

        // ==============winbox================

        // ==============web================

            /**
             * @throws ClientException
             * @throws ConnectException
             * @throws QueryException
             * @throws BadCredentialsException
             * @throws ConfigException
             */
            public function updatePortWeb($pweb, $web, $server)
            {
                $client = $this->getMikrotik($server);
                $updatePortWeb = new Query('/ip/firewall/nat/print');
                $updatePortWeb->where('dst-port', $web);
                $webs = $client->query($updatePortWeb)->read();

                foreach ($webs as $web) {
                    $updatePortWeb = (new Query('/ip/firewal/nat/set'))
                        ->equal('.id', $web['.id'])
                        ->equal('to-ports', $pweb);
                    $client->query($updatePortWeb)->read();
                }
            }
        // ==============web================

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function updatePassPpp($username, $password, $server)
    {
        $client = $this->getMikrotik($server);
        $updateTunnel = new Query('/ppp/secret/print');
        $updateTunnel->where('name', $username);
        $tunnelUsers = $client->query($updateTunnel)->read();

        foreach ($tunnelUsers as $tu) {
            $tu = (new Query('/ppp/secret/set'))
                ->where('name', $username)
                ->equal('.id', $tu['.id'])
                ->equal('password', $password);
            $client->query($tu)->read();
        }
    }
    //   delete ppp

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function deletePortApi($server, $pap)
    {
        $client = $this->getMikrotik($server);
        // ==============api================
        $updatePortApi = new Query('/ip/firewall/nat/print');
        $updatePortApi->where('dst-port', $pap);
        $upas = $client->query($updatePortApi)->read();

        foreach ($upas as $upa) {
            $updatePortWinbox = (new Query('/ip/firewal/nat/remove'))
                ->equal('.id', $upa['.id']);
            $client->query($updatePortWinbox)->read();
        }
        // ==============api================
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function deletePortWinbox($server, $win)
    {
        $client = $this->getMikrotik($server);
        // ==============winbox================
        $updatePortWinbox = new Query('/ip/firewall/nat/print');
        $updatePortWinbox->where('dst-port', $win);
        $wins = $client->query($updatePortWinbox)->read();

        foreach ($wins as $win) {
            $updatePortWinbox = (new Query('/ip/firewal/nat/remove'))
                ->equal('.id', $win['.id']);
            $client->query($updatePortWinbox)->read();
        }
        // ==============winbox================
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws BadCredentialsException
     * @throws QueryException
     * @throws ConfigException
     */
    public function deletePortWeb($server, $web)
    {
        $client = $this->getMikrotik($server);
        // ==============web================

        $updatePortWeb = new Query('/ip/firewall/nat/print');
        $updatePortWeb->where('dst-port', $web);
        $webs = $client->query($updatePortWeb)->read();

        foreach ($webs as $web) {
            $updatePortWeb = (new Query('/ip/firewal/nat/remove'))
                ->equal('.id', $web['.id']);
            $client->query($updatePortWeb)->read();
        }
        // ==============web================
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function deletePppSecret($username, $server)
    {
        $client = $this->getMikrotik($server);
        $updateTunnel = new Query('/ppp/secret/print');
        $updateTunnel->where('name', $username);
        $tunnelUsers = $client->query($updateTunnel)->read();

        foreach ($tunnelUsers as $tu) {
            $tu = (new Query('/ppp/secret/remove'))
                ->where('name', $username)
                ->equal('.id', $tu['.id']);
            $client->query($tu)->read();
        }
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function disableWithSch($server)
    {
        $client = $this->getMikrotik($server);
        $tunnels = Tunnel::get();
        foreach ($tunnels as $tunnel) {
            $expired = now()->gte($tunnel->expired); // compare current time to expired time
            if ($tunnel->status == 'nonaktif') {
                \Log::info('Tunnel '.$tunnel->username.' belum expired '.date('Y-m-d H:i:s'));
            } elseif ($expired) { // check if the tunnel is expired
                $userBalance = UserBalace::where('user_id', $tunnel->user_id)->first();
                $toDisable = 'yes';
                if ($userBalance && $userBalance->balance > 0 && $tunnel->auto_renew == 'yes') {
                    $tunnel->update([
                        'expired' => now()->addMonth(),
                    ]);
                    \Log::info("Akun tunnel $tunnel->username berhasil diperpanjang pada ".date('Y-m-d H:i:s'));
                } else {
                    $disableTunnel = new Query('/ppp/secret/print');
                    $disableTunnel->where('name', $tunnel->username);
                    $disabletnls = $client->query($disableTunnel)->read();

                    foreach ($disabletnls as $dtnl) {
                        $disable = (new Query('/ppp/secret/set')) // change variable name for clarity
                        ->where('name', $tunnel->username)
                            ->equal('.id', $dtnl['.id'])
                            ->equal('disabled', $toDisable);
                        $client->query($disable)->read();
                    }
                    $activeTunnels = $client->query('/ppp/active/print')->read();
                    foreach ($activeTunnels as $actv) {
                        $remove = (new Query('/ppp/active/remove'))
                            ->where('name', $tunnel->username)
                            ->equal('.id', $actv['.id']);
                        $client->query($remove)->read();
                    }
                    \Log::info("Akun tunnel $tunnel->username berhasil di-suspend pada ".date('Y-m-d H:i:s'));
                }
                $tunnel->update([
                    'balance' => $userBalance ? $userBalance->balance : 0, // update the balance of the tunnel user
                ]);
            }
        }
    }

//    public function disableWithSch($server)
//    {
//        $client = $this->getMikrotik($server);
//        $tunnels = Tunnel::get();
//
//        foreach ($tunnels as $tunnel) {
//            $expired = now()->gte($tunnel->expired); // compare current time to expired time
//            if ($tunnel->status == 'nonaktif') {
//                \Log::info('Tunnel ' . $tunnel->username . ' belum expired ' . date('Y-m-d H:i:s'));
//            } elseif ($expired) { // check if the tunnel is expired
//                $tunnel->update([
//                    'status' => 'nonaktif',
//                ]);
//                $toDisable = 'yes';
//                $disableTunnel = new Query('/ppp/secret/print');
//                $disableTunnel->where('name', $tunnel->username);
//                $disabletnls = $client->query($disableTunnel)->read();
//
//                foreach ($disabletnls as $dtnl) {
//                    $disable = (new Query('/ppp/secret/set')) // change variable name for clarity
//                    ->where('name', $tunnel->username)
//                        ->equal('.id', $dtnl['.id'])
//                        ->equal('disabled', $toDisable);
//                    $client->query($disable)->read();
//                }
//                $activeTunnels = $client->query('/ppp/active/print')->read();
//                foreach ($activeTunnels as $actv) {
//                    $remove = (new Query('/ppp/active/remove'))
//                        ->where('name' , $tunnel->username)
//                        ->equal('.id', $actv['.id']);
//                    $client->query($remove)->read();
//                }
//                \Log::info("Akun tunnel $tunnel->username berhasil di-suspend pada " . date('Y-m-d H:i:s'));
//            }
//        }
//    }

    /**
     * @throws ConnectException
     * @throws QueryException
     * @throws ClientException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function disablePpp($server, $username)
    {
        $client = $this->getMikrotik($server);
        $tunnels = Tunnel::get();
        foreach ($tunnels as $ignored1) {
            $toDisable = 'yes';
            $disableTunnel = new Query('/ppp/secret/print');
            $disableTunnel->where('name', $username);
            $disabletnls = $client->query($disableTunnel)->read();

            foreach ($disabletnls as $ignored) {
                $disable = (new Query('/ppp/secret/set'))
                ->where('name', $username)
                    ->equal('disabled', $toDisable);
                $client->query($disable)->read();
            }
        }
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws BadCredentialsException
     * @throws QueryException
     * @throws ConfigException
     */
    public function deleteActiveSecret($server, $username)
    {
        $client = $this->getMikrotik($server);
        $activeTunnels = $client->query('/ppp/active/print')->read();
        foreach ($activeTunnels as $actv) {
            $remove = (new Query('/ppp/active/remove'))
                ->where('name', $username)
                ->equal('.id', $actv['.id']);
            $client->query($remove)->read();
        }
    }

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function enablePppSecret($server, $username)
    {
        $client = $this->getMikrotik($server);
        $query = new Query('/ppp/secret/print');
        $query->where('name', $username);
        $disabledSecrets = $client->query($query)->read();
        foreach ($disabledSecrets as $disabledSecret) {
            $enable = (new Query('/ppp/secret/enable'))
                ->where('name', $username)
                ->equal('.id', $disabledSecret['.id']);
            $client->query($enable)->read();
        }
    }
}
