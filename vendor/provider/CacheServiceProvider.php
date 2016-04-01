<?php

namespace Vendor\Provider;

use Vendor\Interfaces\ServiceProviderInterface;
use Vendor\Application;
use Vendor\Cache;

class CacheServiceProvider implements ServiceProviderInterface
{
	public function register(Application $app)
	{
		$app['cache'] = function($c) {
			$cache = new Cache();
			$cache->setPrefix($c['app.name']);
			$cache->setCachePath($c['cache.path']);
			return $cache;
		};
	}

}