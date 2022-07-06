<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    function getSalonCity()
    {
        $sql = \DB::select('SELECT CONCAT(cities.name, ": ", salons.name) AS city_salon_name FROM cities LEFT JOIN salons ON cities.id = salons.city_id WHERE salons.status = 1 AND cities.status = 1;');
        return response()->json($sql, 200);
    }

    function getSalonCars()
    {
        $sql = \DB::select('SELECT salons.name, COUNT(stock.id) AS stock_count FROM salons LEFT JOIN stock ON salons.id = stock.salon_id WHERE salons.status = 1 GROUP BY salons.name ORDER BY salons.name');
        return response()->json($sql, 200);
    }

    function getSalonMaxPrice()
    {
        $sql = \DB::select('SELECT DISTINCT salons.id, salons.name, NVL(MAX(stock.price) over(PARTITION BY stock.salon_id), 0) as max_car_price FROM salons LEFT JOIN stock ON salons.id = stock.salon_id');
        return response()->json($sql, 200);
    }

    function getModelColorCount()
    {
        $sql = \DB::select('SELECT DISTINCT models.name AS model_name, colors.name AS color_name, COUNT(*) AS cars_count FROM stock JOIN colors ON colors.id = stock.color_id JOIN models ON models.id = stock.model_id GROUP BY models.name, colors.name HAVING COUNT(*) > 10');
        return response()->json($sql, 200);
    }

    function getSalonOrdered()
    {
        $sql = \DB::select('SELECT salons.name, COUNT(stock.id) AS stock_count FROM salons LEFT JOIN stock ON salons.id = stock.salon_id WHERE salons.status = 1 GROUP BY salons.name ORDER BY CASE WHEN COUNT(stock.id) >= 1 THEN 0 ELSE 1 END, salons.name;');
        return response()->json($sql, 200);
    }
}
