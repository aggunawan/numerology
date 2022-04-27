<?php

namespace App\Http\Controllers\Ask;

use App\Http\Controllers\Controller;
use App\Models\CoachingCategory;
use App\Models\CoachingRoom;
use Illuminate\Http\Request;

class AskApiDataContoller extends Controller
{
    public function getDataCategoriesCoaching(){
        $data = CoachingCategory::all();
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function createRoom(Request $request){
        $req = CoachingRoom::create($request->all());

        return response()->json([
            'success' => true,
            'messages' => "Data created successfully!"
        ]);
    }
}
