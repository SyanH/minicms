<?php

$this->module('home')->test = function () {
	return 'test module~';
};
//首页路由
$app->map('GET', '/', 'modules\\home\\controllers\\Index@index', 'index');

$app->map('GET', '/editor', 'modules\\home\\controllers\\Index@editor', 'editor');


//测试闭包路由
$app->map('GET', '/test', function () {
	$this->module('auth')->pass('test', 'index');
	var_dump($this->module('auth')->getUser());
});

$app['acl']->addResource('index',['index']);

$app['acl']->addResource('test',['index']);
$app['acl']->allow('user','test', 'index');