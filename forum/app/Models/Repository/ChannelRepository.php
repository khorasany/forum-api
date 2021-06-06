<?php


namespace App\Models\Repository;


use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelRepository
{
    /**
     * Create new channel
     * @Method POST
     * @param Request $request
     */
    public function create(Request $request): void
    {
        Channel::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug)
        ]);
    }

    public function edit(Request $request):void
    {
        Channel::find($request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
    }

    public function allChannels()
    {
        return Channel::all();
    }

    public function deleteChannel(Request $request):void
    {
//        Channel::find($request->id)->delete();
        // or use destroy method for lower usage server resources
        Channel::destroy($request->id);
    }

}
