<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert(array(
            [
                'name' => 'อะไหล่',
                'created_at' => new Carbon('2022-10-20 12:00:00'),
                'updated_at' => new Carbon('2022-10-20 12:00:00'),
            ],[
                'name' => 'เครื่องแต่งกาย',
                'created_at' => new Carbon('2022-10-20 12:00:00'),
                'updated_at' => new Carbon('2022-10-20 12:00:00'),
            ],[
                'name' => 'รองเท้า',
                'created_at' => new Carbon('2022-10-20 12:00:00'),
                'updated_at' => new Carbon('2022-10-20 12:00:00'),
            ],
        ));
    }
}
