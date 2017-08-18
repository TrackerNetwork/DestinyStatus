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
    <link rel="stylesheet" type="text/css" href="//db.destinytracker.com/content/css/tooltip.css">
    <script src="<?= mix('js/bootstrap.js'); ?>"></script>
    <script src="<?= mix('js/vendor.js'); ?>"></script>
    <script src="<?= mix('js/destiny.js'); ?>"></script>
</head>
<body>
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
                <div class="form-group input-group">
                    <input type="text" class="form-control" placeholder="Gamertag"
                           name="gamertag" value="<?= e(Request::get('gamertag')) ?>" maxlength="16"
                           pattern="[A-Za-z][A-Za-z0-9_- ]{0,15}" title="Please enter a valid gamertag or PSN Id">
                    <span class="input-group-btn">
						<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
					</span>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="https://github.com/TrackerNetwork/DestinyStatus"><i class="fa fa-github"></i> Source Code</a></li>
            </ul>
        </div>
    </div>
</nav>

<div id="page" class="container">
    <?php if (Session::has('alert')): ?>
        <div class="alert alert-danger"><?= e(Session::pull('alert'))?></div>
    <?php endif; ?>
    @yield('content')

    <div class="footer row">
        <div class="col-md-12 about">
            <p class="version">
                <?= date('Y') ?> &copy; DestinyStatus v<?= version(); ?>
                @if (App::isLocal())
                    [<?= App::environment() ?>]
                @endif
                <a class="" href="https://github.com/TrackerNetwork/DestinyStatus/blob/master/CHANGELOG.md" target="_blank">Changelog</a><a class="privacy" href="/privacy">Privacy Policy</a>
            </p>
            <p>
                Ads support server costs and all information used on this site is the property of Bungie<br>
                Originally Developed by <a href="/psn/HermanGatevold">HermanGatevold</a>, currently maintained by <a href="https://github.com/iBotPeaches" target="_blank">iBotPeaches</a>
                and the Tracker Network and is not financed by or associated with Bungie.<br>
            </p>
            <p>
                Contact us on <a href="https://github.com/TrackerNetwork/DestinyStatus" target="_blank"><i class="fa fa-github-square"></i> GitHub</a>
                or <a href="https://twitter.com/DestinyStatus" target="_blank"><i class="fa fa-twitter-square"></i> Twitter</a>.
            </p>
        </div>
    </div>
</div>
@if (! App::isLocal())
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-55937533-1', 'auto');
        ga('send', 'pageview');

        ga('create', 'UA-42280104-15', 'auto', { 'name' : 'tracker' });
        ga('tracker.send', 'pageview');
    </script>
@endif
</body>
</html>