<?php

namespace App\Http\Controllers;

use Iodev\Whois\Factory;
use Iodev\Whois\Modules\Tld\TldServer;
use Illuminate\Http\Request;

class DomainCheckerController extends Controller
{
    public function check(Request $request)
    {
        // return gettype($request->domain);
        $whois = Factory::get()->createWhois();
        try {
            $data = json_decode($request->domain);
            $domain = $request->domain;

            if ($data != null) {
                $newData = [];
                foreach ($data as $key => $value) {
                    if ($whois->isDomainAvailable($value->name)) {
                        array_push($newData, ['name' => $value->name, 'availability' => 1]);
                    }
                }
                return response()->json(['available' => $newData, 'status' => 200]);
            } elseif (!empty($domain)) {
                if ($whois->isDomainAvailable($domain)) {
                    return response()->json(['message' => "The domain available", 'status' => 1]);
                }
                return response()->json(['message' => "The domain is not available", 'status' => 0]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}