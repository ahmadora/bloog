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
        $this->validate($request,[
           'name'=>'required|max:8',
            'title'=>'required|max:8|',
            'email'=>'required'
        ]);
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
                "address" => $request->input('address'),///reqired
                "city" => $request->input('city'),///reqired
                "email" => $request->input('email'),//////reqired
                "name" => $request->input('name'),////reqired
                "phone" => $request->input('phone'),///reqired
                "title" => $request->input('title'),///reqired
                ]
            ]);
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
            return redirect('show');
        }
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

    }

    public function show(){
        $customers = DB::table('customers')->get();
        $users = User::where('isCustomer', '=', false)->get();
//        foreach ($customers as $customer){
//            dump($customer->id);
//        }

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
