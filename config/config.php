<?php
sfToolkit::addIncludePath(array(
  dirname(__FILE__).'/../lib/vendor/PEAR/',
  dirname(__FILE__).'/../lib/vendor/Geomobilejp/',
));
require_once 'Net/UserAgent/Mobile/GPS.php';
require_once 'Converter.php';
require_once 'Mobile.php';
require_once 'IArea.php';

$this->dispatcher->connect('routing.load_configuration', array('opGpsPluginRouting', 'listenToRoutingLoadConfigurationEvent'));
