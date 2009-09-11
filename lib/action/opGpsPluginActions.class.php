<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * gps actions.
 *
 * @package    OpenPNE
 * @subpackage gps
 * @author     Shinichi Urabe <urabe@tejimaya.com>
 */
class opGpsPluginActions extends sfActions
{
  public function preExecute ()
  {
    require_once 'Net/UserAgent/Mobile/GPS.php';
    $this->carrier = opCarrierCheck::checkCarrier();
    try {
      $this->carrierGps = Net_UserAgent_Mobile_GPS::factory();
    } catch (Net_UserAgent_Mobile_GPS_Exception $e) {

      return sfView::ERROR;
    }
  }

 /**
  * Executes index action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }

 /**
  * Executes send action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeSend(sfWebRequest $request)
  {

    $positon = $this->carrierGps->getGPSResponse();
    if ($positon['lat'] && $positon['lon']) {
      $gpsInsert = new MemberGpsPosition();
      $gpsInsert
        ->setMemberId($this->getUser()->getMemberId())
        ->setLat($positon['lat'])
        ->setLon($positon['lon'])
        ->setCarrier($this->carrier)
        ->save();
    }

    $this->redirect('gps/index');
  }

}
