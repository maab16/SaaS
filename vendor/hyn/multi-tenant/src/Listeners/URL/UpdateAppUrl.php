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

namespace Hyn\Tenancy\Listeners\URL;

use Hyn\Tenancy\Contracts\CurrentHostname;
use Hyn\Tenancy\Contracts\Hostname;
use Hyn\Tenancy\Events\Websites\Identified;
use Hyn\Tenancy\Events\Websites\Switched;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\URL;

class UpdateAppUrl
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen([Identified::class, Switched::class], [$this, 'force']);
    }

    /**
     * @param Identified|Switched $event
     */
    public function force($event)
    {
        if (config('tenancy.hostname.update-app-url', false)) {
            $scheme = optional(request())->getScheme() ?? parse_url(config('app.url', PHP_URL_SCHEME));

            /** @var Hostname $hostname */
            $hostname = $event->hostname ?? $event->website->hostnames->first();

            if ($hostname) {
                $url = sprintf('%s://%s', $scheme, $hostname->fqdn);

                config([
                    'app.url' => $url
                ]);

                URL::forceRootUrl($url);
            }
        }
    }
}
