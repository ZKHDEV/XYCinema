$(function(){
    // setTimeout('footerPosition()',1000);
    footerPosition();
    $(window).resize(footerPosition);
});

function footerPosition(){
    $("footer").removeClass("fixed-bottom");
    var contentHeight = $(document.body).outerHeight(true),//网页正文全文高度
        winHeight = $(window).height();//可视窗口高度，不包括浏览器顶部工具栏
    console.log('contentHeight:'+contentHeight);
    console.log('winHeight:'+winHeight);
    if(contentHeight > winHeight){
        $("footer").removeClass("fixed-bottom");
    } else {
        //当网页正文高度小于可视窗口高度时，为footer添加类fixed-bottom
        $("footer").addClass("fixed-bottom");
    }
}

