<?php

require_once __DIR__.'/../app/bootstrap.php.cache';
require_once __DIR__.'/../app/AppKernel.php';
require_once __DIR__.'/../app/AppCache.php';

use Symfony\Component\HttpFoundation\Request;

$kernel = new AppKernel('staging', false);
$kernel->loadClassCache();
$kernel = new AppCache($kernel);
Request::trustProxyData();
$kernel->handle(Request::createFromGlobals())->send();
