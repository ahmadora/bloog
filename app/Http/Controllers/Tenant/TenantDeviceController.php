<?php

namespace App\Http\Controllers\Tenant;

use App\Classes\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\Device;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Version;
use Symfony\Component\Console\Input\Input;

class TenantDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.device.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(Request $request)
    {
        $string = '';
        $request = $request->input();
//        dd($request);
        $name = $request['name']; /////required
        $type = $request['type'];/////required
        $label=$request['label'];//// required
        $email = Auth::user()->email;
        $token = Auth::user()->token;
        $password = Auth::user()->getAuthPassword();
        $help = new HelperClass($email, $password, $token);
        if ($help->isTenant()) {
            $URL = 'http://localhost:8080/api/device';
            $client = new Client([
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => ' application/json',
                    'X-Authorization' => $token,
                ]
            ]);
            $request = $client->post($URL, ['json' => [
                "name" => $name, /////requierd
                "type" => $type,/////requird
                "label"=>$label/// requird
            ]]);
            $data = $request->getBody()->getContents();
            $responses = json_decode($data, true);
            $deviceId = $responses['id']['id'];
            $string = $deviceId;
            $URL = 'http://localhost:8080/api/device/'.$string.'/credentials';
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Authorization'=>$token
                ]
            ]);
            $request = $client->request('GET',$URL);
            $data = $request->getBody()->getContents();
            $response =json_decode($data,true);
            $device = new Device();
            $device->name = $name;
            $device->type = $type;
            $device->label = $label;
            $device->tenantId = $responses['tenantId']['id'];
            $device->deviceId =$responses['id']['id'];
            $device->credentialsType = $response['credentialsType'];
            $device->credentialsId = $response['credentialsId'];
            $device->save();
            echo  'done';

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $string = '';
        $token = Auth::user()->token;
//        $request = $request->input();
        if ($request->input('edit')){
            $deviceId = $request->input('edit');
                $devices = DB::table('devices')->select('*')->where('deviceId','=',$deviceId)->get();
                $customers = DB::table('customers')->select('*')->get();
//                dd($customers);
                return view('admin.device.edit',compact('devices','customers'));
        }else{
            $deviceName = $request->input('delete');
            $deviceId = DB::table('devices')->select('deviceId')->where('name','=',$deviceName)->first();
            foreach ($deviceId as $value){$deviceId=$value;}
            $array = json_decode(json_encode($deviceId),true);
            $string = $array;
            echo $string;
            $URL = 'http://localhost:8080/api/device/'.$string;
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Authorization'=>$token
                ]
            ]);
            $request = $client->request('DELETE',$URL);
            $data = $request->getStatusCode();///200
            DB::table('devices')->where('deviceId','=',$deviceId)->delete();
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $devices = DB::table('devices')->select('*')->where('available','=',true)->get();
        return  view('admin.device.show',compact('devices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $string = '';  $string2 = '';
        $customers = $request->input('customer');
        $deviceId = $request->input('submit');
        foreach ($customers as $value){
            $customer = $value;
            $string = $value;
        }
        $string2 = $deviceId;
        $token = Auth::user()->token;
        $URL = 'http://localhost:8080/api/customer/'.$string.'/device/'.$string2;
        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
                'X-Authorization' => $token,
            ]
        ]);
        $request = $client->post($URL);
        $data = $request->getBody()->getContents();
        $responses = json_decode($data, true);
        DB::table('devices')->select('deviceId')->where('deviceId','=',$deviceId)->update([
           'available'=>false,
           'customerId'=>$value
        ]);
        dd($responses);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
