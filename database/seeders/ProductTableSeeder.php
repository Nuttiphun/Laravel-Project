<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert( array(
            [
                'code' => 'P001',
                'name' => 'เสือหมอบ JAVA', 
                'category_id' => 1,
                'price' => 11900,
                'stock_qty' => 2,
                'created_at' => new Carbon('2022-10-20 12:00:00'),
                'updated_at' => new Carbon('2022-10-20 12:00:00'),
            ],[
                'code' => 'P002',
                'name' => 'เสือหมอบ วินเทจ Cannello Silvia', 
                'category_id' => 1,
                'price' => 5000,
                'stock_qty' => 4,
                'created_at' => new Carbon('2022-10-20 12:00:00'),
                'updated_at' => new Carbon('2022-10-20 12:00:00'),
            ],[
                'code' => 'P003',
                'name' => 'เสือหมอบ Panther March', 
                'category_id' => 1,
                'price' => 6500,
                'stock_qty' => 2,
                'created_at' => new Carbon('2022-10-20 12:00:00'),
                'updated_at' => new Carbon('2022-10-20 12:00:00'),
            ],[
                'code' => 'P004',
                'name' => 'ร้องเท้า Nike',
                'price' => '2000',
                'category_id' => 3,
                'stock_qty' => 10,
                'created_at' => new Carbon('2022-10-20 12:00:00'),
                'updated_at' => new Carbon('2022-10-20 12:00:00'),
            ]
        ));
    }
}
