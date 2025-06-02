<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // ← これを追加！

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // IDが1のユーザーを取得
        $user = User::find(1);

        // ユーザーが存在する場合のみ bio を更新
        if ($user) {
            $user->update([
                'bio' => 'これはID1のユーザーのプロフィールです！',
            ]);
        }
    }
}
