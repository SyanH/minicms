<?php

namespace vendor;

class Module
{
    protected $app;
	protected $apis = array();

    public function __construct($app) {
        $this->app = $app;
    }

    public function extend($api)
    {
        foreach($api as $name => $value) {
            if ($value instanceof \Closure) {
                $value = $value->bindTo($this, $this);
            }
            $this->apis[$name] = $value;
        }
    }

    public function __set($name , $value)
    {
        $this->extend(array($name => $value));
    }

    public function __get($name)
    {
        return isset($this->apis[$name]) ? $this->apis[$name] :null;
    }

    public function __isset($name)
    {
        return isset($this->apis[$name]);
    }

    public function __unset($name)
    {
        unset($this->apis[$name]);
    }

    public function __call($name, $arguments)
    {
        if (isset($this->apis[$name]) && is_callable($this->apis[$name])) {
            return call_user_func_array($this->apis[$name], $arguments);
        }
        return null;
    }
}