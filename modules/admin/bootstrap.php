<?php

$this->map('GET', '/admin', 'modules\\admin\\controllers\\Index@index', 'admin.index');

$this->map('GET', '/admin/ajaxModal', 'modules\\admin\\controllers\\Index@testModal', 'admin.modal');