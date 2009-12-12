<?php
class Geomobilejp_IArea_Area
{

    const DATAFILE_NAME = 'iareadata.php';

    private static $iareadata;

    private $code;

    private $subcode;

    private $name;

    private $meshcache;

    public function __construct($code, $subcode, $name, $meshcache)
    {
        $this->code = $code;
        $this->subcode = $subcode;
        $this->name = $name;
        $this->meshcache = $meshcache;
    }

    public function getIAreaCode()
    {
        $code = '';
        if (intval($this->code) < 10) {
            $code = '00' . $this->code;
        } elseif (intval($this->code) < 100) {
            $code = '0' . $this->code;
        } else {
            $code = $this->code;
        }
        $subcode = '';
        if (intval($this->subcode) < 10) {
            $subcode = '0' . $this->subcode;
        } else {
            $subcode = $this->subcode;
        }
        return $code . $subcode;
    }

    public static function initialize()
    {
        $path = dirname(__FILE__) . '/' . self::DATAFILE_NAME;
        if (!file_exists($path)) {
            throw new Exception(sprintf('"%s" is not exists.', $path));
        }
        require $path;
        self::$iareadata = $data;
    }

    public static function seekArea($mesh, $pattern)
    {
        foreach (self::$iareadata as $line) {
            if (preg_match($pattern, $line)) {
                return self::stringToArea($line);
            }
        }
        return null;
    }

    protected static function stringToArea($line)
    {
        $line = trim($line);
        $exploded = explode(',', $line);
        $variables = array();
        for ($i = 0; $i < 14; $i++) {
            if (isset($exploded[$i])) {
                $variables[$i] = $exploded[$i];
            } else {
                $variables[$i] = '';
            }
        }
        list($code, $subcode, $name,
             $w, $s, $e, $n,
             $second, $third, $forth, $fifth, $sixth, $seventh,
             $rest) = $variables;
        return new Geomobilejp_IArea_Area(
            intval($code), intval($subcode), $name, $line);
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getSubcode()
    {
        return $this->subcode;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getMeshcache()
    {
        return $this->meshcache;
    }

}

Geomobilejp_IArea_Area::initialize();
