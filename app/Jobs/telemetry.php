<?php

namespace App\Jobs;

use App\Models\Device;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class telemetry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param $id
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle($id)
    {
        $deviceId = Device::where('id','=',$id)->get();
        $token = Auth::user()->token;
        $URL = 'http://localhost:8080/api/plugins/telemetry/DEVICE/'.$deviceId[0]->deviceId.'/values/timeseries';
        $client = new Client([
            'headers' => [
                'Content-Type' => ' application/json',
                'X-Authorization' => $token,
            ]
        ]);
        $request = $client->request('GET',$URL);
        $data = $request->getBody()->getContents();
        $response = json_decode($data, true);
        return $response;
    }
}
