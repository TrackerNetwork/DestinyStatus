<?php
declare(strict_types = 1);

namespace App\Helpers;

class StringHelper
{
    public static function slug(string $value = null): string
    {
        if (empty($value)) {
            return '';
        }

        $value = html_entity_decode($value, ENT_QUOTES | ENT_XML1, 'UTF-8');
        $value = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value));
        $value = preg_replace('/[^a-z0-9 -]/', '', $value);
        $value = preg_replace('!\s+!', ' ', $value);
        $value = trim(mb_strimwidth($value, 0, 45));
        $value = str_replace(' ', '-', $value);

        return $value;
    }

    public static function bungieSlug(string $value): string
    {
        $value = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value));
        return rawurlencode($value);
    }

    public static function urlSlug(string $value): string
    {
        $value = mb_strtolower($value);

        return str_replace('#', '%23', $value);
    }

    public static function number($number, int $decimals = 0): string
    {
        if (is_numeric($number)) {
            return number_format($number, $decimals, '.', ',');
        }

        return $number;
    }
}