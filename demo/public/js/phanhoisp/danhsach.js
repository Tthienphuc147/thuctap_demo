function copyText(ele, str){
	const el = document.createElement('textarea');
	el.value = str;
	document.body.appendChild(el);
	el.select();
	document.execCommand('copy');
	document.body.removeChild(el);
	ele.setAttribute('data-tooltip-el', 'copied')
	setTimeout(() => {
		ele.removeAttribute('data-tooltip-el', 'copied')
	}, 1000)
}

function ajaxPhanHoi(loaiid){
	$.ajax({
		type: 'POST',
		url: 'quantri/phanhoisanpham/changephanhoi',
		headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		data: {
			loaiid: loaiid,
		},
		success: function(response){
			if(response.status){
				var str = ''
				var temp = -1;
				for(let i = 0; i < response.phan_hoi_sp.length; i++){
					if(i != 0 && temp != response.phan_hoi_sp[i].spid){
						str += '</tbody></table></div></div></div>'
					}
					if(temp != response.phan_hoi_sp[i].spid){
						str += '<div class="panel panel-default">'
						str += '<div class="panel-heading accordion-head">'
						str += '<h4 class="panel-title">'
						str += '<a data-toggle="collapse" data-parent="#accordion" href="#collapse' + response.phan_hoi_sp[i].spid + '">' + response.phan_hoi_sp[i].spten + '</a>'
						str += '</h4></div>'
						str += '<div id="collapse' + response.phan_hoi_sp[i].spid + '" class="panel-collapse panel-ic collapse">'
						str += '<div class="panel-body admin-panel-content animated bounce">'
						str += '<table class="table hover-table table-bordered">'
						str += '<thead><tr>'
						str += '<th class="text-center">Nội dung</th>'
						str += '<th class="text-center">Xóa</th>'
						str += '</tr>'
						str += '</thead>'
						str += '<tbody>'
					}
					
					str += '<tr id="column' + response.phan_hoi_sp[i].phanhoiid + '">'
					str += '<td>'
					str += '<p><strong>' + response.phan_hoi_sp[i].ten_hien_thi + '</strong><span class="pointed"><i class="text-primary" onclick="copyText(this, \'' + response.phan_hoi_sp[i].email + '\')">' + response.phan_hoi_sp[i].email + '</i></span>'
	                str += '<br>' + response.phan_hoi_sp[i].noi_dung + '</p>'
					str += '</td><td>'
					str += '<button title="Xóa" class="pd-setting-ed" onclick="deleteID(' + response.phan_hoi_sp[i].phanhoiid + ')">'
					str += '<i class="fa fa-trash-o" aria-hidden="true"></i>'
					str += '</button></td>'
					str += '</tr>'
					if(temp == response.phan_hoi_sp.length - 1){
						str += '</tbody></table></div></div></div>' 
					}

					temp = response.phan_hoi_sp[i].spid
				}
				        
				$('#accordion').html(str)
			} else {
				alert('in ra man hinh ko co du lieu')
			}
		}
	})

}

function deleteID (phanhoiid){
	$.ajax({
		type: 'GET',
		url: 'quantri/phanhoisanpham/xoa/' + phanhoiid,
		success: function(response){
			if(response.status){
				removeElement('column' + phanhoiid)
				Lobibox.notify('success', {
                    size: 'mini',
                    msg: "Xóa dữ liệu thành công"
                });
			} else {
				Lobibox.notify('error', {
                    size: 'mini',
                    msg: "Xóa dữ liệu thất bại"
                });
			}
			
		}
	})
}