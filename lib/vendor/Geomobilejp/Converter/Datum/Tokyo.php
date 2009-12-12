<?php
class Geomobilejp_Converter_Datum_Tokyo extends Geomobilejp_Converter_Datum
{

    public function __construct()
    {
        parent::__construct();
        $this->name = 'tokyo';
        $this->radius = 6377397.155;
        $r = 1 / 299.152813;
        $this->rate = 2 * $r - $r * $r;
        $this->translation = array(148, -507, -681);
    }

}
