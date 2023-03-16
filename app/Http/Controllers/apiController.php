<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function seedDB()
    {
        DB::table('api_user')->insert([
            'name' => 'admin',
            'password' => bcrypt('123456'),
            'email' => 'adminApi@gmail.com',
            'api_token' => API_TOKEN_ADMIN,
        ]);

        echo "thanh cong";
    }
}
