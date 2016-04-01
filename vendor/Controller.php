<?php

namespace vendor;

class Controller
{
	protected $app;

	public function __construct($app)
	{
		$this->app = $app;
	}

	public function render($template, $slots = [])
	{
		return $this->app->render($template, $slots);
	}

	public function module($name)
	{
		return $this->app->module($name);
	}
}