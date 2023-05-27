<script type="text/javascript">
    var PATH  = '<?php _ec( base_url()."/" )?>';
    var csrf = "<?php _ec( csrf_hash() ) ?>"; 
    var FORMAT_DATE = 'dd/mm/yy';
    var LANGUAGE = "";
    var FORMAT_DATE = '<?php _ec( date_show_js() ) ?>';
    var FORMAT_DATETIME = <?php _ec( datetime_show_js() )?>;
</script>