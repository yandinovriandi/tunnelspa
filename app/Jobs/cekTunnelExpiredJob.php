<?php

namespace App\Jobs;

use App\Models\Server;
use App\Repositories\RouterOsRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class cekTunnelExpiredJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private RouterOsRepository $routerOsRepository;

    public function __construct(RouterOsRepository $routerOsRepository)
    {
        $this->routerOsRepository = $routerOsRepository;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
//        $server = Server::first(); // contoh server, sesuaikan dengan kebutuhan
//        $this->routerOsRepository->disableWithSch($server);
    }
}
