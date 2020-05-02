// Remove event input[type=number]
jQuery(document).ready( function($) {
    // Disable scroll when focused on a number input.
    $('form').on('focus', 'input[type=number]', function(e) {
        $(this).on('wheel', function(e) {
            e.preventDefault();
        });
    });
 
    // Restore scroll on number inputs.
    $('form').on('blur', 'input[type=number]', function(e) {
        $(this).off('wheel');
    });
 
    // Disable up and down keys.
    $('form').on('keydown', 'input[type=number]', function(e) {
        if ( e.which == 38 || e.which == 40 )
            e.preventDefault();
    });  
});

$("#upload-image").change(function(){
    $('#image_preview').html("");
    var total_file=document.getElementById("upload-image").files.length;
    for(var i=0;i<total_file;i++){
        $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
    }
});

function changeDanhMuc(str){
    if (str == "") {
        $('#chonloai').html('<option value="">Chọn loại</option>')
        return
    }
    $.ajax({
        type: 'POST',
        url:'quantri/sanpham/changedanhmuc',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id_danh_muc_sp: str
        },
        success: function(response){
            $('#chonloai').html(response)
        }
    })
}

function changeGiaGoc(input){
    if(Number(input.value) != 0){
        input.value = Number(input.value)
        var giaban = Number(input.value) - Number(input.value) * Number(document.getElementById('khuyenmai').value) / 100
        document.getElementById('giaban').value =  Math.round(giaban/1000)*1000
    }
    else {
        input.value = ''
        document.getElementById('giaban').value = '0'
    }
}

function onValidateGiaGoc(input){
    if(input.validity.rangeOverflow){
        input.setCustomValidity('Giá gốc vượt quá 100.000.000.000')
    } else input.setCustomValidity('Vui lòng nhập giá gốc cho sản phẩm')
}

function changeKhuyenMai(input){
    if(Number(input.value) != 0){
        input.value = Number(input.value)
        var giaban = document.getElementById('giagoc').value - Number(input.value) * Number(document.getElementById('giagoc').value) / 100
        document.getElementById('giaban').value =  Math.round(giaban/1000)*1000 
    }
    else {
        input.value = '0'
        document.getElementById('giaban').value = '0'
    }
    if(0 == input.value) {
        document.getElementById('data_5').style.display = 'none'
        var giaban = document.getElementById('giagoc').value - Number(input.value) * Number(document.getElementById('giagoc').value) / 100
        document.getElementById('giaban').value =  Math.round(giaban/1000)*1000 
    }
    else {
        document.getElementById("datefrom").value = new Date().toJSON().slice(0,10).split('-').reverse().join('/')
        document.getElementById("dateto").value = new Date().toJSON().slice(0,10).split('-').reverse().join('/')
        document.getElementById('data_5').style.display = 'block'
    }
}

function onValidateKhuyenMai(input){
    if(input.validity.rangeOverflow){
        this.setCustomValidity('Khuyến mãi giới hạn từ 0 - 100')
    } else {
        this.setCustomValidity('Vui lòng nhập khuyến mãi')
    }
}


(function ($) {
    "use strict";
    // document.getElementById("datefrom").value = new Date().toJSON().slice(0,10).split('-').reverse().join('/')
    // document.getElementById("dateto").value = new Date().toJSON().slice(0,10).split('-').reverse().join('/')
    $('#data_5 .input-daterange').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });
    $('#summernote1').summernote({
        height: 400,
    });
})(jQuery);

function destroy(){
    window.location.href="quantri/sanpham/danhsach"
}

var indexBefore = -1;

$('#form-thongtin').submit(function() {
    $.ajax({
        type: 'POST',
        url:'quantri/sanpham/chinhsua',
        data: $('#form-thongtin').serialize(),
        success: function(response){
            if(response.status){
                Lobibox.notify('success', {
                    size: 'mini',
                    msg: "Chỉnh sửa sản phẩm thành công."
                });
                scrollToTopAnimate(1000)
            } else {
                Lobibox.notify('error', {
                    size: 'mini',
                    msg: 'Chỉnh sửa sản phẩm thất bại.'
                });
            }
        }
    })
    return false;
})

