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
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class gpsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    require_once 'PEAR/Net/UserAgent/Mobile/GPS.php';
    try {
      $this->carrierGps = Net_UserAgent_Mobile_GPS::factory();
    } catch (Net_UserAgent_Mobile_GPS_Exception $e) {
      return sfView::ERROR;
    }

    return sfView::SUCCESS;
  }
}
