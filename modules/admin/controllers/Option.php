<?php

namespace modules\admin\controllers;

use vendor\Controller;

class Option extends Controller
{
	public function index()
	{
		echo $this->render('module.admin@views/option.php', ['mainTitle' => '站点设置']);
	}

}