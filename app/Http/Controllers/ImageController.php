<?php

namespace App\Http\Controllers;

use App\Image;
use App\Models\Customer;
use App\Models\Device;
use App\Screen;
use App\ScreenImage;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{

    public function index()
    {
        return view('admin.advertisements.service');
    }

    public function show()
    {
        $images = Image::all();
        $screens = ScreenImage::all();
        $customers = array();
        foreach ($images as $image){
            $user = User::where('id','=',$image->user_id)->get('customerId');
            $customer = Customer::where('customerId','=',$user[0]->customerId)->get();

            array_push($customers, $customer[0]->name);

        }
//        dd($customers);
        if (Auth::user()->id == 1) {
            return view('admin.advertisements.show')->with('images', $images)->with('screens', $screens)->with('customers',$customers);
        } else {
            if (Auth::user()->isActive) {
                return view('user.advertisements')->with('images', $images)->with('screens', $screens);
            }
        }
    }

    public function create()
    {
        $arr = array();
        if (Auth::user()->isActive) {
            $userId = Auth::user()->customerId;
            $deviceIds = DB::table('devices')->select('*')->where('customerId', '=', $userId)->get();
            foreach ($deviceIds as $deviceId) {
                $screenId = $deviceId->screenId;
                if ($screenId) {
                    $screens = DB::table('screens')->select('*')->where('id', '=', $screenId)->get();
                    array_push($arr, $screens[0]);
                }
            }
            $screens = $arr;
            return view("user.uploadImage", compact('screens', $screens));
        } else {
            return view('404');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'path' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'duration' => 'required',
        ]);
        $image = new Image;
        if ($request->file('path')) {
            $imagePath = $request->file('path');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('path')->storeAs('uploads', $imageName, 'public');
        }
        $image->path = '/storage/' . $path;
        $image->duration = $request->duration;
        $image->user_id = Auth::user()->id;
        $image->save();
        $screeIds = $request->input('screen');
        foreach ($screeIds as $screenId) {
            $ImageDev = new ScreenImage();
            $ImageDev->screen_id = $screenId;
            $ImageDev->image_id = $image->id;
            $ImageDev->save();
        }
        $arr = array();
        $arr2 = array();
        $screeIds = $request->input('screen');
        $token = Auth::user()->token;
        foreach ($screeIds as $screenId) {
            $deviceToken = DB::table('devices')->select('credentialsId')->where('screenId', '=', $screenId)->get();
            array_push($arr, $deviceToken[0]);
        }
        foreach ($arr as $item) {
            $url = 'E:/Projects/bloog' . $path;
            $URL = 'http://localhost:8080/api/v1/' . $item->credentialsId . '/telemetry';
            $client = new Client(['headers' => [
                'Content-Type' => 'application/json',
                'X-Authorization'=>$token
            ]]);
            $request = $client->post($URL, ['json' => [
                'url' => $url,
                'duration' => $image->duration
            ]]);
            $data = $request->getStatusCode();

            $response = json_decode($data, true);
        }
        return redirect()->back()->with('success', 'Image uploaded successfully');
    }

    public function delete($id)
    {
        $token = Auth::user()->token;
        $image = Image::find($id);
        $imageScreens = ScreenImage::where('image_id', '=', $id)->get();
        foreach ($imageScreens as $imageScreen)  {
            $device = Device::where('deviceId','=',$imageScreen->screen->deviceId)->get('credentialsId');
            $URL = 'http://localhost:8080/api/v1/' . $device[0]->credentialsId. '/telemetry';
            $client = new Client(['headers' => [
                'Content-Type' => 'application/json',
                'X-Authorization'=>$token
            ]]);
            $request = $client->post($URL, ['json' => [
                'ads' => 'delete'
            ]]);
            $data = $request->getStatusCode();
        }
        unlink(public_path() . $image->path);
        $image->delete();
        return redirect()->back();
    }


}
