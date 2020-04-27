window.onload = function () {
    document.getElementById('show-loading').style.display = 'none'
    document.getElementById('hidden-loading').style.display = 'block'
};

function showModalAdd(){
	let str = ''
	str += '<div class="modal-dialog">'
		str += '<div class="modal-content">'
			str += '<div class="modal-header header-color-modal bg-color-3" style="background: #2b982b; color: white;">'
				str += '<h4 class="modal-title">Thêm danh mục tin tức</h4>'
				str += '<div class="modal-close-area modal-close-df">'
					str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
				str += '</div>'
			str += '</div>'
			str += '<div class="modal-body modal-add">'
				str += '<form id="form-add" method="POST" enctype="application/x-www-form-urlencoded">'
					str += '<div class="row">'
						str += '<div class="form-group col-md-12">'
							str += '<label>Tên danh mục tin tức</label>'
							str += '<input type="text" class="form-control" placeholder="Nhập tên danh mục tin tức" name="ten" onfocus="focusten(this)">'
							str += '<p class="text-danger" id="validateEmpty" style="display:none">Vui lòng điền vào trường này</p>'
							str += '<p class="text-danger" id="validateMaxLength" style="display:none">Tên không được vượt quá 100 ký tự</p>'
						str += '</div>'
					str += '</div>'
					str += '<div class="row">'
						str += '<div class="form-group col-md-12 text-center">'
							str += '<button class="btn btn-success" type="button" onclick="saveAdd()">Lưu lại</button>'
						str += '</div>'
					str += '</div>'
				str += '</form>'
			str += '</div>'
			
		str += '</div>'
	str += '</div>'
	$('#modaladd').html(str)
    $('#modaladd').modal({backdrop: 'static', keyboard: false})    
}

function saveAdd(){
	if($('#form-add input[name*=ten]').val().trim().length == 0) {
		$('#validateEmpty').css('display', 'inline')
		return
	}
	if($('#form-add input[name*=ten]').val().trim().length >= 100) {
		$('#validateMaxLength').css('display', 'inline')
		return
	}
	
	$.ajax({
        type: 'POST',
        url: 'quantri/danhmuctintuc/them',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $('#form-add').serialize(),
        success: (response) => {
            if(response.status){
            	let strOption = ''
            	strOption += '<button title="Chỉnh sửa" class="pd-setting-ed" onclick="editID('+ response.danh_muc_tin_tuc.id + ', this)">'
            		strOption += '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            	strOption += '</button>'
            	strOption += '<button title="Xóa" class="pd-setting-ed" onclick="deleteID('+ response.danh_muc_tin_tuc.id + ');">'
            		strOption += '<i class="fa fa-trash-o" aria-hidden="true"></i>'
            	strOption += '</button>'

            	let row = []
            	row.push({
            		'state': '',
            		'id': response.danh_muc_tin_tuc.id,
            		'ten': response.danh_muc_tin_tuc.ten,
            		'option': strOption,
            	})
            	$('#table').bootstrapTable('append', row)

            	Lobibox.notify('success', {
	                size: 'mini',
	                msg: "Thêm dữ liệu thành công."
	            });
	            $('#modaladd').modal('hide') 
            } else {
            	Lobibox.notify('error', {
	                size: 'mini',
	                msg: "Thêm dữ liệu thất bại."
	            });
            }
        },
        error: (error) => {
            Lobibox.notify('error', {
                size: 'mini',
                msg: "Lỗi kết nối cơ sở dữ liệu.\nVui lòng thử lại."
            });
        }
    })
}

function focusten(input){
	$('#validateEmpty').css('display', 'none')
	$('#validateMaxLength').css('display', 'none')
}


