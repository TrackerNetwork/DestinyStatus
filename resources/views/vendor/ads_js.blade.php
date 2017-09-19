@if (! App::isLocal() && Gate::denies('hide-ads', Auth::user()))
    <script src="//tags-cdn.deployads.com/a/destinystatus.com.js" async></script>
@endif