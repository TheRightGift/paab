<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmailLoginJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request->all();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $loginData = $this->request->validate([
        //     'email' => 'email|required',
        //     'password' => 'required'
        // ]);        

        // if (!auth()->attempt($loginData)) {
        //     return response(['message' => 'Invalid Credentials']);
        // }
        
        // $accessToken = auth()->user()->createToken('accessToken')->accessToken;

        // return ['user' => auth()->user(), 'access_token' => $accessToken];
        logger('email sent!');
        return gettype($this->request);
    }
}
