<?php

namespace App\Http\Controllers\Tenant;

use App\Classes\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\userCustomer;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TenantCustomerController extends Controller
{
    public function saveNewUser(Request $request)
    {
        $string='';
        $customerIds = $request->input('customer');
        $emails = $request->input('email');
        foreach ($customerIds as $key){$customerId = $key;}
        foreach ($emails as $email) {
            $users = DB::table('users')->select('*')->where('email', '=', $email)->get();
            foreach ($users as $user) {
                $userEmail = $user->email;
                $username = $user->name;
            }
            $email = Auth::user()->email;
            $token = Auth::user()->token;
            $password = Auth::user()->getAuthPassword();
            $URL = "http://localhost:8080/api/user?sendActivationMail=false";
            $help = new HelperClass($email, $password, $token);
            if ($help->isTenant()) {
                ////////////  save user API ---- user name ---- email ----- customer Id /////////////
                /// //////// return user id
                $client = new Client([
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => ' application/json',
                        'X-Authorization' => $token,
                    ]
                ]);
                $request = $client->post($URL, ['json' => [
                    "authority" => "CUSTOMER_USER",
                    "name"=>$username, /////requierd
                    "email" => $userEmail,/////requird
                    "customerId" => [
                        "entityType" => "CUSTOMER",
                        "id" =>$customerId /////required
                    ],////required
                ]]);
                $data = $request->getBody()->getContents();
                $responses = json_decode($data, true);
                $userIsCustomer = DB::table('users')->where('email','=' ,$userEmail)->update([
                    'isCustomer' => true,
                    'userId'=>$responses['id']['id'],
                    'customerId'=>$responses['customerId']['id']
                ]);
                $userIds = DB::table('users')->select('userId')->where('email','=',$userEmail)->get('userId');
                foreach ($userIds as $key){$userId =$key;}
                $array = json_decode(json_encode($userId),true);
                foreach ($array as $value){$string =  $value;}
                ///////////////  get Active Link API    userId (string) //////////////
                /// ///////// return token in link  ///////////////
                $URL = "http://localhost:8080/api/user/".$string."/activationLink";/////requierd
                $client = new Client([
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'X-Authorization'=>$token
                    ]
                ]);
                $request = $client->request('GET',$URL);
                $data = $request->getBody()->getContents();
                $activationLink = substr($data,-30,30);
                $activeLink = DB::table('users')->where('email','=',$userEmail)->update([
                    'activetionLink'=>$activationLink
                ]);
                return redirect('showCustomer');
            }else{
                return view('404');
            }
        }
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
//                dd($value);
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
                        'customerId'=>null,
                        'activetionLink'=>null,
                        'userId'=>null
                    ]);
//                dump($data);
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
                        'customerId'=>null,
                        'activetionLink'=>null,
                        'userId'=>null
                    ]);
                    return redirect()->back();
                }
            }
        }
    }
    public function show(){
        $customers = DB::table('customers')->select('*')->get();
        $customerIds = DB::table('customers')->get('customerId');
        $users = DB::table('users')->where('isCustomer','=',true)->get();
        return view('admin.customer.showCustomer',compact('customers','users'));
    }
}
