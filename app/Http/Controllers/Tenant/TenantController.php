<?php

namespace App\Http\Controllers\Tenant;

use App\Classes\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Tenant;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    public function service()
    {
        return view('admin.customer.service');
    }

    public function createCustomer(Request $request)
    {
        $email = Auth::user()->email;
        $token = Auth::user()->token;
        $password = Auth::user()->getAuthPassword();
        $URL = "http://localhost:8080/api/customer";
        $help = new HelperClass($email, $password, $token);
        if ($help->isTenant()) {
            $client = new Client([
                'headers' => [
                    'Accept' => 'application/json',
                    'X-Authorization' => $token,
                ]
            ]);
            $request = $client->post($URL, ['json' => [
                "additionalInfo" => "null",
                "address" => $request->input('address'),///reqired
                "address2" => "string",
                "city" => $request->input('city'),///reqired
                "country" => "string",
                "createdTime" => 0,
                "email" => $request->input('email'),//////reqired
                "name" => $request->input('name'),////reqired
                "phone" => $request->input('phone'),///reqired
                "region" => "string",
                "state" => "string",
                "title" => $request->input('title'),///reqired
                'zip' => "string"]]);
            $data = $request->getBody()->getContents();
            $responses = json_decode($data, true);
            $customer= new Customer();
            $customer->customerId =$responses['id']['id'];
            $customer->address =$responses['address'];
            $customer->email = $responses['email'];
            $customer->title = $responses['title'];;
            $customer->name = $responses['name'];
            $customer->city =  $responses['city'];
            $customer->phone = $responses['phone'];
            $customer->save();
            dd($customer);
            return redirect('show');
        }
        dd($email);
    }

    public function index()
    {
        return view('admin.index');
    }

    public function create()
    {
        $email = Auth::user()->email;
        $token = Auth::user()->token;
        $password = Auth::user()->getAuthPassword();
        $help = new HelperClass($email, $password, $token);
        if ($help->isTenant()) {
            return view('admin.customer.create');
        } else {
            return view('404');
        }
    }

    public function store(Request $request)
    {
//        $this->validate($request,[
//
//        ]);
        $email =$request->input('email');
//        dump($email['email']);
        $user = DB::table('users')-> select('*')->where('email','=',$request->input('email'))->get();
//        $customerId =DB::table('customers')->select('*')->where('title','=',re)
//        dd($user);
//
//        return redirect('show');
    ///store user to customer
    }

    public function show(){
        $customers = DB::table('customers')->get();
        $users = User::where('isCustomer', '=', false)->get();
        dd($customers);
        return view('admin.customer.show',compact('users','customers'));
        }

    public function edit($id){
        //
    }

    public function update(Request $request)
    {
        $email = Auth::user()->email;
        $token = Auth::user()->token;
        $password = Auth::user()->getAuthPassword();
        $URL = "http://localhost:8080/api/user?sendActivationMail=false";
        $help = new HelperClass($email, $password, $token);
        if ($help->isTenant()) {
            $client = new Client([
                'headers' => [
                    'Accept' => 'application/json',
                    'X-Authorization' => $token,
                ]
            ]);
            $request = $client->post($URL, ['json' => [
                "additionalInfo" => "null",
                "authority" => "CUSTOMER_USER",
                "Name" => $request->input('address'),////required
                "email" => $request->input('email'),/////requird
                "customerId"=>[
                    "entityType"=>"CUSTOMER",
                    "id"=>""   ////required
                ],
                /// customerId": {
                //    "entityType":"CUSTOMER",
                //    "id": "a97e2c20-c444-11ea-b24e-7b4abc39f8c1"
                ]
            ]);
            $data = $request->getBody()->getContents();
            $responses = json_decode($data, true);
        }
    }

    public function destroy($id){
        //
    }
}
