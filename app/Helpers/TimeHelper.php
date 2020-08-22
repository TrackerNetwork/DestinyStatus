<?php
declare(strict_types=1);

namespace App\Helpers;

class TimeHelper
{
    public static function duration($minutes, $output = 'days,hours,minutes')
    {
        return self::timespan(time() + ($minutes * 60), time(), $output);
    }

    public static function timespan($remote, $local = null, $output = 'years,months,weeks,days,hours,minutes,seconds')
    {
        // Normalize output
        $output = trim(strtolower((string)$output));

        if (!$output) {
            return false;
        }

        // Array with the output formats
        $output = preg_split('/[^a-z]+/', $output);

        // Convert the list of outputs to an associative array
        $output = array_combine($output, array_fill(0, count($output), 0));

        // Make the output values into keys
        extract(array_flip($output), EXTR_SKIP);

        if ($local === null) {
            $local = time();
        }

        // Calculate timespan (seconds)
        $timespan = abs($remote - $local);

        if (isset($output['years'])) {
            $year = (60 * 60 * 24 * 365);
            $timespan -= $year * ($output['years'] = (int)floor($timespan / $year));
        }

        if (isset($output['months'])) {
            $month = (60 * 60 * 24 * 30);
            $timespan -= $month * ($output['months'] = (int)floor($timespan / $month));
        }

        if (isset($output['weeks'])) {
            $week = (60 * 60 * 24 * 7);
            $timespan -= $week * ($output['weeks'] = (int)floor($timespan / $week));
        }

        if (isset($output['days'])) {
            $day = (60 * 60 * 24);
            $timespan -= $day * ($output['days'] = (int)floor($timespan / $day));
        }

        if (isset($output['hours'])) {
            $hour = (60 * 60);
            $timespan -= $hour * ($output['hours'] = (int)floor($timespan / $hour));
        }

        if (isset($output['minutes'])) {
            $minute = 60;
            $timespan -= $minute * ($output['minutes'] = (int)floor($timespan / $minute));
        }

        // Seconds ago, 1
        if (isset($output['seconds'])) {
            $output['seconds'] = $timespan;
        }

        // Return array
        return $output;
    }

    public static function durationHuman($minutes, $output = 'days,hours,minutes', $short = false, $separator = ', ')
    {
        $format = function ($value, $unit, $short) {
            $unitString = trans_choice("time.$unit", $value);

            return sprintf('<strong>%d</strong>%s', $value, $short ? $unitString[0] : " $unitString");
        };

        $strings = [];

        if ($short && $separator == ', ') {
            $separator = ' ';
        }

        $timespan = self::timespan(time() + ($minutes * 60), time(), $output);

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
        }

        return $last;
    }
}
