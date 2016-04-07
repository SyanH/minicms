<?php

namespace modules\home\controllers;

use vendor\Controller;

class Index extends Controller
{
	public function index()
	{
		//$this->app['db']->query('SELECT title FROM @table.blog');
		//$data = $this->app['db']->fetchAll();
		//echo $this->render('module.home@views/index.php', ['title'=>'标题', 'content'=>'内容!', 'data'=>$data]);
		echo time();
	}

	public function editor()
	{
		echo $this->render('module.home@views/editor.php');
	}
}