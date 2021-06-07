<?php

namespace Tests\Feature\App\Http\Controllers\Api\v1\Channel;

use App\Models\Channel;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllChannels():void
    {
        $response = $this->get(route('channel.all'));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testChannelCanBeCreated():void
    {
        $channel = Channel::factory()->create();
        $response = $this->postJson(route('channel.create'),[
            'name' => $channel->name,
            'slug' => Str::slug($channel->name)
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function testChannelShouldBeValidate():void
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
        $channel = Channel::factory()->create();
        $response = $this->json('PUT',route('channel.update'), [
                'id' => $channel->id,
                'name' => $channel->name
            ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testDeleteChannel():void
    {
        $channel = Channel::factory()->create();
        $response = $this->json('DELETE',route('channel.delete'),[
            'id' => $channel->id
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testDeleteChannelShouldBeValidate():void
    {
        $response = $this->json('DELETE',route('channel.delete'),[]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
