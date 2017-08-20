<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Bungie Authentication</h4>
            </div>
            <div class="modal-body text-center">
                You can now authenticate yourself with Bungie, this allows you to view a bit more information about your guardian than normally.
                <br /><br />
                Additionally, if you have privacy settings enabled signing in is the only way to view your complete guardian stats.
            </div>
            <!-- If you are reading this. I took the design idea of this modal from DestinyTrialsReport.com -->
            <div class="modal-footer">
                <div class="text-center">
                    <a href="<?= route('login'); ?>" type="button" class="btn btn-primary"><i class="fa fa-sign-in" aria-hidden="true"></i> Authenticate with Bungie.net</a>
                </div>
            </div>
        </div>
    </div>
</div>