<?php if (get_option("beamer_status", 0)==1 && get_option("beamer_product_id", "") != ""): ?>
<div class="d-flex align-items-stretch ms-1">
    <div class="d-flex align-items-center">
        <div class="btn btn-icon btn-active-light-primary" id="beamer-notification">
            <i class="fad fa-bell"></i>
        </div>
    </div>
</div>
<script>
    var beamer_config = {
        product_id : '<?php _e( get_option("beamer_product_id", "") )?>'
    };
</script>
<script type="text/javascript" src="https://app.getbeamer.com/js/beamer-embed.js" defer="defer"></script>
<?php endif ?>