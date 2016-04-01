<?php

$this->module('home')->test = function () {
	return 'test module~';
};
//首页路由
$this->map('GET', '/', 'modules\\home\\controllers\\Index@index', 'index');

$this->map('GET', '/editor', 'modules\\home\\controllers\\Index@editor', 'editor');

//测试闭包路由
$this->map('GET', '/test', function () {
	$this->module('auth')->pass('index', 'index');
	var_dump($this->module('auth')->getUser());
});

$this['acl']->addResource('index',['index']);

