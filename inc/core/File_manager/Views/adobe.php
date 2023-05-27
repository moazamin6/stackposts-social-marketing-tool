<?php if ($button): ?>
<a class="dropdown-item ccEverywhere" href="javascript:void(0)"><img src="<?php _ec( get_module_path( __DIR__, "Assets/img/adobe.png") )?>" class="w-17 h-17"> <?php _e("Adobe Express")?></a>
<?php endif ?>
<script src="https://sdk.cc-embed.adobe.com/v2/CCEverywhere.js"></script>
<script type="text/javascript">
	(async () => {
	    ccEverywhere = await window.CCEverywhere.initialize({
            clientId: '<?php _ec( get_option("fm_adobe_client_id", "") )?>',
            appName: "Adobe Express",
            appVersion: { major: 1, minor: 0 },
            platformCategory: 'web', 
            redirectUri: '<?php _ec( base_url() )?>'
        });
	})();

	$(function(){
		$( document ).on( 'click', '.ccEverywhere', function (e) {
	        e.preventDefault();

	        $("body").append("<div class='run_adobe'><div>");

	        ccEverywhere.createDesign({
	            callbacks: {
	                onCancel: () => {
	                	$(".run_adobe").remove();
	                },
	                onPublish: (publishParams) => {
	                	File_manager.saveFile(publishParams.asset.data);
	                   	$(".run_adobe").remove();
	                },
	                onError: (err) => {
	                	$(".run_adobe").remove();
	                    console.error('Error received is', err.toString());
	                }
	            }, 
	            outputParams: {
	                outputType: "base64"
	            }
	        }); 
	    });
	});
</script> 