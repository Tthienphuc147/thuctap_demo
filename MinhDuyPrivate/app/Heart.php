<?php
namespace App;
use App\Heart;
use Session;
class Heart
{
	public $san_phams = null; 
	public function __construct($yeu_thich_hien_tai){
		if($yeu_thich_hien_tai){
			$this->san_phams = $yeu_thich_hien_tai->san_phams; 
		}
	}
	public function themYeuThich($san_pham, $id_san_pham){ 
		$yeu_thich_moi = ['san_pham' => $san_pham];     
		$this->san_phams[$id_san_pham] = $yeu_thich_moi;  
	}
	//xóa 1 sản phẩm 
	public function xoaYeuThich($id){  
		unset($this->san_phams[$id]); 
	} 
}