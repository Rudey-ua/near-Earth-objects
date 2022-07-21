<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\NearEarthObject;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DefaultController extends Controller
{
    public function index()
    {
        // First task
        return response()->json([
            'hello' => 'MacPaw Internship 2022!',
        ]);
    }

    //Third task
    public function getDangerAsteroids()
    {
        $dangerAsteroids = NearEarthObject::where('is_hazardous', 1)->get();

        return response()->json($dangerAsteroids, 200);
    }

    //Fourth task
    public function getFastestAsteroids(Request $request)
    {
        $statement = $request->get('hazardous', "false");

        if($statement == "false"){
            $result = NearEarthObject::where('is_hazardous', 0)
                ->orderBy('speed', 'desc')
                ->get();
            return response()->json($result, 200);
        }
        elseif($statement == "true") {
            $result = NearEarthObject::where('is_hazardous', 1)
                ->orderBy('speed', 'desc')
                ->get();

            return response()->json($result, 200);
        }
    }

    // Extra task
    public function store()
    {
        // Delete old data before adding new ones
        DB::table('near_earth_objects')->truncate();

        // Get data
        $data = DefaultController::getData();

        // Store the data
        foreach ($data as $item) {
            foreach ($item as $asteroid){
                NearEarthObject::create([
                    'name' => $asteroid['name'],
                    'referenced' => $asteroid['neo_reference_id'],
                    'speed' => (int)$asteroid['close_approach_data'][0]['relative_velocity']['kilometers_per_hour'],
                    'is_hazardous' => $asteroid['is_potentially_hazardous_asteroid'],
                    'Date' => $asteroid['close_approach_data'][0]['close_approach_date']
                ]);
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'Data saved to DB'
        ])->setStatusCode(201);
    }
    // Get data from API
    private function getData(){
        $key = env('NASA_SECRET_KEY');
        $date = DefaultController::getDate();
        $url = 'https://api.nasa.gov/neo/rest/v1/feed?start_date='.$date['from'].'&end_date='.$date['to'].'&api_key='.$key;
        return json_decode(file_get_contents($url), true)['near_earth_objects'];
    }

    //Get date
    private function getDate(){
        $to = date("Y-m-d");
        $from = date('Y-m-d', strtotime('-2 days'));
        return ['to' => $to, 'from' => $from];
    }
}

