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
class opGpsPluginGpsActions extends opGpsPluginActions
{
 /**
  * Executes list action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeList(sfWebRequest $request)
  {
    $this->pager = Doctrine::getTable('MemberGpsPosition')->getGpsPager($request->getParameter('page'));
  }

 /**
  * Executes list action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeShow(sfWebRequest $request)
  {
    $this->form = new sfForm();
  }

 /**
  * Executes list member action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeListMember(sfWebRequest $request)
  {
    $this->pager = Doctrine::getTable('MemberGpsPosition')->getMemberGpsPager($this->member->getId(), $request->getParameter('page'));
  }

 /**
  * Executes list member action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeListFriend(sfWebRequest $request)
  {
    $this->pager = Doctrine::getTable('MemberGpsPosition')->getFriendGpsPager($this->getUser()->getMemberId(), $request->getParameter('page'));
  }

 /**
  * Executes create action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeCreate(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $memberGpsPosition = Doctrine::getTable('MemberGpsPosition')
      ->addGpsPosition($this->getPosition(), $this->carrier);

    if ($memberGpsPosition)
    {
      $this->getUser()->setFlash('notice', 'send foot path success.');
      $this->redirect('@gps_show?id='.$memberGpsPosition->getId());
    }

    $this->getUser()->setFlash('error', 'couldn\'t get foot path.');
    $this->redirect('@homepage');
  }

 /**
  * Executes list member action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $this->memberGpsPosition->delete();

    $this->getUser()->setFlash('notice', 'delete foot path success.');
    $this->redirect('@homepage');
  }

  protected function getPosition()
  {
    $carrierGps = Net_UserAgent_Mobile_GPS::factory();

    return $carrierGps->getGPSResponse();
  }

}
