<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

function op_gps_link_to_show($position, $location = true, $width = 36)
{
  if ($location && $position->getLocation())
  {
    return link_to(op_truncate($position->getLocation(), $width), 'gps_show', $position);
  }
  else
  {
    return link_to(op_truncate(sprintf('time of %s foot path', $position->getCreatedAt()), $width), 'gps_show', $position);
  }
}

function op_gps_generate_url($position, $mapType = 1, $zoom = 15)
{
  switch ($mapType)
  {
    case 1:
    $url = 'http://www.google.co.jp/maps?ie=UTF8&ll=%s,%s&z=%s';
    break;
    case 2:
    $url = 'http://map.yahoo.co.jp/pl?mode=map&type=scroll&lat=%s&lon=%s&sc=%s';
  }

  return sprintf($url, $position->getLat(), $position->getLon(), $zoom);
}
