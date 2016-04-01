<?php

define('ROOT', __DIR__);

function autoLoad($path, $namespace = NULL)
{
    spl_autoload_register(function ($class) use ($path, $namespace) {
        if (!empty($namespace)) {
            if (0 == strpos(ltrim($class, '\\'), $namespace . '\\')) {
                $class = substr(ltrim($class, '\\'), strlen($namespace) + 1);
            } else {
                return;
            }
        }
        $file = $path . '/' . str_replace(array('_', '\\'), '/', $class) . '.php';
        if (file_exists($file)) {
            include_once $file;
        }
    });
}

autoLoad(ROOT . '/vendor', 'vendor');

autoLoad(ROOT . '/modules', 'modules');

$configs = [
    'app.name'    => 'syan',
    'root'        => __DIR__,
    'debug'       => true,
    'debug.log'   => false,
    'db.prefix' => 'test_',
    'db.host'   => '127.0.0.1',
    'db.dbname' => 'testdb',
    'db.user'   => 'root',
    'db.pw'     => ''
];

// 实例化应用
$app = new vendor\Application($configs);

$app->registerErrorHandler();

$app->register(new vendor\provider\AclServiceProvider);

$app->register(new vendor\provider\CacheServiceProvider);

$app->register(new vendor\provider\DbServiceProvider);

$app->loadModules([ROOT . '/modules']);

$app->trigger('app.init')->run();
