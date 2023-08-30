<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;

class Com_SerController extends Controller
{
    public function addCommunityToService(Request $request, $serviceId)
    {
        $service = Services::findOrFail($serviceId);
        $communityId = $request->input('com_id');

        // Attach the single community to the service
        $service->Comunities()->attach($communityId);

        return response()->json("Community Added to Service", 200);
    }
}
