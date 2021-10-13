<?php

namespace App\Commands\Sites;

use App\Services\SpinupApiService;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class ServerList extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'servers:list';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'List servers';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(SpinupApiService $api)
    {
        $this->info('Server list');
        $sites = collect(($api->listServers())->toArray());

        $headers = ['Server name', 'IP Address'];

        $serverInfo = $sites->map(function ($server) {
            return [
                'server' => $server->name,
                'ip_address' => $server->ip_address,
            ];
        });

        $this->table($headers, $serverInfo);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
