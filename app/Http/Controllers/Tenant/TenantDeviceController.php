<?php

namespace App\Http\Controllers\Tenant;

use App\Classes\HelperClass;
use App\Http\Controllers\Controller;
use App\Jobs\telemetry;
use App\Models\Device;
use App\Screen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TenantDeviceController extends Controller
{
    public function index()
    {
        return view('admin.device.create');
    }

    public function service()
    {
        return view('admin.device.service');
    }

    public function create(Request $request)
    {
        $string = '';
        $request = $request->input();
        $name = $request['name']; /////required
        $type = $request['type'];/////required
        $label = $request['label'];//// required
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
                "label" => $label/// requird
            ]]);
            $data = $request->getBody()->getContents();
            $responses = json_decode($data, true);
            $deviceId = $responses['id']['id'];
            $string = $deviceId;
            $URL = 'http://localhost:8080/api/device/' . $string . '/credentials';
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Authorization' => $token
                ]
            ]);
            $request = $client->request('GET', $URL);
            $data = $request->getBody()->getContents();
            $response = json_decode($data, true);
            $device = new Device();
            $device->name = $name;
            $device->type = $type;
            $device->label = $label;
            $device->tenantId = $responses['tenantId']['id'];
            $device->deviceId = $responses['id']['id'];
            $device->credentialsType = $response['credentialsType'];
            $device->credentialsId = $response['credentialsId'];
            $device->save();
            return redirect()->route('createDevice')->with('success', 'successfully');
        } else {
            return view('404');
        }
    }

    public function store(Request $request)
    {
        $string = '';
        $token = Auth::user()->token;;
        if ($request->input('edit')) {
            $deviceId = $request->input('edit');
            $devices = DB::table('devices')->select('*')->where('deviceId', '=', $deviceId)->get();
            $customers = DB::table('customers')->select('*')->get();
            return view('admin.device.edit', compact('devices', 'customers'));
        } else {
            if ($request->input('assign')) {
                $deviceId = $request->input('assign');
                $screens = DB::table('screens')->select('*')->where('available', '=', true)->get();
                $devices = DB::table('devices')->select('name')->where('deviceId', '=', $deviceId)->get();
                return view('admin.device.assign', compact('devices', 'screens'));

            }
            $deviceName = $request->input('delete');
            $deviceId = DB::table('devices')->select('deviceId')->where('name', '=', $deviceName)->first();
            foreach ($deviceId as $value) {
                $deviceId = $value;
            }
            $array = json_decode(json_encode($deviceId), true);
            $string = $array;
            echo $string;
            $URL = 'http://localhost:8080/api/device/' . $string;
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Authorization' => $token
                ]
            ]);
            $request = $client->request('DELETE', $URL);
            $data = $request->getBody()->getContents();
            $response = json_decode($data, true);
            DB::table('devices')->where('deviceId', '=', $deviceId)->delete();
            DB::table('screens')->where('deviceId', '=', $deviceId)->update(['available' => true, 'customerId' => null]);
            return redirect()->route('showDevices');
        }
    }

    public function show()
    {
        $string = '';
        $user = Auth::user()->id;
        $array = array();
        if ($user == 1) {
            $devices = Device::get();
            $screenId = Device::get('screenId');
            foreach ($screenId as $id) {
                $screens = DB::table('screens')->select('*')->where('id', '=', $id->screenId)->get();
                array_push($array, $screens);
            }
            return view('admin.device.show', compact('devices', 'array'));

        } else {
            $userId = DB::table('users')->select('customerId')->where('id', '=', $user)->get();
            $array = json_decode(json_encode($userId), true);
            foreach ($array as $id) {
                $string = $id;
            }
            $devices = DB::table('devices')->select('*')->where('customerId', '=', $string['customerId'])->get();
            return view('admin.device.show', compact('devices'));
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'customer' => 'required',
            'submit' => 'required'
        ]);
        $string = '';
        $string2 = '';
        $customers = $request->input('customer');
        $deviceId = $request->input('submit');
        $string = $customers[0];
        $string2 = $deviceId;
        $token = Auth::user()->token;
        $URL = 'http://localhost:8080/api/customer/' . $string . '/device/' . $string2;
        $client = new Client([
            'headers' => [
                'Content-Type' => ' application/json',
                'X-Authorization' => $token,
            ]
        ]);
        $request = $client->post($URL);
        $data = $request->getBody()->getContents();
        $response = json_decode($data, true);
        DB::table('devices')->select('deviceId')->where('deviceId', '=', $deviceId)->update([
            'available' => false,
            'customerId' => $string
        ]);
        return redirect()->route('showDevices')->with('success', 'successfully');
    }

    public function showTelemetry($id)
    {
        return view('admin.device.telemetry')->with('id', $id);
    }

    public function getTelemetryData($id)
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
