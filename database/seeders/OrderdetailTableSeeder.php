<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrderdetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orderdetail')->insert(array(
            ['order_id'=>1,'id_product'=>1,'t_price'=>11950,'qty'=>1,'status'=>0],
        ));
    }
}
