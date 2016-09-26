@extends('layout')
@section('content')
<?php
/**
 * @var \destiny\Player $player
 * @var \destiny\Character $character
 */
de($character->inventory);
?>

<?=d($character->toArray())?>

@stop
