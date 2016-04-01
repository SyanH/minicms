<?php

namespace vendor\provider;

use vendor\interfaces\ServiceProviderInterface;
use vendor\Application;
use vendor\Acl;

class AclServiceProvider implements ServiceProviderInterface
{
	public function register(Application $app)
	{
		$app['acl'] = function() {
			return new Acl();
		};
	}

}