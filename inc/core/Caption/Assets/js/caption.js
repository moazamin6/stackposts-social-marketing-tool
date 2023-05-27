"use strict";
function Caption(){
    var self = this;
    this.init = function(){
        self.action();
    };

    this.action = function(){
        $(document).on("click", ".btnCloseCaption", function(){
            var that = $(this).parents(".popup-caption").remove();
            return false;
        });

        $(document).on("click", ".btnGetCaption", function(){
            var that = $(this);
            var name = that.parents(".wrap-input-emoji").find("textarea").attr("name");
            Core.overplay();

            $.post(PATH+"caption/get", { csrf  : csrf, name: name }, function(result){
                that.parents(".wrap-caption").addClass("overflow-hidden h-100").append(result);
                Core.overplay("hide");
            });
            return false;
        });

        $(document).on("click", ".btnSelectCaption", function(){
            var that = $(this);
            var name = $(".popup-caption").attr("data-id");
            var content = that.parents(".caption-item").find("textarea").val();

            var el = $("textarea[name='"+name+"']").emojioneArea();
            el[0].emojioneArea.setText(content);
            $(".popup-caption").remove();

            return false;
        });

        $(document).on("click", ".btnSaveCaption", function(){
            var that = $(this);
            var name = that.parents(".wrap-input-emoji").find("textarea").attr("name");
            Core.overplay();

            $.post(PATH+"caption/popup_save", { csrf  : csrf, name: name }, function(result){
                $("body").append(result);

                var el = $("textarea[name='"+name+"']").emojioneArea();
                var content = el[0].emojioneArea.getText();
                $("textarea[name='caption_content']").val(content);

                $('#saveCaptionModal').modal('show').on('hidden.bs.modal', function (e) {
                    $(this).remove();
                });
                Core.overplay("hide");
            });
            return false;
        });
    };

    this.closeSaveModal = function(){
        $('#saveCaptionModal').modal('hide');
    };

    this.emojioneArea = function(el){
        //Emoji texterea

        if(el == undefined){
            el = "input-emoji"
        }

        if($("."+el).length > 0){
            $("."+el).emojioneArea({
                hideSource: true,
                useSprite: false,
                pickerPosition    : "bottom",
                filtersPosition   : "top",
            });

            setTimeout(function(){
                $(".emojionearea-editor").niceScroll({cursorcolor:"#ddd"});
            }, 1000);
        }
    };

}

var Caption = new Caption();
$(function(){
    Caption.init();
});