<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File, Validator;

class AffiliateController extends Controller
{
    public $curruntLat;
    public $curruntLong;

    public function __construct()
    {
        $this->curruntLat = '53.3340285';
        $this->curruntLong = '-6.2535495';
    }
    
    public function getNearbyAffiliates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'affiliates' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        
        $file = $request->file('affiliates');
        $file_handle = fopen($file->getRealPath(), "rb");
        $affilaiates = [];
        while (!feof($file_handle) ) {
            $affilaiates[] = fgets($file_handle);
        }
        fclose($file_handle);
        
        $result = [];

        foreach ($affilaiates as $key => $value) {
            $data = json_decode($value, true);
            // print_r($data);
            $distance = self::getDistance($data['latitude'], $data['longitude']);
            if ($distance < 100) {
                $result[] = $data;
            }
        }
        usort($result, fn($a, $b) => $a['affiliate_id'] <=> $b['affiliate_id']);
        return redirect()->back()->with('result', $result)->with('success', 'File uploaded successfully');
    }
    
    function getDistance($latitude2, $longitude2) {  
        $latitude1 = $this->curruntLat;
        $longitude1 = $this->curruntLong;
        $earth_radius = 6371;
      
        $dLat = deg2rad($latitude2 - $latitude1);  
        $dLon = deg2rad($longitude2 - $longitude1);  
      
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
        $c = 2 * asin(sqrt($a));  
        $d = $earth_radius * $c;  

        return $d;  
    }
}
