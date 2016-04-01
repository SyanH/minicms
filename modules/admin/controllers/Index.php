<?php

namespace modules\admin\controllers;

use vendor\Controller;

class Index extends Controller
{
	public function index()
	{
		//$this->module('auth')->pass('index', 'index');
		echo $this->render('module.admin@views/index.php');
	}

	public function testModal()
	{
		sleep(2);
		echo $this->render('module.admin@views/ajaxModal.php');
	}
}