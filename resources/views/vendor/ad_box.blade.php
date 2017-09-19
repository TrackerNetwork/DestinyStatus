@if (! App::isLocal() && Gate::denies('hide-ads', Auth::user()))
    <div class="col-md-4">
        <div style="margin-top:50px;">
            <div class="ad-tag" data-ad-name="300x250_#1" data-ad-size="300x250" ></div>
            <script src="//tags-cdn.deployads.com/a/destinystatus.com.js " async ></script>
            <script>(deployads = window.deployads || []).push({});</script>
        </div>
    </div>
@endif