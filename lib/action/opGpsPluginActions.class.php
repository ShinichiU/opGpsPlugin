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
  public function initialize($context, $moduleName, $actionName)
  {
    parent::initialize($context, $moduleName, $actionName);

    $this->security['all'] = array('is_secure' => true, 'credentials' => 'SNSMember');
  }

  public function preExecute()
  {
    require_once 'Net/UserAgent/Mobile/GPS.php';
    $this->carrier = opCarrierCheck::checkCarrier();

    if (is_callable(array($this->getRoute(), 'getObject')))
    {
      $object = $this->getRoute()->getObject();
      if ($object instanceof MemberGpsPosition)
      {
        $this->memberGpsPosition = $object;
        $this->member = $this->memberGpsPosition->getMember();
      }
      elseif ($object instanceof Member)
      {
        $this->member = $object;
      }
    }

    if (empty($this->member))
    {
      $this->member = $this->getUser()->getMember();
    }
    elseif ($this->member->getId() !== $this->getUser()->getMemberId())
    {
      $relation = Doctrine::getTable('MemberRelationship')->retrieveByFromAndTo($this->member->getId(), $this->getUser()->getMemberId());
      $this->forwardIf($relation && $relation->getIsAccessBlock(), 'default', 'error');
    }
  }

  public function postExecute()
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->setNavigation($this->member);

      // to display header navigations
      $this->setIsSecure();
    }

    if ($this->pager instanceof sfPager)
    {
      $this->pager->init();
    }
  }

  protected function setNavigation(Member $member)
  {
    if ($member->getId() !== $this->getUser()->getMemberId())
    {
      sfConfig::set('sf_nav_type', 'friend');
      sfConfig::set('sf_nav_id', $member->getId());
    }
  }

  protected function setIsSecure()
  {
    if (!$this->isSecure())
    {
      $security = $this->getSecurityConfiguration();

      $actionName = strtolower($this->getActionName());

      $security[$actionName]['is_secure'] = true;

      $this->setSecurityConfiguration($security);
    }
  }
}
