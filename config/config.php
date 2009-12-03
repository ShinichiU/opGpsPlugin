<?php
sfToolkit::addIncludePath(dirname(__FILE__).'/../lib/vendor/PEAR/');
$this->dispatcher->connect('routing.load_configuration', array('opGpsPluginRouting', 'listenToRoutingLoadConfigurationEvent'));

sfConfig::set('google_maps_api_key', '');
sfConfig::set('google_ajax_search_api_key', '');
