<?php

namespace modules\auth\controllers;

use vendor\Controller;

class Auth extends Controller
{
	public function login()
	{
		if ($this->app['request']->isAjax()) {
			$param = $this->app['request']->getArray(['name', 'password', 'rememberMe']);
			$expire = $param['rememberMe'] == 1 ? 86400 : 0;
			$return = $this->module('auth')->login($param['name'], $param['password'], $expire);
			if ($return) {
				echo $this->app->json(['status'=>1]);
			} else {
				echo $this->app->json(['status'=>0]);
			}
		} else {
			if ($this->module('auth')->hasLogin()) { //登录过直接跳转首页
				$this->app['response']->redirect($this->app['app.url'], 301);
			}
			echo $this->render('module.auth@views/login.php');
		}
	}

	public function logout()
	{
		$this->module('auth')->logout();
		//退出后跳转首页
		$this->app['response']->redirect($this->app['app.url'], 301);
	}
}