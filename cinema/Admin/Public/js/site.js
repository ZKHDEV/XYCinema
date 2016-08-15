$('.mainmenu').on('click','li',function () {
    if(!$(this).hasClass('start active')){
        $('.mainmenu li').removeClass('start active');
        $('.mainmenu li span.selected').remove();
        $(this).addClass('start active');
        $('.mainmenu li > a').append('<span class="selected"></span>');
    }
});


