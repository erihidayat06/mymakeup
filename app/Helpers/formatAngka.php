<?php

function formatAngka($angka, $presisi=1)
{
    if($angka<900){
        $formatangka = number_format($angka, $presisi);
        $karakter = '';
    }elseif($angka<900000){
        $formatangka = number_format($angka / 1000, $presisi);
        $karakter = 'rb';
    }elseif($angka<900000000){
        $formatangka = number_format($angka / 1000000, $presisi);
        $karakter = 'jt';
    }elseif($angka<900000000000){
        $formatangka = number_format($angka / 1000000000, $presisi);
        $karakter = 'M';
    }else{
        $formatangka = number_format($angka / 1000000000000, $presisi);
        $karakter = 'T';
    }

    if($presisi > 0){
        $pisah = "." . str_repeat('0', $presisi );
        $formatangka = str_replace($pisah,'' , $formatangka);
    }

    return $formatangka . $karakter;
}