<?php
class Geomobilejp_Converter_Datum_WGS84 extends Geomobilejp_Converter_Datum
{

    public function __construct()
    {
        parent::__construct();
        $this->name = 'wgs84';
        $this->radius = 6378137;
        $r = 1 / 298.257223563;
        $this->rate = 2 * $r - $r * $r;
    }

}
