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
class opGpsPluginGpsComponents extends sfComponents
{
  public function executeGpsList()
  {
    $max = ($this->gadget) ? $this->gadget->getConfig('max') : 5;
    $this->gpsList = Doctrine::getTable('MemberGpsPosition')->getGpsList($max);
  }

  public function executeMyGpsList()
  {
    $max = ($this->gadget) ? $this->gadget->getConfig('max') : 5;
    $this->gpsList = Doctrine::getTable('MemberGpsPosition')->getMemberGpsList($this->getUser()->getMemberId(), $max, $this->getUser()->getMemberId());
  }

  public function executeFriendGpsList()
  {
    $max = ($this->gadget) ? $this->gadget->getConfig('max') : 5;
    $this->gpsList = Doctrine::getTable('MemberGpsPosition')->getFriendGpsList($this->getUser()->getMemberId(), $max);
  }

  public function executeMemberGpsList(sfWebRequest $request)
  {
    $this->memberId = $request->getParameter('id', $this->getUser()->getMemberId());
    $this->gpsList = Doctrine::getTable('MemberGpsPosition')->getMemberGpsList($this->memberId, 5, $this->getUser()->getMemberId());
  }
}
