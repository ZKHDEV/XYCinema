function getticketbymovie(target) {
    $("#ticketul").empty();
    var location = $(target).html();
    var mid = $(target).attr("mid");
    $.post("/cinema/Home/Order/getticket",{"c_location":location,"m_id":mid},function (data) {
        var res = eval(data);
        $.each(res,function (k,v) {
            $("#ticketul").append("<a class='list-group-item' href='/cinema/Home/Order/seat/t_id/"+v.t_id+"'>"+v.cinema+"<span class='stanspan2'>"+v.t_standard+'/'+v.t_language+"</span><span class='datetimespan2'>"+
                v.t_date+' '+v.t_time+"</span><span class='pricespan2'>"+"¥"+v.t_price+"</a>");
        });
    });
}