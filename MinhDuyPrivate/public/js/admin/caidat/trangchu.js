window.onload = function () {
    document.getElementById('show-loading').style.display = 'none'
    document.getElementById('hidden-loading').style.display = 'block'
};

$('#radioBtn a').on('click', function(){
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
    $('#'+tog).prop('value', sel);
    
    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
})

function editThongTin(){
    let listInputs = $('#form-cai-dat-trang-chu input')
    $.each(listInputs, function( key, value ) {
        if(value.hasAttribute('readonly')){
            value.removeAttribute('readonly')
        }
    })
    $('#radioBtn a').removeClass('disabled')
    $('button[name=save]').css('display', 'inline')
    $('button[name=destroy]').css('display', 'inline')
    $('button[name=edit]').css('display', 'none')
    document.getElementById("file").disabled = false;
}

function readURL(input) {
    var fileInput = document.getElementById('file')
    var filePath = fileInput.value
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if(!allowedExtensions.exec(filePath)){
        Lobibox.notify('warning', {
            size: 'mini',
            msg: "Vui lòng đăng ảnh với đuôi .jpeg/.jpg/.png."
        });
        fileInput.value = ''
        $('#preview').html('')
    }else{
        if (input.files && input.files[0]) {
            let reader = new FileReader()
            reader.onload = function (e) {
                $('#preview').html('<img src="' + e.target.result + '" alt="Hình ảnh" style="margin-top: 20px; max-width: 400px;" />')
            };
            reader.readAsDataURL(input.files[0])
        }
    }
}

$('#form-cai-dat-trang-chu').submit((e) => {
	let formData = new FormData();
	let listInputs = $('#form-cai-dat-trang-chu input')
    $.each(listInputs, function( key, value ) {
    	if(value.name != 'file'){
    		formData.append('' + value.name, value.value)
    	}
    })
    if($('#file')[0].files[0] == undefined || $('#file')[0].files[0] == null){

    } else {
    	formData.append('logo', $('#file')[0].files[0])
    }
	
	formData.append("_token",$('meta[name="csrf-token"]').attr('content'))
	// for (let [key, value] of formData.entries()) {
	// 	console.log(key + ' : ' + value)
	// }
    $.ajax({
        type: 'POST',
        url: 'quantri/caidat/trangchu/chinhsua',
        data: formData,
        contentType: false,
        processData: false,
        success: (response) =>{
            if(response.status){
                let listInputs = $('#form-cai-dat-trang-chu input')
			    $.each(listInputs, function( key, value ) {
			        if(!value.hasAttribute('readonly')){
			            value.setAttribute('readonly', '')
			        }
			    })
			    $('#radioBtn a').addClass('disabled')
			    $('button[name=save]').css('display', 'none')
			    $('button[name=destroy]').css('display', 'none')
			    $('button[name=edit]').css('display', 'inline')
			    document.getElementById("file").disabled = true
                Lobibox.notify('success', {
                    size: 'mini',
                    msg: "Thay đổi dữ liệu thành công."
                });
            } else {
                Lobibox.notify('error', {
                    size: 'mini',
                    msg: "Thay đổi dữ liệu thất bại."
                });
            }
        },
        error: (error) => {
            Lobibox.notify('error', {
                size: 'mini',
                msg: "Lỗi không lấy được dữ liệu.\nVui lòng thử lại."
            });
        }
    })
    e.preventDefault();
})

function destroyTinTuc(){
    location.reload()
}