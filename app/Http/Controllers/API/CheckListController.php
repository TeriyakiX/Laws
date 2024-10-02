<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckListRequest;
use App\Models\Checklist;
use Google\Rpc\Context\AttributeContext\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckListController extends Controller
{
    public function index()
    {
        $checklist = Checklist::where('user_id', Auth()->id())->get();
        if(empty($checklist))
        {
            return response()->json(['success' => false, 'errors' => 'Список пуст']);
        }
        return response()->json(['success' => true, 'date' => $checklist]);
    }

    public function create(CheckListRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth()->id();
        $data = Checklist::create($data);
        return response()->json(['success' => true, 'date' => $data]);
    }

    public function finished($id)
    {
        $checklist = Checklist::find($id);
        if($checklist['user_id'] != Auth()->id())
        {
            return response()->json(['success' => false, 'date' => 'Не удалось завершить задачу']);
        }
        $checklist['finished'] = 1;
        $checklist->save();
        return response()->json(['success' => true, 'date' => $checklist]);
    }

    public function delete($id)
    {
        $checklist = Checklist::find($id);
        if(empty($checklist))
        {
            return response()->json(['success' => false, 'error' => 'Такого чек листа не существует']);
        }
        if($checklist['user_id'] != Auth()->id())
        {
            return response()->json(['success' => false, 'error' => 'Данный чек лист Вам не принадлежит']);
        }
        $checklist->delete();
        return response()->json(['success' => true]);
    }
}
