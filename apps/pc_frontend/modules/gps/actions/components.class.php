<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * gps components.
 *
 * @package    OpenPNE
 * @subpackage gps
 * @author     Shinichi Urabe <urabe@tejimaya.com>
 */
class gpsComponents extends opGpsPluginGpsComponents
{
  public function executeInfomationNowPosition($request)
  {
    $this->carrier = opCarrierCheck::checkCarrier();
    $this->recentGpsList = Doctrine::getTable('MemberGpsPosition')
      ->getFriendGpsList($this->getUser()->getMemberId(), 1);
  }
}
