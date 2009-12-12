<?php
require_once dirname(__FILE__) . '/Format.php';
require_once dirname(__FILE__) . '/Point.php';

class Geomobilejp_Converter_Datum
{

    private static $loadedDatums = array();

    protected $name;

    protected $radius;

    protected $rate;

    protected $translation;

    public function __construct()
    {
        $this->radius = 0;
        $this->rate = 0;
        $this->translation = array(0, 0, 0);
    }

    public static function initialize()
    {
        $base = dirname(__FILE__) . '/Datum/';
        $names = scandir($base);
        foreach ($names as $name) {
            if (preg_match('/\.php$/', $name)) {
                require_once $base . $name;
                $datumName = preg_replace('/\.php$/', '', $name);
                $datumKey = strtolower($datumName);
                $datumClassName = 'Geomobilejp_Converter_Datum_' . $datumName;
                if (class_exists($datumClassName)) {
                    self::$loadedDatums[$datumKey] = $datumClassName;
                }
            }
        }
    }

    public static function datumFromString($datumName)
    {
        if (!is_string($datumName) || $datumName == '') {
            return $datumName;
        }
        $key = strtolower($datumName);
        if (array_key_exists($key, self::$loadedDatums)) {
            $className = self::$loadedDatums[$key];
            return new $className;
        } else {
            throw new Exception(sprintf('Invalid datum name "%s"', $datumName));
        }
    }

    public static function convert($point, $datum)
    {
        if (is_string($datum)) {
            $datum = self::datumFromString($datum);
        }
        $format = Geomobilejp_Converter_Format::detectFormat(
            $point->getLatitude(), $point->getLongitude());
        $point1 = $point->toFormat(Geomobilejp_Converter_Format::DEGREE);
        $point2 = self::toDatum($point1->getDatum(), $point1);
        $point3 = self::datumFrom($datum, $point2);
        return $point3->toFormat($format);
    }

    protected static function toDatum($datum, $point)
    {
        $radian = 4 * atan2(1, 1) / 180;

        $height = floatval($point->getHeight()) || 0.0;

        $latSin = sin(floatval($point->getLatitude()) * $radian);
        $latCos = cos(floatval($point->getLatitude()) * $radian);
        $radiusRate = $datum->getRadius() / sqrt(
                            1 - $datum->getRate() * $latSin * $latSin);

        $xyBase = ($radiusRate + $height) * $latCos;
        $x = $xyBase * cos(floatval($point->getLongitude()) * $radian);
        $y = $xyBase * sin(floatval($point->getLongitude()) * $radian);
        $z = ($radiusRate * (1 - $datum->getRate()) + $height) * $latSin;

        list($transX, $transY, $transZ) = $datum->getTranslation();

        $lat = $x + (-1 * $transX);
        $lon = $y + (-1 * $transY);
        $hgt = $z + (-1 * $transZ);

        return new Geomobilejp_Converter_Point(
            $lat, $lon, new Geomobilejp_Converter_Datum(), $hgt);
    }

    protected static function datumFrom($datum, $point)
    {
        $radian = 4 * atan2(1, 1) / 180;

        list($transX, $transY, $transZ) = $datum->getTranslation();

        $x = floatval($point->getLatitude()) + $transX;
        $y = floatval($point->getLongitude()) + $transY;
        $z = floatval($point->getHeight()) + $transZ;

        $rateSqrt = sqrt(1 - $datum->getRate());

        $xySqrt  = sqrt($x * $x + $y * $y);
        $atanBase = atan2($z, $xySqrt * $rateSqrt);
        $atanSin = sin($atanBase);
        $atanCos = cos($atanBase);
        $lat = atan2($z + $datum->getRate() * $datum->getRadius()
                            / $rateSqrt * $atanSin * $atanSin * $atanSin,
                     $xySqrt - $datum->getRate() * $datum->getRadius()
                            * $atanCos * $atanCos * $atanCos);
        $lon = atan2($y, $x);

        $latSin = sin($lat);
        $radiusRate = $datum->getRadius()
                    / sqrt(1 - $datum->getRate() * ($latSin * $latSin));

        return new Geomobilejp_Converter_Point(
            $lat / $radian,
            $lon / $radian,
            $datum,
            ($xySqrt / cos($lat) - $radiusRate));
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRadius()
    {
        return $this->radius;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function getTranslation()
    {
        return $this->translation;
    }

}

Geomobilejp_Converter_Datum::initialize();
