<?php
/**
 * PHP versions 5
 *
 * @category   Geomobilejp
 * @package    Geomobilejp_Converter
 * @author     NAKAMURA Satoru <satoru@unoh.net>
 * @copyright  2008 Unoh Inc. <http://www.unoh.net/>
 * @license    New BSD License
 */
require_once dirname(__FILE__) . '/Converter/Point.php';

class Geomobilejp_Converter
{

    private $point;

    public function __construct($lat, $lon, $datum = null, $height = 0)
    {
        $this->point = new Geomobilejp_Converter_Point(
            $lat, $lon, $datum, $height);
    }

    public function format($format)
    {
        $this->point = $this->point->toFormat($format);
        return clone $this;
    }

    public function convert($datum)
    {
        $this->point = $this->point->convert($datum);
        return clone $this;
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function getLatitude()
    {
        return $this->point->getLatitude();
    }

    public function getLongitude()
    {
        return $this->point->getLongitude();
    }

    public function getDatum()
    {
        return $this->point->getDatum();
    }

}
