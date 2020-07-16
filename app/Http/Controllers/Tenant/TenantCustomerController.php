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

    public function index()
    {
        //
    }


    public function saveNewUser(Request $request)
    {
        $customerIds = $request->input('customer');
        $emails = $request->input('email');
        foreach ($customerIds as $key){
            $customerId = $key;
        }
        foreach ($emails as $email) {
            $users = DB::table('users')->select('*')->where('email', '=', $email)->get();
            foreach ($users as $user) {
                $userEmail = $user->email;
                dump($userEmail);
            }
            $email = Auth::user()->email;
            $token = Auth::user()->token;
            $password = Auth::user()->getAuthPassword();
            $URL = "http://localhost:8080/api/user?sendActivationMail=false";
            $help = new HelperClass($email, $password, $token);
            if ($help->isTenant()) {
                $client = new Client([
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => ' application/json',
                        'X-Authorization' => $token,
                    ]
                ]);
                $request = $client->post($URL, ['json' => [
                    "additionalInfo" => "null",
                    "authority" => "CUSTOMER_USER",
//                    "name" => $request->input('address'),////required
                    "email" => $userEmail,/////requird
                    "customerId" => [
                        "entityType" => "CUSTOMER",
                        "id" =>$customerId /////required
                    ],
                ]
                ]);
                $data = $request->getBody()->getContents();
                $responses = json_decode($data, true);
                $userIsCustomer = DB::table('users')->where('email','=' ,$userEmail)->update([
                    'isCustomer' => true,
                    'userId'=>$responses['id']['id'],
                    'customerId'=>$responses['customerId']['id']
                ]);
                $URL = "http://localhost:8080/api/user/bf145ef0-c6f2-11ea-b24e-7b4abc39f8c1/activationLink";
                $client = new Client([
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'X-Authorization'=>$token
                    ]
                ]);
                $request = $client->request('GET',$URL);
                $data = $request->getBody()->getContents();
                $response = json_decode($data, true);
                dd($response);
                echo 'done';
            }
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        $customers = DB::table('customers')->select('*')->get();
        dump($customers);
        return view('admin.customer.showCustomer',compact('customers'));
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
