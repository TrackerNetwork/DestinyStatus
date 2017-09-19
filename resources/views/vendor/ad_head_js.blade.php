@if (! App::isLocal() && Gate::denies('hide-ads', Auth::user()))
<script>
    window.device = 'mobile';
    if (window.matchMedia !== undefined && window.matchMedia("(min-width: 1000px)").matches) {
        window.device = 'desktop';
    }
</script>
@endif