<?php

class Format {
    private $formatRole = 'YYYY-MM-dd';

    public static function dateFormat($date) {
        $date = new Date($date);
        return $date->format($formatRole);
    }
}