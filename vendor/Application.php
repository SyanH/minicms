<?php

namespace vendor;

use vendor\interfaces\ServiceProviderInterface;

class Application extends Container
{
    public $viewvars    = [];

	protected $events   = [];

    protected $paths   = [];

    protected $modules = [];

    public function __construct(array $values = [])
    {
        ob_start();
        $this['app.version']        = '0.1';
    	$this['debug']          = true;
        $this['debug.log']      = true;
        $this['debug.log.path'] = '';
        $this['cache.path']     = '';
        $this['timezone']       = 'Asia/Shanghai';
        $this['app.name']       = 'syan';
        $this['app.url']        = '';
        $this['root']           = '';
    	$this['charset']        = 'UTF-8';
        $this['key']        = 'SfE9SD7j23h23*98WR2';
        parent::__construct($values);

        date_default_timezone_set($this['timezone']);
        
        $this['router'] = function() {
            return new Router();
        };
        $this['request'] = function() {
            return new Request();
        };
        $this['response'] = function() {
            return new Response();
        };
        if ($this['app.url'] == '') {
            $this['app.url'] = $this['request']->getRequestRoot();
        }
        if ($this["root"] == '') {
            $this["root"] = str_replace(DIRECTORY_SEPARATOR, '/', isset($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : dirname($_SERVER['SCRIPT_FILENAME']));
        }
        if($this['debug.log.path'] == '') {
            $this['debug.log.path'] = $this['root'] . '/Storage/logs';
        }
        if($this['cache.path'] == '') {
            $this['cache.path'] = $this['root'] . '/Storage/caches';
        }
        $this['log'] = function($c) {
            return new Logger($c['debug.log.path']);
        };
    	$this['response']->setCharset($this['charset']);
    }

    public function register(ServiceProviderInterface $provider, array $values = [])
    {
        parent::register($provider, $values);
        return $this;
    }

    public function path($name, $path = '')
    {
        if (empty($path)) {
            $parts = explode('@', $name, 2);
            if (count($parts) == 2 && isset($this->paths[$parts[0]])) {
                return $this->paths[$parts[0]] . $parts[1];
            }
            throw new \Exception("没有找到名称为 \"{$name}\" 的path，可能没有定义.");
        } else {
            $this->paths[$name] = rtrim(str_replace(DIRECTORY_SEPARATOR, '/', $path), '/') . '/';
        }
    }

    public function pathUrl($path)
    {
        $file = str_replace(DIRECTORY_SEPARATOR, '/', $this->path($path));
        $root = str_replace(DIRECTORY_SEPARATOR, '/', $this['root']);
        $url = '/'.ltrim(str_replace($root, '', $file), '/');
        return $this['app.url'] . implode('/', array_map('rawurlencode', explode('/', $url)));
    }

    public function assets($path)
    {
        $version = $this['debug'] ? time() : $this['app.version'];
        $pathUrl = $this->pathUrl($path);
        return $pathUrl . '?v=' . $version;
    }

    public function render($____template, $_____slots = [])
    {
        $_____slots = array_merge($this->viewvars, $_____slots);
        if (strpos($____template, '@') !== false) {
            $____template = $this->path($____template);
        }
        extract($_____slots, EXTR_REFS | EXTR_SKIP);
        ob_start();
        include $____template;
        return ob_get_clean();
    }

    public function e($string, $charset=null)
    {
        if (is_null($charset)) {
            $charset = $this["charset"];
        }
        return htmlspecialchars($string, ENT_QUOTES, $charset);
    }

    public function on($event, $callback, $priority = 0)
    {
        if (!isset($this->events[$event])) $this->events[$event] = [];
        // make $this available in closures
        if (is_object($callback) && $callback instanceof \Closure) {
            $callback = $callback->bindTo($this);
        }
        $this->events[$event][] = ["fn" => $callback, "prio" => $priority];
    }

    public function trigger($event,$params=[])
    {
        if (!isset($this->events[$event])){
            return $this;
        }
        if (!count($this->events[$event])){
            return $this;
        }
        $queue = new \SplPriorityQueue();
        foreach($this->events[$event] as $index => $action){
            $queue->insert($index, $action["prio"]);
        }
        $queue->top();
        while($queue->valid()){
            $index = $queue->current();
            if (is_callable($this->events[$event][$index]["fn"])){
                if (call_user_func_array($this->events[$event][$index]["fn"], $params) === false) {
                    break; // stop Propagation
                }
            }
            $queue->next();
        }
        return $this;
    }

    public function hasEvent($name)
    {
    	if (isset($this->events[$name]) and count($this->events[$name])){
            return true;
        }
        return false;
    }

    public function json($data, $cb = false)
    {
        if ($cb) {
            $this['response']->setHeader('content-type', 'application/javascript; charset=UTF-8');
            echo sprintf('%s(%s)', $cb, json_encode($data));
        } else {
            $this['response']->setHeader('content-type', 'application/json; charset=UTF-8');
            echo json_encode($data);
        }
    }

    public function map($method, $route, $target, $name = null)
    {
        $this['router']->map($method, $route, $target, $name);
    }

    public function urlFor($routeName, array $params = [])
    {
        return $this['app.url'] . $this['router']->generate($routeName, $params);
    }

    public function run($pathinfo = null, $method = null)
    {
        $pathinfo = is_null($pathinfo) ? $this['request']->getPathInfo() : $pathinfo;
        $method = is_null($method) ? $this['request']->getMethod() : $method;
        $match = $this['router']->match($pathinfo, $method);
        if ($match) {
        	$this['routerName'] = $match['name'];
        	$this['request']->setParams($match['params']);
            if (is_object($match['target']) && $match['target'] instanceof \Closure && is_callable($match['target'])) {
                $match['target'] = $match['target']->bindTo($this);
                call_user_func($match['target'], $match['params']);
            } elseif (is_string($match['target']) && strpos($match['target'], '@') !== false) {
                list($controller, $method) = explode('@', $match['target'], 2);
                $controllerInstance = new $controller($this);
                if (method_exists($controllerInstance, $method)) {
                    call_user_func_array(array($controllerInstance, $method), $match['params']);
                } else {
                	throw new \Exception("没有在控制器 \"{$controller}\" 中找到 \"{$method}\" 方法.");
                }
            } else {
            	throw new \Exception("匹配的路由不可调用.");
            }
        } else {
            $this['response']->setStatusCode(404);
        	if ($this->hasEvent('404')) {
        		$this->trigger("404");
        	} else {
                echo $this->render('Views/404.php');
        	}
        }
        $this->send();
    }

    public function send()
    {
        $output = ob_get_clean();
        $this->trigger("end", [&$output]);
        $this['response']->setHeader('X-Powered-By', $this['app.name']);
        if ($this['debug']) $this->noCache();
        $this['response']->setResult((string) $output)->respond();
    }

    public function noCache()
    {
        $this['response']->setHeader('Pragma', 'no-cache');
        $this['response']->setHeader('Cache-Control', 'no-store, no-cache');
        return $this;
    }

    public function module($name) {
        return isset($this->modules[$name]) && $this->modules[$name] ? $this->modules[$name] : null;
    }

    public function registerModule($name, $dir)
    {

        $name = strtolower($name);

        if (!isset($this->modules[$name])) {

            $module = new Module($this);

            $module->_dir      = $dir;
            $module->_bootfile = "{$dir}/bootstrap.php";

            $this->path('module.' . $name, $dir);

            $this->modules[$name] = $module;

            $this->bootModule($module);
        }

        return $this->modules[$name];
    }

    public function loadModules($dirs)
    {

        $modules = [];
        $dirs    = (array)$dirs;

        foreach ($dirs as &$dir) {

            if (file_exists($dir)){

                // load modules
                foreach (new \DirectoryIterator($dir) as $module) {

                    if($module->isFile() || $module->isDot()) continue;

                    $this->registerModule($module->getBasename(), $module->getRealPath());

                    $modules[] = strtolower($module);
                }

            }
        }

        return $modules;
    }

    protected function bootModule($module)
    {
        $app = $this;
        require($module->_bootfile);
    }

    //注册自定义错误和异常处理函数
    public function registerErrorHandler()
    {
        $app = $this;
        set_error_handler(function ($errno, $errStr, $errFile, $errLine) use ($app) {
            $error = ['msg'=>$errStr, 'file'=>$errFile,'line'=>$errLine];
            if ($this['debug.log']) {$this['log']->error($error);}
            while(ob_get_level() > 0) ob_end_clean();
            ob_start();
            if ($app['debug']) {
                echo $this->render('Views/debug.php', $error);
            } else {
                echo $this->render('Views/500.php');
            }
            $app['response']->setStatusCode(500);
            $app->send();
        });
        set_exception_handler(function ($e) use ($app) {
            $exception = ['msg'=>$e->getMessage(), 'file'=>$e->getFile(), 'line'=>$e->getLine()];
            if ($this['debug.log']) {$this['log']->exception($exception);}
            while(ob_get_level() > 0) ob_end_clean();
            ob_start();
            if ($app['debug']) {
                echo $app->render('Views/debug.php', ['e'=>$e]);
            } else {
                echo $this->render('Views/500.php');
            }
            $app['response']->setStatusCode(500);
            $app->send();
        });
        register_shutdown_function(function () use ($app) {
            $last_error = error_get_last();
            if($last_error !== null) {
                $error = ['msg'=>$last_error['message'], 'file'=>$last_error['file'],'line'=>$last_error['line']];
                if ($this['debug.log']) {$this['log']->error($error);}
                while(ob_get_level() > 0) ob_end_clean();
                ob_start();
                if ($app['debug']) {
                    echo $this->render('Views/debug.php', $error);
                } else {
                    echo $this->render('Views/500.php');
                }
                $app['response']->setStatusCode(500);
                $app->send();
            }
        });
    }
}