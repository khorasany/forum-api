<?php

namespace Tests\Feature\App\Http\Controllers\Api\v1\Channel;

use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllChannels()
    {
        $response = $this->get(route('channel.all'));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testChannelCanBeCreated()
    {
        $response = $this->postJson(route('channel.create'),[
            'name' => 'laravel',
            'slug' => Str::slug('laravel')
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function testChannelShouldBeValidate()
    {
        $response = $this->postJson(route('channel.validate'),[]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testUpdateChannelShouldBeValidate():void
    {
        $response = $this->json('PUT',route('channel.update'),[]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testUpdateChannel():void
    {
        $response = $this->json('PUT',route('channel.update'), [
                'id' => 1,
                'name' => 'laravel 1'
            ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testDeleteChannel():void
    {
        $response = $this->json('DELETE',route('channel.delete'),[
            'id' => 1
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testDeleteChannelShouldBeValidate():void
    {
        $response = $this->json('DELETE',route('channel.delete'),[]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
