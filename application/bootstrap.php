<?php

require 'core/ClassLoader.php';

$loader = new ClassLoader();
$loader->resisterDir(dirname(__FILE__).'/core');
$loader->resisterDir(dirname(__FILE__).'/models');
$loader->register();
