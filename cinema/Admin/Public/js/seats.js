$(function () {
    $('.seatlink').click(function () {
        if($(this).attr('sel')=='1') {
            $(this).attr('sel','0');
            $(this).find('img').attr('src','/cinema/Admin/Public/img/eseat.png');
            $("#seatnum").val(parseInt($("#seatnum").val())-1);
            var seats = $("#seats").val();
            var seatarr = seats.split(',');
            seatarr.splice($.inArray($(this).attr('num'),seatarr),1);
            seats = seatarr.join(',');
            $("#seats").val(seats);
        }else if($(this).attr('sel')=='0'){
            $(this).attr('sel','1');
            $(this).find('img').attr('src','/cinema/Admin/Public/img/sseat.png');
            $("#seatnum").val(parseInt($("#seatnum").val())+1);
            var seats = $("#seats").val();
            var seatarr = seats.split(',');
            seatarr.push($(this).attr('num'));
            seats = seatarr.join(',');
            $("#seats").val(seats);
        }
    });
});

function checkseat() {
    if(parseInt($("#seatnump").html()) === 0) {
        alert('请选择座位！');
        return false;
    }
    return true;
}