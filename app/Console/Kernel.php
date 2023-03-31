<?php

namespace App\Console;


use App\Models\Server;
use App\Models\Tunnel;
use App\Models\UserBalace;
use App\Repositories\RouterOsRepository;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use RouterOS\Query;

class Kernel extends ConsoleKernel
{

//    protected $routerOSRepository;
//
//    public function __construct(RouterOSRepository $routerOSRepository)
//    {
//        parent::__construct($routerOSRepository);
//        $this->routerOSRepository = $routerOSRepository;
//    }
    /**
     * Define the application's command schedule.
     */

    public function disableWithSch()
    {
        $routerOSRepository = new RouterOsRepository();
        $tunnels = Tunnel::get();
        foreach ($tunnels as $tunnel) {
            $server = Server::where('id',$tunnel->server_id)->first();
            $client = $routerOSRepository->getMikrotik($server);
            $expired = now()->gte($tunnel->expired); // compare current time to expired time
            if ($tunnel->status == 'nonaktif') {
                \Log::info('Tunnel ' . $tunnel->username . ' belum expired ' . date('Y-m-d H:i:s'));
            } elseif ($expired) { // check if the tunnel is expired
                $userBalance = UserBalace::where('user_id', $tunnel->user_id)->first();
                $toDisable = 'yes';
                if ($userBalance && $userBalance->balance >= 5000 && $tunnel->auto_renew == 'yes') {
                    $tunnel->update([
                        'expired' => now()->addMonth(),
                    ]);
                    $userBalance->create([
                        'balance' => -5000,
                        'user_id' => $tunnel->user_id
                    ]);
                    \Log::info("Akun tunnel $tunnel->username berhasil diperpanjang pada " . date('Y-m-d H:i:s'));
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
                            ->where('name' , $tunnel->username)
                            ->equal('.id', $actv['.id']);
                        $client->query($remove)->read();
                    }
                    \Log::info("Akun tunnel $tunnel->username berhasil di-suspend pada " . date('Y-m-d H:i:s'));
                }
            }
        }
    }

    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
            $this->disableWithSch();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
