<?php
/**
 * PHP versions 5
 *
 * @category   Geomobilejp
 * @package    Geomobilejp_IArea
 * @author     NAKAMURA Satoru <satoru@unoh.net>
 * @copyright  2008 Unoh Inc. <http://www.unoh.net/>
 * @license    New BSD License
 */
require_once dirname(__FILE__) . '/IArea/Mesh.php';

class Geomobilejp_IArea
{

    public static function seekArea($converter)
    {
        $point = $converter->format('degree')->convert('wgs84')->getPoint();
        return Geomobilejp_IArea_Mesh::seekArea(
            $point->getLatitude(), $point->getLongitude());
    }

}
