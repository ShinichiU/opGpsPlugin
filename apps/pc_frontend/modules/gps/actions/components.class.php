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
  public function executeNowPosition()
  {
    $this->recentGpsList = Doctrine::getTable('MemberGpsPosition')
      ->getMemberGpsList
      (
        $this->member->getId(),
        5,
        $this->getUser()->getMemberId()
      );
  }

  public function executeInfomationNowPosition($request)
  {
    $this->recentGpsList = Doctrine::getTable('MemberGpsPosition')
      ->getMemberGpsList
      (
        $request->getParameter('id', $this->getUser()->getMemberId()),
        1,
        $this->getUser()->getMemberId()
      );
  }

  public function executeGooglemap($request)
  {
  }
}