$('#form-thongso').submit(function() {
    $.ajax({
        type: 'POST',
        url:'quantri/sanpham/chinhsuathongso',
        data: $('#form-thongso').serialize(),
        success: function(response){
            console.log(response)
            if(response.status){
                Lobibox.notify('success', {
                    size: 'mini',
                    msg: "Chỉnh sửa thông số kỹ thuật cho sản phẩm thành công."
                });
                    scrollToTopAnimate(1000)

            } else {
                Lobibox.notify('error', {
                    size: 'mini',
                    msg: 'Chỉnh sửa thông số kỹ thuật cho sản phẩm thất bại.'
                });
            }
        }
    })                
    return false;
})

 function changeHinhChinh(id, input, index){
    var id_sp = document.forms.form_hinhanh.id.value
    
    $.ajax({
        type: 'POST',
        url: 'quantri/hinhanhsanpham/changehinhchinh',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
            id_sp: id_sp,
        },
        success: function(response){
            console.log(response)
            if(response.status){
                indexBefore = index
                Lobibox.notify('success', {
                    size: 'mini',
                    msg: "Thay đổi hình ảnh làm hình ảnh chính thành công."
                });
            } else {
                input.checked = false;
                document.forms.form_loadajaxhinhanh.hinh_chinh[indexBefore].checked = true
                Lobibox.notify('error', {
                    size: 'mini',
                    msg: 'Thay đổi hình ảnh làm hình ảnh chính thất bại.'
                });
            }
        }
    })
    return false
}

function uploadImg() {
    let image_upload = new FormData();
    let totalImages = $('#upload-image')[0].files.length;
    if(totalImages <= 0){
        Lobibox.notify('warning', {
            size: 'mini',
            msg: "Vui lòng chọn hình ảnh trước khi tải ảnh lên"
        });
        return false
    }
    for(let i = 0; i < totalImages; i++){
        image_upload.append('images[]', $('#upload-image')[0].files[i])
    }
    image_upload.append('totalImages', totalImages)
    image_upload.append('id', document.forms.form_hinhanh.id.value)

    image_upload.append("_token",$('meta[name="csrf-token"]').attr('content'))

    $.ajax({
        type: 'POST',
        url:'quantri/hinhanhsanpham/them',
        data: image_upload,
        contentType: false,
        processData: false,
        success: function(response){
            if(response.status){
                $('#image_preview').html('')
                $('#uploaded').html('')
                $('#uploaded').append('<h1 style="margin-top: 50px;">Ảnh của sản phẩm đã tải lên</h1>');
                $('#uploaded').append('<div id="image_preview-upload"></div>');
                
                let str = '';
                str +='<div class="box-upload" style="margin-top: 10px; padding: 20px;"><form name="form_loadajaxhinhanh"><div class="row">';

                for(var i = 0; i < response.hinh_anh.length; i++){
                    
                    str += '<div class="col-md-3" style="margin-bottom: 10px;">';
                    str += '<img src="uploads/images/products/' + response.hinh_anh[i].ten +'" alt="" class="img-thumbnail">';
                    str += '<label class="ml-15">';
                    if(response.hinh_anh[i].hinh_chinh){
                        str += '<input type="radio" class="option-input radio" name="hinh_chinh" onchange="changeHinhChinh('+ response.hinh_anh[i].id +', this, '+ i + ')" checked="" />';
                        indexBefore = i;
                    }else str += '<input type="radio" class="option-input radio" name="hinh_chinh" onchange="changeHinhChinh('+ response.hinh_anh[i].id +', this, '+ i + ')" />';
                    str += 'Chọn làm hình chính';
                    str += '</label>';
                    str += '<button class="btn btn-default btn-xs ml-10" onclick="deleteImg(' +response.hinh_anh[i].id + ','+ i + ')" type="button">Xóa</button>';
                    str += '</div>';
                    if((i % 4) == 3) str += '</div><div class="row">';
                }
                str += '</div></form></div>';
                $('#image_preview-upload').append(str);
                Lobibox.notify('success', {
                    size: 'mini',
                    msg: "Thêm hình ảnh thành công.\nTiếp tục thêm hình ảnh cho sản phẩm."
                });
            } else {
                Lobibox.notify('error', {
                    size: 'mini',
                    msg: 'Thêm hình ảnh thất bại.'
                });
            }
        }
    })
     return false
}

