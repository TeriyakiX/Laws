<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;

use App\Http\Requests\IntensionRequest;
use App\Http\Resources\IntensionResource;
use App\Models\Intensions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntensionController extends BaseController
{
    public function index(Request $request)
    {
        $user = $request->user();
        $intensions = Intensions::where('user_id', $user->id)->get();
        return $this->sendResponse(IntensionResource::collection($intensions), 'Successfully.');
    }

    public function create(IntensionRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $intension = Intensions::create($data);
        return $this->sendResponse(IntensionResource::make($intension), 'Successfully.');
    }


    public function update($id, IntensionRequest $request): \Illuminate\Http\Response
    {
        $intension = Intensions::findOrFail($id);
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $intension->update($data);
        return $this->sendResponse(IntensionResource::make($intension), 'Successfully.');
    }

    public function delete($id): \Illuminate\Http\Response
    {
        $intension = Intensions::findOrFail($id);
        $intension->delete();
        return $this->sendResponse('Deleted', 'Successfully.');
    }

}
