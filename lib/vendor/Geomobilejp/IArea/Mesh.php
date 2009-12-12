<?php
require_once dirname(__FILE__) . '/Area.php';

class Geomobilejp_IArea_Mesh
{

    const MESH_RE = '/^(\d{6})(\d?)(\d?)(\d?)(\d?)(\d?)$/';

    const SEEK_MESH_RE = '/,(%s(%s(%s(%s(%s%s?)?)?)?)?),/';

    public static function seekArea($lat, $lon)
    {
        $mesh = self::calcurateMesh($lat, $lon);
        $pattern = sprintf(self::SEEK_MESH_RE,
                           $mesh[0], $mesh[1], $mesh[2],
                           $mesh[3], $mesh[4], $mesh[5]);
        return Geomobilejp_IArea_Area::seekArea($mesh, $pattern);
    }

    public static function calcurateMesh($lat, $lon)
    {
        $lat = intval($lat * 60 * 60 * 1000);
        $lon = intval($lon * 60 * 60 * 1000);

        // 1st mesh code
        $ab = intval($lat / 2400000);
        $cd = intval($lon / 3600000) - 100;

        // 2nd mesh code
        $x1 = ($cd + 100) * 3600000;
        $y1 = $ab * 2400000;
        $e = intval(($lat - $y1) / 300000);
        $f = intval(($lon - $x1) / 450000);

        $m = array();
        $mesh2 = sprintf('%s%s%s%s', $ab, $cd, $e, $f);
        $m[] = $mesh2;

        // 3rd mesh code
        $x2 = $x1 + $f * 450000;
        $y2 = $y1 + $e * 300000;
        $l3 = intval(($lon - $x2) / 225000);
        $m3 = intval(($lat - $y2) / 150000);
        $g = $l3 + $m3 * 2;
        $mesh3 = sprintf('%s%s', $mesh2, $g);
        $m[] = $g;

        // 4th meth code
        $x3 = $x2 + $l3 * 225000;
        $y3 = $y2 + $m3 * 150000;
        $l4 = intval(($lon - $x3) / 112500);
        $m4 = intval(($lat - $y3) / 75000);
        $h = $l4 + $m4 * 2;
        $mesh4 = sprintf('%s%s', $mesh3, $h);
        $m[] = $h;

        // 5th mesh code
        $x4 = $x3 + $l4 * 112500;
        $y4 = $y3 + $m4 * 75000;
        $l5 = intval(($lon - $x4) / 56250);
        $m5 = intval(($lat - $y4) / 37500);
        $i = $l5 + $m5 * 2;
        $mesh5 = sprintf('%s%s', $mesh4, $i);
        $m[] = $i;

        // 6th mesh code
        $x5 = $x4 + $l5 * 56250;
        $y5 = $y4 + $m5 * 37500;
        $l6 = intval(($lon - $x5) / 28125);
        $m6 = intval(($lat - $y5) / 18750);
        $j = $l6 + $m6 * 2;
        $mesh6 = sprintf('%s%s', $mesh5, $j);
        $m[] = $j;

        // 7th mesh code
        $x6 = $x5 + $l6 * 28125;
        $y6 = $y5 + $m6 * 18750;
        $l7 = intval(($lon - $x6) / 14062.5);
        $m7 = intval(($lat - $y6) / 9375);
        $k = $l7 + $m7 * 2;
        $mesh7 = sprintf('%s%s', $mesh6, $k);
        $m[] = $k;

        // return mesh7
        return $m;
    }

}
