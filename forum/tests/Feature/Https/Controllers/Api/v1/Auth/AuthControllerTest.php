<?php

namespace Tests\Feature\App\Http\Controllers\Api\v1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test register user
     */
    public function testRegisterShouldBeValidate()
    {
        $response = $this->postJson(route('auth.register'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testRegisterCanBeRegister()
    {
        $response = $this->postJson(route('auth.register'),[
            'name'      => 'alireza',
            'email'     => 'a.khorasany@gmail.com',
            'password'  => 'adygcy8b'
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * Test Login user
     */

    public function testLoginUserShouldBeValidated()
    {
        $response = $this->postJson(route('auth.login'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testRegisterUserCanBeValidated()
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('auth.login'),[
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testShowUserInfoIfLoggedIn()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('auth.user'));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testUserCanLogout()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('auth.logout'));

        $response->assertStatus(Response::HTTP_OK);
    }
}
