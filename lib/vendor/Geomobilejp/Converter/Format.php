<?php
class Geomobilejp_Converter_Format
{

    const DMS = 'dms';

    const DEGREE = 'degree';

    const DMS_LATITUDE_RE = '/^[\-\+NS]?\d{1,2}\.\d{1,2}.\d{1,2}(?:\.\d+)$/i';

    const DMS_LONGITUDE_RE = '/^[\-\+EW]?\d{1,3}\.\d{1,2}.\d{1,2}(?:\.\d+)$/i';

    const DEGREE_LATITUDE_RE = '/^[\-\+NS]?\d{1,2}(?:\.\d+)$/i';

    const DEGREE_LONGITUDE_RE = '/^[\-\+WE]?\d{1,3}(?:\.\d+)$/i';

    public static function asDms($latitude, $longitude)
    {
        $lat = trim(strval($latitude));
        $lon = trim(strval($longitude));
        $format = self::detectFormat($lat, $lon);
        if ($format == self::DMS) {
            return array(self::toDms(self::toDegree($lat)),
                         self::toDms(self::toDegree($lon)));
        }
        return array(self::toDms($lat), self::toDms($lon));
    }

    public static function asDegree($latitude, $longitude)
    {
        $lat = trim(strval($latitude));
        $lon = trim(strval($longitude));
        $format = self::detectFormat($lat, $lon);
        if ($format == self::DEGREE) {
            return array(strval(floatval($latitude)),
                         strval(floatval($longitude)));
        }
        return array(self::toDegree($lat), self::toDegree($lon));
    }

    public static function detectFormat($latitude, $longitude)
    {
        if (preg_match(self::DMS_LATITUDE_RE, $latitude)
                && preg_match(self::DMS_LONGITUDE_RE, $longitude)) {
            return self::DMS;
        } elseif (preg_match(self::DEGREE_LATITUDE_RE, $latitude)
                && preg_match(self::DEGREE_LONGITUDE_RE, $longitude)) {
            return self::DEGREE;
        }
        throw new Exception(sprintf(
            'Can\'t detect the format. (%s,%s) is given.',
            $latitude, $longitude));
    }

    protected static function toDms($value, $digits = 3)
    {
        preg_match('/^([\-\+NSWE]?)(.+)$/i', $value, $matches);

        if (count($matches) !== 3) {
            return $value;
        }

        $ws     = $matches[1];
        $degree = $matches[2];

        if ($ws == '-'
                || array_search($ws, array('W', 'w', 'S', 's')) !== false) {
            $ws = '-';
        } else {
            $ws = '';
        }

        $degree = floatval($degree);

        $deg = floor($degree);
        $min = floor(($degree - $deg) * 60 % 60);

        $sec = ($degree - $deg) * 3600 - $min * 60;
        $zero = $sec < 10 ? '0' : '';

        $format = sprintf('%%s%%d.%%02d.%%s%%%d.%df', $digits, $digits);
        return sprintf($format, $ws, $deg, $min, $zero, $sec);
    }

    protected static function toDegree($value, $digits = 6)
    {
        preg_match('/^([\-\+NSWE]?)(\d+)\.(\d+)\.(\d+(?:\.\d+)?)$/i',
            $value, $matches);

        if (count($matches) !== 5) {
            return $value;
        }

        $ws  = $matches[1];
        $deg = $matches[2];
        $min = $matches[3];
        $sec = $matches[4];

        $ret = intval($deg)
             + (floatval($min) / 60.0)
             + (floatval($sec) / 3600.0);

        if ($ws == '-'
                || array_search($ws, array('W', 'w', 'S', 's')) !== false) {
            $ret *= -1;
        }

        $format = sprintf('%%%d.%df', $digits, $digits);
        return sprintf($format, $ret);
    }

}
