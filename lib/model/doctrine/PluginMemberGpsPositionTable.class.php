<?php
/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * PluginGpsTable
 *
 * @package    opGpsPlugin
 * @author     Shinichi Urabe <urabe@tejimaya.com>
 */
abstract class PluginMemberGpsPositionTable extends Doctrine_Table
{

  public function addGpsPosition($position, $carrier)
  {
    $_lat = $this->formatString($position['lat']);
    $_lon = $this->formatString($position['lon']);

    if ($_lat && $_lon)
    {
      $memberGpsPositon = new MemberGpsPosition();
      $memberGpsPositon->setMemberId($this->getMine()->getId());
      $memberGpsPositon->setLat($_lat);
      $memberGpsPositon->setLon($_lon);
      $memberGpsPositon->setGcs('tokyo');
      $memberGpsPositon->setCarrier($carrier);
      $memberGpsPositon->save();

      return $memberGpsPositon;
    }

    return false;
  }


  public function getGpsList($limit = 5)
  {
    $q = $this->getOrderdQuery();
    $q->limit($limit);

    return $q->execute();
  }

  public function getGpsPager($page = 1, $size = 20)
  {
    $q = $this->getOrderdQuery();

    return $this->getPager($q, $page, $size);
  }

  public function getMemberGpsList($memberId, $limit = 5, $myMemberId = null)
  {
    $q = $this->getOrderdQuery();
    $this->addMemberQuery($q, $memberId, $myMemberId);
    $q->limit($limit);

    return $q->execute();
  }

  public function getMemberGpsPager
  (
    $memberId,
    $page = 1,
    $size = 20,
    $myMemberId = null,
    $year = null,
    $month = null,
    $day = null
  )
  {
    $q = $this->getOrderdQuery();
    $this->addMemberQuery($q, $memberId, $myMemberId);

    if ($year && $month)
    {
      $this->addDateQuery($q, $year, $month, $day);
    }

    return $this->getPager($q, $page, $size);
  }

  public function getMemberGpsDays($memberId, $myMemberId, $year, $month)
  {
    $days = array();

    $q = $this->createQuery()->select('created_at');
    $this->addMemberQuery($q, $memberId, $myMemberId);
    $this->addDateQuery($q, $year, $month);

    $result = $q->execute();
    foreach ($result as $row)
    {
      $day = date('j', strtotime($row['created_at']));
      $days[$day] = true;
    }

    return $days;
  }

  public function getFriendGpsList($memberId, $limit = 5)
  {
    $q = $this->getOrderdQuery();
    $this->addFriendQuery($q, $memberId);
    $q->limit($limit);

    return $q->execute();
  }

  public function getFriendGpsPager($memberId, $page = 1, $size = 20)
  {
    $q = $this->getOrderdQuery();
    $this->addFriendQuery($q, $memberId);

    return $this->getPager($q, $page, $size);
  }

  protected function getPager(Doctrine_Query $q, $page, $size)
  {
    $pager = new sfDoctrinePager('MemberGpsPosition', $size);
    $pager->setQuery($q);
    $pager->setPage($page);

    return $pager;
  }

  protected function getOrderdQuery()
  {
    return $this->createQuery()->orderBy('created_at DESC');
  }

  protected function addMemberQuery(Doctrine_Query $q, $memberId, $myMemberId)
  {
    $q->andWhere('member_id = ?', $memberId);
  }

  protected function addFriendQuery(Doctrine_Query $q, $memberId)
  {
    $friendIds = Doctrine::getTable('MemberRelationship')->getFriendMemberIds($memberId, 5);
    if (!$friendIds)
    {
      $q->andWhere('1 = 0');

      return;
    }

    $q->andWhereIn('member_id', $friendIds);
  }

  public function getPreviousGps(MemberGpsPosition $gps, $myMemberId)
  {
    $q = $this->createQuery()
      ->andWhere('member_id = ?', $gps->getMemberId())
      ->andWhere('id < ?', $gps->getId())
      ->orderBy('id DESC');

    return $q->fetchOne();
  }

  public function getNextGps(MemberGpsPosition $gps, $myMemberId)
  {
    $q = $this->createQuery()
      ->andWhere('member_id = ?', $gps->getMemberId())
      ->andWhere('id > ?', $gps->getId())
      ->orderBy('id ASC');

    return $q->fetchOne();
  }

  protected function getMine()
  {
    return sfContext::getInstance()->getUser()->getMember();
  }

  protected function formatString($param)
  {
    if (preg_match('@^\s*(.+)\s*$@', $param, $mache))
    {
      return $mache[1];
    }

    return false;
  }
}
