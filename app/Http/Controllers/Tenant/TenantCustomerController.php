<?php

namespace App\Http\Controllers\Tenant;

use App\Classes\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\Device;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TenantCustomerController extends Controller
{
    public function saveNewUser(Request $request)
    {
        $email = Auth::user()->email;
        $token = Auth::user()->token;
        $password = Auth::user()->getAuthPassword();
        $URL = "http://localhost:8080/api/user?sendActivationMail=false";
        $help = new HelperClass($email, $password, $token);
        if (Auth::user()->id == 1) {
            $customerIds = $request->input('customer');
            $emails = $request->input('email');
            $users = DB::table('users')->select('*')->where('email', '=', $request->input('email')[0])->get();
            foreach ($customerIds as $customerId) {
                if ($customerId != null) {
                    $id = $customerId;
                }
            }
            $client = new Client([
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => ' application/json',
                    'X-Authorization' => $token,]]);
            $request = $client->post($URL, ['json' => [
                "authority" => "CUSTOMER_USER",
                "name" => $users[0]->name, /////requierd
                "email" => $users[0]->email,/////requird
                "customerId" => [
                    "entityType" => "CUSTOMER",
                    "id" => $id /////required
                ],////required
            ]]);
            $data = $request->getBody()->getContents();
            $responses = json_decode($data, true);
            DB::table('users')->where('email', '=', $users[0]->email)->update([
                'isCustomer' => true,
                'userId' => $responses['id']['id'],
                'customerId' => $responses['customerId']['id']
            ]);
            $userEmail = $responses['email'];
            $userIds = DB::table('users')->select('userId')->where('email', '=', $responses['email'])->get('userId');
            $string = '';
            $string = $userIds[0]->userId;
            $URL = "http://localhost:8080/api/user/" . $string . "/activationLink";/////requierd
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Authorization' => $token
                ]
            ]);
            $request = $client->request('GET', $URL);
            $data = $request->getBody()->getContents();
            $activationLink = substr($data, -30, 30);
            $activeLink = DB::table('users')->where('email', '=', $userEmail)->update([
                    'activationLink' => $activationLink
            ]);
            return redirect()->back();
        } else {
            return view('404');
        }
    }

    public function index()
    {
        $customers = DB::table('customers')->select('title')->get('title');
        return view('admin.customer.service')->with('customers', $customers);
    }

    public function delete(Request $request)
    {
        $string = '';
        $token = Auth::user()->token;
        $customersId = $request->input('customerId');
        $usersId = $request->input('userId');
        if ($customersId != null) {
            $customerIds = DB::table('customers')->select('customerId')->where('id', '=', $customersId)->get('customerId');
            $str = $customerIds[0]->customerId;

            $URL = 'http://localhost:8080/api/customer/' . $str;
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Authorization' => $token
                ]
            ]);
            $request = $client->request('DELETE', $URL);
            $data = $request->getStatusCode();///200

            DB::table('users')->where('customerId', '=', $str)->update([
                'isCustomer' => false,
                'isActive' => false,
                'customerId' => null,
                'activationLink' => null,
                'userId' => null,
            ]);
            DB::table('devices')->where('customerId', '=', $str)->update([
                'available' => true,
                'customerId' => null,
                'availableScreen' => true,
                'screenId' => null
            ]);
            DB::table('screens')->where('customerId', '=', $str)->delete();
            $users = DB::table('users')->where('customerId', '=', $str)->get('id');
            foreach ($users as $user) {
                DB::table('images')->where('user_id', '=', $user[0]->id)->delete();
            }
            DB::table('customers')->where('id', '=', $customersId)->delete();
            return redirect()->back();

        } else {
            if ($usersId != null) {

                foreach ($usersId as $value) {
                    $URL = 'http://localhost:8080/api/user/' . $value;
                    $client = new Client([
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'X-Authorization' => $token
                        ]
                    ]);
                    $request = $client->request('DELETE', $URL);
                    $data = $request->getStatusCode();///200

                    DB::table('users')->where('userId', '=', $value)->update([
                        'isCustomer' => false,
                        'isActive' => false,
                        'customerId' => null,
                        'activationLink' => null,
                        'userId' => null
                    ]);
                }


                return redirect()->route('showCustomerUser');
            }
        }
    }

    public function active(Request $request)
    {
        return view('home');
    }

    public function showDevices($id)
    {
        $devices = DB::table('devices')->where('customerId', '=', $id)->get();
        $screenId = DB::table('devices')->where('customerId', '=', $id)->get('screenId');
        $array = array();
        foreach ($screenId as $id) {
            $screens = DB::table('screens')->select('*')->where('id', '=', $id->screenId)->get();
            array_push($array, $screens);
        }
        return view('admin.customer.device')->with('array', $array)->with('devices', $devices);
    }

    public function activeAccount(Request $request)
    {
        $email = Auth::user()->email;
        $token = Auth::user()->token;
        $password = $request->input('password');
        $help = new HelperClass($email, $password, $token);
        $tenantToken = $help->tenantToken();
        $activationLink = Auth::user()->activationLink;

        $URL = 'http://localhost:8080/api/noauth/activate';
        $client = new Client([
            'header' => [
                'Accept' => 'application/json',
                'Content-Type' => ' application/json',
                'X-Authorization' => $tenantToken,
            ]
        ]);
        $request = $client->post($URL, ['json' => [
            'activateToken' => $activationLink,
            'password' => $password
        ],
        ]);
        $data = $request->getBody()->getContents();
        $response = json_decode($data, true);
        $response = $response['token'];
        $token = 'Bearer ' . $response;
        DB::table('users')->select('isActive')->where('email', '=', $email)->update([
            'token' => $token,
            'isActive' => true
        ]);
        return redirect()->back();
    }

    public function show()
    {
        $customers = DB::table('customers')->select('*')->get();
        $customerIds = DB::table('customers')->get('customerId');
        $users = DB::table('users')->where('isCustomer', '=', true)->get();
        return view('admin.customer.showCustomer', compact('customers', 'users'));
    }

    public function showUsers(Request $request)
    {
        $customerId = DB::table('customers')->where('id', '=', $request->input('assign'))->get();
        $users = DB::table('users')->where('customerId', '=', $customerId[0]->customerId)->get();
        return view('admin.customer.info')->with('users', $users)->with('customer', $customerId);
    }

}

