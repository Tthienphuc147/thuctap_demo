<?php
namespace App;
use App\Cart;
use Session;
use DB, Exception;
class Cart
{
	public $san_phams = null;
	public $tong_so_luong = 0;
	public $tong_gia = 0;
	public function __construct($gio_hang_hien_tai){
		if($gio_hang_hien_tai){
			$this->san_phams = $gio_hang_hien_tai->san_phams;
			$this->tong_so_luong = $gio_hang_hien_tai->tong_so_luong;
			$this->tong_gia = $gio_hang_hien_tai->tong_gia;
		}
	}
	public function themGioHang($san_pham, $id_san_pham){
		$gio_hang_moi = ['so_luong' => 0, 'gia_ban' => $san_pham->gia_ban, 'san_pham' => $san_pham];
		if($this->san_phams){
			if(array_key_exists($id_san_pham, $this->san_phams)){
				$gio_hang_moi = $this->san_phams[$id_san_pham];
			}
		}
		$gio_hang_moi['so_luong']++;
		$gio_hang_moi['gia_ban'] = $san_pham->gia_ban * $gio_hang_moi['so_luong'];
		$this->san_phams[$id_san_pham] = $gio_hang_moi;
		$this->tong_so_luong++;
		$this->tong_gia += $san_pham->gia_ban;
	}
	//xóa 1 sản phẩm
	public function xoaTungSanPham($id){
        $san_pham1 = DB::table('san_phams')->where('id','=',$id)->first();
        $so_luong_hien_tai = $san_pham1->so_luong;
            $so_luong_con_lai = $so_luong_hien_tai +1;
            $san_pham1 = DB::table('san_phams')->where('id','=',$id)->update(
                [
                    'so_luong' => $so_luong_con_lai
                ]
        );
		$this->san_phams[$id]['so_luong']--;
		$this->tong_so_luong--;
		$this->tong_gia -= $this->san_phams[$id]['san_pham']->gia_ban;
		if($this->san_phams[$id]['so_luong'] <= 0){
			unset($this->san_phams[$id]);
		}
	}
	// thêm hàng có số lượng
	public function themCoSoLuong($san_pham, $id_san_pham, $so_luong){
		$gio_hang_moi = ['so_luong' => 0, 'gia_ban' => $san_pham->gia_ban, 'san_pham' => $san_pham];
		if($this->san_phams){
			if(array_key_exists($id_san_pham, $this->san_phams)){
				$gio_hang_moi = $this->san_phams[$id_san_pham];
			}
		}
		$gio_hang_moi['so_luong'] += $so_luong;
		$gio_hang_moi['gia_ban'] = $san_pham->gia_ban * $gio_hang_moi['so_luong'];
		$tinh_tien = $san_pham->gia_ban * $so_luong;
		$this->san_phams[$id_san_pham] = $gio_hang_moi;
		$this->tong_so_luong += $so_luong;
		$this->tong_gia += $tinh_tien;
	}

	//xóa nhiều
	public function xoaHetMotSanPham($id){
		$this->tong_so_luong -= $this->san_phams[$id]['so_luong'];
		$this->tong_gia -= $this->san_phams[$id]['gia_ban'];
		unset($this->san_phams[$id]);
	}
	// sửa số lượng cho giỏ hàng
	public function suaSoLuong($san_pham, $id_san_pham, $so_luong){
		$this->tong_so_luong -= $this->san_phams[$id_san_pham]['so_luong'];
		$this->tong_gia -= $this->san_phams[$id_san_pham]['gia_ban'];

		$this->san_phams[$id_san_pham]['so_luong'] = $so_luong;
		$this->san_phams[$id_san_pham]['gia_ban'] = $san_pham->gia_ban * $so_luong;

		$this->tong_so_luong += $so_luong;
		$this->tong_gia += $this->san_phams[$id_san_pham]['gia_ban'];
	}
}
