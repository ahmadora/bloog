<?php

namespace App\Http\Controllers;

use App\Classes\HelperClass;
use App\Models\Roles;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userLogin(Request $request)
    {
        $email = Auth::user()->email;
        $id = Auth::user()->id;
        $token = Auth::user()->token;
        $name = Auth::user()->name;
        $password = Auth::user()->getAuthPassword();
        $URL = "http://localhost:8080/api/auth/login";
        $help = new HelperClass($email, $password, $token);
        if ($help->checkTenantPassword($password)) {
            $client = new Client(['headers' => ['Content-Type' => 'application/json']]);
            $request = $client->post($URL, ['json' => [
                'username' => $email,
                'password' => $help->returnPassword($password)]]);
            $data = $request->getBody()->getContents();
            $response = json_decode($data, true);
            $response = $response['token'];
            $token = 'Bearer ' . $response;
            $tokenAdmin = DB::table('users')->where('id', $id)->update(['token' => $token]);
            return redirect('home');
        }
    }

    public function index()
    {
        return view('home');
    }

}
