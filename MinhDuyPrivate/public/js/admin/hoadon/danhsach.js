/**
 * 1. Xem chi tiết hóa đơn
 * 2. Click button sửa chi tiết
 * 3. Click button hủy chỉnh sửa chi tiết
 * 4. Bắt validate input số lượng chi tiết
 * 5. Lưu hóa đơn chi tiết
 * 6. Xóa hóa đơn chi tiết
 * 7. Thêm hóa đơn chi tiết
 * 8. Lọc danh sách san phẩm khi input thay đổi
 * 9. Click chọn sản phẩm để thêm vào chi tiết hóa đơn
 * 10. Xóa 1 hóa đơn
 * 11. Thay đổi trạng thái hóa đơn
 * 12. Lưu giá trị tiền ship khi chuyển trang trạng thái ĐANG SHIP
 * 13. Hủy bỏ thay đổi đến trạng thái ĐANG SHIP
 * 14. Tạo chuỗi vẽ select option thay đổi trang thái hóa đơn
 * 15. Tạo chuỗi vẽ button trang thái chi tiết hóa đơn
 * 16. Chỉnh sửa hóa đơn
 * 17. Thay đổi select-option tỉnh/thành phố 
 * 18. Thay đổi select-option quận/huyện
 * 19. Thay đổi select-option xã/phường
 * 20. Bắt sự kiện focus input ten_khach_hang
 * 21. Bắt sự kiện focus input email
 * 22. Bắt sự kiện focus input dia_chi
 * 23. Bắt sự kiện focus input phi_ship
 * 24. Kiểm tra định dạng email
 * 25. Bắt sự kiện focus input so_dien_thoai
 * 26. Bắt sự kiện focus input ten_khach_hang
 * 27. Thay đổi select-option xã/phường
 * 28. Submit form chỉnh sửa hóa đơn
 */
var datatable
 window.onload = function () {
    document.getElementById('show-loading').style.display = 'none'
    document.getElementById('hidden-loading').style.display = 'block'
    datatable = $('#table').bootstrapTable('getData')
}