function editID(id, thisbutton){
    $.ajax({
    	type: 'GET',
    	url: 'quantri/danhmuctintuc/chinhsua/' + id,
    	success: (response) => {
    		if(response.status){
    			let str = ''
				str += '<div class="modal-dialog">'
					str += '<div class="modal-content">'
						str += '<div class="modal-header header-color-modal bg-color-3" style="background: #2b982b; color: white;">'
							str += '<h4 class="modal-title">Chỉnh sửa danh mục tin tức</h4>'
							str += '<div class="modal-close-area modal-close-df">'
								str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
							str += '</div>'
						str += '</div>'
						str += '<div class="modal-body modal-add">'
							str += '<form id="form-edit" method="POST" enctype="application/x-www-form-urlencoded">'
								str += '<div class="row">'
									str += '<div class="form-group col-md-12">'
										str += '<label>Tên danh mục tin tức</label>'
										str += '<input type="text" class="form-control" placeholder="Nhập tên danh mục tin tức" name="ten" onfocus="focusten(this)" value="' + response.danh_muc_tin_tuc.ten + '">'
										str += '<p class="text-danger" id="validateEmpty" style="display:none">Vui lòng điền vào trường này</p>'
										str += '<p class="text-danger" id="validateMaxLength" style="display:none">Tên không được vượt quá 100 ký tự</p>'
									str += '</div>'
								str += '</div>'
								str += '<div class="row">'
									str += '<div class="form-group col-md-12 text-center">'
										str += '<button class="btn btn-success" type="button" onclick="saveEdit(' + response.danh_muc_tin_tuc.id + ', ' + $(thisbutton).parent().parent().data('index') + ')">Lưu lại</button>'
									str += '</div>'
								str += '</div>'
							str += '</form>'
						str += '</div>'
						
					str += '</div>'
				str += '</div>'
				$('#modaledit').html(str)
			    $('#modaledit').modal({backdrop: 'static', keyboard: false})
    		} else {
    			Lobibox.notify('error', {
	                size: 'mini',
	                msg: "Lỗi không tìm thấy dữ liệu.\nVui lòng thử lại."
	            });
    		}
    	},
    	error: (error) => {
            Lobibox.notify('error', {
                size: 'mini',
                msg: "Lỗi kết nối cơ sở dữ liệu.\nVui lòng thử lại."
            });
        }
    })
}

function saveEdit(id, index){
	if($('#form-edit input[name*=ten]').val().trim().length == 0) {
		$('#validateEmpty').css('display', 'inline')
		return
	}
	if($('#form-edit input[name*=ten]').val().trim().length >= 100) {
		$('#validateMaxLength').css('display', 'inline')
		return
	}
	$.ajax({
		type: 'POST',
		url: 'quantri/danhmuctintuc/chinhsua/' + id,
		headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $('#form-edit').serialize(),
        success: (response) => {
        	if(response.status){
        		$('#modaledit').modal('hide')
				$('#table').bootstrapTable(
					'updateRow', 
					{
						index: index, 
						row: {
							'ten': response.ten,
						}
					})
				Lobibox.notify('success', {
	                size: 'mini',
	                msg: "Chỉnh sửa dữ liệu thành công."
	            });
        	} else {
        		Lobibox.notify('error', {
	                size: 'mini',
	                msg: "Chỉnh sửa dữ liệu thất bại."
	            });
        	}
        	
        },
        error: (error) => {
            Lobibox.notify('error', {
                size: 'mini',
                msg: "Lỗi kết nối cơ sở dữ liệu.\nVui lòng thử lại."
            });
        }

	})
}

// Sắp xếp dữ liệu trong bảng
function orderByData(column, type){
    let data = $('#table').bootstrapTable('getData')

    if(column == 'id' && type == 'ASC'){
        data.sort((a, b) => {
            return a.id - b.id
            // return ('' + a.id).localeCompare(b.id)
        })
    }
    if(column == 'id' && type == 'DESC'){
        data.sort((a, b) => {
            return b.id - a.id
            // return ('' + b.id).localeCompare(a.id)
        })
    }

    if(column == 'ten' && type == 'ASC'){
        data.sort((a, b) => {
            return ('' + a.ten).localeCompare(b.ten)
        })
    }

    if(column == 'ten' && type == 'DESC'){
        data.sort((a, b) => {
            return ('' + b.ten).localeCompare(a.ten)
        })
    }

    $('#table').bootstrapTable('load', {
        data: data
    })
}

function deleteID(id) {
    swal({
        title: "Bạn có chắc chắn muốn xóa dữ liệu?",
        text: "Sau khi xóa, dữ liệu sẽ không thể khôi phục!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((isConfirm) => {
        if (isConfirm) {
            $.ajax({
                type: 'GET',
                url: 'quantri/danhmuctintuc/xoa/' + id,
                success: (response) => {
                    if(response.status){
                        $('#table').bootstrapTable('removeByUniqueId', id)
                        Lobibox.notify('success', {
                            size: 'mini',
                            msg: "Xóa dữ liệu thành công."
                        });
                    } else {
                        Lobibox.notify('error', {
                            size: 'mini',
                            msg: "Xóa dữ liệu thất bại."
                        });
                    }
                },
                error: (error) => {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: "Lỗi không xóa được dữ liệu."
                    });
                }
            })
        } else {
            swal("Dữ liệu không thay đổi!")
        }
    });
}   
