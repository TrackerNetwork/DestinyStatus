<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <meta name="description" content="Destiny progression, weekly checklist and Grimoire completion!">
    <title>@yield('title', 'Destiny Status - Character Progress & Checklist')</title>
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}"/>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,700,300,500">
    <link rel="stylesheet" type="text/css" href="<?= elixir('css/destiny.css'); ?>">
</head>
<body>
<div id="app">
<nav class="navbar navbar-default navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Destiny Status</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form action="/" class="navbar-form navbar-left" role="search" method="post">
                {!! csrf_field() !!}
                <autocomplete></autocomplete>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @include('partials.user-nav')
            </ul>
        </div>
    </div>
</nav>

<div id="page" class="container">
    <?php if (Session::has('alert')): ?>
        <div class="alert alert-danger"><?= e(Session::pull('alert'))?></div>
    <?php endif; ?>
    <?php if (Session::has('success')): ?>
        <div class="alert alert-success"><?= Session::pull('success')?></div>
    <?php endif; ?>
    @include('partials.auth')
    @yield('content')

    <div class="footer row">
        <div class="col-md-12 about">
            <p class="version">
                <?= date('Y') ?> &copy; DestinyStatus <a href="https://github.com/TrackerNetwork/DestinyStatus/blob/master/CHANGELOG.md" target="_blank">v<?= version(); ?></a>
                @if (App::isLocal())
                    [<?= App::environment() ?>]
                @endif
                <a class="privacy" href="/privacy">Privacy Policy</a>
            </p>
            <p>
                Ads support server costs and all information used on this site is the property of Bungie. Looking for <a href="https://d1.destinystatus.com">Destiny 1 stats</a>?<br>
                Developed by <a href="https://github.com/iBotPeaches" target="_blank">iBotPeaches</a>, <a href="https://d1.destinystatus.com/psn/HermanGatevold">HermanGatevold</a> and the Tracker Network and is not financed by or associated with Bungie.<br>
            </p>
            <p>
                Contact us on <a href="https://github.com/TrackerNetwork/DestinyStatus" target="_blank"><i class="fa fa-github-square"></i> GitHub</a>
                or <a href="https://twitter.com/DestinyStatus" target="_blank"><i class="fa fa-twitter-square"></i> Twitter</a>. Check our <a href="/faq">FAQs</a> if you have any questions.
            </p>
        </div>
    </div>
</div>
</div>
<script src="<?= mix('js/bootstrap.js'); ?>"></script>
<script src="<?= mix('js/vendor.js'); ?>"></script>
<script src="<?= mix('js/destiny.js'); ?>"></script>
<script src="<?= mix('js/app.js'); ?>"></script>
@if (! App::isLocal())
    @include('vendor.analytics')
@endif
</body>
</html>