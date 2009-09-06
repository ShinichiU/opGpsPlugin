<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * PluginGps
 *
 * @package    opGpsPlugin
 * @author     Shinichi Urabe <urabe@tejimaya.com>
 */
abstract class PluginMemberGpsPosition extends BaseMemberGpsPosition
{
  protected $previous, $next;

  public function getPrevious($myMemberId = null)
  {
    if (is_null($this->previous))
    {
      $this->previous = $this->getTable()->getPreviousGps($this, $myMemberId);
    }

    return $this->previous;
  }

  public function getNext($myMemberId = null)
  {
    if (is_null($this->next))
    {
      $this->next = $this->getTable()->getNextGps($this, $myMemberId);
    }

    return $this->next;
  }

  public function isAuthor($memberId)
  {
    return ($this->getMemberId() === $memberId);
  }

}
