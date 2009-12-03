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
    $params = op_calc_gcs_to_WGS84($position);
    $url = 'http://www.google.co.jp/maps?ie=UTF8&ll=%s,%s&z=%s';
    break;
    case 2:
    $params = array('lat' => $position->getLat(), 'lon' => $position->getLon());
    $url = 'http://map.yahoo.co.jp/pl?mode=map&type=scroll&lat=%s&lon=%s&sc=%s';
    $zoom = 5;
  }

  return sprintf($url, $params['lat'], $params['lon'], $zoom);
}

function op_generate_google_cmd($position)
{
  return get_partial('gps/iframe', array('memberGpsPosition' => $position));
}

function op_calc_gcs_to_WGS84($position)
{
  if ('tokyo' == $position->getGcs())
  {
    if (preg_match('@^(\d+)\.(\d+)\.(\d+)\.(\d+)$@', $position->getLat(), $params))
    {
      $_lat_1 = floor(($params[2] * 60000 + ($params[3] + 12) * 1000 + $params[4]) / 3.6);
      $_lat = $params[1].'.'.$_lat_1;
    }

    if (preg_match('@^(\d+)\.(\d+)\.(\d+)\.(\d+)$@', $position->getLon(), $params))
    {
      $_lon_1 = floor(($params[2] * 60000 + ($params[3] - 12) * 1000 + $params[4]) / 3.6);
      $_lon = $params[1].'.'.$_lon_1;
    }

    return array('lat' => $_lat, 'lon' => $_lon);
  }
}