//Xem chi tiết hóa đơn
function showDetails(id, mahoadon){
	$.ajax({
		type: 'POST',
		url: 'quantri/chitiethoadon/danhsachtheoidhoadon',
		headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        	id_hoa_don: id
        },
        success: (response) => {
        	// console.log(response)
        	if(response.status){
        		let str = ''
        		let tongsoluong = 0
				let tongthanhtien = 0
        		if(response.chi_tiet_hoa_don.length > 0){
        			switch(response.chi_tiet_hoa_don[0].trang_thai){
	        			case 1: 
	        				str += '<div class="modal-dialog content-hdchitiet">'
			        		str += '<div class="modal-content">'
			        		str += '<div class="modal-header header-color-modal bg-color-3" style="background: #2b982b; color: white;">'
			        		str += '<h4 class="modal-title">Danh sách chi tiết hóa đơn</h4>'
			        		str += '<div class="modal-close-area modal-close-df">'
			        		str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
			        		str += '</div>'
			        		str += '</div>'
			        		str += '<div class="modal-body">'
			        		str += '<div class="row">'
			        		str += '<div class="col-md-8">'
			        		str += '<h4 style="padding-top: 10px">Mã hóa đơn: '+ mahoadon + '</h4>'
			        		str += '</div>'
			        		str += '<div class="col-md-4">'
			        		str += '<div style="text-align: right; padding-bottom: 20px"><button class="btn btn-success" onclick="addChiTietHoaDon('+ id + ')" id="buttonThem">Thêm</button></div>'
			        		str += '</div>'
			        		str += '</div>'
			        		str += '<div id="contentModal">'
		        			str += '<table class="table hover-table table-bordered">'
			        		str += '<thead>'
			        		str += '<tr>'
							str += '<th>Tên sản phẩm</th>'
							str += '<th width="100" style="text-align: center;">Hình ảnh</th>'
							str += '<th style="text-align: right;">Giá bán</th>'
							str += '<th width="80">Số lượng</th>'
							str += '<th style="text-align: right;">Thành tiền</th>'
							str += '<th style="text-align: center;">Trạng thái</th>'
							str += '<th width="100">Tùy chọn</th>'
							str += '</tr>'
							str += '</thead>'
							str += '<tbody>'
							tongsoluong = 0
							tongthanhtien = 0
							for(let i = 0; i < response.chi_tiet_hoa_don.length; i++){
								str += '<tr id="rowchitiet'+ response.chi_tiet_hoa_don[i].id + '">'
								str += '<td align="left">'+ response.chi_tiet_hoa_don[i].spten + '</td>'
								str += '<td>'
								if(response.chi_tiet_hoa_don[i].hinh_anh == ''){
									str += '<img src="https://via.placeholder.com/1200x800" alt="" class="img-thumbnail">'
								} else {
									str += '<img src="uploads/images/products/'+ response.chi_tiet_hoa_don[i].hinh_anh + '" class="img-thumbnail"/>'
								}
								str += '</td>'
								str += '<td align="right">'+ formatNumberThousand(response.chi_tiet_hoa_don[i].gia_ban) + '₫</td>'
								str += '<td align="center">'
								str += '<div class="form-group form-group-soluong">'
								str += '<input type="number" class="form-control form-control-soluong" value="'+ response.chi_tiet_hoa_don[i].so_luong + '" readonly id="inputsoluongchitiet'+ response.chi_tiet_hoa_don[i].id + '" min="1" onchange="changeinputsoluong(this, '+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].gia_ban + ')" onKeyPress="return khongNhapKyTu(event);">'
								str += '</div>'
  								str += '</td>'
								str += '<td align="right" id="idthanhtien'+ response.chi_tiet_hoa_don[i].id + '">'+ formatNumberThousand(response.chi_tiet_hoa_don[i].so_luong * response.chi_tiet_hoa_don[i].gia_ban) + '₫</td>'
								str += '<td align="center">'+ drawHTMLTrangThaiChiTietHoaDon(response.chi_tiet_hoa_don[i].id, response.chi_tiet_hoa_don[i].trang_thai) + '</td>'
								str += '<td align="left">'
								str += '<button title="Xóa" class="pd-setting-ed" onclick="deleteChiTietHD('+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].id_hoa_don + ')" id="iddeletechitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: inline;">'
								str += '<i class="fa fa-trash-o" aria-hidden="true"></i>'
								str += '</button>'
								str += '<button title="Click để sửa số lượng" class="pd-setting-ed" onclick="editChiTietHD('+ response.chi_tiet_hoa_don[i].id + ')" id="ideditchitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: inline;">'
								str += '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
								str += '</button>'
								str += '<button title="Click để lưu thay đổi số lượng" class="pd-setting-ed" onclick="saveChiTietHoaDon('+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].so_luong + ', '+ response.chi_tiet_hoa_don[i].gia_ban + ', '+ response.chi_tiet_hoa_don[i].id_hoa_don + ')" id="idsavechitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: none;">'
								str += '<i class="fa fa-floppy-o" aria-hidden="true"></i>'
								str += '</button>'
								str += '<button title="Click để hủy bỏ" class="pd-setting-ed" onclick="destroyChiTietHoaDon('+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].so_luong + ', '+ response.chi_tiet_hoa_don[i].gia_ban + ')" id="iddestroychitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: none;">'
								str += '<i class="fa fa-window-close" aria-hidden="true"></i>'
								str += '</button>'
								str += '</td>'
								str += '</tr>'
								tongsoluong += response.chi_tiet_hoa_don[i].so_luong
								tongthanhtien += response.chi_tiet_hoa_don[i].so_luong * response.chi_tiet_hoa_don[i].gia_ban
							}
							str += '</tbody>'
							str += '</table>'
							str += '</div>'
							str += '</div>'
							str += '<div class="modal-footer warning-md">'
							str += '<div class="row">'
			        		str += '<div class="col-md-7" id="tongsoluong">'
			        		str += '<h5 style="padding-top: 10px">Tổng số lượng: <span style="color: red">'+ tongsoluong + '</span></h5>'
			        		str += '</div>'
			        		str += '<div class="col-md-4" style="text-align: left" id="tongthanhtien">'
			        		str += '<h5 style="padding-top: 10px">Tổng thành tiền: <span style="color: red">'+ formatNumberThousand(tongthanhtien) + '</span>₫</h5>'
			        		str += '</div>'
			        		str += '<div class="col-md-1">'
			        		str += '<button class="btn btn-success" data-dismiss="modal">Đóng</button>'
			        		str += '</div>'
			        		str += '</div>'

							str += '</div>'
							str += '</div>'
							str += '</div>'
			        		break
			        	case 2: 
	        				str += '<div class="modal-dialog content-hdchitiet">'
			        		str += '<div class="modal-content">'
			        		str += '<div class="modal-header header-color-modal bg-color-3" style="background: #ff9600; color: white;">'
			        		str += '<h4 class="modal-title">Danh sách chi tiết hóa đơn</h4>'
			        		str += '<div class="modal-close-area modal-close-df">'
			        		str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
			        		str += '</div>'
			        		str += '</div>'
			        		str += '<div class="modal-body">'
			        		str += '<div class="row">'
			        		str += '<div class="col-md-12">'
			        		str += '<h4 style="padding-top: 10px">Mã hóa đơn: '+ mahoadon + '</h4>'
			        		str += '</div>'
			        		str += '</div>'
			        		str += '<div id="contentModal">'
		        			str += '<table class="table hover-table table-bordered">'
			        		str += '<thead>'
			        		str += '<tr>'
							str += '<th>Tên sản phẩm</th>'
							str += '<th width="100" style="text-align: center;">Hình ảnh</th>'
							str += '<th style="text-align: right;">Giá bán</th>'
							str += '<th width="80">Số lượng</th>'
							str += '<th style="text-align: right;">Thành tiền</th>'
							str += '<th style="text-align: center;">Trạng thái</th>'
							str += '</tr>'
							str += '</thead>'
							str += '<tbody>'
							tongsoluong = 0
							tongthanhtien = 0
							for(let i = 0; i < response.chi_tiet_hoa_don.length; i++){
								str += '<tr id="rowchitiet'+ response.chi_tiet_hoa_don[i].id + '">'
								str += '<td align="left">'+ response.chi_tiet_hoa_don[i].spten + '</td>'
								str += '<td>'
								if(response.chi_tiet_hoa_don[i].hinh_anh == ''){
									str += '<img src="https://via.placeholder.com/1200x800" alt="" class="img-thumbnail">'
								} else {
									str += '<img src="uploads/images/products/'+ response.chi_tiet_hoa_don[i].hinh_anh + '" class="img-thumbnail"/>'
								}
								str += '</td>'
								str += '<td align="right">'+ formatNumberThousand(response.chi_tiet_hoa_don[i].gia_ban) + '₫</td>'
								str += '<td align="center">'
								str += '<div class="form-group form-group-soluong">'
								str += '<input type="number" class="form-control form-control-soluong" value="'+ response.chi_tiet_hoa_don[i].so_luong + '" readonly id="inputsoluongchitiet'+ response.chi_tiet_hoa_don[i].id + '" min="1" onchange="changeinputsoluong(this, '+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].gia_ban + ')" onKeyPress="return khongNhapKyTu(event);">'
								str += '</div>'
  								str += '</td>'
								str += '<td align="right" id="idthanhtien'+ response.chi_tiet_hoa_don[i].id + '">'+ formatNumberThousand(response.chi_tiet_hoa_don[i].so_luong * response.chi_tiet_hoa_don[i].gia_ban) + '₫</td>'
								str += '<td align="center">'+ drawHTMLTrangThaiChiTietHoaDon(response.chi_tiet_hoa_don[i].id, response.chi_tiet_hoa_don[i].trang_thai) + '</td>'
								str += '</tr>'
								tongsoluong += response.chi_tiet_hoa_don[i].so_luong
								tongthanhtien += response.chi_tiet_hoa_don[i].so_luong * response.chi_tiet_hoa_don[i].gia_ban
							}
							str += '</tbody>'
							str += '</table>'
							str += '</div>'
							str += '</div>'
							str += '<div class="modal-footer warning-md">'
							str += '<div class="row">'
			        		str += '<div class="col-md-7">'
			        		str += '<h5 style="padding-top: 10px">Tổng số lượng: <span style="color: red">'+ tongsoluong + '</span></h5>'
			        		str += '</div>'
			        		str += '<div class="col-md-4" style="text-align: left">'
			        		str += '<h5 style="padding-top: 10px">Tổng thành tiền: <span style="color: red">'+ formatNumberThousand(tongthanhtien) + '</span>₫</h5>'
			        		str += '</div>'
			        		str += '<div class="col-md-1">'
			        		str += '<button class="btn btn-success" data-dismiss="modal">Đóng</button>'
			        		str += '</div>'
			        		str += '</div>'

							str += '</div>'
							str += '</div>'
							str += '</div>'
			        		break
			        	case 3: 
	        				str += '<div class="modal-dialog content-hdchitiet">'
			        		str += '<div class="modal-content">'
			        		str += '<div class="modal-header header-color-modal bg-color-3" style="background: #795548; color: white;">'
			        		str += '<h4 class="modal-title">Danh sách chi tiết hóa đơn</h4>'
			        		str += '<div class="modal-close-area modal-close-df">'
			        		str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
			        		str += '</div>'
			        		str += '</div>'
			        		str += '<div class="modal-body">'
			        		str += '<div class="row">'
			        		str += '<div class="col-md-12">'
			        		str += '<h4 style="padding-top: 10px">Mã hóa đơn: '+ mahoadon + '</h4>'
			        		str += '</div>'
			        		str += '</div>'
			        		str += '<div id="contentModal">'
		        			str += '<table class="table hover-table table-bordered">'
			        		str += '<thead>'
			        		str += '<tr>'
							str += '<th>Tên sản phẩm</th>'
							str += '<th width="100" style="text-align: center;">Hình ảnh</th>'
							str += '<th style="text-align: right;">Giá bán</th>'
							str += '<th width="80">Số lượng</th>'
							str += '<th style="text-align: right;">Thành tiền</th>'
							str += '<th style="text-align: center;">Trạng thái</th>'
							str += '<th width="100">Tùy chọn</th>'
							str += '</tr>'
							str += '</thead>'
							str += '<tbody>'
							tongsoluong = 0
							tongthanhtien = 0
							for(let i = 0; i < response.chi_tiet_hoa_don.length; i++){
								str += '<tr id="rowchitiet'+ response.chi_tiet_hoa_don[i].id + '">'
								str += '<td align="left">'+ response.chi_tiet_hoa_don[i].spten + '</td>'
								str += '<td>'
								if(response.chi_tiet_hoa_don[i].hinh_anh == ''){
									str += '<img src="https://via.placeholder.com/1200x800" alt="" class="img-thumbnail">'
								} else {
									str += '<img src="uploads/images/products/'+ response.chi_tiet_hoa_don[i].hinh_anh + '" class="img-thumbnail"/>'
								}
								str += '</td>'
								str += '<td align="right">'+ formatNumberThousand(response.chi_tiet_hoa_don[i].gia_ban) + '₫</td>'
								str += '<td align="center">'
								str += '<div class="form-group form-group-soluong">'
								str += '<input type="number" class="form-control form-control-soluong" value="'+ response.chi_tiet_hoa_don[i].so_luong + '" readonly id="inputsoluongchitiet'+ response.chi_tiet_hoa_don[i].id + '" min="1" onchange="changeinputsoluong(this, '+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].gia_ban + ')" onKeyPress="return khongNhapKyTu(event);">'
								str += '</div>'
  								str += '</td>'
								str += '<td align="right" id="idthanhtien'+ response.chi_tiet_hoa_don[i].id + '">'+ formatNumberThousand(response.chi_tiet_hoa_don[i].so_luong * response.chi_tiet_hoa_don[i].gia_ban) + '₫</td>'
								str += '<td align="center">'+ drawHTMLTrangThaiChiTietHoaDon(response.chi_tiet_hoa_don[i].id, response.chi_tiet_hoa_don[i].trang_thai) + '</td>'
								str += '<td align="left">'
								str += '<button title="Xóa" class="pd-setting-ed" onclick="deleteChiTietHD('+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].id_hoa_don + ')" id="iddeletechitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: inline;">'
								str += '<i class="fa fa-trash-o" aria-hidden="true"></i>'
								str += '</button>'
								str += '<button title="Click để sửa số lượng" class="pd-setting-ed" onclick="editChiTietHD('+ response.chi_tiet_hoa_don[i].id + ')" id="ideditchitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: inline;">'
								str += '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
								str += '</button>'
								str += '<button title="Click để lưu thay đổi số lượng" class="pd-setting-ed" onclick="saveChiTietHoaDon('+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].so_luong + ', '+ response.chi_tiet_hoa_don[i].gia_ban + ', '+ response.chi_tiet_hoa_don[i].id_hoa_don + ')" id="idsavechitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: none;">'
								str += '<i class="fa fa-floppy-o" aria-hidden="true"></i>'
								str += '</button>'
								str += '<button title="Click để hủy bỏ" class="pd-setting-ed" onclick="destroyChiTietHoaDon('+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].so_luong + ', '+ response.chi_tiet_hoa_don[i].gia_ban + ')" id="iddestroychitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: none;">'
								str += '<i class="fa fa-window-close" aria-hidden="true"></i>'
								str += '</button>'
								str += '</td>'
								str += '</tr>'
								tongsoluong += response.chi_tiet_hoa_don[i].so_luong
								tongthanhtien += response.chi_tiet_hoa_don[i].so_luong * response.chi_tiet_hoa_don[i].gia_ban
							}
							str += '</tbody>'
							str += '</table>'
							str += '</div>'
							str += '</div>'
							str += '<div class="modal-footer warning-md">'
							str += '<div class="row">'
			        		str += '<div class="col-md-7" id="tongsoluong">'
			        		str += '<h5 style="padding-top: 10px">Tổng số lượng: <span style="color: red">'+ tongsoluong + '</span></h5>'
			        		str += '</div>'
			        		str += '<div class="col-md-4" style="text-align: left" id="tongthanhtien">'
			        		str += '<h5 style="padding-top: 10px">Tổng thành tiền: <span style="color: red">'+ formatNumberThousand(tongthanhtien) + '</span>₫</h5>'
			        		str += '</div>'
			        		str += '<div class="col-md-1">'
			        		str += '<button class="btn btn-success" data-dismiss="modal">Đóng</button>'
			        		str += '</div>'
			        		str += '</div>'

							str += '</div>'
							str += '</div>'
							str += '</div>'
			        		break
			        	case 4: 
	        				str += '<div class="modal-dialog content-hdchitiet">'
			        		str += '<div class="modal-content">'
			        		str += '<div class="modal-header header-color-modal bg-color-3" style="background: #fb483a; color: white;">'
			        		str += '<h4 class="modal-title">Danh sách chi tiết hóa đơn</h4>'
			        		str += '<div class="modal-close-area modal-close-df">'
			        		str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
			        		str += '</div>'
			        		str += '</div>'
			        		str += '<div class="modal-body">'
			        		str += '<div class="row">'
			        		str += '<div class="col-md-12">'
			        		str += '<h4 style="padding-top: 10px">Mã hóa đơn: '+ mahoadon + '</h4>'
			        		str += '</div>'
			        		str += '</div>'
			        		str += '<div id="contentModal">'
		        			str += '<table class="table hover-table table-bordered">'
			        		str += '<thead>'
			        		str += '<tr>'
							str += '<th>Tên sản phẩm</th>'
							str += '<th width="100" style="text-align: center;">Hình ảnh</th>'
							str += '<th style="text-align: right;">Giá bán</th>'
							str += '<th width="80">Số lượng</th>'
							str += '<th style="text-align: right;">Thành tiền</th>'
							str += '<th style="text-align: center;">Trạng thái</th>'
							str += '</tr>'
							str += '</thead>'
							str += '<tbody>'
							tongsoluong = 0
							tongthanhtien = 0
							for(let i = 0; i < response.chi_tiet_hoa_don.length; i++){
								str += '<tr id="rowchitiet'+ response.chi_tiet_hoa_don[i].id + '">'
								str += '<td align="left">'+ response.chi_tiet_hoa_don[i].spten + '</td>'
								str += '<td>'
								if(response.chi_tiet_hoa_don[i].hinh_anh == ''){
									str += '<img src="https://via.placeholder.com/1200x800" alt="" class="img-thumbnail">'
								} else {
									str += '<img src="uploads/images/products/'+ response.chi_tiet_hoa_don[i].hinh_anh + '" class="img-thumbnail"/>'
								}
								str += '</td>'
								str += '<td align="right">'+ formatNumberThousand(response.chi_tiet_hoa_don[i].gia_ban) + '₫</td>'
								str += '<td align="center">'
								str += '<div class="form-group form-group-soluong">'
								str += '<input type="number" class="form-control form-control-soluong" value="'+ response.chi_tiet_hoa_don[i].so_luong + '" readonly id="inputsoluongchitiet'+ response.chi_tiet_hoa_don[i].id + '" min="1" onchange="changeinputsoluong(this, '+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].gia_ban + ')" onKeyPress="return khongNhapKyTu(event);">'
								str += '</div>'
  								str += '</td>'
								str += '<td align="right" id="idthanhtien'+ response.chi_tiet_hoa_don[i].id + '">'+ formatNumberThousand(response.chi_tiet_hoa_don[i].so_luong * response.chi_tiet_hoa_don[i].gia_ban) + '₫</td>'
								str += '<td align="center">'+ drawHTMLTrangThaiChiTietHoaDon(response.chi_tiet_hoa_don[i].id, response.chi_tiet_hoa_don[i].trang_thai) + '</td>'
								str += '</tr>'
								tongsoluong += response.chi_tiet_hoa_don[i].so_luong
								tongthanhtien += response.chi_tiet_hoa_don[i].so_luong * response.chi_tiet_hoa_don[i].gia_ban
							}
							str += '</tbody>'
							str += '</table>'
							str += '</div>'
							str += '</div>'
							str += '<div class="modal-footer warning-md">'

							str += '<div class="row">'
			        		str += '<div class="col-md-7">'
			        		str += '<h5 style="padding-top: 10px">Tổng số lượng: <span style="color: red">'+ tongsoluong + '</span></h5>'
			        		str += '</div>'
			        		str += '<div class="col-md-4" style="text-align: left">'
			        		str += '<h5 style="padding-top: 10px">Tổng thành tiền: <span style="color: red">'+ formatNumberThousand(tongthanhtien) + '</span>₫</h5>'
			        		str += '</div>'
			        		str += '<div class="col-md-1">'
			        		str += '<button class="btn btn-success" data-dismiss="modal">Đóng</button>'
			        		str += '</div>'
			        		str += '</div>'


							
							str += '</div>'
							str += '</div>'
							str += '</div>'
			        		break
			        	default:
			        		str += '<div class="modal-dialog content-hdchitiet">'
			        		str += '<div class="modal-content">'
			        		str += '<div class="modal-header header-color-modal bg-color-3" style="background: #2b982b; color: white;">'
			        		str += '<h4 class="modal-title">Danh sách chi tiết hóa đơn</h4>'
			        		str += '<div class="modal-close-area modal-close-df">'
			        		str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
			        		str += '</div>'
			        		str += '</div>'
			        		str += '<div class="modal-body">'
			        		str += 'tu tu code tiep'
			        		str += '</div>'
							str += '<div class="modal-footer warning-md">'
							str += '<button class="btn btn-success" data-dismiss="modal">Đóng</button>'
							str += '</div>'
							str += '</div>'
							str += '</div>'
	        		}
        		} else {
        			str += '<div class="modal-dialog content-hdchitiet">'
	        		str += '<div class="modal-content">'
	        		str += '<div class="modal-header header-color-modal bg-color-3" style="background: #2b982b; color: white;">'
	        		str += '<h4 class="modal-title">Danh sách chi tiết hóa đơn</h4>'
	        		str += '<div class="modal-close-area modal-close-df">'
	        		str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
	        		str += '</div>'
	        		str += '</div>'
	        		str += '<div class="modal-body">'
	        		str += '<div class="row">'
	        		str += '<div class="col-md-8">'
	        		str += '<h4 style="padding-top: 10px">Mã hóa đơn: '+ mahoadon + '</h4>'
        			str += '</div>'
        			str += '<div class="col-md-4">'
        			str += '<div style="text-align: right; padding-bottom: 20px"><button class="btn btn-success" onclick="addChiTietHoaDon('+ id + ')" id="buttonThem">Thêm</button></div>'
        			str += '</div>'
        			str += '<div id="contentModal">'
        			str += '<center><h5>Chưa có danh sách chi tiết hóa đơn</h5></center>'
        			str += '</div>'
        			str += '</div>'
        			str += '</div>'
					str += '<div class="modal-footer warning-md">'
					str += '<button class="btn btn-success" data-dismiss="modal">Đóng</button>'
					str += '</div>'
					str += '</div>'
					str += '</div>'
				}
        		
				$('#modalshowdetail').html('')
				$('#modalshowdetail').html(str)
        		$('#modalshowdetail').modal({backdrop: 'static', keyboard: false})

        	} else {
        		Lobibox.notify('error', {
					size: 'mini',
					msg: "Lỗi không lấy được dữ liệu.\nVui lòng thử lại."
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
}

//Click button sửa chi tiết
function editChiTietHD(id){
	$('#idsavechitiet'+ id).css('display', 'inline')
	$('#iddestroychitiet'+ id).css('display', 'inline')
	$('#iddeletechitiet'+ id).css('display', 'none')
	$('#ideditchitiet'+ id).css('display', 'none')
	var attr = $('#inputsoluongchitiet' + id).attr('readonly');
	if (typeof attr !== typeof undefined && attr !== false) {
	  $('#inputsoluongchitiet' + id).removeAttr('readonly')
	}
}

//Click button hủy chỉnh sửa chi tiết
function destroyChiTietHoaDon(id, soluong, giaban){
	$('#idsavechitiet'+ id).css('display', 'none')
	$('#iddestroychitiet'+ id).css('display', 'none')
	$('#iddeletechitiet'+ id).css('display', 'inline')
	$('#ideditchitiet'+ id).css('display', 'inline')
	$('#inputsoluongchitiet' + id).attr('readonly', '')
	$('#inputsoluongchitiet' + id).val(soluong)
	$('#idthanhtien' + id).html(formatNumberThousand(soluong * giaban) + '₫')
}

//Bắt validate input số lượng chi tiết
function changeinputsoluong(input, id, giaban){
	let regex = /^(0*)[1-9][0-9]*$/g;
	if(regex.test(input.value)){
		$('#idthanhtien' + id).html(formatNumberThousand(input.value * giaban) + '₫')
	} else {
		Lobibox.notify('error', {
			size: 'mini',
			msg: "Vui lòng nhập số lượng đúng định dạng"
		});
	}
}

//Lưu hóa đơn chi tiết
function saveChiTietHoaDon(id, soluong, giaban, idhoadon){
	let regex = /^(0*)[1-9][0-9]*$/g;
	if(regex.test($('#inputsoluongchitiet' + id).val())){
		$.ajax({
			type: 'POST',
			url: 'quantri/chitiethoadon/chinhsuasoluong',
			data: {
				id: id,
				so_luong: Number($('#inputsoluongchitiet' + id).val()),
				id_hoa_don: idhoadon
			},
			headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
			success: (response) => {
				// console.log(response)
				if(response.status){
					$('#idsavechitiet'+ id).css('display', 'none')
					$('#iddestroychitiet'+ id).css('display', 'none')
					$('#iddeletechitiet'+ id).css('display', 'inline')
					$('#ideditchitiet'+ id).css('display', 'inline')
					$('#inputsoluongchitiet' + id).attr('readonly', '')
					$('#inputsoluongchitiet' + id).val(response.so_luong)
					$('#iddestroychitiet'+ id).attr('onclick', 'destroyChiTietHoaDon(' + id + ', '+ response.so_luong + ', ' + giaban + ', ' + idhoadon + ')')
					$('#idsavechitiet'+ id).attr('onclick', 'saveChiTietHoaDon(' + id + ', '+ response.so_luong + ', ' + giaban + ', ' + idhoadon + ')')

					$('#tongsoluong').html('<h5 style="padding-top: 10px">Tổng số lượng: <span style="color: red">'+ response.tong[0].tong_so_luong + '</span></h5>')
					$('#tongthanhtien').html('<h5 style="padding-top: 10px">Tổng thành tiền: <span style="color: red">'+ formatNumberThousand(response.tong[0].tong_thanh_tien) + '</span>₫</h5>')
					Lobibox.notify('success', {
						size: 'mini',
						msg: "Thay đổi số lượng thành công"
					});
				} else {
					Lobibox.notify('error', {
						size: 'mini',
						msg: "Thay đổi số lượng thất bại"
					});
					$('#inputsoluongchitiet' + id).val(soluong)
				}
			},
			error: (error) => {
				Lobibox.notify('error', {
					size: 'mini',
					msg: "Lỗi khi thay đổi số lượng"
				});
				$('#inputsoluongchitiet' + id).val(soluong)
			}
		})
	} else {
		Lobibox.notify('error', {
			size: 'mini',
			msg: "Vui lòng nhập số lượng đúng định dạng"
		});
		$('#inputsoluongchitiet' + id).val(soluong)
	}
}

//Xóa hóa đơn chi tiết
function deleteChiTietHD(id, idhoadon){
	$.ajax({
		type: 'GET',
		url: 'quantri/chitiethoadon/xoa/' + idhoadon + '/' + id,
		success: (response)=>{
			// console.log(response)
			if(response.status){
				removeElement('rowchitiet' + id)
				if(response.tong[0].tong_so_luong == null){
					$('#tongsoluong').html('<h5 style="padding-top: 10px">Tổng số lượng: <span style="color: red">0</span></h5>')
				} else {
					$('#tongsoluong').html('<h5 style="padding-top: 10px">Tổng số lượng: <span style="color: red">'+ response.tong[0].tong_so_luong + '</span></h5>')
				}
				$('#tongthanhtien').html('<h5 style="padding-top: 10px">Tổng thành tiền: <span style="color: red">'+ formatNumberThousand(response.tong[0].tong_thanh_tien) + '</span>₫</h5>')
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
		},
		error: (error)=>{
			Lobibox.notify('error', {
				size: 'mini',
				msg: "Lỗi khi xóa chi tiết hóa đơn"
			});
		}
	})
}

//Thêm hóa đơn chi tiết
function addChiTietHoaDon(id){
	$.ajax({
		type: 'GET',
		url: 'quantri/chitiethoadon/them',
		success: (response) => {
			if(response.status){
				$('#buttonThem').css('display', 'none')
				let str = ''
				str += '<input type="text" id="myInput" onkeyup="changeInputAdd()" placeholder="Tìm kiếm theo tên sản phẩm" title="Tìm kiếm sản phẩm">'
				str += '<div id="searchtable">'
				str += '<table class="table hover-table table-bordered" id="myTable">'
				str += '<thead>'
				str += '<tr>'
				str += '<th width="80" style="text-align: center;">ID</th>'
				str += '<th>Tên sản phẩm</th>'
				str += '<th width="100">Số lượng</th>'
				str += '<th width="100">Tùy chọn</th>'
				str += '</tr>'
				str += '</thead>'
				str += '<tbody>'
				for(let i = 0; i < response.san_pham.length; i++){
					str += '<tr>'
					str += '<td align="center">' + response.san_pham[i].id + '</td>'
					str += '<td align="left">' + response.san_pham[i].ten + '</td>'
					str += '<td align="center">'
					str += '<div class="form-group form-group-soluong">'
					str += '<input type="number" class="form-control form-control-soluong" value="1" min="1" onKeyPress="return khongNhapKyTu(event);" id="inputsoluongsp' + response.san_pham[i].id + '">'
					str += '</div>'
					str += '</td>'
					str += '<td align="center">'
					str += '<button class="btn btn-success" onclick="chonSP(' + response.san_pham[i].id + ', '+ id + ')">Chọn</button>'
					str += '</td>'
					str += '</tr>'
				}
				str += '</tbody>'
				str += '</table>'
				str += '</div>'
				$('#contentModal').html(str)
			} else {
				Lobibox.notify('error', {
					size: 'mini',
					msg: "Lỗi không lấy được dữ liệu.\nVui lòng thử lại."
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
}

//Lọc danh sách san phẩm khi input thay đổi
function changeInputAdd() {
	var input, filter, table, tr, td, i, txtValue;
	input = document.getElementById("myInput");
	filter = input.value.toUpperCase();
	table = document.getElementById("myTable");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[1];
		if (td) {
			txtValue = td.textContent || td.innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}       
	}
}

//Click chọn sản phẩm để thêm vào chi tiết hóa đơn
function chonSP(id, idhoadon){
	let regex = /^(0*)[1-9][0-9]*$/g;
	if(regex.test($('#inputsoluongsp' + id).val())){
		$.ajax({
			type: 'POST',
			url: 'quantri/chitiethoadon/them',
			headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	        	id_hoa_don: idhoadon,
	        	id_sp: id,
	        	so_luong: $('#inputsoluongsp' + id).val()
	        },
			success: (response) => {
				// console.log(response)
				if(response.status){
					$('#buttonThem').css('display', 'inline')
					let str = ''
					str += '<table class="table hover-table table-bordered">'
					str += '<thead>'
					str += '<tr>'
					str += '<th>Tên sản phẩm</th>'
					str += '<th width="100" style="text-align: center;">Hình ảnh</th>'
					str += '<th style="text-align: right;">Giá bán</th>'
					str += '<th width="80">Số lượng</th>'
					str += '<th style="text-align: right;">Thành tiền</th>'
					str += '<th style="text-align: center;">Trạng thái</th>'
					str += '<th width="100">Tùy chọn</th>'
					str += '</tr>'
					str += '</thead>'
					str += '<tbody>'
					for(let i = 0; i < response.chi_tiet_hoa_don.length; i++){
						str += '<tr id="rowchitiet'+ response.chi_tiet_hoa_don[i].id + '">'
						str += '<td align="left">'+ response.chi_tiet_hoa_don[i].spten + '</td>'
						str += '<td>'
						if(response.chi_tiet_hoa_don[i].hinh_anh == ''){
							str += '<img src="https://via.placeholder.com/1200x800" alt="" class="img-thumbnail">'
						} else {
							str += '<img src="uploads/images/products/'+ response.chi_tiet_hoa_don[i].hinh_anh + '" class="img-thumbnail"/>'
						}
						str += '</td>'
						str += '<td align="right">'+ formatNumberThousand(response.chi_tiet_hoa_don[i].gia_ban) + '₫</td>'
						str += '<td align="center">'
						str += '<div class="form-group form-group-soluong">'
						str += '<input type="number" class="form-control form-control-soluong" value="'+ response.chi_tiet_hoa_don[i].so_luong + '" readonly id="inputsoluongchitiet'+ response.chi_tiet_hoa_don[i].id + '" min="1" onchange="changeinputsoluong(this, '+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].gia_ban + ')" onKeyPress="return khongNhapKyTu(event);">'
						str += '</div>'
							str += '</td>'
						str += '<td align="right" id="idthanhtien'+ response.chi_tiet_hoa_don[i].id + '">'+ formatNumberThousand(response.chi_tiet_hoa_don[i].so_luong * response.chi_tiet_hoa_don[i].gia_ban) + '₫</td>'
						str += '<td align="center">'+ drawHTMLTrangThaiChiTietHoaDon(response.chi_tiet_hoa_don[i].id, response.chi_tiet_hoa_don[i].trang_thai) + '</td>'
						str += '<td align="left">'
						str += '<button title="Xóa" class="pd-setting-ed" onclick="deleteChiTietHD('+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].id_hoa_don + ')" id="iddeletechitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: inline;">'
						str += '<i class="fa fa-trash-o" aria-hidden="true"></i>'
						str += '</button>'
						str += '<button title="Click để sửa số lượng" class="pd-setting-ed" onclick="editChiTietHD('+ response.chi_tiet_hoa_don[i].id + ')" id="ideditchitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: inline;">'
						str += '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
						str += '</button>'
						str += '<button title="Click để lưu thay đổi số lượng" class="pd-setting-ed" onclick="saveChiTietHoaDon('+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].so_luong + ', '+ response.chi_tiet_hoa_don[i].gia_ban + ', '+ response.chi_tiet_hoa_don[i].id_hoa_don + ')" id="idsavechitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: none;">'
						str += '<i class="fa fa-floppy-o" aria-hidden="true"></i>'
						str += '</button>'
						str += '<button title="Click để hủy bỏ" class="pd-setting-ed" onclick="destroyChiTietHoaDon('+ response.chi_tiet_hoa_don[i].id + ', '+ response.chi_tiet_hoa_don[i].so_luong + ', '+ response.chi_tiet_hoa_don[i].gia_ban + ')" id="iddestroychitiet'+ response.chi_tiet_hoa_don[i].id + '" style="display: none;">'
						str += '<i class="fa fa-window-close" aria-hidden="true"></i>'
						str += '</button>'
						str += '</td>'
						str += '</tr>'
					}
					str += '</tbody>'
					str += '</table>'
					$('#contentModal').html(str)
					$('#tongsoluong').html('<h5 style="padding-top: 10px">Tổng số lượng: <span style="color: red">'+ response.tong[0].tong_so_luong + '</span></h5>')
					$('#tongthanhtien').html('<h5 style="padding-top: 10px">Tổng thành tiền: <span style="color: red">'+ formatNumberThousand(response.tong[0].tong_thanh_tien) + '</span>₫</h5>')
					Lobibox.notify('success', {
						size: 'mini',
						msg: "Thêm sản phẩm cho hóa đơn thành công"
					});
				} else {
					Lobibox.notify('error', {
						size: 'mini',
						msg: "Thêm sản phẩm cho hóa đơn không thành công"
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

	} else {
		Lobibox.notify('error', {
			size: 'mini',
			msg: "Vui lòng nhập số lượng đúng định dạng"
		});
	}
}

//Xóa 1 hóa đơn
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
            	url: 'quantri/hoadon/xoa/' + id,
            	success: (response) => {
            		console.log(response)
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

//Thay đổi trạng thái hóa đơn
function changeTrangThaiHD(input, id, trangthai){
	switch(input.value){
		case '1':
			$.ajax({
				type: 'POST',
				url: 'quantri/hoadon/changetrangthaidendathang',
				data: {
					id: id,
				},
				headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
				success: (response) => {
					if(response.status){
						$('#table').bootstrapTable(
							'updateRow', 
							{
								index: $(input).parent().parent().data("index"), 
								row: {
									'phi_ship': "0₫",
									'trang_thai': drawHTMLTrangThaiHoaDon(id, 1)
								}
							})
						Lobibox.notify('success', {
							size: 'mini',
							msg: "Thay đổi trạng thái về ĐẶT HÀNG thành công."
						});
					} else {
						$('#table').bootstrapTable(
							'updateRow', 
							{
								index: $(input).parent().parent().data("index"), 
								row: {
									'phi_ship': "0₫",
									'trang_thai': drawHTMLTrangThaiHoaDon(id, trangthai)
								}
							})
						Lobibox.notify('error', {
							size: 'mini',
							msg: "Thay đổi trạng thái thất bại."
						});
					}
				}
			})
			break
		case '2':
			input.style.backgroundColor= "#ff9600"
			input.style.color= "white"
			let str = ''
			str += '<div id="myModal" class="modal modal-edu-general Customwidth-popup-WarningModal fade" role="dialog">'
			str += '<div class="modal-dialog">'
			str += '<div class="modal-content">'
			str += '<div class="modal-header header-color-modal bg-color-3">'
			str += '<h4 class="modal-title">Nhập phí ship</h4>'
			str += '<div class="modal-close-area modal-close-df">'
			str += '<a class="close" data-dismiss="modal" href="javascript:void(0)" onclick="destroyDangShip('+ id +', '+ trangthai +', '+ $(input).parent().parent().data("index") + ')"><i class="fa fa-close"></i></a>'
			str += '</div>'
			str += '</div>'
			str += '<div class="modal-body">'
			str += '<input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Nhập phí ship" id="inputPhiShip" min="0" max="100000000" onKeyPress="return khongNhapKyTu(event);">'
			str += '</div>'
			str += '<div class="modal-footer warning-md">'
			str += '<button class="btn btn-success" data-dismiss="modal" onclick="saveDangShip('+ id +', '+ trangthai +', '+ $(input).parent().parent().data("index") + ')">Lưu</button>'
			str += '</div>'
			str += '</div>'
			str += '</div>'
			str += '</div>'
			$('#showModal').html(str)
			$('#myModal').modal({backdrop: 'static', keyboard: false})
			break
		case '3':
			if(trangthai == 1) {
				swal({
	                title: "Bạn có chắc chắn muốn bỏ qua nhập PHÍ SHIP?",
	                text: "Nếu bỏ qua, trạng thái sẽ được chuyển đến ĐÃ THANH TOÁN",
	                icon: "warning",
	                buttons: true,
	                dangerMode: true,
	            })
	            .then((isConfirm) => {
	                if (isConfirm) {
	                    $.ajax({
							type: 'POST',
							url: 'quantri/hoadon/changetrangthaidendathanhtoan',
							data: {
								id: id,
							},
							headers: {
					            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					        },
							success: (response) => {
								if(response.status){
									Lobibox.notify('success', {
										size: 'mini',
										msg: "Thay đổi trạng thái đến ĐÃ THANH TOÁN thành công."
									});
									$('#table').bootstrapTable(
										'updateRow', 
										{
											index: $(input).parent().parent().data("index"), 
											row: {
												'trang_thai': drawHTMLTrangThaiHoaDon(id, 3)
											}
										})
								} else {
									Lobibox.notify('error', {
										size: 'mini',
										msg: "Thay đổi trạng thái thất bại."
									});
									$('#table').bootstrapTable(
										'updateRow', 
										{
											index: $(input).parent().parent().data("index"), 
											row: {
												'trang_thai': drawHTMLTrangThaiHoaDon(id, trangthai)
											}
										})
								}
							}
						})
	                } else {
	                	$('#table').bootstrapTable(
							'updateRow', 
							{
								index: $(input).parent().parent().data("index"), 
								row: {
									'trang_thai': drawHTMLTrangThaiHoaDon(id, trangthai)
								}
							})
	                }
	            });
			} else {
				$.ajax({
					type: 'POST',
					url: 'quantri/hoadon/changetrangthaidendathanhtoan',
					data: {
						id: id,
					},
					headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        },
					success: (response) => {
						if(response.status){
							Lobibox.notify('success', {
								size: 'mini',
								msg: "Thay đổi trạng thái đến ĐÃ THANH TOÁN thành công."
							});
							$('#table').bootstrapTable(
								'updateRow', 
								{
									index: $(input).parent().parent().data("index"), 
									row: {
										'trang_thai': drawHTMLTrangThaiHoaDon(id, 3)
									}
								})
						} else {
							Lobibox.notify('error', {
								size: 'mini',
								msg: "Thay đổi trạng thái thất bại."
							});
							$('#table').bootstrapTable(
								'updateRow', 
								{
									index: $(input).parent().parent().data("index"), 
									row: {
										'trang_thai': drawHTMLTrangThaiHoaDon(id, trangthai)
									}
								})
						}
					}
				})
			}
			break
		case '4':
			$.ajax({
				type: 'POST',
				url: 'quantri/hoadon/changetrangthaidenhuydonhang',
				data: {
					id: id,
				},
				headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
				success: (response) => {
					if(response.status){
						Lobibox.notify('success', {
							size: 'mini',
							msg: "Thay đổi trạng thái đến HỦY ĐƠN HÀNG thành công."
						});
						$('#table').bootstrapTable(
							'updateRow', 
							{
								index: $(input).parent().parent().data("index"), 
								row: {
									'trang_thai': drawHTMLTrangThaiHoaDon(id, 4)
								}
							})
					} else {
						Lobibox.notify('error', {
							size: 'mini',
							msg: "Thay đổi trạng thái thất bại."
						});
						$('#table').bootstrapTable(
							'updateRow', 
							{
								index: $(input).parent().parent().data("index"), 
								row: {
									'trang_thai': drawHTMLTrangThaiHoaDon(id, trangthai)
								}
							})
					}
				}
			})
			break
		default:
			input.style.backgroundColor= "white"
			input.style.color= "black"
	}
}

//Lưu giá trị tiền ship khi chuyển trang trạng thái ĐANG SHIP
function saveDangShip(id, trangthai, index){
	let inputphiship = $('#inputPhiShip').val()
	let regex = /^(0*)[1-9][0-9]*$/g;
	if(regex.test(inputphiship)){
		if(Number(inputphiship) > 0 && Number(inputphiship) <= 100000000){
			let phi_ship = Math.round(Number(inputphiship)/1000) * 1000
			$.ajax({
				type: 'POST',
				url: 'quantri/hoadon/changephiship',
				data: {
					id: id,
					phi_ship: phi_ship,
				},
				headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
				success: (response) => {
					if(response.status){
						Lobibox.notify('success', {
							size: 'mini',
							msg: "Thay đổi phí ship thành công."
						});
						$('#table').bootstrapTable(
							'updateRow', 
							{
								index: index, 
								row: {
									'trang_thai': drawHTMLTrangThaiHoaDon(id, 2),
									'phi_ship': formatNumberThousand(phi_ship) + "₫"
								}
							})
					} else {
						Lobibox.notify('error', {
							size: 'mini',
							msg: "Thay đổi phí ship thất bại."
						});
						$('#table').bootstrapTable(
							'updateRow', 
							{
								index: index, 
								row: {
									'trang_thai': drawHTMLTrangThaiHoaDon(id, trangthai)
								}
							})
					}
				}
			})	
		}
	} else {
		Lobibox.notify('warning', {
			size: 'mini',
			msg: "Nhập phí ship không đúng.\nVui lòng nhập lại."
		});
		$('#table').bootstrapTable(
			'updateRow', 
			{
				index: index, 
				row: {
					'trang_thai': drawHTMLTrangThaiHoaDon(id, trangthai)
				}
			})
	}
}

//Hủy bỏ thay đổi đến trạng thái ĐANG SHIP
function destroyDangShip(id, trangthai, index){
	$('#table').bootstrapTable(
		'updateRow', 
		{
			index: index, 
			row: {
				'trang_thai': drawHTMLTrangThaiHoaDon(id, trangthai)
			}
		})
}

//Tạo chuỗi vẽ select option thay đổi trang thái hóa đơn
function drawHTMLTrangThaiHoaDon(id, trangthai){
	let str = ''
	if(trangthai == 1){
		str += '<select class="form-control" onchange="changeTrangThaiHD(this, '+ id +', '+ trangthai +')" style="background: #2b982b; color: white;">'
		str += '<option value="1" class="select-hd" selected="">Đặt hàng</option>'
		str += '<option value="2" class="select-hd">Đang ship</option>'
		str += '<option value="3" class="select-hd">Đã thanh toán</option>'
		str += '<option value="4" class="select-hd">Hủy đơn hàng</option>'
	}
	if(trangthai == 2){
		str += '<select class="form-control" onchange="changeTrangThaiHD(this, '+ id +', '+ trangthai +')" style="background: #ff9600; color: white;">'
		str += '<option value="1" class="select-hd">Đặt hàng</option>'
		str += '<option value="2" class="select-hd" selected="">Đang ship</option>'
		str += '<option value="3" class="select-hd">Đã thanh toán</option>'
		str += '<option value="4" class="select-hd">Hủy đơn hàng</option>'
	}
	if(trangthai == 3){
		str += '<select class="form-control" onchange="changeTrangThaiHD(this, '+ id +', '+ trangthai +')" style="background: #795548; color: white;">'
		str += '<option value="1" class="select-hd">Đặt hàng</option>'
		str += '<option value="2" class="select-hd">Đang ship</option>'
		str += '<option value="3" class="select-hd" selected="">Đã thanh toán</option>'
		str += '<option value="4" class="select-hd">Hủy đơn hàng</option>'
	}
	if(trangthai == 4){
		str += '<select class="form-control" onchange="changeTrangThaiHD(this, '+ id +', '+ trangthai +')" style="background: #fb483a; color: white;">'
		str += '<option value="1" class="select-hd">Đặt hàng</option>'
		str += '<option value="2" class="select-hd">Đang ship</option>'
		str += '<option value="3" class="select-hd">Đã thanh toán</option>'
		str += '<option value="4" class="select-hd" selected="">Hủy đơn hàng</option>'
	}
	str += '</select>'
	return str
}

//Tạo chuỗi vẽ button trang thái chi tiết hóa đơn
function drawHTMLTrangThaiChiTietHoaDon(id, trangthai){
	let str = ''
	if(trangthai == 1){
		str += '<button class="btn btn-success disabled" style="background: #2b982b; color: white;">Đặt hàng</button>'
	}
	if(trangthai == 2){
		str += '<button class="btn btn-success disabled" style="background: #ff9600; color: white;">Đang ship</button>'
	}
	if(trangthai == 3){
		str += '<button class="btn btn-success disabled" style="background: #795548; color: white;">Đã thanh toán</button>'
	}
	if(trangthai == 4){
		str += '<button class="btn btn-success disabled" style="background: #fb483a; color: white;">Hủy đơn hàng</button>'
	}
	return str
}

//Chỉnh sửa hóa đơn
function editID(id, thisbutton){
	let index = $(thisbutton).parent().parent().data('index')
    $.ajax({
		type: 'GET',
		url: 'quantri/hoadon/chinhsua/' + id,
        success: (response) => {
        	// console.log(response)
        	let str = ''
        	if(response.status){
				str += '<div class="modal-dialog content-hdchitiet">'
        		str += '<div class="modal-content">'
        		str += '<div class="modal-header header-color-modal bg-color-3" style="background: #2b982b; color: white;">'
        		str += '<h4 class="modal-title">Chỉnh sửa hóa đơn: '+ response.hoa_don.ma_hoa_don +'</h4>'
        		str += '<div class="modal-close-area modal-close-df">'
        		str += '<a class="close" data-dismiss="modal" href="javascript:void(0)"><i class="fa fa-close"></i></a>'
        		str += '</div>'
        		str += '</div>'
        		str += '<div class="modal-body">'


        		str+= '<form id="form-hoadon" enctype="application/x-www-form-urlencoded">'
        		str+= '<input type="text" name="id" value="' + id + '" style="display:none">'
        		str+= '<div class="row">'
        			str+= '<div class="col-md-6">'
        				str+= '<div class="form-group">'
        					str+= '<label>Tỉnh/Thành phố</label>'
    						str+= '<div class="form-select-list">'
    							str+= '<select class="form-control custom-select-value" name="province_id" required="" onchange="changeProvince(this.value)" id="province">'
        						str+= '<option value="">Chọn tỉnh/thành phố</option>'
        						for (var i = 0; i < response.provinces.length; i++) {
        							if(response.provinces[i].province_id == response.hoa_don.province_id){
        								str+= '<option value="'+ response.provinces[i].province_id +'" selected>'+ response.provinces[i].type + ' ' + response.provinces[i].name +'</option>'
        							} else {
        								str+= '<option value="'+ response.provinces[i].province_id +'">'+ response.provinces[i].type + ' ' + response.provinces[i].name +'</option>'
        							}
        						}
        						str+= '</select>'
        					str+= '</div>'
        					str += '<p class="text-danger" id="validate-province" style="display: none;">Vui lòng chọn tỉnh/thành phố</p>'
        				str+= '</div>'
        			str+= '</div>'
        			str+= '<div class="col-md-6">'
        				str+= '<div class="form-group">'
        					str+= '<label>Họ tên</label>'
    						str+= '<input type="text" class="form-control" placeholder="Nhập họ tên" required="" name="ten_khach_hang" value="'+ response.hoa_don.ten_khach_hang +'" onfocus="focusten_khach_hang(this)">'
    						str += '<p class="text-danger" id="validate-ten-khach-hang" style="display: none;">Vui lòng nhập họ tên</p>'
        				str+= '</div>'
        			str+= '</div>'
    			str+= '</div>'
    			str+= '<div class="row">'
    				str+= '<div class="col-md-6">'
        				str+= '<div class="form-group">'
        					str+= '<label>Quận/Huyện</label>'
    						str+= '<div class="form-select-list">'
    							str+= '<select class="form-control custom-select-value" name="district_id" required="" onchange="changeDistrict(this.value)" id="district">'
        						str+= '<option value="">Chọn quận huyện</option>'
        						for (var i = 0; i < response.districts.length; i++) {
        							if(response.districts[i].district_id == response.hoa_don.district_id){
        								str+= '<option value="'+ response.districts[i].district_id +'" selected>'+ response.districts[i].type + ' ' + response.districts[i].name +'</option>'
        							} else {
        								str+= '<option value="'+ response.districts[i].district_id +'">'+ response.districts[i].type + ' ' + response.districts[i].name +'</option>'
        							}
        						}
        						str+= '</select>'
        					str+= '</div>'
        					str += '<p class="text-danger" id="validate-district" style="display: none;">Vui lòng chọn quận/huyện</p>'
        				str+= '</div>'
        			str+= '</div>'
        			str+= '<div class="col-md-6">'
        				str+= '<div class="form-group">'
        					str+= '<label>Số điện thoại</label>'
    						str+= '<input type="text" class="form-control" placeholder="Nhập số điện thoại" required="" name="so_dien_thoai" value="'+ response.hoa_don.so_dien_thoai +'" onfocus="focusso_dien_thoai(this)">'
    						str += '<p class="text-danger" id="validate-so-dien-thoai" style="display: none;">Vui lòng nhập số điện thoại</p>'
        				str+= '</div>'
        			str+= '</div>'
    			str+= '</div>'

    			str+= '<div class="row">'
    				str+= '<div class="col-md-6">'
        				str+= '<div class="form-group">'
        					str+= '<label>Xã/Phường</label>'
    						str+= '<div class="form-select-list">'
    							str+= '<select class="form-control custom-select-value" name="ward_id" required="" id="ward" onchange="changeWard(this.value)">'
        						str+= '<option value="">Chọn xã phường</option>'
        						for (var i = 0; i < response.wards.length; i++) {
        							if(response.wards[i].ward_id == response.hoa_don.ward_id){
        								str+= '<option value="'+ response.wards[i].ward_id +'" selected>'+ response.wards[i].type + ' ' + response.wards[i].name +'</option>'
        							} else {
        								str+= '<option value="'+ response.wards[i].ward_id +'">'+ response.wards[i].type + ' ' + response.wards[i].name +'</option>'
        							}
        						}
        						str+= '</select>'
        					str+= '</div>'
        					str += '<p class="text-danger" id="validate-ward" style="display: none;">Vui lòng chọn xã/phường</p>'
        				str+= '</div>'
        			str+= '</div>'
        			str+= '<div class="col-md-6">'
        				str+= '<div class="form-group">'
        					str+= '<label>Email</label>'
    						str+= '<input type="email" class="form-control" placeholder="Nhập email" required="" name="email" value="'+ response.hoa_don.email +'" onfocus="focusemail(this)">'
    						str += '<p class="text-danger" id="validate-email" style="display: none;">Vui lòng nhập email đúng định dạng</p>'
        				str+= '</div>'
        			str+= '</div>'
    			str+= '</div>'

        		str+= '<div class="row">'
        			str+= '<div class="col-md-6">'
        				str+= '<div class="form-group">'
        					str+= '<label>Địa chỉ</label>'
    						str+= '<input type="text" class="form-control" placeholder="Nhập địa chỉ" required="" name="dia_chi" value="'+ response.hoa_don.dia_chi +'" onfocus="focusdia_chi(this)">'
    						str += '<p class="text-danger" id="validate-dia-chi" style="display: none;">Vui lòng nhập địa chỉ</p>'
        				str+= '</div>'
        			str+= '</div>'
        			str+= '<div class="col-md-6">'
        				str+= '<div class="form-group">'
        					str+= '<label>Phí ship</label>'
    						str+= '<input type="number" class="form-control" placeholder="Nhập phí ship" required="" name="phi_ship" value="'+ response.hoa_don.phi_ship +'" onKeyPress="return khongNhapKyTu(event);" onfocus="focusphi_ship(this)">'
    						str += '<p class="text-danger" id="validate-phi-ship" style="display: none;">Vui lòng nhập phí ship đúng định dạng</p>'
        				str+= '</div>'
        			str+= '</div>'
    			str+= '</div>'
        		
        		str+= '<div class="row">'
        			str+= '<div class="col-md-12">'
        				str+= '<div class="form-group">'
        					str+= '<label>Ghi chú</label>'
    						str+= '<textarea class="form-control" placeholder="Nhập ghi chú" style="height: 70px;" name="ghi_chu">'+ response.hoa_don.ghi_chu +'</textarea>'
        				str+= '</div>'
        			str+= '</div>'
    			str+= '</div>'

        		str+= '<div class="row">'
        			str+= '<div class="col-md-6">'
        				str+= '<div class="form-group">'
        					str+= '<button type="button" class="btn btn-primary pull-right" onclick="submitformhoadon('+ index + ')">Lưu lại</button>'
        				str+= '</div>'
    				str+= '</div>'
    				str+= '<div class="col-md-6">'
        				str+= '<div class="form-group">'
        					str+= '<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy bỏ</button>'
        				str+= '</div>'
    				str+= '</div>'
				str+= '</div>'
        		
        		str+= '</form>'

        		str += '</div>'
				str += '</div>'
				str += '</div>'        		
				$('#modalshowedit').html('')
				$('#modalshowedit').html(str)
        		$('#modalshowedit').modal({backdrop: 'static', keyboard: false})

        	} else {
        		Lobibox.notify('error', {
					size: 'mini',
					msg: "Lỗi không lấy được dữ liệu.\nVui lòng thử lại."
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
}

// Thay đổi select-option tỉnh/thành phố 
function changeProvince(id_province){
	$('#validate-province').css('display', 'none')
	if(id_province == ''){
		$('#district').html('<option value="">Chọn quận/huyện</option>')
		$('#ward').html('<option value="">Chọn xã/phường</option>')
	} else {
		$.ajax({
			type: 'GET',
			url: 'quantri/hoadon/changeprovince/' + id_province,
			success: (response) => {
				let str = ''
				if(response.status){
					str += '<option value="">Chọn quận/huyện</option>'
					for (var i = 0; i <  response.districts.length; i++) {
						str += '<option value="'+ response.districts[i].district_id +'">'+ response.districts[i].type + ' ' + response.districts[i].name +'</option>'
					}
					$('#district').html(str)
					$('#ward').html('<option value="">Chọn xã/phường</option>')
				} else {
					Lobibox.notify('error', {
						size: 'mini',
						msg: "Lỗi không lấy được dữ liệu.\nVui lòng thử lại."
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
	}
}

// Thay đổi select-option quận/huyện
function changeDistrict(id_district){
	$('#validate-district').css('display', 'none')
	if(id_district == ''){
		$('#ward').html('<option value="">Chọn xã/phường</option>')
	} else {
		$.ajax({
			type: 'GET',
			url: 'quantri/hoadon/changedistrict/' + id_district,
			success: (response) => {
				let str = ''
				if(response.status){
					str += '<option value="">Chọn xã/phường</option>'
					for (var i = 0; i <  response.wards.length; i++) {
						str += '<option value="'+ response.wards[i].ward_id +'">'+ response.wards[i].type + ' ' + response.wards[i].name +'</option>'
					}
					$('#ward').html(str)
				} else {
					Lobibox.notify('error', {
						size: 'mini',
						msg: "Lỗi không lấy được dữ liệu.\nVui lòng thử lại."
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
	}
}

// Thay đổi select-option xã/phường
function changeWard(id_ward){
	$('#validate-ward').css('display', 'none')
}

// Bắt sự kiện focus input ten_khach_hang
function focusten_khach_hang(input){
	$('#validate-ten-khach-hang').css('display', 'none')
}

// Bắt sự kiện focus input so_dien_thoai
function focusso_dien_thoai(input){
	$('#validate-so-dien-thoai').css('display', 'none')
}

// Bắt sự kiện focus input email
function focusemail(input){
	$('#validate-email').css('display', 'none')
}

// Bắt sự kiện focus input dia_chi
function focusdia_chi(input){
	$('#validate-dia-chi').css('display', 'none')
}

// Bắt sự kiện focus input phi_ship
function focusphi_ship(input){
	$('#validate-phi-ship').css('display', 'none')
}

// Kiểm tra định dạng email
function checkEmail(str){
	return str.trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) != null
}

// Submit form chỉnh sửa hóa đơn
function submitformhoadon(index){
	if($('select[name*=province_id]').val().trim().length == 0){
		$('#validate-province').css('display', 'inline')
		return
	}
	if($('select[name*=district_id]').val().trim().length == 0){
		$('#validate-district').css('display', 'inline')
		return
	}
	if($('select[name*=ward_id]').val().trim().length == 0){
		$('#validate-ward').css('display', 'inline')
		return
	}
	if($('input[name*=dia_chi]').val().trim().length == 0){
		$('#validate-dia-chi').css('display', 'inline')
		return
	}
	if($('input[name*=ten_khach_hang]').val().trim().length == 0){
		$('#validate-ten-khach-hang').css('display', 'inline')
		return
	}
	if($('input[name*=so_dien_thoai]').val().trim().length == 0){
		$('#validate-so-dien-thoai').css('display', 'inline')
		return
	}
	if(!checkEmail($('input[name*=email]').val().trim())){
		$('#validate-email').css('display', 'inline')
		return
	}
	if($('input[name*=phi_ship]').val().trim().length == 0){
		$('#validate-phi-ship').css('display', 'inline')
		return
	} else {
		let regex = /^(0*)[1-9]*[0-9]*$/g;
		if(!regex.test($('input[name*=phi_ship]').val().trim())){
			$('#validate-phi-ship').css('display', 'inline')
			return
		}
	}

	$.ajax({
        type: 'POST',
        url:'quantri/hoadon/chinhsua',
        data: $('#form-hoadon').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (response) => {
        	console.log(response)
            if(response.status){
                Lobibox.notify('success', {
                    size: 'mini',
                    msg: "Chỉnh sửa hóa đơn thành công."
                });
                $('#modalshowedit').modal('hide')
                let thongtin = ''
                thongtin += '<strong>Tên khách hàng: </strong>' + response.hoa_don.ten_khach_hang+ '<br>'
                thongtin += '<strong>Số điện thoại: </strong>' + response.hoa_don.so_dien_thoai + '<br>'
                thongtin += '<strong>Email: </strong>' + response.hoa_don.email + '<br>'
				thongtin += '<strong>Địa chỉ: </strong>' + response.hoa_don.dia_chi + '<br>'
				thongtin += '<strong>' + response.hoa_don.wards_type + ': </strong>' + response.hoa_don.wards_name + '<br>'
				thongtin += '<strong>' + response.hoa_don.districts_type + ': </strong>' + response.hoa_don.districts_name + '<br>'
				thongtin += '<strong>' + response.hoa_don.provinces_type + ': </strong>' + response.hoa_don.provinces_name + '<br>'
                $('#table').bootstrapTable(
					'updateRow', 
					{
						index: index, 
						row: {
							'thong_tin': thongtin,
							'ghi_chu': response.hoa_don.ghi_chu,
							'phi_ship': formatNumberThousand(response.hoa_don.phi_ship) + "₫"
						}
					})
            } else {
                Lobibox.notify('error', {
                    size: 'mini',
                    msg: 'Chỉnh sửa hóa đơn thất bại.'
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
    return false;
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

	// console.log(data)
	$('#table').bootstrapTable('load', {
        data: data
  	})
}

//Xóa hàng loạt
function deleteMulti(){
    let data = $('#table').bootstrapTable('getData')
    let arrID = []
    for(let i = 0; i < data.length; i++){
        if(data[i].state) arrID.push(Number(data[i].id))
    }
    if(arrID.length > 0){
        $.ajax({
            type: 'POST',
            url:'quantri/hoadon/xoanhieu',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                arrID: arrID
            },
            success: function(response){
                console.log(response)
                if(response.status){
                    for(let i = 0; i < arrID.length; i++){
                        $('#table').bootstrapTable('removeByUniqueId', arrID[i])
                    }
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
                    msg: "Lỗi kết nối cơ sở dữ liệu.\nVui lòng thử lại."
                });
            }
        })
    } else {
        Lobibox.notify('warning', {
            size: 'mini',
            msg: "Chọn dữ liệu trước khi xóa hàng loạt."
        });
    }
}

function changeDataForTable(thisselect){
	switch (thisselect.value){
		case '1':
			thisselect.style.backgroundColor = "#2b982b"
			thisselect.style.color = "#fff"
			break
		case '2':
			thisselect.style.backgroundColor = "#ff9600"
			thisselect.style.color = "#fff"
			break
		case '3':
			thisselect.style.backgroundColor = "#795548"
			thisselect.style.color = "#fff"
			break
		case '4':
			thisselect.style.backgroundColor = "#fb483a"
			thisselect.style.color = "#fff"
			break
		default:
			thisselect.style.backgroundColor = "#fff"
			thisselect.style.color = "#000"
	}
	if(thisselect.value == '') {
		$('#table').bootstrapTable('load', datatable.slice())
		return
	}
	let _data = datatable.slice()
	$('#table').bootstrapTable('load', _data)
	let i = 0
	while(i < _data.length){
		let htmlObj = $(_data[i].trang_thai)
		if(thisselect.value == htmlObj[0].value){
			i++
    	} else {    		
    		$('#table').bootstrapTable('removeByUniqueId', _data[i].id)
    	}
	}
}

function refreshPage(){
	Lobibox.notify('error', {
        size: 'mini',
        msg: "Lỗi kết nối cơ sở dữ liệu.\nVui lòng thử lại."
    });
	return location.reload()
}