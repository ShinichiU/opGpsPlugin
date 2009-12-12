<?php
require_once dirname(__FILE__) . '/Format.php';
require_once dirname(__FILE__) . '/Datum.php';

class Geomobilejp_Converter_Point
{

    const DEFAULT_DATUM = 'wgs84';

    private $latitude;

    private $longitude;

    private $datum;

    private $height;

    public function __construct($latitude = null, $longitude = null,
                                $datum = null, $height = 0.0)
    {
        if ($datum == null) {
            $datum = Geomobilejp_Converter_Point::DEFAULT_DATUM;
        }
        $this->latitude = $latitude ? $latitude : 0.0;
        $this->longitude = $longitude ? $longitude : 0.0;
        $this->datum = Geomobilejp_Converter_Datum::datumFromString($datum);
        $this->height = $height;
    }

    public function toFormat($format = Geomobilejp_Converter_Format::DEGREE)
    {
        if ($format == Geomobilejp_Converter_Format::DEGREE) {
            list($latitude, $longitude) = Geomobilejp_Converter_Format::asDegree(
                                          $this->latitude, $this->longitude);
        } elseif ($format == Geomobilejp_Converter_Format::DMS) {
            list($latitude, $longitude) = Geomobilejp_Converter_Format::asDms(
                                          $this->latitude, $this->longitude);
        } else {
            throw new Exception(sprintf('Invalid format name "%s"', $format));
        }
        return new Geomobilejp_Converter_Point(
            $latitude, $longitude, $this->datum, $this->height);
    }

    public function convert($datum)
    {
        return Geomobilejp_Converter_Datum::convert($this, $datum);
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function getDatum()
    {
        return $this->datum;
    }

    public function getHeight()
    {
        return $this->height;
    }

}
