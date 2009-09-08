<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * Gps routing.
 *
 * @package    OpenPNE
 * @author     Shinichi Urabe <urabe@tejimaya.com>
 */
class opGpsPluginRouting
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $routing = $event->getSubject();

    $routes = array(
      'gps_index' => new sfRoute(
        '/gps',
        array('module' => 'gps', 'action' => 'index')
      ),
      'gps_send' => new sfRoute(
        '/gps/send',
        array('module' => 'gps', 'action' => 'send')
      ),
      'gps_nodefaults' => new sfRoute(
        '/gps/*',
        array('module' => 'default', 'action' => 'error')
      )
    );

    $routes = array_reverse($routes);
    foreach ($routes as $name => $route)
    {
      $routing->prependRoute($name, $route);
    }
  }
}
