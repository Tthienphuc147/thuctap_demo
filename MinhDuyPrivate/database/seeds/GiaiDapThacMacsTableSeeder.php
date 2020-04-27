<?php

use Illuminate\Database\Seeder;

class GiaiDapThacMacsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         for ($i=1; $i <= 5; $i++) { 
             DB::table('giai_dap_thac_macs')->insert([
                'cau_hoi' => 'Câu hỏi ' . $i,
                'tra_loi' => 'Câu trả lời ' . $i,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
