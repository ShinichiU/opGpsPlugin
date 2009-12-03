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
      'gps_list' => new sfRoute(
        '/gps',
        array('module' => 'gps', 'action' => 'list')
      ),
      'gps_show' => new sfDoctrineRoute(
        '/gps/:id',
        array('module' => 'gps', 'action' => 'show'),
        array('id' => '\d+'),
        array('model' => 'MemberGpsPosition', 'type' => 'object')
      ),
      'gps_list_mine' => new sfRoute(
        '/gps/listMember',
        array('module' => 'gps', 'action' => 'listMember')
      ),
      'gps_list_member' => new sfDoctrineRoute(
        '/gps/listMember/:id',
        array('module' => 'gps', 'action' => 'listMember'),
        array('id' => '\d+'),
        array('model' => 'Member', 'type' => 'object')
      ),
      'gps_list_friend' => new sfRoute(
        '/gps/listFriend',
        array('module' => 'gps', 'action' => 'listFriend')
      ),
      'gps_new' => new sfRoute(
        '/gps/new',
        array('module' => 'gps', 'action' => 'new'),
        array('_csrf_token' => '\w+', 'sf_method' => array('get'))
      ),
      'gps_create' => new sfRoute(
        '/gps/create',
        array('module' => 'gps', 'action' => 'create'),
        array('_csrf_token' => '\w+', 'sf_method' => array('get'))
      ),
      'gps_delete' => new sfDoctrineRoute(
        '/gps/:id/delete',
        array('module' => 'gps', 'action' => 'delete'),
        array('id' => '\d+', 'sf_method' => array('post')),
        array('model' => 'MemberGpsPosition', 'type' => 'object')
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
