<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowFormLogin()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertViewIs('admin.login');
        $response->assertSeeText('Đăng nhập');
    }

    public function testLoginWithEmailNull()
    {
        $user = new User();
        $user->name = 'long';
        $user->email = 'long@gmail.com';
        $user->password = Hash::make('1234');
        $user->save();

        $data = [
          'email' => null,
          'password' => '123455'
        ];

        $response = $this->post('admin/login', $data);
        $response->assertStatus(302);

        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertViewIs('admin.login');
        $response->assertSeeText('Tai khoan mat khau khong dung');


    }

    public function testLoginWithPasswordNull()
    {
        $user = new User();
        $user->name = 'long';
        $user->email = 'long@gmail.com';
        $user->password = Hash::make('1234');
        $user->save();

        $data = [
            'email' => 'long@gmail.com',
            'password' => ''
        ];

        $response = $this->post('admin/login', $data);
        $response->assertStatus(302);

        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertViewIs('admin.login');
        $response->assertSeeText('Tai khoan mat khau khong dung');
    }

    public function testLoginWithAccountNotExits()
    {
        $user = new User();
        $user->name = 'long';
        $user->email = 'long@gmail.com';
        $user->password = Hash::make('1234');
        $user->save();

        $data = [
            'email' => 'long@gmail.com',
            'password' => '1213213'
        ];

        $response = $this->post('admin/login', $data);
        $response->assertStatus(302);

        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertViewIs('admin.login');
        $response->assertSeeText('Tai khoan mat khau khong dung');
    }

    public function testLoginSuccess()
    {
        $user = new User();
        $user->name = 'long';
        $user->email = 'long@gmail.com';
        $user->password = Hash::make('1234');
        $user->save();

        $data = [
            'email' => 'long@gmail.com',
            'password' => '1234'
        ];

        $response = $this->post('admin/login', $data);
        $response->assertStatus(302);

        $response = $this->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee($user->name);

    }
}
