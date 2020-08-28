<?php

namespace App\Http\Controllers\Tenant;

use App\Classes\HelperClass;
use App\Http\Controllers\Controller;
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
            $users = DB::table('users')->select('*')->where('email','=',$request->input('email')[0])->get();
            foreach ($customerIds as $customerId){
                if ($customerId != null){
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
             DB::table('users')->where('email', '=',  $users[0]->email)->update([
                'isCustomer' => true,
                'userId' => $responses['id']['id'],
                'customerId' => $responses['customerId']['id']
            ]);
            $userEmail= $responses['email'];
            $userIds = DB::table('users')->select('userId')->where('email', '=',$responses['email'])->get('userId');
//            dd($userIds);
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
        }else
            {return view('404');}
        }

    public function index(){
        $customers = DB::table('customers')->select('title')->get('title');
        return view('admin.customer.service')->with('customers',$customers);
    }

    public function delete(Request $request){
        $string = '';
        $token = Auth::user()->token;
        $customersId= $request->input('customerId');
        $usersId = $request->input('userId');
        if ($customersId != null) {
            foreach ($customersId as $key) {
                $customerId = $key;
                $customerIds = DB::table('customers')->select('customerId')->where('customerId', '=', $customerId)->get('customerId');
                foreach ($customerIds as $value){$customerId =$value;}
                $array = json_decode(json_encode($customerId),true);
                foreach ($array as $value){$string =  $value;}
                $URL = 'http://localhost:8080/api/customer/'.$string;
                $client = new Client([
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'X-Authorization'=>$token
                    ]
                ]);
                $request = $client->request('DELETE',$URL);
                $data = $request->getStatusCode();///200
                    DB::table('customers')->where('customerId','=',$value)->delete();
                    DB::table('users')->where('customerId','=',$value)->update([
                        'isCustomer'=>false,
                        'isActive'=>false,
                        'customerId'=>null,
                        'activationLink'=>null,
                        'userId'=>null,

                    ]);
                return redirect()->back();
            }
        }else {
            if ($usersId != null) {
                foreach ($usersId as $key) {
                    $userId = $key;
                    $userId = DB::table('users')->select('userId')->where('userId', '=', $userId)->get('userId');
                    foreach ($usersId as $value){$userId=$value;}
                    $array = json_decode(json_encode($userId),true);
                    $string = $array;
                    $URL = 'http://localhost:8080/api/user/'.$string;
                    $client = new Client([
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'X-Authorization'=>$token
                        ]
                    ]);
                    $request = $client->request('DELETE',$URL);
                    $data = $request->getStatusCode();///200
                    DB::table('users')->where('userId','=',$array)->update([
                        'isCustomer'=>false,
                        'isActive'=>false,
                        'customerId'=>null,
                        'activationLink'=>null,
                        'userId'=>null
                    ]);
                    return redirect()->back();
                }
            }
        }
    }

    public function active(Request $request){
        return view('home');
    }

    public function activeAccount(Request $request){
        $email = Auth::user()->email;
        $token = Auth::user()->token;
        $password = $request->input('password');
        $help = new HelperClass($email,$password,$token);
        $tenantToken= $help->tenantToken();

        $activationLink = Auth::user()->activationLink;
        $URL = 'http://localhost:8080/api/noauth/activate';
        $client = new Client([
            'header' => [
                'Accept' => 'application/json',
                'Content-Type'=>' application/json',
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
        DB::table('users')->select('isActive')->where('email','=',$email)->update([
            'token'=>$token,
           'isActive'=>true
        ]);
        return redirect()->back();
    }

    public function show(){
        $customers = DB::table('customers')->select('*')->get();
        $customerIds = DB::table('customers')->get('customerId');
        $users = DB::table('users')->where('isCustomer','=',true)->get();
        return view('admin.customer.showCustomer',compact('customers','users'));
    }
}

