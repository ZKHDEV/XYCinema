$(function () {
    $.validator.addMethod("password2", function (value, element) {
        var tel = /^[\A-Za-z0-9\!\#\$\%\^\&\*\.\~]{5,32}$/;
        return this.optional(element) || (tel.test(value));
    }, "密码格式错误");
    $.validator.addMethod("mobile", function (value, element) {
        var length = value.length;
        var mobile = /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "手机号码格式错误");
    $('#registerform').validate({
        event:"keyup",
        rules:{
            u_phone:{ required:true, mobile:true },
            verify:{ required:true },
            mobile_code:{ required:true },
            u_pwd2:{ required:true, password2:true },
            r_pwd2:{ required:true, equalTo:'#u_pwd2' },
            u_name:{ required:true },
            u_email:{ required:true,email:true }
        },
        messages:{
            u_phone:{ required:"*必填", mobile:"手机号格式错误" },
            verify:{ required:"*必填" },
            mobile_code:{ required:"*必填" },
            u_pwd2:{ required:"*必填", password2:"密码必须至少包含 5 个字符，其中可包括以下字符: 大写字母、小写字母、数字和符号。" },
            r_pwd2:{ required:"*必填", equalTo:"密码不匹配" },
            u_name:{ required:"*必填" },
            u_email:{ required:"*必填",email:"邮箱格式错误" }
        },
        errorPlacement:function (error,element) {
            error.appendTo(element.parent());
        }
    });

    $('#forgetform').validate({
        event:"keyup",
        rules:{
            u_phone:{ required:true, mobile:true },
            u_email:{ required:true, email:true },
            verify:{ required:true }
        },
        messages:{
            u_phone:{ required:"必填", mobile:"手机号格式错误" },
            u_email:{ required:"必填", email:"邮箱格式错误" },
            verify:{ required:"必填" }
        },
        errorPlacement:function (error,element) {
            error.appendTo(element.parent());
        }
    });

    $('#msgform').validate({
        event:"keyup",
        rules:{
            u_name:{ required:true },
            u_email:{ required:true,email:true }
        },
        messages:{
            u_name:{ required:"必填" },
            u_email:{ required:"必填",email:"邮箱格式错误" }
        },
        errorPlacement:function (error,element) {
            error.appendTo(element.parent());
        }
    });

    $('#pwdform').validate({
        event:"keyup",
        rules:{
            o_pwd2:{ required:true },
            u_pwd2:{ required:true, password2:true },
            r_pwd2:{ required:true, equalTo:'#u_pwd2' }
        },
        messages:{
            o_pwd2:{ required:"必填" },
            u_pwd2:{ required:"必填", password2:"密码必须至少包含 5 个字符，其中可包括以下字符: 大写字母、小写字母、数字和符号。" },
            r_pwd2:{ required:"必填", equalTo:"密码不匹配" }
        },
        errorPlacement:function (error,element) {
            error.appendTo(element.parent());
        }
    });
});


