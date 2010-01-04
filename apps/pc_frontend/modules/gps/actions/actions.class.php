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
class gpsActions extends opGpsPluginGpsActions
{
 /**
  * Executes googlemap action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeGooglemap(sfWebRequest $request)
  {
  }
 /**
  * Executes list action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new sfForm();
  }
 /**
  * Executes create action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeCreate(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $lat = $request->getParameter('lat');
    $lon = $request->getParameter('lon');
    if ($lat && $lon)
    {
      $memberGpsPosition = Doctrine::getTable('MemberGpsPosition')->addGpsPcPosition($lat, $lon, $this->carrier);
      $this->getUser()->setFlash('notice', 'send foot path success.');
      $this->redirect('@gps_show?id='.$memberGpsPosition->getId());
    }

    $this->getUser()->setFlash('error', 'couldn\'t get foot path.');
    $this->redirect('@homepage');
  }
}
