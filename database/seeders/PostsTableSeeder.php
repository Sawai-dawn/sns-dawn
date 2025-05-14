<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追記(1)

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 追記(2)： 以下を追加します
        DB::table('posts')->insert([
            [
                'user_id' => 1,
                'post' => '1つ目の投稿になります',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