function uploadImgView() {
    let image_upload = new FormData();
    let totalImages = $('#upload-image')[0].files.length;
    if(totalImages <= 0){
        Lobibox.notify('warning', {
            size: 'mini',
            msg: "Vui lòng chọn hình ảnh trước khi tải ảnh lên"
        });
        return false
    }
    for(let i = 0; i < totalImages; i++){
        image_upload.append('images[]', $('#upload-image')[0].files[i])
    }
    image_upload.append('totalImages', totalImages)
    image_upload.append('id', document.forms.form_hinhanh.id.value)

    image_upload.append("_token",$('meta[name="csrf-token"]').attr('content'))

    $.ajax({
        type: 'POST',
        url:'quantri/hinhanhsanpham/them',
        data: image_upload,
        contentType: false,
        processData: false,
        success: function(response){
            // console.log(response)
            if(response.status){
                $('#image_preview').html('')
                $('#uploaded').html('')
                $('#uploaded').append('<h1 style="margin-top: 50px;">Hình ảnh đã tải lên</h1>');
                $('#uploaded').append('<div id="image_preview-upload"></div>');
                
                let str = '';
                str +='<div class="box-upload" style="margin-top: 10px; padding: 20px;"><form name="form_loadajaxhinhanh"><div class="row">';

                for(var i = 0; i < response.hinh_anh.length; i++){
                    
                    str += '<div class="col-md-3" style="margin-bottom: 10px;">';
                    str += '<img src="uploads/images/products/' + response.hinh_anh[i].ten +'" alt="" class="img-thumbnail">';
                    str += '<label class="ml-15">';
                    if(response.hinh_anh[i].hinh_chinh){
                        str += '<input type="radio" class="option-input radio" name="hinh_chinh" onchange="changeHinhChinh('+ response.hinh_anh[i].id +', this, '+ i + ')" checked="" />';
                        indexBefore = i;
                    }else str += '<input type="radio" class="option-input radio" name="hinh_chinh" onchange="changeHinhChinh('+ response.hinh_anh[i].id +', this, '+ i + ')" />';
                    str += 'Chọn làm hình chính';
                    str += '</label>';
                    str += '<button class="btn btn-default btn-xs ml-10" onclick="deleteImg(' +response.hinh_anh[i].id + ','+ i + ')" type="button">Xóa</button>';
                    str += '</div>';
                    if((i % 4) == 3) str += '</div><div class="row">';
                }
                str += '</div></form></div>';
                $('#image_preview-upload').append(str);
                Lobibox.notify('success', {
                    size: 'mini',
                    msg: "Thêm hình ảnh thành công.\nTiếp tục thêm hình ảnh cho sản phẩm."
                });
                window.location.href = 'quantri/sanpham/xem/' + document.forms.form_hinhanh.id.value
            } else {
                Lobibox.notify('error', {
                    size: 'mini',
                    msg: 'Thêm hình ảnh thất bại.'
                });
            }
        }
    })
     return false
}

