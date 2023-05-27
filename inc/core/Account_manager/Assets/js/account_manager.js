"use strict";
function Account_manager(){
    var self = this;
    this.init = function(){
        self.selectAccount();
    };

    this.selectAccount = function(el){
        
        $(document).on("click", ".am-open-list-account", function(){
            if($(".am-list-account").hasClass("down")){
                $(".am-list-account").slideUp().removeClass("down");
                $(".am-choice-box").removeClass("active");
            }else{
                $(".am-list-account").slideDown().addClass("down");
                $(".am-choice-box").addClass("active");
            }
        });

        $(document).mouseup(function (e) {
            var container = $(".am-choice-box");
            if(!container.is(e.target) && 
            container.has(e.target).length === 0) {
                $(".am-list-account").slideUp().removeClass("down");
                $(".am-choice-box").removeClass("active");
            }
        });

        $(document).on("change", ".am-choice-body .am-choice-item", function(){
            var that = $(this);
            if(!that.find("input").is(":checked")){
                var id = that.find("input").val();
                $(".am-selected-list .am-selected-item[data-id='"+id+"']").remove();

                if( $(".am-selected-list .am-selected-item").length == 0 ){
                    $(".am-selected-empty").show();
                }

                self.checkListChoiceEmpty();
            }else{
                var selected_item_html = that.find(".am-choice-item-selected").html();
                $(".am-selected-list").append(selected_item_html);
                $(".am-selected-empty").hide();
            }
            Post.openAdvanceOptions();
        });

        $(document).on("click", ".am-selected-list .am-selected-item .remove", function(){
            var that = $(this).parents(".am-selected-item");
            var id = that.attr("data-id");
            that.remove();
            $(".am-choice-body .am-choice-item input[value='"+id+"']").prop('checked',false);
            self.checkListChoiceEmpty();
            Post.openAdvanceOptions();
        });

        $(document).on("click", ".btnSelectedGroup", function(){
            var accounts = $(this).data("accounts");
            $(".am-selected-list .am-selected-item").remove();
            $(".am-choice-body .am-choice-item").each(function(){
                var pid = $(this).data("pid");
                if( jQuery.inArray( pid.toString(), accounts ) != -1 || jQuery.inArray( parseInt(pid), accounts ) != -1 ){
                    $(this).find("input").prop('checked', true);
                    var selected_item_html = $(this).find(".am-choice-item-selected").html();
                    $(".am-selected-list").append(selected_item_html);
                    $(".am-selected-empty").hide();
                }else{
                    $(this).find("input").prop('checked', false);
                    var id = $(this).find("input").val();
                    $(".am-selected-list .am-selected-item[data-id='"+id+"']").remove();
                    if( $(".am-selected-list .am-selected-item").length == 0 ){
                        $(".am-selected-empty").show();
                    }
                    self.checkListChoiceEmpty();
                }
            });
        });

        $(document).on("change", ".am-list-account .check-box-all", function(){
            var that = $(this);
            if(!that.is(":checked")){
                $(".am-selected-list .am-selected-item").remove();
                if( $(".am-selected-list .am-selected-item").length == 0 ){
                    $(".am-selected-empty").show();
                }
                self.checkListChoiceEmpty();
            }else{
                $(".am-list-account .am-choice-body .am-choice-item").each(function(){
                    var selected_item_html = $(this).find(".am-choice-item-selected").html();
                    $(".am-selected-list").append(selected_item_html);
                    $(".am-selected-empty").hide();
                });

            }
        });

    };

    this.CheckAndSelect = function(item){
        item.find("input").prop("checked", true);
        var selected_item_html = item.find(".am-choice-item-selected").html();
        $(".am-selected-list").append(selected_item_html);
        $(".am-selected-empty").hide();
    };

    this.checkListChoiceEmpty = function(){
        if( $(".am-selected-list .am-selected-item").length == 0 ){
            $(".am-selected-empty").show();
        }
    }

}

var Account_manager = new Account_manager();
$(function(){
    Account_manager.init();
});