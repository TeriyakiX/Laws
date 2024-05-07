<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramRequest;
use App\Http\Resources\ProgramResource;
use App\Models\Program;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends BaseController
{
    public function index(Request $request)
    {
        $programs = Program::all();
        return $this->sendResponse(ProgramResource::collection($programs), 'Successfully.');
    }

    public function create(ProgramRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $program = Program::create($data);
        return $this->sendResponse(ProgramResource::make($program), 'Successfully.');
    }


    public function update($id, ProgramRequest $request)
    {
        $program = Program::findOrFail($id);
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $program->update($data);
        return $this->sendResponse(ProgramResource::make($program), 'Successfully.');
    }

    public function delete($id)
    {
        $program = Program::findOrFail($id);
        $program->delete();
        return $this->sendResponse('Deleted', 'Successfully.');
    }

}
