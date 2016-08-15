$(function () {
    var today = new Date();
    var month = today.getMonth()+1>10?today.getMonth()+1:'0'+(today.getMonth()+1);
    var day = today.getDate()>10?today.getDate():'0'+today.getDate();
    var date = month+'/'+day+'/'+today.getFullYear();
    $('.datepicker').val(date);
    $('.datepicker').datetimepicker({
        format:'mm/dd/yyyy',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView:2,
        startDate:date
    });
});
