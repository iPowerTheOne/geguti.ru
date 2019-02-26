(function () {
    "use strict";
    
    $(document).ready(function () {
        var prev=0;
        
        $(window).on('scroll', function () {
            var top=$(window).scrollTop();
            
            if (top>prev && top>90) {
                if (!$('.header').hasClass('header_overflow')) {
                    $('.header').addClass('header_hide');
                } else {
                    $('.header').removeClass('header_hide');
                }
                $('.header').addClass('header_overflow');
                $('.header').removeClass('header_active');
            } else if (top<prev) {
                $('.header').removeClass('header_hide');
                if (top==0) {
                    $('.header').removeClass('header_overflow');
                    $('.header').removeClass('header_active');
                } else {
                    $('.header').addClass('header_active');
                }                
            }
            
            prev=top;
        });        
        $(window).trigger('scroll');
        
        $(window).on('resize', function () {
            $('body').removeClass('overflow');
            $('.mobile').removeClass('mobile_active');
            $('.overlay').removeClass('overlay_active');
            $('.callback').removeClass('callback_active');                        
        });
        $(window).trigger('resize');
        
        $('.js-link').on('click', function (e) {
            e.preventDefault();
            var href=$(this).attr('href');
            var p=$(href).parent().offset();
            $('.mobile').removeClass('mobile_active');
            $('.overlay').removeClass('overlay_active');
            $('html, body').animate({scrollTop: (p.top)},1000,function () {
                prev=1;
                $(window).trigger('scroll');
            });
        });
        
        var slider=$('.slider').bxSlider({
            pager: false,
            controls: false
        });
        
        $('.block-reviews__control').on('click', function (e) {
            e.preventDefault();
            if ($(this).hasClass('block-reviews__control-prev')) {
                slider.goToPrevSlide();
            } else if ($(this).hasClass('block-reviews__control-next')) {
                slider.goToNextSlide();
            }
            prev=1;
            $(window).trigger('scroll');            
        });
        
        $('.form__control-label').on('click', function () {
            if ($(this).hasClass('form__control-label_sel')) return;
            $(this).addClass('form__control-label_sel');
            $(this).parent().find('.form__control-input').focus();
        });
        
        $('.form__control-input').on('blur', function () {
            if (!$(this).val()) {
                $(this).parent().find('.form__control-label').removeClass('form__control-label_sel');
            }
        });
        
        $('.form__control-input').val('');
        
        $('.form__control-file').on('change', function () {
            var val=$(this).val();
            if (val) {
                val=val.split(/(\\|\/)/g).pop();
                var label=$(this).parent().find('.form__control-label');
                var obj=$(this).parent().find('.form__control-input');
                $(obj).val(val);
                $(label).trigger('click');
                $(obj).blur();
            }
        });
        
        $('.form').on('submit', function (e) {
            var error=false;
            $(this).find('.js-req').each(function () {
                var val=$(this).val().trim();                
                if (val) {
                    $(this).parent().removeClass('js-req__error');
                } else {
                    $(this).parent().addClass('js-req__error');
                    error=true;
                }
            });
            
            if (error) {
                e.preventDefault();
            }
        });
        
        $('.js-callback').on('click', function (e) {
            e.preventDefault();
            $('body').addClass('overflow');
            $('.overlay').addClass('overlay_active');
            $('.callback').addClass('callback_active');
        });
        
        $('.callback').on('click', function (e) {
            if (!$(e.target).closest('.callback__form').length || $(e.target).hasClass('form__close') || $(e.target).hasClass('form__btn-close')) {
                e.preventDefault();                
                $('.callback').removeClass('callback_active');
                $('.overlay').removeClass('overlay_active');
                window.setTimeout(function () {
                    $('body').removeClass('overflow');
                },800);                
            }
        });
        
        $('.header__mobile').on('click', function (e) {
            e.preventDefault();
            $('.mobile').addClass('mobile_active');
            $('body').addClass('overflow');
        });
        
        $('.mobile__link_close').on('click', function (e) {
            e.preventDefault();
            $('.mobile').removeClass('mobile_active');
            $('body').removeClass('overflow');            
        });
    });
    
})(jQuery);