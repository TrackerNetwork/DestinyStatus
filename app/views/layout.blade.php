<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="csrf-token" content="<?= csrf_token() ?>">
	<title>@yield('title', 'Destiny Status')</title>
	<link rel="shortcut icon" href="{{ url('favicon.ico') }}"/>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,700,300,500">
	<link rel="stylesheet" type="text/css" href="<?= Asset::url('css/destiny.css') ?>">
	<script src="<?= Asset::url('js/destiny.js') ?>"></script>
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
				<div class="form-group input-group">
					<input type="text" class="form-control" placeholder="Gamertag" name="gamertag" value="<?= e(Input::get('gamertag')) ?>">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form>
		</div>
	</div>
</nav>

<div id="page" class="container">
	<?php if (Session::has('alert')): ?>
		<div class="alert alert-danger"><?=e(Session::pull('alert'))?></div>
	<?php endif; ?>

	@yield('content')

	<div class="footer row">
		<div class="col-md-8 about">
			<p class="version">
				<?= date('Y') ?> &copy; DestinyStatus v<?= version() ?>
				@if( ! App::environment('production'))
				[<?= App::environment() ?>]
				@endif
			</p>
			<p>
				This is a hobby project by <a href="/psn/HermanGatevold">HermanGatevold</a> and is not financed by or associated with Bungie.<br>
				All information used on this site is the property of Bungie.
			</p>
			<p>
				Contact me on <a href="http://reddit.com/u/mofrodo" target="_blank"><i class="fa fa-reddit-square"></i> Reddit</a>
				or <a href="http://twitter.com/DestinyStatus" target="_blank"><i class="fa fa-twitter-square"></i> Twitter</a>.
			</p>
		</div>

		<div class="col-md-4 donate">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display: inline-block; vertical-align: middle">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----	">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form> to help keep this site alive.
		</div>
	</div>
</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55937533-1', 'auto');
  ga('send', 'pageview');
</script>

</body>
</html>
