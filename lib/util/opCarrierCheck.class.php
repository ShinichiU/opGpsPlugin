<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opCarrierCheck
 *
 * @package    OpenPNE
 * @subpackage util
 * @author     Shinichi Urabe <urabe@tejimaya.com>
 */
class opCarrierCheck extends opMobileUserAgent
{
  public function checkCarrier()
  {
    $mobileType = parent::getInstance()->getMobile();
    if ($mobileType->isDocomo()) {
      return 'Docomo';
    } elseif ($mobileType->isSoftBank()) {
      return 'SoftBank';
    } elseif ($mobileType->isEZweb()) {
      return 'EZweb';
    } elseif ($mobileType->isWillcom()) {
      return 'Willcom';
    } else {
      if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== false) {
        return 'iPhone';
      } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false) {
        return 'Android';
      }
    return 'other';
    }
  }

  public function isCookie()
  {
    return parent::getInstance()->isCookie();
  }
}
