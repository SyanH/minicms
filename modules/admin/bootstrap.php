<?php

$this['acl']->addResource('admin',['index','testModal']);

$this['acl']->allow('user', 'admin');

$this->map('GET', '/admin', 'modules\\admin\\controllers\\Index@index', 'admin.index');

$this->map('GET', '/admin/option', 'modules\\admin\\controllers\\Option@index', 'admin.option');

$this->map('GET', '/admin/ajaxModal', 'modules\\admin\\controllers\\Index@testModal', 'admin.modal');