<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalonsModel;

class SalonController extends Controller
{
    function readSalon($id)
    {
        $salon = SalonsModel::where('id', $id)->get();
        if ($salon[0]->status == 0)
            return response()->json(['status' => 'Данный салон не работает'], 200);
        if ($salon->count() == 0)
            return response()->json(['status' => 'Данный салон не найден'], 200);
        return response()->json($salon, 200);
    }

    function createSalon(Request $request)
    {
        $salon = new SalonsModel;
        if ($salon->where('name', $request->name)->get()->count() == '1')
            return response()->json(['status' => 'Салон с таким названием уже существует'], 300);
        $salon->name = $request->name;
        $salon->city_id = $request->city_id;
        $salon->status = $request->status;
        $salon->save();
        return response()->json(['id' => $salon->id], 200);
    }
}
