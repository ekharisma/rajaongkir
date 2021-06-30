<?php

require '../vendor/autoload.php';
use Kavist\RajaOngkir\RajaOngkir;

$rajaOngkir = new RajaOngkir("d3cff0fef76df39c9c162caca0a0f6ad", 'starter');
$daftarProvinsi = $rajaOngkir->provinsi()->all();
print_r($daftarProvinsi);
