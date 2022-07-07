<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalonsModel;
use App\Models\CitiesModel;

class SalonController extends Controller
{
    function salonsCity($id)
    {
        $salon = SalonsModel::select('id', 'name')->where('city_id', $id)->where('status', 1)->get();
        $citiesCheck = CitiesModel::where('id', $id)->where('status', 1)->get();
        if ($citiesCheck->count() == 0)
            return response()->json(['status' => 'Данный город не найден'], 404);
        if ($salon->count() == 0)
            return response()->json(['status' => 'В данном городе нет салонов'], 404);
        return response()->json($salon, 200);
    }

    function salonsCityInfo($cid, $sid)
    {
        $salon = SalonsModel::select('id', 'name')->where('city_id', $cid)->where('id', $sid)->where('status', 1)->get();
        $city = CitiesModel::where('id', $cid)->where('status', 1)->get();
        if ($city->count() == 0)
            return response()->json(['status' => 'Данный город не найден'], 404);
        if ($salon->count() == 0)
            return response()->json(['status' => 'Данный салон не найден'], 404);
        $salon[0]->city = array('id' => $city[0]->id, 'name' => $city[0]->name);
        return response()->json($salon, 200);
    }

    function addSalon($id, Request $request)
    {
        $citiesCheck = CitiesModel::where('id', $id)->where('status', 1)->get();
        $salon = new SalonsModel;
        if ($citiesCheck->count() == 0)
            return response()->json(['status' => 'Данный город не найден'], 404);
        if ($request->name == '')
            return response()->json(['status' => 'Необходимо дать название салону'], 400);
        if ($salon->where('name', $request->name)->get()->count() == '1')
            return response()->json(['status' => 'Салон с таким названием уже существует'], 409);
        $salon->name = $request->name;
        $salon->city_id = $id;
        $salon->save();
        return response()->json($salon, 201);
    }

    function updateSalon($cid, $sid, Request $request)
    {
        $citiesCheck = CitiesModel::where('id', $cid)->where('status', 1)->get();
        if ($citiesCheck->count() == 0)
            return response()->json(['status' => 'Данный город не найден'], 404);
        $salon = SalonsModel::where('city_id', $cid)->where('id', $sid)->where('status', 1)->get();
        $salonCheck = SalonsModel::where('name', $request->name)->where('status', 1)->get();
        if ($salon->count() == 0)
            return response()->json(['status' => 'Данный салон не найден'], 404);
        if ($request->name == '')
            return response()->json(['status' => 'Необходимо дать название салону'], 400);
        if ($salonCheck->count() != 0 && $salonCheck[0]->id != $sid && $request->name == $salonCheck[0]->name)
            return response()->json(['status' => 'Салон с таким названием уже существует'], 409);
        $salon[0]->update($request->all());
        return response()->json($salon, 200);
    }

    function deleteSalon($cid, $sid)
    {
        $citiesCheck = CitiesModel::where('id', $cid)->where('status', 1)->get();
        if ($citiesCheck->count() == 0)
            return response()->json(['status' => 'Данный город не найден'], 404);
        $salon = SalonsModel::where('city_id', $cid)->where('status', 1)->where('id', $sid)->get();
        if ($salon->count() == 0)
            return response()->json(['status' => 'Данный салон не найден'], 404);
        $salon[0]->update(['status' => 0]);
        return response()->json($salon, 200);
    }
}