function deleteImg(id, index, hinhchinh){
    if($('input[name*="hinh_chinh"]').length == 1){
        swal({
            title: "Chỉ còn hình ảnh duy nhất. Bạn có chắc chắn muốn xóa?",
            text: "Sau khi xóa, hình ảnh sẽ không thể khôi phục!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((isConfirm) => {
            if (isConfirm) {
                $.ajax({
                    type: 'GET',
                    url: 'quantri/hinhanhsanpham/xoa/' + document.forms.form_hinhanh.id.value + '/' + id,
                    success: function(response){
                        console.log(response)
                        if(response.status){
                            $('#uploaded').html('')
                            $('#uploaded').append('<h1 style="margin-top: 50px;">Ảnh của sản phẩm đã tải lên</h1>');
                            $('#uploaded').append('<div id="image_preview-upload"></div>');
                            
                            let str = '';
                            str +='<div class="box-upload" style="margin-top: 10px; padding: 20px;"><form name="form_loadajaxhinhanh"><div class="row">';

                            for(var i = 0; i < response.hinh_anh.length; i++){
                                
                                str += '<div class="col-md-3" style="margin-bottom: 10px;">';
                                str += '<img src="uploads/images/products/' + response.hinh_anh[i].ten +'" alt="" class="img-thumbnail">';
                                str += '<label class="ml-15">';
                                if(response.hinh_anh[i].hinh_chinh){
                                    str += '<input type="radio" class="option-input radio" name="hinh_chinh" onchange="changeHinhChinh('+ response.hinh_anh[i].id +', this, '+ i + ')" checked="" />';
                                    indexBefore = i;
                                }else str += '<input type="radio" class="option-input radio" name="hinh_chinh" onchange="changeHinhChinh('+ response.hinh_anh[i].id +', this, '+ i + ')" />';
                                str += 'Chọn làm hình chính';
                                str += '</label>';
                                str += '<button class="btn btn-default btn-xs ml-10" onclick="deleteImg(' +response.hinh_anh[i].id + ','+ i + ')" type="button">Xóa</button>';
                                str += '</div>';
                                if((i % 4) == 3) str += '</div><div class="row">';
                            }
                            str += '</div></form></div>';
                            $('#image_preview-upload').append(str); 
                            Lobibox.notify('success', {
                                size: 'mini',
                                msg: 'Xóa hình ảnh thành công.'
                            });
                        } else {
                            Lobibox.notify('error', {
                                size: 'mini',
                                msg: 'Xóa hình ảnh thất bại.'
                            });
                        }
                    }
                })
            } else {
                swal("Dữ liệu không thay đổi!")
            }
        });
    } else if(index == indexBefore || hinhchinh) {
        Lobibox.notify('warning', {
            size: 'mini',
            msg: 'Hãy chọn hình ảnh khác làm hình chính trước khi xóa hình ảnh này'
        });
    } else {
        $.ajax({
            type: 'GET',
            url: 'quantri/hinhanhsanpham/xoa/' + document.forms.form_hinhanh.id.value + '/' + id,
            success: function(response){
                console.log(response)
                if(response.status){
                    $('#uploaded').html('')
                    $('#uploaded').append('<h1 style="margin-top: 50px;">Ảnh của sản phẩm đã tải lên</h1>');
                    $('#uploaded').append('<div id="image_preview-upload"></div>');
                    
                    let str = '';
                    str +='<div class="box-upload" style="margin-top: 10px; padding: 20px;"><form name="form_loadajaxhinhanh"><div class="row">';

                    for(var i = 0; i < response.hinh_anh.length; i++){
                        
                        str += '<div class="col-md-3" style="margin-bottom: 10px;">';
                        str += '<img src="uploads/images/products/' + response.hinh_anh[i].ten +'" alt="" class="img-thumbnail">';
                        str += '<label class="ml-15">';
                        if(response.hinh_anh[i].hinh_chinh){
                            str += '<input type="radio" class="option-input radio" name="hinh_chinh" onchange="changeHinhChinh('+ response.hinh_anh[i].id +', this, '+ i + ')" checked="" />';
                            indexBefore = i;
                        }else str += '<input type="radio" class="option-input radio" name="hinh_chinh" onchange="changeHinhChinh('+ response.hinh_anh[i].id +', this, '+ i + ')" />';
                        str += 'Chọn làm hình chính';
                        str += '</label>';
                        str += '<button class="btn btn-default btn-xs ml-10" onclick="deleteImg(' +response.hinh_anh[i].id + ','+ i + ')" type="button">Xóa</button>';
                        str += '</div>';
                        if((i % 4) == 3) str += '</div><div class="row">';
                    }
                    str += '</div></form></div>';
                    $('#image_preview-upload').append(str); 
                    Lobibox.notify('success', {
                        size: 'mini',
                        msg: 'Xóa hình ảnh thành công.'
                    });
                } else {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: 'Xóa hình ảnh thất bại.'
                    });
                }
            }
        })
    }
    return false;
}