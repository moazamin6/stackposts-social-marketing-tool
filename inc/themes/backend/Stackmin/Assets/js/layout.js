"use strict";
function Layout(){
    var self = this;
    this.init = function(){
        self.menu();
        self.header();
        self.sidebar();
        self.search();
        self.checkbox();
        self.dropdown();
        self.tooltip();
        self.scroll();
        self.carousel();
        self.resize();
    };

    this.sidebar = function(){
        $(document).on('click', '.sidebar .sidebar-toggle', function(){
            if( !$('body').hasClass('sidebar-close') ){
                if( $(window).width() > 768){
                    if( $('body').hasClass('sidebar-hover') ){
                        $('body').removeClass('sidebar-hover');
                        $('body').addClass('sidebar-open');
                        localStorage.setItem('sidenav-state', 'pinned');
                    }else{
                        $('body').addClass('sidebar-hover');
                    }

                    if( $('body').hasClass('sidebar-hover') ){
                        $('body').attr('class', 'sidebar-small');
                        $('.sidebar .menu-sub').hide().removeClass('show');
                        localStorage.setItem('sidenav-state', 'unpinned');
                    }
                }else{
                    if( $('body').hasClass('sidebar-small') ){
                        $('body').addClass('sidebar-hover');
                        $('body').removeClass('sidebar-small');
                    }else{
                        $('body').addClass('sidebar-small');
                        $('body').removeClass('sidebar-hover');
                    }
                }
            }

            self.header();
        });
        
        $(document).on('click', '.sidebar .menu .menu-item', function(e){
            var that = $(this);

            if( that.find('.submenu').hasClass('submenu') ){
                that.siblings('.menu-item').removeClass('menu-open').find('.submenu').stop().slideUp(0);
            }

            if( !that.find('.submenu').hasClass('open') ){
                that.addClass('open');

                if( that.hasClass('menu-open') && that.find('.submenu').hasClass('submenu') ){
                    that.find('.submenu').stop().slideUp(0, function() {
                        that.removeClass('menu-open');
                        that.removeClass('open');

                    });

                }else{
                    that.find('.submenu').stop().slideDown(0, function() {
                        that.addClass('menu-open');
                        that.removeClass('open');
                    });
                }
            }
        });

        $(document).on({
            mouseenter: function () {
                if( $('body').hasClass('sidebar-small') ){
                    $('body').addClass('sidebar-hover').removeClass('sidebar-small');
                }
            },
            mouseleave: function () {
                if( $('body').hasClass('sidebar-hover') ){
                    $('body').removeClass('sidebar-hover').addClass('sidebar-small');
                    $('.sidebar .menu-sub').hide().removeClass('show');
                }
            }
        }, '.sidebar');

        $(document).on( "click", ".sidebar .nav-link", function(e){
            if( $(this).next('.menu-sub').length > 0 ){
                e.preventDefault();
                var _that = $(this);
                var nav_item = _that.parents(".nav-item");
                var menu_sub = nav_item.find('.menu-sub');

                if( menu_sub.length > 0 ){
                    if( menu_sub.hasClass('show') ){
                        menu_sub.stop(true, true).slideUp().removeClass('show');
                    }else{
                        $('.sidebar .menu-sub').hide().removeClass('show');
                        menu_sub.stop(true, true).slideDown().addClass('show');
                    }
                }
            }
        });

        $('body.sidebar-close .webuiPopover').webuiPopover({content: 'Content' , width: 250, trigger: 'hover'});

        $('body.sidebar-close .sidebar .nav-item.have-menus-sub > a.nav-link').webuiPopover({
            container: ".sidebar-popover",
            placement: 'auto-right',
            trigger: 'click',
            padding: false,
            animation: "fade", //pop
            delay: { 
                show: 200,
                hide: 100
            },
            content: function(data){
                var html = "<div class='menu-content menu-scroll-content'>"+$(this).next().html()+"</div>";
                return html;
            }
        });

        $('.btn-open-sidebar').on('click', function () {
            setTimeout(function () {
                $(this).toggleClass('active');
                $('.sidebar').toggleClass('active');
            }, 100);
        });

        $('.sidebar a').on('click', function (event) {
            if( !$(this).parents(".have-menus-sub").length > 0 ){
                event.stopPropagation();
            }
        });

        $('.btn-open-sub-sidebar').on('click', function () {
            setTimeout(function () {
                $(this).toggleClass('active');
                $('.sub-sidebar').toggleClass('active');
                $('.submenu-right').toggleClass('active');
            }, 100);
        });

        $(document).on("click", function (e) {
            if ($(e.target).parents('.sub-sidebar').length == 0) {
                $(".sub-sidebar").removeClass('active');
                $(".btn-open-sub-sidebar").removeClass('active');
                $('.submenu-right').toggleClass('active');
            }

            if ($(e.target).parents('.sidebar-wrapper').length == 0) {
                $(".sidebar").removeClass('active');
                $(".btn-open-sidebar").removeClass('active');
                $('.submenu-right').toggleClass('active');
            }
        });

        /*$('.sub-sidebar').on('click', function (event) {
            if( 
                !$( $(this) ).hasClass("actionItem") && 
                !$( $(this) ).hasClass("actionMultiItem") && 
                !$( $(this) ).hasClass("actionForm") &&
                !$( $(this) ).hasClass("search-input")
            ){
                //event.stopPropagation();
            }
        });*/

        if( $(".sub-sidebar").length > 0 ){
            $(".btn-open-sub-sidebar").parents(".d-lg-none").removeClass("d-sm-none d-none").addClass("d-sm-block d-block");
        }
    };

    this.closeSidebar = function(){
            $(".sidebar").removeClass('active');
            $('.sub-sidebar').removeClass('active');
            $(".btn-open-sidebar").removeClass('active');
    }

    this.header = function(){
        if( $(".sub-sidebar").length == 0 ){
            if( $("body.sidebar-open").length > 0 ){
                $(".header").width( $(window).width() - 250 ).fadeIn(100); 
            }else{
                $(".header").width( $(window).width() - 80 ).fadeIn(100); 
            }
        }else{
            $(".header").fadeIn(100); 
        }
    };

    this.search = function(el){
        if(el == undefined){
            el = 'search-list';
        }

        $(document).on('keyup', '.search-input', function() {
            var search_element = $(this).data("search");
            if( search_element != undefined ){
                el = search_element;
            }else{
                el = 'search-list';
            }

            var value = $(this).val().toLowerCase();
            $( '.' + el ).filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    };

    this.checkbox = function(el){
        /*Check all*/
        $(document).on("change", ".check-all", function(){
            var that = $(this);
            if($('input:checkbox').hasClass("check-item")){
                if(!that.hasClass("checked")){
                    $('input.check-item:checkbox').prop('checked',true);
                    that.addClass('checked');
                }else{
                    $('input.check-item:checkbox').prop('checked',false);
                    that.removeClass('checked');        
                }
            }
            return false;
        });

        /*Check all*/
        $(document).on("change", ".check-box-all", function(){
            var that = $(this);
            if(that.parents(".check-wrap-all").find("input:checkbox").hasClass("check-item")){
                if(!that.hasClass("checked")){
                    that.parents(".check-wrap-all").find("input.check-item:checkbox").prop('checked',true);
                    that.addClass('checked');
                }else{
                    that.parents(".check-wrap-all").find("input.check-item:checkbox").prop('checked',false);
                    that.removeClass('checked');        
                }
            }
            return false;
        });
    };

    this.menu = function(){
        $(document).on("click", ".sp-menu .sp-menu-item", function(){
            var that = $(this);
            var checkbox = that.find("input");
            var activeClass = that.data("active");
            var removeOther = that.data("remove-other-active");

            if(removeOther != undefined && removeOther){
                that.parents(".sp-menu").find(".sp-menu-item").removeClass( activeClass );
            }

            if( activeClass != undefined ){
                if( that.hasClass( activeClass ) ){
                    that.removeClass(activeClass);
                }else{
                    that.addClass(activeClass);
                }
            }

            if(checkbox.length > 0){
                switch( checkbox.attr("type") ){
                    case "checkbox":
                        if ( checkbox.is(':checked') ) {
                            checkbox.prop("checked", false).change();
                        }else{
                            checkbox.prop("checked", true).change();
                        }
                        break;

                    case "radio":
                        checkbox.prop("checked", true).change();
                        break;

                    default:
                        break;
                }
            }
        });
    };

    this.dropdown = function(){
        $(document).on("click", ".dropdown .dropdown-toggle", function(){
            var that = $(this);
            var dropdown = that.parents(".dropdown");
            var spacing = dropdown.data("dropdown-spacing") != undefined? dropdown.data("dropdown-spacing") : 0;
            var down = spacing + 20;

            if( !that.parents(".dropdown").hasClass("show") ){
                that.parents(".dropdown").addClass("show");
                that.next(".dropdown-menu").css({ opacity: 0, top: down }).addClass("show").animate({ top: spacing , opacity: 1 }, 300);
            }else{
                that.parents(".dropdown").removeClass("show");
                that.next(".dropdown-menu").css({ opacity: 1, top: spacing }).animate({ top: down  , opacity: 0 }, 300, function(){
                    that.next(".dropdown-menu").removeClass("show")
                });
            }
        });

        $(document).mouseup(function(e) {
            var container = $(".dropdown.show");
            if (!container.is(e.target) && container.has(e.target).length === 0) 
            {
                container.removeClass("show");
                container.find(".dropdown-menu").removeClass("show").removeAttr("style");
            }
        });

        //Hide dropdown when click
        $(document).on('click', '.dropdown.dropdown-hide .dropdown-menu a', function () {
            $(this).parents('.dropdown-menu.show').removeClass('show');
            $(this).parents('.dropdown.show').removeClass('show');
        });
    };

    this.tooltip = function(){
        $(document).on('mouseenter','[data-toggle="tooltip"]', function(){
            $(this).tooltip('show');
        });
    };

    this.scroll = function(){
        $('.nx-scroll,.overflow-x-auto,.overflow-x-scroll').mousewheel(function(e, delta) {
            this.scrollLeft -= (delta * 40);
            e.preventDefault();
        });
    };

    this.carousel = function(element){
        if(element == undefined){
            var element = "owl-carousel";
        }

        if( $('.'+element).length > 0 ){
            $('.'+element).owlCarousel({
                loop:true,
                margin:0,
                nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                }
            });
        }
    }

    this.resize = function(){
        $(window).resize( function(){
            self.header();
        });
    };
}

var Layout = new Layout();
$(function(){
    Layout.init();
});