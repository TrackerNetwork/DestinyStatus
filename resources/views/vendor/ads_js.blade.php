@if (! App::isLocal())
    <script src="//tags-cdn.deployads.com/a/destinystatus.com.js" async></script>
    <script>
        window.device = 'mobile';
        if (window.matchMedia !== undefined && window.matchMedia("(min-width: 1000px)").matches) {
            window.device = 'desktop';
        }
    </script>
@endif