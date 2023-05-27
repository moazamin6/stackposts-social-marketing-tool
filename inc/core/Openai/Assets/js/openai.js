"use strict";
function OpenAI(){
    var self = this;
    this.init = function(){
    };

    this.saveContent = function(result){
        var name = $(".OpenAIGenerate").data("name");
        $("textarea[name="+name+"]").val(result.data).trigger("change");
        $("textarea[name="+name+"]").data("emojioneArea").editor.html(result.data);
        $('#OpenAIModal').modal('hide');
    };

    this.saveImage = function(result){
		File_manager.saveFile(result.data);        
        $('#OpenAIImageModal').modal('hide');
    };
}

var OpenAI = new OpenAI();
$(function(){
    OpenAI.init();
});