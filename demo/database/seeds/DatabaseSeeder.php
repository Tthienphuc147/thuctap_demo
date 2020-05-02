<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(DanhMucSanPhamsTableSeeder::class);
        $this->call(LoaiSanPhamsTableSeeder::class);
        $this->call(SanPhamsTableSeeder::class);
        $this->call(HinhAnhSanPhamsTableSeeder::class); 
        $this->call(CaiDatSanPhamsTableSeeder::class);  
        $this->call(PhanHoiSanPhamsTableSeeder::class);  
        $this->call(HoaDonsTableSeeder::class);  
        $this->call(ChiTietHoaDonsTableSeeder::class); 
        // $this->call(DistrictsTableSeeder::class);  
        // $this->call(ProvincesTableSeeder::class);  
        // $this->call(WardsTableSeeder::class);  
        $this->call(DanhMucTinTucTableSeeder::class);  
        $this->call(LoaiTinTucTableSeeder::class);
        $this->call(TinTucTableSeeder::class);
        $this->call(CaiDatTinTucsTableSeeder::class);
        $this->call(DanhMucDichVusTableSeeder::class);
        $this->call(LoaiDichVusTableSeeder::class);
        $this->call(DichVusTableSeeder::class);
        $this->call(CaiDatDichVusTableSeeder::class);
        $this->call(CaiDatTrangChusTableSeeder::class);
        $this->call(HoTrosTableSeeder::class);
        $this->call(GiaiDapThacMacsTableSeeder::class);
    }
}
