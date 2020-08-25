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
        $customers = DB::table('customers')->select('title')->get('title');
        return view('admin.customer.service')->with('customers',$customers);
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
        $this->validate($request, [
            'name' => 'required|max:8',
            'title' => 'required|max:8|',
            'email' => 'required'
        ]);
//        dd($request);
        $email = Auth::user()->email;
        $token = Auth::user()->token;
        $title = $request->input('title');
        $address = $request->input('address');///reqired
        $city = $request->input('city');///reqired
        $emaill = $request->input('email');//////reqired
        $name = $request->input('name');////reqired
        $phone = $request->input('phone');///reqired
        $title = $request->input('title');///reqired
        $password = Auth::user()->getAuthPassword();
        $help = new HelperClass($email, $password, $token);
        $URL = 'http://localhost:8080/api/customers?limit=10';
        if ($help->isTenant()) {
            $client = new Client([
                'headers' => [
                    'Accept' => 'application/json',
                    'X-Authorization' => $token,
                ]
            ]);
            $request = $client->request('GET', $URL);
            $detils = $request->getBody()->getContents();
            $response = json_decode($detils, true)['data'];
            foreach ($response as $da) {
                if ($da['title'] == $title) {
                    $check = true;
                } else {
                    $check = false;
                }
            }
            if (!$check) {
                $URL = "http://localhost:8080/api/customer";
                $client = new Client([
                    'headers' => [
                        'Accept' => 'application/json',
                        'X-Authorization' => $token,
                    ]
                ]);
                $request = $client->post($URL, ['json' => [
                    "address" => $address,///reqired
                    "city" => $city,///reqired
                    "email" => $emaill,//////reqired
                    "name" => $name,////reqired
                    "phone" => $phone,///reqired
                    "title" => $title,///reqired
                ]
                ]);
                $status = $request->getStatusCode();
                $data = $request->getBody()->getContents();
                $responses = json_decode($data, true);
                $customer = new Customer();
                $customer->customerId = $responses['id']['id'];
                $customer->address = $responses['address'];
                $customer->email = $responses['email'];
                $customer->title = $responses['title'];;
                $customer->name = $responses['name'];
                $customer->city = $responses['city'];
                $customer->phone = $responses['phone'];
                $customer->save();
            } else {
                return view('404');
            }
            return redirect()->back();
        }
    }

    public function show(){
        $customers = DB::table('customers')->pluck('title','customerId');
//        $devices = DB::table('devices')->select('*')->where('customerId','=',);
//        dd($customers);
        $users = User::where('isCustomer', '=', false)->get();
        return view('admin.customer.show',compact('users','customers'));
        }

    public function edit($id){
        //
    }

    public function update(Request $request)
    {
    }

    public function destroy(){

    }
}
