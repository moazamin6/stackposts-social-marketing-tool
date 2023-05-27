<div class="mw-400 container d-flex align-items-center align-self-center h-100">
    <div>
        <div class="text-center px-4">
            <img class="mw-100 mh-300px mb-3" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty.png">
            <div>
                <a class="btn btn-primary btn-sm b-r-30" href="<?php _ec( get_module_url("index/update") )?>">
                    <i class="fad fa-plus"></i><?php _e("Add new")?>
                </a>

                <button type="button" class="btn btn-dark btn-sm b-r-30 fileinput-button">
                    <i class="fad fa-file-import"></i> <?php _e("Import")?>
                    <input id="import_language" type="file" name="files[]" multiple="" data-action="<?php _ec( get_module_url("do_import") )?>" data-redirect="<?php _ec( get_module_url() )?>">
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        Core.do_upload("import_language");
    });
</script>