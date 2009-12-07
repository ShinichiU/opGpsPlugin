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
    $params = op_calc_gcs_to_tokyo($position);
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
  $_lat = op_calc_gps_decimal($position->getLat());
  $_lon = op_calc_gps_decimal($position->getLon());

  if ('tokyo' == $position->getGcs())
  {
    $_lat = $_lat - $_lat * 0.00010695  + $_lon * 0.000017464 + 0.0046017;
    $_lon = $_lon - $_lat * 0.000046038 - $_lon * 0.000083043 + 0.010040;
  }

  return array('lat' => $_lat, 'lon' => $_lon);
}

function op_calc_gcs_to_tokyo($position)
{
  $_lat = op_calc_gps_decimal($position->getLat());
  $_lon = op_calc_gps_decimal($position->getLon());

  if ('WGS84' == $position->getGcs())
  {
    $_lat = $_lat + $_lat * 0.00010696  - $_lon * 0.000017467 - 0.0046020;
    $_lon = $_lon + $_lat * 0.000046047 + $_lon * 0.000083049 - 0.010041;
  }

  return array('lat' => $_lat, 'lon' => $_lon);
}

function op_calc_gps_decimal($value)
{
  if (preg_match('@^(\d+)\.(\d+)\.([\d\.]+)$@', $value, $params))
  {
    return $params[1] + $params[2] / 60 + $params[3] / 3600;
  }

  return $value;
}
