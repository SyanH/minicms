<?php

use vendor\Helper;

$this->module('auth')->extend([
	'login' => function ($name, $password, $expire = 0) use ($app) {
		$selectField = filter_var($name, \FILTER_VALIDATE_EMAIL) === false ? 'username' : 'email';
		$app['db']->query(sprintf('SELECT uid,username,email,nickname,role,password FROM @table.user WHERE %s = :username', $selectField));
		$app['db']->bind(':username', $name);
		$user = $app['db']->fetch();
		if (false === $user) {
			return false;
		}
		$hashValidate = password_verify($password, $user['password']);
		if ($user && $hashValidate) {
			$authCode = function_exists('openssl_random_pseudo_bytes') ?
                bin2hex(openssl_random_pseudo_bytes(16)) : sha1(Helper::randString(20));
            $app['response']->setCookie('__' . $app['app.name'] . '_uid', $user['uid'], $expire);
            $infoRandString = Helper::randString(10);
            $hash = base64_encode(Helper::hash($authCode) . '|' . $infoRandString . $app['key']);
            $app['response']->setCookie('__' . $app['app.name'] . '_authCode', $hash, $expire);
            unset($user['password']);
            $infoHash = Helper::encode($app['key'] . '|' . implode('|', $user), $app['key'], true);
            $app['response']->setCookie('__' . $app['app.name'] . '_' . $infoRandString, $infoHash, $expire);
            $app['db']->query('UPDATE @table.user SET logintime = :logintime, authcode = :authcode WHERE uid = :uid');
            $app['db']->bindArray([
            	':logintime'   => time(),
            	':authcode' => $authCode,
            	':uid'      => $user['uid']
            ]);
            $app['db']->execute();
			return $user;
		}
		return false;
	},
	'logout' => function () use ($app) {
		$app['response']->deleteCookie('__' . $app['app.name'] . '_uid');
		$authCode = $app['request']->getCookie('__' . $app['app.name'] . '_authCode');
		if (null !== $authCode) {
			$code = explode('|', base64_decode($authCode), 2);
			$infoRandString = str_replace($app['key'], '', $code[1]);
			$app['response']->deleteCookie('__' . $app['app.name'] . '_' . $infoRandString);
			$app['response']->deleteCookie('__' . $app['app.name'] . '_authCode');
		}
	},
	'hasLogin' => function () use ($app) {
		$cookieUid = $app['request']->getCookie('__' . $app['app.name'] . '_uid');
		$cookieAuthCode = $app['request']->getCookie('__' . $app['app.name'] . '_authCode');
		if (null === $cookieUid || null === $cookieAuthCode) {
			return false;
		} else {
			$code = explode('|', base64_decode($cookieAuthCode), 2);
			if (count($code) !== 2) {
				return false;
			}
			$infoRandString = str_replace($app['key'], '', $code[1]);
			$cookieUserInfo = $app['request']->getCookie('__' . $app['app.name'] . '_' . $infoRandString);
			if (null === $cookieUserInfo) {
				return false;
			}
			$app['db']->query('SELECT authcode FROM @table.user WHERE uid = :uid');
			$app['db']->bind(':uid', intval($cookieUid));
			$user = $app['db']->fetch();
			if ($user && Helper::hashValidate($user['authcode'], $code[0])) {
                return true;
            }
            $this->logout();
		}
		return false;
	},
	'getUser' => function ($key = null) use ($app) {
		$cookieUid = $app['request']->getCookie('__' . $app['app.name'] . '_uid');
		$cookieAuthCode = $app['request']->getCookie('__' . $app['app.name'] . '_authCode');
		if (null === $cookieUid || null === $cookieAuthCode) {
			return null;
		} else {
			$code = explode('|', base64_decode($cookieAuthCode), 2);
			if (count($code) !== 2) {
				return null;
			}
			$infoRandString = str_replace($app['key'], '', $code[1]);
			$cookieUserInfo = $app['request']->getCookie('__' . $app['app.name'] . '_' . $infoRandString);
			if (null === $cookieUserInfo) {
				$this->logout();
				return null;
			}
			$info = explode('|', Helper::decode(base64_decode($cookieUserInfo), $app['key']));
			unset($info[0]);
			$userData = ['uid'=>$info[1], 'username'=>$info[2], 'email'=>$info[3], 'nickname'=>$info[4], 'role'=>$info[5]];
			if (null !== $key && isset($userData[$key])) {
				return $userData[$key];
			}
			return $userData;
		}
	},
	'pass' => function ($resource, $action, $return = false) use ($app) {
		if ($this->hasLogin()) {
			$userGroup = $this->getUser('role');
			if ($app['acl']->hasaccess($userGroup, $resource, $action)) {
				return true;
			}
		} else {
			if ($return) {
				return false;
			} else {
				$app['response']->redirect($app['app.url'], 301);
			}
		}

		if ($return) {
            return false;
        } else {
            $app['response']->setStatusCode(403);
            echo $app->render($app['root'] . '/Vendor/Views/403.php');
            $app->send();
        }
	}
]);

//添加管理员组
$this['acl']->addGroup('admin', true);
//添加用户组
$this['acl']->addGroup('user');

//路由
$this->map('GET|POST', '/login', 'modules\\auth\\controllers\\Auth@login', 'login');
$this->map('GET|POST', '/reg', 'modules\\auth\\controllers\\Auth@reg', 'reg');
$this->map('GET', '/logout', 'modules\\auth\\controllers\\Auth@logout', 'logout');
