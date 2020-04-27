function showModalAdd(){
	let str = ''
	str += '<div class="modal-dialog">'
		str += '<div class="modal-content">'
			str += '<div class="modal-header header-color-modal bg-color-3" style="background: #2b982b; color: white;">'
				str += '<h4 class="modal-title">Thêm câu hỏi thường gặp</h4>'
				str += '<div class="modal-close-area modal-close-df">'
					str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
				str += '</div>'
			str += '</div>'
			str += '<div class="modal-body modal-add">'
				str += '<form id="form-add" method="POST" enctype="application/x-www-form-urlencoded">'
					str += '<div class="row">'
						str += '<div class="form-group col-md-12">'
							str += '<label>Câu hỏi</label>'
							str += '<textarea class="form-control" style="height: 70px" name="cau_hoi" onfocus="focuscauhoi(this)" placeholder="Nhập câu hỏi"></textarea>'
							str += '<p class="text-danger" id="validateEmpty" style="display:none">Vui lòng điền vào trường này</p>'
						str += '</div>'
					str += '</div>'
					str += '<div class="row">'
						str += '<div class="form-group col-md-12">'
							str += '<label>Trả lời</label>'
							str += '<textarea class="form-control" style="height: 200px" name="tra_loi" onfocus="focustraloi(this)" placeholder="Nhập câu trả lời"></textarea>'
							str += '<p class="text-danger" id="validateEmpty1" style="display:none">Vui lòng điền vào trường này</p>'
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
	if($('#form-add textarea[name*=cau_hoi]').val().trim().length == 0) {
		$('#validateEmpty').css('display', 'inline')
		return
	}

	if($('#form-add textarea[name*=tra_loi]').val().trim().length == 0) {
		$('#validateEmpty1').css('display', 'inline')
		return
	}

	$.ajax({
        type: 'POST',
        url: 'quantri/chamsockhachhang/giaidapthacmac/them',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        	cau_hoi: $('#form-add textarea[name*=cau_hoi]').val().trim().replace(new RegExp('\r?\n','g'), '<br />'),
        	tra_loi: $('#form-add textarea[name*=tra_loi]').val().trim().replace(new RegExp('\r?\n','g'), '<br />')
        },
        success: (response) => {
            if(response.status){
            	let strOption = ''
            	strOption += '<button title="Chỉnh sửa" class="pd-setting-ed" onclick="editID('+ response.giai_dap_thac_mac.id + ', this)">'
            		strOption += '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            	strOption += '</button>'
            	strOption += '<button title="Xóa" class="pd-setting-ed" onclick="deleteID('+ response.giai_dap_thac_mac.id + ');">'
            		strOption += '<i class="fa fa-trash-o" aria-hidden="true"></i>'
            	strOption += '</button>'

            	let row = []
            	row.push({
            		'state': '',
            		'id': response.giai_dap_thac_mac.id,
            		'cau_hoi': response.giai_dap_thac_mac.cau_hoi,
            		'tra_loi': response.giai_dap_thac_mac.tra_loi,
            		'option': strOption,
            	})
            	$('#table').bootstrapTable('append', row)
            	let data = $('#table').bootstrapTable('getData')

		        data.sort((a, b) => {
		            return b.id - a.id
		        })
		        $('#table').bootstrapTable('load', {
			        data: data
			    })
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

function focuscauhoi(input){
	$('#validateEmpty').css('display', 'none')
}

function focustraloi(input){
	$('#validateEmpty1').css('display', 'none')
}

function editID(id, thisbutton){
    $.ajax({
    	type: 'GET',
    	url: 'quantri/chamsockhachhang/giaidapthacmac/chinhsua/' + id,
    	success: (response) => {
    		if(response.status){
    			let str = ''
	str += '<div class="modal-dialog">'
		str += '<div class="modal-content">'
			str += '<div class="modal-header header-color-modal bg-color-3" style="background: #2b982b; color: white;">'
				str += '<h4 class="modal-title">Chỉnh sửa câu hỏi thường gặp</h4>'
				str += '<div class="modal-close-area modal-close-df">'
					str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
				str += '</div>'
			str += '</div>'
			str += '<div class="modal-body modal-add">'
				str += '<form id="form-edit" method="POST" enctype="application/x-www-form-urlencoded">'
					str += '<div class="row">'
						str += '<div class="form-group col-md-12">'
							str += '<label>Câu hỏi</label>'
							str += '<textarea class="form-control" style="height: 70px" name="cau_hoi" onfocus="focuscauhoi(this)" placeholder="Nhập câu hỏi">' + response.giai_dap_thac_mac.cau_hoi.split('<br />').join('\n') + '</textarea>'
							str += '<p class="text-danger" id="validateEmpty" style="display:none">Vui lòng điền vào trường này</p>'
						str += '</div>'
					str += '</div>'
					str += '<div class="row">'
						str += '<div class="form-group col-md-12">'
							str += '<label>Trả lời</label>'
							str += '<textarea class="form-control" style="height: 200px" name="tra_loi" onfocus="focustraloi(this)" placeholder="Nhập câu trả lời">' + response.giai_dap_thac_mac.tra_loi.split('<br />').join('\n') + '</textarea>'
							str += '<p class="text-danger" id="validateEmpty1" style="display:none">Vui lòng điền vào trường này</p>'
						str += '</div>'
					str += '</div>'
					str += '<div class="row">'
						str += '<div class="form-group col-md-12 text-center">'
							str += '<button class="btn btn-success" type="button" onclick="saveEdit(' + response.giai_dap_thac_mac.id + ', ' + $(thisbutton).parent().parent().data('index') + ')">Lưu lại</button>'
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
	if($('#form-edit textarea[name*=cau_hoi]').val().trim().length == 0) {
		$('#validateEmpty').css('display', 'inline')
		return
	}

	if($('#form-edit textarea[name*=tra_loi]').val().trim().length == 0) {
		$('#validateEmpty1').css('display', 'inline')
		return
	}
	$.ajax({
		type: 'POST',
		url: 'quantri/chamsockhachhang/giaidapthacmac/chinhsua/' + id,
		headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        	cau_hoi: $('#form-edit textarea[name*=cau_hoi]').val().trim().replace(new RegExp('\r?\n','g'), '<br />'),
        	tra_loi: $('#form-edit textarea[name*=tra_loi]').val().trim().replace(new RegExp('\r?\n','g'), '<br />')
        },
        success: (response) => {
        	if(response.status){
        		$('#modaledit').modal('hide')
				$('#table').bootstrapTable(
					'updateRow', 
					{
						index: index, 
						row: {
							'cau_hoi': response.cau_hoi,
            				'tra_loi': response.tra_loi,
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

    if(column == 'cau_hoi' && type == 'ASC'){
        data.sort((a, b) => {
            return ('' + a.cau_hoi).localeCompare(b.cau_hoi)
        })
    }

    if(column == 'cau_hoi' && type == 'DESC'){
        data.sort((a, b) => {
            return ('' + b.cau_hoi).localeCompare(a.cau_hoi)
        })
    }

    if(column == 'tra_loi' && type == 'ASC'){
        data.sort((a, b) => {
            return ('' + a.tra_loi).localeCompare(b.tra_loi)
        })
    }

    if(column == 'tra_loi' && type == 'DESC'){
        data.sort((a, b) => {
            return ('' + b.tra_loi).localeCompare(a.tra_loi)
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
                url: 'quantri/chamsockhachhang/giaidapthacmac/xoa/' + id,
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