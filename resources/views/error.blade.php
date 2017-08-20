@extends('layout')
@section('content')
<?php
/**
* @var string $error
* @var bool $bungie
*/

$bungie = (bool) $bungie ?? false;
?>
<h2><?= $bungie ? 'Bungie says:' : 'Oopsie' ?></h2>
<div class="alert alert-info">{{ $error }}</div>
@stop