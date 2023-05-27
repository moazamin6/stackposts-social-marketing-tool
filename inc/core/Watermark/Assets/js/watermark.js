"use strict";
function Watermark(){
    var self = this;
    this.init = function(){
        self.actions();
        self.upload();
        self.range();
        setTimeout(function(){
            self.render($(".watermark-positions .watermark-position-item.active"));
        }, 200);
    };

    this.actions = function(){
        $(document).on("change", "#watermark_upload", function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.watermark-mask').remove();
                    $(".watermark-image").append('<img class="watermark-mask" src="'+e.target.result+'">');
                    setTimeout(function(){
                        self.render($(".watermark-positions .watermark-position-item.active"));
                    }, 50);
                }

                reader.readAsDataURL(input.files[0]);
            }
        });

        $(document).on("change", ".watermark-size, .watermark-transparent", function(){
            self.render($(".watermark-positions .watermark-position-item.active"));
        });

        $(document).on("click", ".watermark-positions .watermark-position-item", function(){
            self.render($(this));
        });

        $(document).on("click", ".btnUploadWatermark", function(){
            event.preventDefault();    
            var _that = $(this);
            var _action = PATH + "watermark/upload_files";
            var size = $(".watermark-size").val();
            var transparent = $(".watermark-transparent").val();
            var position = $(".watermark-position").val();
            var ids = $(".watermark-ids").val();
            var data = $.param({ csrf: csrf, size: size, opacity: transparent, position: position, ids: ids });
            Core.ajax_post(_that, _action, data, null);
            return false;
        });

        $(document).on("click", ".btn-delete-watermark", function(){
            var ids = $(".watermark-ids").val();
            var action = PATH + "watermark/delete/"+ids;

            Core.ajax_post( $(".watermark"), action, { csrf: csrf } ,function(result){

                

            });
        });
    };

    this.upload = function(){
        
    	$(document).on( 'change', '#watermake-upload', function(){
    		var size = $('.watermark-size').val()
    		var opacity = $('.watermark-transparent').val();
    		var position = $('.watermark-position').val();
    		var ids = $('.watermark-ids').val();

		 	var form_data = new FormData();
		 	form_data.append("size", size);
		 	form_data.append("opacity", opacity);
		 	form_data.append("position", position);
		 	form_data.append("ids", ids);
			var totalfiles = document.getElementById('watermake-upload').files.length;
			for (var index = 0; index < totalfiles; index++) {
		  		form_data.append("files[]", document.getElementById('watermake-upload').files[index]);
			}
			
			$(this).val('');
		 	var url = PATH + 'watermark/upload_files';
			$.ajax({
				url: url, 
				type: 'post',
				data: form_data,
				dataType: 'json',
				contentType: false,
				processData: false,
				xhr: function () {
			        var xhr = new window.XMLHttpRequest();
			        xhr.upload.addEventListener("progress", function (evt) {
			            if (evt.lengthComputable) {
			                var percentComplete = evt.loaded / evt.total;
			            }
			        }, false);
			        xhr.addEventListener("progress", function (evt) {
			            if (evt.lengthComputable) {
			                var percentComplete = evt.loaded / evt.total;
			            }
			        }, false);
			        return xhr;
			    },
				success: function (result) {
					if(result.status == "success"){
						$(".watermark-mask").attr("src", result.mask)
					}else{
						Core.notify(result.message, result.status);
					}
				}
		   	});

		   	return false;
		} );
    };

    this.range = function(){
        $('input[type="range"]').ionRangeSlider({
            min: 0,
            max: 100
        });
        self.render($(".watermark-positions .watermark-position-item.active"));
    };

    this.render = function(that){
        var size = $(".watermark-size").val();
        var transparent = $(".watermark-transparent").val();
        
        $('.watermark-mask').css({"width": size+"%"});
        $('.watermark-mask').css({"opacity": (transparent/100)});
        $('.watermark-mask').removeClass("d-none");

        var width = $(".watermark-mask").width();
        var height = $(".watermark-mask").height();
        var type = that.data("direction");
        
        that.addClass('active').siblings().removeClass('active');
        $(".watermark-position").val(type);
        switch(type){
            case "lt":
                $('.watermark-mask').css({"top": 0, "left": 0, "margin-left": 0, "margin-top": 0});
                break;

            case "ct":
                $('.watermark-mask').css({"top": 0, "left": 50+"%", "margin-left": "-"+width/2+"px", "margin-top": 0});
                break;

            case "rt":
                $('.watermark-mask').css({"top": 0, "right": 0, "left": "inherit", "margin-left": 0, "margin-top": 0});
                break;

            case "lc":
                $('.watermark-mask').css({"top": 50+"%", "left": 0, "margin-left": 0, "margin-top": "-"+height/2+"px"});
                break;

            case "cc":
                $('.watermark-mask').css({"top": 50+"%", "left": 50+"%", "margin-left": "-"+width/2+"px", "margin-top": "-"+height/2+"px"});
                break;

            case "rc":
                $('.watermark-mask').css({"top": 50+"%", "right": 0, "left": "inherit", "margin-left": 0, "margin-top": "-"+height/2+"px"});
                break;

            case "lb":
                $('.watermark-mask').css({"bottom": 0, "left": 0, "top": "inherit", "margin-left": 0});
                break;

            case "cb":
                $('.watermark-mask').css({"bottom": 0, "left": 50+"%", "top": "inherit", "margin-left": -width/2+"px"});
                break;

            case "rb":
                $('.watermark-mask').css({"bottom": 0, "right": 0, "top": "inherit", "left": "inherit", "margin-left": 0});
                break;
        }
    };

}

var Watermark = new Watermark();
$(function(){
    Watermark.init();
});