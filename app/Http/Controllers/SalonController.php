<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalonsModel;
use App\Models\CitiesModel;

class SalonController extends Controller
{
    function readSalon($id)
    {
        $salon = SalonsModel::where('id', $id)->get();
        if ($salon[0]->status == 0)
            return response()->json(['status' => 'Данный салон не работает'], 200);
        if ($salon->count() == 0)
            return response()->json(['status' => 'Данный салон не найден'], 404);
        return response()->json($salon, 200);
    }

    function createSalon(Request $request)
    {
        $salon = new SalonsModel;
        if ($salon->where('name', $request->name)->get()->count() == '1')
            return response()->json(['status' => 'Салон с таким названием уже существует'], 409);
        $salon->name = $request->name;
        $salon->city_id = $request->city_id;
        $salon->status = $request->status;
        $salon->save();
        return response()->json(['id' => $salon->id], 201);
    }

    function updateSalon(Request $request)
    {
        $salon = SalonsModel::where('id', $request->id)->get()->first();
        $salonCheck = SalonsModel::where('name', $request->name)->get();
        if ($salon->count() == 0) {
            return response()->json(['status' => 'Данный салон не найден'], 404);
        }
        if ($salonCheck[0]->id != $request->id && $salonCheck->count() != 0 && $request->name == $salonCheck[0]->name) {
            return response()->json(['status' => 'Салон с таким названием уже существует'], 409);
        }
        if ($request->name == '') {
            return response()->json(['status' => 'Необходимо дать название салону'], 400);
        }
        if ($salon->count() != 0) {
            $salon->update($request->all());
        }
        return response()->json($salon, 200);
    }

    function deleteSalon($id)
    {
        $salon = SalonsModel::where('id', $id)->get()[0];
        if ($salon->count() == 0) {
            return response()->json(['status' => 'Данный салон не найден'], 404);
        }
        if ($salon->status == 0)
            return response()->json(['status' => 'Данный салон уже удалён'], 410);
        $salon->update(['status' => 0]);
        return response()->json($salon, 200);
    }
}
