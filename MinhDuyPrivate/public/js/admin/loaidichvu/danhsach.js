window.onload = function () {
    document.getElementById('show-loading').style.display = 'none'
    document.getElementById('hidden-loading').style.display = 'block'
}

function showModalAdd(danhmucdichvu){
	let str = ''
	str += '<div class="modal-dialog">'
		str += '<div class="modal-content">'
			str += '<div class="modal-header header-color-modal bg-color-3" style="background: #2b982b; color: white;">'
				str += '<h4 class="modal-title">Thêm loại dịch vụ</h4>'
				str += '<div class="modal-close-area modal-close-df">'
					str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
				str += '</div>'
			str += '</div>'
			str += '<div class="modal-body modal-add">'
				str += '<form id="form-add" method="POST" enctype="application/x-www-form-urlencoded">'
					str += '<div class="row">'
						str += '<div class="form-group col-md-12">'
							str += '<label>Chọn danh mục</label>'
							str += '<div class="form-select-list">'
								str += '<select class="form-control custom-select-value" name="id_danh_muc_dich_vu" onfocus="focusid_danh_muc(this)">'
								str += '<option value="">Chọn danh mục</option>'
								for (var i = 0; i < danhmucdichvu.length; i++) {
									str += '<option value="' + danhmucdichvu[i].id + '">' + danhmucdichvu[i].ten + '</option>'
								}
								str += '</select>'
								str += '<p class="text-danger" id="validateRequiredSelect" style="display:none">Vui lòng chọn trường này</p>'
							str += '</div>'                            
						str += '</div>'
					str += '</div>'
					str += '<div class="row">'
						str += '<div class="form-group col-md-12">'
							str += '<label>Tên loại dịch vụ</label>'
							str += '<input type="text" class="form-control" placeholder="Nhập tên loại dịch vụ" name="ten" onfocus="focusten(this)">'
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

function focusid_danh_muc(input){
	$('#validateRequiredSelect').css('display', 'none')
}

function focusten(input){
	$('#validateEmpty').css('display', 'none')
	$('#validateMaxLength').css('display', 'none')
}

function saveAdd(){
	if($('#form-add select[name*=id_danh_muc_dich_vu]').val().trim().length == 0) {
		$('#validateRequiredSelect').css('display', 'inline')
		return
	}

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
        url: 'quantri/loaidichvu/them',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $('#form-add').serialize(),
        success: (response) => {
            if(response.status){
            	let strOption = ''
            	strOption += '<button title="Chỉnh sửa" class="pd-setting-ed" onclick="editID('+ response.loai_dich_vu.id + ', this)">'
            		strOption += '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            	strOption += '</button>'
            	strOption += '<button title="Xóa" class="pd-setting-ed" onclick="deleteID('+ response.loai_dich_vu.id + ');">'
            		strOption += '<i class="fa fa-trash-o" aria-hidden="true"></i>'
            	strOption += '</button>'

            	let row = []
            	row.push({
            		'state': '',
            		'id': response.loai_dich_vu.id,
            		'ten_danh_muc': response.loai_dich_vu.ten_danh_muc,
            		'ten': response.loai_dich_vu.ten,
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

function editID(id, thisbutton){
    $.ajax({
    	type: 'GET',
    	url: 'quantri/loaidichvu/chinhsua/' + id,
    	success: (response) => {
    		if(response.status){
    			let str = ''
				str += '<div class="modal-dialog">'
					str += '<div class="modal-content">'
						str += '<div class="modal-header header-color-modal bg-color-3" style="background: #2b982b; color: white;">'
							str += '<h4 class="modal-title">Chỉnh sửa loại dịch vụ</h4>'
							str += '<div class="modal-close-area modal-close-df">'
								str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
							str += '</div>'
						str += '</div>'
						str += '<div class="modal-body modal-add">'
							str += '<form id="form-edit" method="POST" enctype="application/x-www-form-urlencoded">'
								str += '<div class="row">'
									str += '<div class="form-group col-md-12">'
										str += '<label>Chọn danh mục</label>'
										str += '<div class="form-select-list">'
											str += '<select class="form-control custom-select-value" name="id_danh_muc_dich_vu" onfocus="focusid_danh_muc(this)">'
											str += '<option value="">Chọn danh mục</option>'
											for (var i = 0; i < response.danh_muc_dich_vu.length; i++) {
												if(response.danh_muc_dich_vu[i].id == response.loai_dich_vu.id_danh_muc_dich_vu){
													str += '<option value="' + response.danh_muc_dich_vu[i].id + '" selected>' + response.danh_muc_dich_vu[i].ten + '</option>'
												} else {
													str += '<option value="' + response.danh_muc_dich_vu[i].id + '">' + response.danh_muc_dich_vu[i].ten + '</option>'
												}
											}
											str += '</select>'
											str += '<p class="text-danger" id="validateRequiredSelect" style="display:none">Vui lòng chọn trường này</p>'
										str += '</div>'                            
									str += '</div>'
								str += '</div>'
								str += '<div class="row">'
									str += '<div class="form-group col-md-12">'
										str += '<label>Tên loại dịch vụ</label>'
										str += '<input type="text" class="form-control" placeholder="Nhập tên loại dịch vụ" name="ten" onfocus="focusten(this)" value="' + response.loai_dich_vu.ten + '">'
										str += '<p class="text-danger" id="validateEmpty" style="display:none">Vui lòng điền vào trường này</p>'
										str += '<p class="text-danger" id="validateMaxLength" style="display:none">Tên không được vượt quá 100 ký tự</p>'
									str += '</div>'
								str += '</div>'
								str += '<div class="row">'
									str += '<div class="form-group col-md-12 text-center">'
										str += '<button class="btn btn-success" type="button" onclick="saveEdit(' + response.loai_dich_vu.id + ', ' + $(thisbutton).parent().parent().data('index') + ')">Lưu lại</button>'
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
	if($('#form-edit select[name*=id_danh_muc_dich_vu]').val().trim().length == 0) {
		$('#validateRequiredSelect').css('display', 'inline')
		return
	}

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
		url: 'quantri/loaidichvu/chinhsua/' + id,
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
							'ten_danh_muc': response.ten_danh_muc,
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

    if(column == 'ten_danh_muc' && type == 'ASC'){
        data.sort((a, b) => {
            return ('' + a.ten_danh_muc).localeCompare(b.ten_danh_muc)
        })
    }

    if(column == 'ten_danh_muc' && type == 'DESC'){
        data.sort((a, b) => {
            return ('' + b.ten_danh_muc).localeCompare(a.ten_danh_muc)
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
                url: 'quantri/loaidichvu/xoa/' + id,
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