$(function () {
   $('#movieaddform').validate({
       event:"keyup",
       rules:{
           m_name:{ required:true },
           m_director:{ required:true },
           m_star:{ required:true  },
           m_type:{ required:true },
           m_country:{ required:true },
           m_language:{ required:true },
           m_version:{ required:true },
           m_showdate:{ required:true },
           m_length:{ required:true },
           m_descride:{ required:true },
           m_frontcover:{ required:true },
           m_poster:{ required:true }
       },
       messages:{
           m_name:{ required:"必填" },
           m_director:{ required:"必填" },
           m_star:{ required:"必填" },
           m_type:{ required:"必填" },
           m_country:{ required:"必填" },
           m_language:{ required:"必填" },
           m_version:{ required:"必填" },
           m_showdate:{ required:"必填" },
           m_length:{ required:"必填" },
           m_descride:{ required:"必填" },
           m_frontcover:{ required:"必填" },
           m_poster:{ required:"必填" }
       },
       errorPlacement:function (error,element) {
           error.appendTo(element.parent());
       }
   });

    $('#movieupdateform').validate({
        event:"keyup",
        rules:{
            m_name:{ required:true },
            m_director:{ required:true },
            m_star:{ required:true  },
            m_type:{ required:true },
            m_country:{ required:true },
            m_language:{ required:true },
            m_standard:{ required:true },
            m_version:{ required:true  },
            m_showdate:{ required:true },
            m_length:{ required:true },
            m_descride:{ required:true }
        },
        messages:{
            m_name:{ required:"必填" },
            m_director:{ required:"必填" },
            m_star:{ required:"必填" },
            m_type:{ required:"必填" },
            m_country:{ required:"必填" },
            m_language:{ required:"必填" },
            m_standard:{ required:"必填" },
            m_version:{ required:"必填" },
            m_showdate:{ required:"必填" },
            m_length:{ required:"必填" },
            m_descride:{ required:"必填" }
        },
        errorPlacement:function (error,element) {
            error.appendTo(element.parent());
        }
    });

    $('#cinemaaddform').validate({
        event:"keyup",
        rules:{
            c_name:{ required:true },
            c_location:{ required:true }
        },
        messages:{
            m_name:{ required:"必填" },
            m_location:{ required:"必填" }
        },
        errorPlacement:function (error,element) {
            error.appendTo(element.parent());
        }
    });


    $('#roomform').validate({
        event:"keyup",
        ignore: "",
        rules:{
            r_name:{ required:true },
            r_seats:{ required:true }
        },
        messages:{
            r_name:{ required:"必填" },
            r_seats:{ required:"请选择座位" }
        },
        errorPlacement:function (error,element) {
            error.appendTo(element.parent());
        }
    });

    $('#ticketform').validate({
        event:"keyup",
        ignore: "",
        rules:{
            t_movieid:{ required:true },
            t_cinemaid:{ required:true },
            t_roomid:{ required:true },
            t_price:{ required:true },
            t_ticketnum:{ required:true },
            t_points:{ required:true },
            t_standard:{ required:true },
            t_language:{ required:true },
            t_date:{ required:true },
            t_time:{ required:true }
        },
        messages:{
            t_movieid:{ required:"请选择一项" },
            t_cinemaid:{ required:"请选择一项" },
            t_roomid:{ required:"请选择一项" },
            t_price:{ required:"必填" },
            t_ticketnum:{ required:"必填" },
            t_points:{ required:"必填" },
            t_standard:{ required:"必填" },
            t_language:{ required:"必填" },
            t_date:{ required:"必填" },
            t_time:{ required:"必填" }
        },
        errorPlacement:function (error,element) {
            error.appendTo(element.parent());
        }
    });

    $('#employform').validate({
        event:"keyup",
        ignore: "",
        rules:{
            e_post:{ required:true },
            e_num:{ required:true },
            e_area:{ required:true },
            e_descride:{ required:true }
        },
        messages:{
            e_post:{ required:"必填" },
            e_num:{ required:"必填" },
            e_area:{ required:"必填" },
            e_descride:{ required:"必填" }
        },
        errorPlacement:function (error,element) {
            error.appendTo(element.parent());
        }
    });

    $('#noticeform').validate({
        event:"keyup",
        ignore: "",
        rules:{
            n_content:{ required:true }
        },
        messages:{
            n_content:{ required:"必填" }
        },
        errorPlacement:function (error,element) {
            error.appendTo(element.parent());
        }
    });

    $.validator.addMethod("password2", function (value, element) {
        var tel = /^[\A-Za-z0-9\!\#\$\%\^\&\*\.\~]{5,32}$/;
        return this.optional(element) || (tel.test(value));
    }, "密码格式错误");
    $('#changeform').validate({
        event:"keyup",
        rules:{
            p_pwd2:{ required:true },
            a_pwd2:{ required:true, password2:true },
            r_pwd2:{ required:true, equalTo:'#a_pwd2' }
        },
        messages:{
            p_pwd2:{ required:"必填" },
            a_pwd2:{ required:"必填", password2:"密码必须至少包含 5 个字符，其中可包括以下字符: 大写字母、小写字母、数字和符号。" },
            r_pwd2:{ required:"必填", equalTo:"密码不匹配" }
        },
        errorPlacement:function (error,element) {
            error.appendTo(element.parent());
        }
    });
});

function checkUpload() {

    return checkimg($('#frontcover')) && checkimg($('#poster'));
}

function checkimg(obj) {
    var res = true;
    if(obj.val()!=='')
    {
        var allowsize = 5*1024*1024;
        var allowext =['.jpeg','.jpg','.png','.gif','.bmp'];

        var imgdir = obj.val();
        console.log(imgdir);
        var imgext = imgdir.substring(imgdir.lastIndexOf('.')).toLowerCase();
        var imgsize = obj.filesize;
        if($.inArray(imgext,allowext) === -1){
            obj.focus();
            alert('图片格式须为"JPG/PNG/GIF/BMP"');
            res=false;
            return false;
        }
        if(imgsize>allowsize){
            obj.focus();
            alert('图片大小须小于5MB');
            res=false;
            return false;
        }
    }
    return res;
}

function submitstage() {
    if(checkimg($('#stageinput'))){
        $("#stageform").submit();
    }
}

// function checkimgarr(arr) {
//     var allowsize = 5*1024*1024;
//     var allowext =['.jpeg','.jpg','.png','.gif','.bmp'];
//     var res = true;
//     $.each(arr,function (k,item) {
//         if(item.val()!=='') {
//             var imgdir = item.val();
//             var imgext = imgdir.substring(imgdir.lastIndexOf('.')).toLowerCase();
//             var imgsize = item.filesize;
//             if ($.inArray(imgext, allowext) === -1) {
//                 item.focus();
//                 alert('图片格式须为"JPG/PNG/GIF/BMP"');
//                 res = false;
//                 return false;
//             }
//             if (imgsize > allowsize) {
//                 item.focus();
//                 alert('图片大小须小于5MB');
//                 res = false;
//                 return false;
//             }
//         }
//     });
//     return res;
// }