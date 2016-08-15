$(function () {
    $('.seatlink').click(function () {
        if($(this).attr('sel')=='1') {
            if($(this).parent().next().find('a').attr('sel') == "1"
                && $(this).parent().prev().find('a').attr('sel') == "1")
            {
                alert('请选择连续的座位！');
                return;
            }

            $(this).attr('sel','0');
            $(this).find('img').attr('src','/cinema/Admin/Public/img/eseat.png');
            $("#seatnum").val(parseInt($("#seatnum").val())-1);

            var seats = $("#seats").val();
            var seatarr = seats.split(',');
            seatarr.splice($.inArray($(this).attr('num'),seatarr),1);
            seats = seatarr.join(',');
            $("#seats").val(seats);

            var col=$(this).attr('col');
            var row=$(this).attr('row');
            var seat=row+'排'+col+'号';
            $("#seatlist").val($("#seatlist").val().replace(seat+';',''));

            $("#seatnump").html(parseInt($("#seatnump").html())-1);

        }else if($(this).attr('sel')=='0'){
            if(parseInt($("#seatnump").html())===6){
                alert("每笔订单最多可以选择6个座位");
                return;
            }
            if(parseInt($("#seatnump").html()) !== 0){
                if($(this).parent().next().find('a').attr('sel') != "1"
                    && $(this).parent().prev().find('a').attr('sel') != "1")
                {
                    alert('请选择连续的座位！');
                    return;
                }
            }

            $(this).attr('sel','1');
            $(this).find('img').attr('src','/cinema/Admin/Public/img/sseat.png');
            $("#seatnum").val(parseInt($("#seatnum").val())+1);

            var seats = $("#seats").val();
            if(seats==='') {
                $("#seats").val($(this).attr('num'));
            }else{
                var seatarr = seats.split(',');
                seatarr.push($(this).attr('num'));
                seats = seatarr.join(',');
                $("#seats").val(seats);
            }

            var col=$(this).attr('col');
            var row=$(this).attr('row');
            var seat=row+'排'+col+'号';
            $("#seatlist").val($("#seatlist").val()+seat+';');

            $("#seatnump").html(parseInt($("#seatnump").html())+1);
        }
    });
});


function checkform() {
    if($("#seatlist").val()==='' || $("#seats").val()==='') {
        alert("请选择座位");
        return false;
    }
    return true;
}