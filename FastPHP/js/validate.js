// $(function() {
//     $('#form1').validate({
//         event: "keyup",
//         rules: {
//             name: { required: true },
//         },
//         messages: {
//             name: { required: "必填" }
//         },
//         errorPlacement: function(error, element) {
//             error.appendTo(element.parent());
//         }
//     });
// });

function checkfile() {
    var obj = $("#inputfile");
    var allowsize = 5 * 1024 * 1024;
    var allowext = ['.jpeg', '.jpg', '.png', '.gif', '.bmp'];

    var filedir = obj.val();
    var fileext = filedir.substring(filedir.lastIndexOf('.')).toLowerCase();
    var filesize = obj.filesize;
    if ($.inArray(fileext, allowext) === -1) {
        obj.focus();
        obj.val('');
        alert('图片格式须为"JPG/PNG/GIF/BMP"');
        return false;
    }
    if (filesize > allowsize) {
        obj.focus();
        obj.val('');
        alert('图片大小须小于5MB');
        return false;
    }
}