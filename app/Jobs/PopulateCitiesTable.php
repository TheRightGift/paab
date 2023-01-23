<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\City;

class PopulateCitiesTable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id;
    private $name;
    private $state_id;
    private $state_code;
    private $country_id;
    private $country_code;
    private $latitude;
    private $longitude;
    private $flag;
    private $wikiDataId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $name, $state_id, $state_code, $country_id, $country_code, $latitude, $longitude, $flag, $wikiDataId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->state_id = $state_id;
        $this->state_code = $state_code;
        $this->country_id = $country_id;
        $this->country_code = $country_code;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->flag = $flag;
        $this->wikiDataId = $wikiDataId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $input = $request->all();
        // $city = City::create($input);

        // return response(['city' => $city, 'message' => 'Created Success'], 201);

        $cityExist = City::where('id', $this->id)->first();
        if($cityExist == null || $cityExist->count() < 1){
            $reqArr = [];
            $reqArr['id'] = $this->id;
            $reqArr['name'] = $this->name;
            $reqArr['state_id'] = $this->state_id;
            $reqArr['state_code'] = $this->state_code;
            $reqArr['country_id'] = $this->country_id;
            $reqArr['country_code'] = $this->country_code;
            $reqArr['latitude'] = $this->latitude;
            $reqArr['longitude'] = $this->longitude;
            $reqArr['flag'] = $this->flag;
            $reqArr['wikiDataId'] = $this->wikiDataId;
    
            $city = City::create($reqArr);
        } 
    }
}
