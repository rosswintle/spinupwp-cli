<?php

namespace App\Commands\Sites;

use App\Services\SpinupApiService;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class SiteList extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'sites:list';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'List sites';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(SpinupApiService $api)
    {
        $this->info('Sites list');
        $sites = collect(($api->listSites())->toArray());

        $headers = ['Domain', 'Site user', 'Git branch'];

        $sitesInfo = $sites->map(function ($site) {
            $info = [
                'domain' => $site->domain,
                'site_user' => $site->site_user,
                'git_branch' => $site->git['enabled'] ? $site->git['branch'] : 'disabled',
            ];
            return $info;
        });

        $this->table($headers, $sitesInfo);
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
