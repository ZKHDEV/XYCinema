$(function () {
    getlocation();
});

function cityclick(target) {
    $(".location").html($(target).html());
    getcinema();
}

function cinemaclick(target) {
    $("#cinema").html($(target).html());
    $("#cinema").attr('cid',$(target).attr('cid'));
}

function getlocation() {
    $.post("/cinema/Home/Home/getlocation",function (data) {
        $(".location").html(data);
        getcity();
    });
}

function getcity(){
    $(".citylist").empty();
    $.post("/cinema/Home/Home/getcity",function (data) {
        var res = eval(data);
        $.each(res,function (k,v) {
            $(".citylist").append("<li><a href='javascript:void(0)' onclick='cityclick(this)'>"+v+"</a></li>");
        });
        getcinema();
    });
}

function getcinema() {
    $("#cinemalist").empty();
    $("#cinemalist2").empty();
    $("#movielist").empty();
    $("#ticketlist").empty();
    var location = $(".location").html();
    $.post("/cinema/Home/Home/getcinema",{"c_location":location},function (data) {
        var res = eval(data);
        $.each(res,function (k,v) {
            $("#cinemalist2").append("<li><a href='javascript:void(0)' onclick='cinemaclick(this);getmovie("+v.c_id+")' cid='"+v.c_id+"'>"+v.c_name+"</a></li>");
            $("#cinemalist").append("<a href='javascript:void(0)' class='cinemalink list-group-item' onclick='getmovie("+v.c_id+")' cid='"+v.c_id+"'>"+v.c_name+"</a>");
        });
        $("#cinema").html($("#cinemalist2 a:first").html());
        $("#cinema").attr('cid',$("#cinemalist2 a:first").attr('cid'));
        getmovie($("#cinema").attr('cid'));
    });
}

function getmovie(c_id) {
    $("#movielist").empty();
    $("#ticketlist").empty();
    $(".cinemalink").removeClass("list-group-item-danger active");
    $(".cinemalink[cid='"+c_id+"']").addClass("list-group-item-danger active");
    $.post("/cinema/Home/Home/getmovie",{"c_id":c_id},function (data) {
        var res = eval(data);
        $.each(res,function (k,v) {
            $("#movielist").append("<a href='javascript:void(0)' class='movielink list-group-item' onclick='getticket(this)' cid='"+c_id+"' mid='"+v.m_id+"'>"+v.m_name+"</a>");
        });
    });
}

function getticket(target) {
    $("#ticketlist").empty();
    $(".movielink").removeClass("list-group-item-danger active");
    $(target).addClass("list-group-item-danger active");
    var c_id = $(target).attr("cid");
    var m_id = $(target).attr("mid");
    var date = $(".datepicker").val();
    $.post("/cinema/Home/Home/getticket",{"c_id":c_id,"m_id":m_id,"date":date},function (data) {
        var res = eval(data);
        console.log(res);
        $.each(res,function (k,v) {
            $("#ticketlist").append("<a href='/cinema/Home/Order/seat/t_id/"+v.t_id+"' class='ticketlink list-group-item'>"+v.t_time+"<span class='stanspan'>"+v.t_language+'/'+v.t_standard+"</span><span class='pricespan'>"+"¥"+v.t_price+"</span></a>");
        });
    });
}

function getticketbydate() {
    $("#ticketlist").empty();
    var c_id = $("#movielist .active").attr("cid");
    var m_id = $("#movielist .active").attr("mid");
    var date = $(".datepicker").val();
    $.post("/cinema/Home/Home/getticket",{"c_id":c_id,"m_id":m_id,"date":date},function (data) {
        var res = eval(data);
        $.each(res,function (k,v) {
            $("#ticketlist").append("<a href='/cinema/Home/Order/seat/t_id/"+v.t_id+"' class='ticketlink list-group-item'>"+v.t_time+"<span class='stanspan'>"+v.t_language+'/'+v.t_standard+"</span><span class='pricespan'>"+"¥"+v.t_price+"</span></a>");
        });
    });
}