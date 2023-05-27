<?php if (get_option("poupup_nofification_backend_status", 0)): ?>
    <div class="modal fade" id="popup_notification" tabindex="-1">
        <div class="modal-lg modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body shadow-none">
                    <?php _ec( htmlspecialchars_decode( get_option("poupup_nofification_backend", ""), ENT_QUOTES) )?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(window).on('load', function() {
            if( Core.getCookie("popup_notification_<?php _ec( get_option("poupup_nofification_id_backend", ids()) )?>") == false ){
                $('#popup_notification').modal('show');
                $("#popup_notification").on('hide.bs.modal', function(){
                    Core.setCookie("popup_notification_<?php _ec( get_option("poupup_nofification_id_backend", ids()) )?>", true, <?php _ec( get_option("poupup_nofification_repeat_backend", "60") )?>);
                });
            }
        });
    </script>
<?php endif ?>