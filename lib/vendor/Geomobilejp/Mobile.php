<?php
/**
 * PHP versions 5
 *
 * @category   Geomobilejp
 * @package    Geomobilejp_Mobile
 * @author     NAKAMURA Satoru <satoru@unoh.net>
 * @copyright  2008 Unoh Inc. <http://www.unoh.net/>
 * @license    New BSD License
 */
class Geomobilejp_Mobile
{

    private $latitude;

    private $longitude;

    private $datum;

    public function __construct()
    {
        $this->parse();
    }

    public function hasParameter()
    {
        return (strlen($this->latitude) > 1 && strlen($this->longitude) > 1);
    }

    protected function parse()
    {
        $latitude = '';
        $longitude = '';
        $datum = '';

        if (array_key_exists('lat', $_REQUEST)
                && array_key_exists('lon', $_REQUEST)) {
            $latitude = $_REQUEST['lat'];
            $longitude = $_REQUEST['lon'];
        } elseif (array_key_exists('pos', $_REQUEST)) {
            preg_match(
                '/^([NS]\d+\.\d+\.\d+\.\d+)([EW]\d+\.\d+\.\d+\.\d+)$/i',
                $_REQUEST['pos'], $matches);
            if (count($matches) === 3) {
                $latitude = $matches[1];
                $longitude = $matches[2];
            }
        }

        if (array_key_exists('datum', $_REQUEST)) {
            $datum = $_REQUEST['datum'];
            if ($datum == 0) {
                $datum = 'wgs84';
            } elseif ($datum == 1) {
                $datum = 'tokyo';
            }
        } elseif (array_key_exists('geo', $_REQUEST)) {
            $datum = $_REQUEST['geo'];
        } else {
            $datum = 'tokyo';
        }

        $this->latitude = strtoupper(trim($latitude)); 
        $this->longitude = strtoupper(trim($longitude)); 
        $this->datum = strtolower(trim($datum));
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

}
