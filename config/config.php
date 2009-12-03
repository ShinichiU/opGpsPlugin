<?php
sfToolkit::addIncludePath(dirname(__FILE__).'/../lib/vendor/PEAR/');
$this->dispatcher->connect('routing.load_configuration', array('opGpsPluginRouting', 'listenToRoutingLoadConfigurationEvent'));

sfConfig::set('google_map_api_key', '');
