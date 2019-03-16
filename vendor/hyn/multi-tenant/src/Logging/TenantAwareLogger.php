<?php

/*
 * This file is part of the hyn/multi-tenant package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://laravel-tenancy.com
 * @see https://github.com/hyn/multi-tenant
 */

namespace Hyn\Tenancy\Logging;

use Monolog\Logger;
use Illuminate\Support\Carbon;
use Hyn\Tenancy\Website\Directory;
use Monolog\Handler\StreamHandler;

class TenantAwareLogger
{
    /**
     * Create a custom Monolog instance and pipe logs to the tenant directory.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $log = new Logger('tenant');
        $level = $log->toMonologLevel($config['level'] ?: 'debug');
        $tenantDirectory = app(Directory::class);
        $directoryPath = $tenantDirectory->getWebsite() ? 'app/tenancy/tenants/' . $tenantDirectory->path() : null;

        $logPath = storage_path($directoryPath . 'logs/' . $config['level'] . '_' . Carbon::now()->toDateString() . '.log');
        $log->pushHandler(new StreamHandler($logPath, $level, false));

        return $log;
    }
}
