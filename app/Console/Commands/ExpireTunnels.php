<?php

namespace App\Console\Commands;

use App\Http\Controllers\TunnelController;
use App\Models\Server;
use App\Repositories\RouterOsRepository;
use Illuminate\Console\Command;

class ExpireTunnels extends Command
{
    private $routerOsRepository;

    public function __construct(RouterOsRepository $routerOsRepository)
    {
        parent::__construct();
        $this->routerOsRepository = $routerOsRepository;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-tunnels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $server = Server::first(); // contoh server, sesuaikan dengan kebutuhan
        $this->routerOsRepository->disableWithSch($server);
    }
}
