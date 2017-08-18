<?php

use Carbon\Carbon;

require 'instance.php';

function d($var)
{
    var_dump($var);
}

function de($var)
{
    header('Content-Type: application/json', true);
    echo json_encode($var);
    die;
}

function bungie($url)
{
    if (starts_with($url, 'http')) {
        return $url;
    }

    return url('https://www.bungie.net'.$url);
}

function slug($name)
{
    /*
        This method generates url slugs:
        - Converts accented characters
        - Makes the string lowercase
        - Converts multiple spaces to one
        - Trim to a max length of 45 characters.
        - Replace spaces with hypens.
    */

    $name = html_entity_decode($name, ENT_QUOTES | ENT_XML1, 'UTF-8');
    $name = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $name));
    $name = preg_replace('/[^a-z0-9 -]/', '', $name);
    $name = preg_replace('!\s+!', ' ', $name);
    $name = trim(mb_strimwidth($name, 0, 45));
    $name = str_replace(' ', '-', $name);

    return $name;
}

function duration($minutes, $output = 'days,hours,minutes')
{
    return timespan(time() + ($minutes * 60), time(), $output);
}

function duration_human($minutes, $output = 'days,hours,minutes', $short = false, $separator = ', ')
{
    $format = function ($value, $unit, $short) {
        $unitString = trans_choice("time.$unit", $value);

        return sprintf('<strong>%d</strong>%s', $value, $short ? $unitString[0] : " $unitString");
    };

    $strings = [];

    if ($short && $separator == ', ') {
        $separator = ' ';
    }

    $timespan = timespan(time() + ($minutes * 60), time(), $output);

    foreach (array_filter($timespan) as $unit => $value) {
        $strings[] = $format($value, $unit, $short);
    }

    if (empty($strings)) {
        end($timespan);
        $unit = key($timespan);
        $strings[] = $format($timespan[$unit], $unit, $short);
    }

    $last = array_pop($strings);
    $count = count($strings);

    if ($count && $short) {
        return sprintf('%s%s%s', implode($separator, $strings), $separator, $last);
    } elseif ($count) {
        return sprintf('%s %s %s', implode($separator, $strings), trans('and'), $last);
    } else {
        return $last;
    }
}

/**
 * Returns time difference between two timestamps, in human readable format.
 * If the second timestamp is not given, the current time will be used.
 * Also consider using [Date::fuzzy_span] when displaying a span.
 *
 *     $span = Date::span(60, 182, 'minutes,seconds'); // array('minutes' => 2, 'seconds' => 2)
 *     $span = Date::span(60, 182, 'minutes'); // 2
 *
 * @param int    $remote timestamp to find the span of
 * @param int    $local  timestamp to use as the baseline
 * @param string $output formatting string
 *
 * @return array associative list of all outputs requested
 */
function timespan($remote, $local = null, $output = 'years,months,weeks,days,hours,minutes,seconds')
{
    // Normalize output
    $output = trim(strtolower((string) $output));

    if (!$output) {
        // Invalid output
        return false;
    }

    // Array with the output formats
    $output = preg_split('/[^a-z]+/', $output);

    // Convert the list of outputs to an associative array
    $output = array_combine($output, array_fill(0, count($output), 0));

    // Make the output values into keys
    extract(array_flip($output), EXTR_SKIP);

    if ($local === null) {
        // Calculate the span from the current time
        $local = time();
    }

    // Calculate timespan (seconds)
    $timespan = abs($remote - $local);

    if (isset($output['years'])) {
        $year = (60 * 60 * 24 * 365);
        $timespan -= $year * ($output['years'] = (int) floor($timespan / $year));
    }

    if (isset($output['months'])) {
        $month = (60 * 60 * 24 * 30);
        $timespan -= $month * ($output['months'] = (int) floor($timespan / $month));
    }

    if (isset($output['weeks'])) {
        $week = (60 * 60 * 24 * 7);
        $timespan -= $week * ($output['weeks'] = (int) floor($timespan / $week));
    }

    if (isset($output['days'])) {
        $day = (60 * 60 * 24);
        $timespan -= $day * ($output['days'] = (int) floor($timespan / $day));
    }

    if (isset($output['hours'])) {
        $hour = (60 * 60);
        $timespan -= $hour * ($output['hours'] = (int) floor($timespan / $hour));
    }

    if (isset($output['minutes'])) {
        $minute = 60;
        $timespan -= $minute * ($output['minutes'] = (int) floor($timespan / $minute));
    }

    // Seconds ago, 1
    if (isset($output['seconds'])) {
        $output['seconds'] = $timespan;
    }

    // Return array
    return $output;
}

function carbon($date)
{
    return new Carbon($date);
}

function version($update = false)
{
    static $version;

    if (!\App::isLocal()) {
        $update = true;
    }

    if ($version && !$update) {
        return trim($version);
    }

    $versionFile = base_path('.version.php');
    if (!is_file($versionFile) || $update) {
        exec('git describe --always', $version);
        $version = array_shift($version) ?: '0-unknown';
        if ($version[0] == 'v') {
            $version = substr($version, 1);
        }
        file_put_contents($versionFile, "<?php return '$version';");
    } else {
        $version = require $versionFile;
    }

    return trim($version);
}

function n($number, $decimals = 0)
{
    if (is_numeric($number)) {
        return number_format($number, $decimals, '.', '');
    }

    return $number;
}
