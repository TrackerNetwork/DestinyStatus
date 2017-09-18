@if (! App::isLocal())
<script>
    window.device = 'mobile';
    if (window.matchMedia !== undefined && window.matchMedia("(min-width: 1000px)").matches) {
        window.device = 'desktop';
    }
</script>
@endif