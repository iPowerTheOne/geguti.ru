(function () {
    "use strict";
    
    $(document).ready(function () {
        new WOW().init();
        var prev=0;
        var facts=$('.block-facts').offset().top-$('.block-facts').outerHeight();
        var tId=false;
        
        $(window).on('scroll', function () {
            var top=$(window).scrollTop();

            if (top>200 && top<prev && !$('.block-top_active').length) {
                $('.block-top').addClass('block-top_active');
            } else if ((top<80 || top>prev) && $('.block-top_active').length) {
                $('.block-top').removeClass('block-top_active');
            }
            
            if (top>facts && !$('.block-facts').hasClass('block-facts_loaded')) {
                $('.block-facts').addClass('block-facts_loaded');
                tId=window.setInterval(function () {
                    
                    $('.block-facts__header').each(function () {
                        var num=1;
                        var rel=parseInt($(this).attr('rel'));
                        var current=parseInt($(this).html());
                        
                        if (rel>500) num=8;
                        else if (rel>100) num=2;
                        
                        current+=num;
                        
                        if (current>rel) current=rel;
                        
                        if (rel>=current) {
                            
                            $(this).html(current);
                        }                        
                    });
                    
                },10);
            }
            
            prev=top;
        });        
        $(window).trigger('scroll');
        
        $('.callback-modal').on('click', function (e) {
            e.preventDefault();
            var target=$(this).attr('rel');
            $('.callback__target').val(target);
            
            $('.block-top').removeClass('block-top_active');
            $('html').addClass('overflow');                
            $('.callback').addClass('callback__active');                
        });
        
        $('.callback__close').on('click', function (e) {
            e.preventDefault();
            $('.callback').removeClass('callback__active');
            window.setTimeout(function () {
                $('html').removeClass('overflow');            
            },500);                        
        });
        
        $('.callback').on('click', function (e) {
            if (!$(e.target).closest('.callback__form').length) {            
                $('.callback__close').trigger('click');
            }
        });
        
        $('.js-link').on('click', function (e) {
            e.preventDefault();
            var href=$(this).attr('href').replace('#','');
            var p=$('a[name="'+href+'"]').offset();
            $('html, body').animate({scrollTop: (p.top+20)},1000, function () {
                $('.block-top').removeClass('block-top_active');                
            });
            $('.mobile-menu__link_close').trigger('click');
        });
        
        $('.mobile-menu-button').on('click', function (e) {
            e.preventDefault();
            $('.mobile-menu').addClass('mobile-menu_active');
            window.setTimeout(function () {
                $('html').addClass('overflow');            
            },500);                                    
        });
        
        $('.mobile-menu__link_close').on('click', function (e) {
            e.preventDefault();
            $('.mobile-menu').removeClass('mobile-menu_active');
            window.setTimeout(function () {
                $('html').removeClass('overflow');            
            },500);                                                
        });
        
        $('.callback__input-phone').mask('8(999)999-99-99');
        
        $('.callback__form').on('submit', function (e) {
            var data=$(this).serialize();
            var error=false;
            
            $(this).find('.js-req').each(function () {
                var val=$(this).val().trim();
                if (val) {
                    $(this).parent().removeClass('callback__input_error');
                } else {
                    error=true;                    
                    $(this).parent().addClass('callback__input_error');
                }
            });
            
            if (error) {
                e.preventDefault();
            }            
        });
        
        $('.callback__target').val('');
        $('.callback__input-text').val('');
    });
    
})(jQuery);