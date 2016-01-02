<?php

use Carbon\Carbon;

require 'destiny.php';

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

function bool($val)
{
	return $val ? 'true' : 'false';
}

function bungie($url)
{
	return url('http://www.bungie.net'.$url);
}

function duration($minutes, $output = 'days,hours,minutes')
{
	return timespan(time() + ($minutes * 60), time(), $output);
}

function duration_human($minutes, $output = 'days,hours,minutes', $short = false, $separator = ', ')
{
	$format = function($value, $unit, $short)
	{
		$unitString = trans_choice("time.$unit", $value);

		return sprintf('<strong>%d</strong>%s', $value, $short ? $unitString[0] : " $unitString");
	};

	$strings = [];

	if ($short && $separator == ', ')
		$separator = ' ';

	$timespan = timespan(time() + ($minutes * 60), time(), $output);

	foreach (array_filter($timespan) as $unit => $value)
	{
		$strings[] = $format($value, $unit, $short);
	}

	if (empty($strings))
	{
		end($timespan);	$unit = key($timespan);
		$strings[] = $format($timespan[$unit], $unit, $short);
	}

	$last = array_pop($strings);
	$count = count($strings);

	if ($count && $short)
		return sprintf('%s%s%s', implode($separator, $strings), $separator, $last);
	elseif ($count)
		return sprintf('%s %s %s', implode($separator, $strings), trans('and'), $last);
	else
		return $last;
}

/**
 * Returns time difference between two timestamps, in human readable format.
 * If the second timestamp is not given, the current time will be used.
 * Also consider using [Date::fuzzy_span] when displaying a span.
 *
 *     $span = Date::span(60, 182, 'minutes,seconds'); // array('minutes' => 2, 'seconds' => 2)
 *     $span = Date::span(60, 182, 'minutes'); // 2
 *
 * @param   integer $remote timestamp to find the span of
 * @param   integer $local  timestamp to use as the baseline
 * @param   string  $output formatting string
 * @return  array    associative list of all outputs requested
 */
function timespan($remote, $local = NULL, $output = 'years,months,weeks,days,hours,minutes,seconds')
{
	// Normalize output
	$output = trim(strtolower( (string) $output));

	if ( ! $output)
	{
		// Invalid output
		return FALSE;
	}

	// Array with the output formats
	$output = preg_split('/[^a-z]+/', $output);

	// Convert the list of outputs to an associative array
	$output = array_combine($output, array_fill(0, count($output), 0));

	// Make the output values into keys
	extract(array_flip($output), EXTR_SKIP);

	if ($local === NULL)
	{
		// Calculate the span from the current time
		$local = time();
	}

	// Calculate timespan (seconds)
	$timespan = abs($remote - $local);

	if (isset($output['years']))
	{
		$year = (60 * 60 * 24 * 365);
		$timespan -= $year * ($output['years'] = (int) floor($timespan / $year));
	}

	if (isset($output['months']))
	{
		$month = (60 * 60 * 24 * 30);
		$timespan -= $month * ($output['months'] = (int) floor($timespan / $month));
	}

	if (isset($output['weeks']))
	{
		$week = (60 * 60 * 24 * 7);
		$timespan -= $week * ($output['weeks'] = (int) floor($timespan / $week));
	}

	if (isset($output['days']))
	{
		$day = (60 * 60 * 24);
		$timespan -= $day * ($output['days'] = (int) floor($timespan / $day));
	}

	if (isset($output['hours']))
	{
		$hour = (60 * 60);
		$timespan -= $hour * ($output['hours'] = (int) floor($timespan / $hour));
	}

	if (isset($output['minutes']))
	{
		$minute = 60;
		$timespan -= $minute * ($output['minutes'] = (int) floor($timespan / $minute));
	}

	// Seconds ago, 1
	if (isset($output['seconds']))
	{
		$output['seconds'] = $timespan;
	}

	// Return array
	return $output;
}

function retry($retries, callable $fn)
{
	beginning:
	try {
		return $fn();
	} catch (\Exception $e) {
		if (!$retries) {
			throw new FailingTooHardException($e->getMessage(), 0, $e);
		}
		$retries--;
		goto beginning;
	}
}

function carbon($date)
{
	return new Carbon($date);
}

function version($update = false)
{
	static $version;

	if ( ! App::environment('production'))
	{
		$update = true;
	}

	if ($version && ! $update)
	{
		return trim($version);
	}

	$versionFile = base_path('.version.php');
	if ( ! is_file($versionFile) || $update)
	{
		exec('git describe --long', $version);
		$version = array_shift($version) ?: '0-unknown';
		if ($version[0] == 'v') $version = substr($version, 1);
		file_put_contents($versionFile, "<?php return '$version';");
	}
	else
	{
		$version = require($versionFile);
	}

	return trim($version);
}

function n($number, $decimals = 0)
{
	if (is_numeric($number))
	{
		return number_format($number, $decimals, '.', '');
	}

	return $number;
}
