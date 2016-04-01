<?php

namespace vendor\provider;

use vendor\interfaces\ServiceProviderInterface;
use vendor\Application;
use vendor\Db;

class DbServiceProvider implements ServiceProviderInterface
{
	public function register(Application $app)
	{
		$app['db'] = function($c) {
			$config = [
				'prefix' => $c['db.prefix'],
				'host'   => $c['db.host'],
				'dbname' => $c['db.dbname'],
				'user'   => $c['db.user'],
				'pw'     => $c['db.pw'],
			];
			$db = new Db($config);
			return $db;
		};
	}

}