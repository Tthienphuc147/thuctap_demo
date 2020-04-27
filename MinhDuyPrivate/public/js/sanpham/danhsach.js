function editID(id){
    window.location.href="quantri/sanpham/chinhsua/" + id
}

function add(){
    window.location.href="quantri/sanpham/them"
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
                url: 'quantri/sanpham/xoa/' + id,
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

function changeNew(id, input){
    $.ajax({
        type: "POST",
        url: 'quantri/sanpham/chinhsuamoi',
        data: {
            id: id,
            checked: input.checked
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.status == false){
                $('#table').bootstrapTable(
					'updateRow', 
					{
						index: $(input).parent().parent().data('index'), 
						row: {
							'moi': !input.checked ? '<input type="checkbox" value="" checked="" onclick="changeNew('+ id + ', this)">': '<input type="checkbox" value="" onclick="changeNew('+ id + ', this)">'
						}
					})
                Lobibox.notify('error', {
                    size: 'mini',
                    msg: 'Thay đổi dữ liệu thất bại.'
                });
            } else {
            	$('#table').bootstrapTable(
					'updateRow', 
					{
						index: $(input).parent().parent().data('index'), 
						row: {
							'moi': input.checked ? '<input type="checkbox" value="" checked="" onclick="changeNew('+ id + ', this)">': '<input type="checkbox" value="" onclick="changeNew('+ id + ', this)">'
						}
					})
                Lobibox.notify('success', {
                    size: 'mini',
                    msg: 'Thay đổi dữ liệu thành công.'
                });
            }
        },
        error: (error) => {
        	$('#table').bootstrapTable(
				'updateRow', 
				{
					index: $(input).parent().parent().data('index'), 
					row: {
						'moi': !input.checked ? '<input type="checkbox" value="" checked="" onclick="changeNew('+ id + ', this)">': '<input type="checkbox" value="" onclick="changeNew('+ id + ', this)">'
					}
				})
			Lobibox.notify('error', {
				size: 'mini',
				msg: "Lỗi không kết nối được với dữ liệu.\nVui lòng thử lại."
			});
		}
    });
}

function changeNoiBat(id, input){
    $.ajax({
        type: "POST",
        url: 'quantri/sanpham/chinhsuanoibat',
        data: {
            id: id,
            checked: input.checked
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.status == false){
            	$('#table').bootstrapTable(
					'updateRow', 
					{
						index: $(input).parent().parent().parent().data('index'), 
						row: {
							'noibat': !input.checked ? '<div class="checkbox-noi-bat"><input type="checkbox" value="" checked="" onclick="changeNoiBat('+ id + ', this)"></div>': '<div class="checkbox-noi-bat"><input type="checkbox" value="" onclick="changeNoiBat('+ id + ', this)"></div>'
						}
					})
                Lobibox.notify('error', {
                    size: 'mini',
                    msg: 'Thay đổi dữ liệu thất bại.'
                });
            } else {
            	$('#table').bootstrapTable(
					'updateRow', 
					{
						index: $(input).parent().parent().parent().data('index'), 
						row: {
							'noibat': input.checked ? '<div class="checkbox-noi-bat"><input type="checkbox" value="" checked="" onclick="changeNoiBat('+ id + ', this)"></div>': '<div class="checkbox-noi-bat"><input type="checkbox" value="" onclick="changeNoiBat('+ id + ', this)"></div>'
						}
					})
                Lobibox.notify('success', {
                    size: 'mini',
                    msg: 'Thay đổi dữ liệu thành công.'
                });
            }
        },
        error: (error) => {
        	$('#table').bootstrapTable(
				'updateRow', 
				{
					index: $(input).parent().parent().parent().data('index'), 
					row: {
						'noibat': !input.checked ? '<div class="checkbox-noi-bat"><input type="checkbox" value="" checked="" onclick="changeNoiBat('+ id + ', this)"></div>': '<div class="checkbox-noi-bat"><input type="checkbox" value="" onclick="changeNoiBat('+ id + ', this)"></div>'
					}
				})
			Lobibox.notify('error', {
				size: 'mini',
				msg: "Lỗi không kết nối được với dữ liệu.\nVui lòng thử lại."
			});
		}
    });
}

function changeBanChay(id, input){
    $.ajax({
        type: "POST",
        url: 'quantri/sanpham/chinhsuabanchay',
        data: {
            id: id,
            checked: input.checked
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.status == false){
            	$('#table').bootstrapTable(
				'updateRow', 
				{
					index: $(input).parent().parent().parent().data('index'), 
					row: {
						'banchay': !input.checked ? '<div class="checkbox-noi-bat"><input type="checkbox" value="" checked="" onclick="changeBanChay('+ id + ', this)"></div>': '<div class="checkbox-noi-bat"><input type="checkbox" value="" onclick="changeBanChay('+ id + ', this)"></div>'
					}
				})
                Lobibox.notify('error', {
                    size: 'mini',
                    msg: 'Thay đổi dữ liệu thất bại.'
                });
            } else {
            	$('#table').bootstrapTable(
				'updateRow', 
				{
					index: $(input).parent().parent().parent().data('index'), 
					row: {
						'banchay': input.checked ? '<div class="checkbox-noi-bat"><input type="checkbox" value="" checked="" onclick="changeBanChay('+ id + ', this)"></div>': '<div class="checkbox-noi-bat"><input type="checkbox" value="" onclick="changeBanChay('+ id + ', this)"></div>'
					}
				})
                Lobibox.notify('success', {
                    size: 'mini',
                    msg: 'Thay đổi dữ liệu thành công.'
                });
            }
        },
        error: (error) => {
        	$('#table').bootstrapTable(
				'updateRow', 
				{
					index: $(input).parent().parent().parent().data('index'), 
					row: {
						'banchay': !input.checked ? '<div class="checkbox-noi-bat"><input type="checkbox" value="" checked="" onclick="changeBanChay('+ id + ', this)"></div>': '<div class="checkbox-noi-bat"><input type="checkbox" value="" onclick="changeBanChay('+ id + ', this)"></div>'
					}
				})
			Lobibox.notify('error', {
				size: 'mini',
				msg: "Lỗi không kết nối được với dữ liệu.\nVui lòng thử lại."
			});
		}
    });
}
