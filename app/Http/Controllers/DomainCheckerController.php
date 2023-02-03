<?php

namespace App\Http\Controllers;
use Iodev\Whois\Factory;
use Illuminate\Http\Request;

class DomainCheckerController extends Controller
{
    public function check(Request $request)
    {
        // dd(gettype($request->domain), $request->domain);
        $whois = Factory::get()->createWhois();
        try {
            //code...
            $data = json_decode($request->domain);
            $domain = $request->domain;
            if ($data != null) {
                $newData = [];
                foreach ($data as $key => $value) {
                    $response = $whois->lookupDomain($value->name);
                    if (strpos($response->text, 'No match for') !== false) {
                        array_push($newData, ['name' => $value->name, 'availability' => 1]);
                    }
                }
                return response()->json(['available' => $newData, 'status' => 200]);
            }else if (!empty($domain)) {
                $response = $whois->lookupDomain($domain);
                if (strpos($response->text, 'No match for') !== false) {
                    return response()->json(['message' => "The domain available", 'status' => 1]);
                }
                return response()->json(['message' => "The domain is not available", 'status' => 0]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
