$(function () {
   $("#cinemaselect").change(function () {
       var cinemaid = $("#cinemaselect option:selected").val();
       console.log(cinemaid);
       $.post("/cinema/Admin/Ticket/getroom",{c_id:cinemaid},function (data) {
           $("#roomselect").empty();
           $("#roomselect").append("<option value='' selected>请选择...</option>");
           var res = eval(data);
           $.each(res,function (k,v) {
               $("#roomselect").append("<option value='" + v['r_id'] + "'>" + v['r_name'] + "</option>");
           });
       });
   });
});