<?php

namespace App\Http\Controllers\Api\v1\Channel;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Repository\ChannelRepository;
use Database\Factories\ChannelFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChannelController extends Controller
{
    public function getAllChannels()
    {
        $allChannels = resolve(ChannelRepository::class)->allChannels();
        return response()->json($allChannels,Response::HTTP_OK);
    }

    public function createNewChannel(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        resolve(ChannelRepository::class)->create($request);

        return response()->json([
            'message' => 'new channel created successfully'
        ],Response::HTTP_CREATED);
    }

    public function editChannel(Request $request)
    {
        $request->validate([
           'id' => ['required'],
            'name' => ['required']
        ]);

        resolve(ChannelRepository::class)->edit($request);

        return response()->json([
            'message' => 'channel id '.$request->id.' has been updated'
        ],Response::HTTP_OK);

    }

    public function deleteChannel(Request $request)
    {
        $request->validate([
            'id' => ['required']
        ]);

        resolve(ChannelRepository::class)->deleteChannel($request);

        return response()->json([
            'message' => 'request for delete channel id '.$request->id.' has been success'
        ],Response::HTTP_OK);
    }
}
