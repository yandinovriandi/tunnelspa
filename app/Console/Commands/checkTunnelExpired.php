<?php

namespace App\Console\Commands;


use App\Repositories\RouterOsRepository;
use Illuminate\Console\Command;
use RouterOS\Exceptions\BadCredentialsException;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\ConnectException;
use RouterOS\Exceptions\QueryException;

class checkTunnelExpired extends Command
{
    private RouterOsRepository $routerOsRepository;

    public function __construct(RouterOsRepository $routerOsRepository)
    {
        $this->routerOsRepository = $routerOsRepository;
        parent::__construct();
    }

    protected $signature = 'checkTunnelExpired:cron';

    protected $description = 'Cek Tunnel Expired';

    /**
     * @throws ClientException
     * @throws ConnectException
     * @throws QueryException
     * @throws BadCredentialsException
     * @throws ConfigException
     */
    public function handle(): void
    {
        $this->routerOsRepository->checkExpiredPpp();
    }
}
