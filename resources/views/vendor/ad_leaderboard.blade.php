@if (! App::isLocal())
    <div class="row">
        <div class="col-xs-12" style="text-align:center;width:100%;">
            <script>
                if (window.device == 'mobile') {
                    document.write('<div class="ad-tag" data-ad-name="300x250_#1" data-ad-size="300x250" ></div>');
                }
                else {
                    document.write('<div class="ad-tag" data-ad-name="728x90_#1" data-ad-size="728x90" ></div>');
                }
                (deployads = window.deployads || []).push({});
            </script>
        </div>
    </div>
@endif