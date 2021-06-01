<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LimitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit_names = [
            '今日中',
            '明日中',
            '今週中',
            '今月中',
            '未定',
        ];

        $now = Carbon::now();
        foreach ($limit_names as $limit_name) {
            $limit_info = [
                'name' => $limit_name,
                'created_at' => $now,
                'updated_at' => $now,
            ];
            DB::table('limits')->insert($limit_info);
        }
    }
}
