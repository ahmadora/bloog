<?php

namespace App\Http\Controllers;

use App\Image;
use App\ScreenImage;
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
        if (Auth::user()->id == 1){
            $images = Image::get();
            $screens = ScreenImage::get();
            return view('admin.advertisements.show',compact('images','screens'));
        }else{
            if (Auth::user()->isActive){

            }
        }
    }

    public function create()
    {
        $car = [];
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
        $image->path = '/storage/'.$path;
        $image->duration = $request->duration;
        $image->userId = Auth::user()->id;
        $image->save();



        $screeIds = $request->input('screen');
        foreach ($screeIds as $screenId){
            $ImageDev = new ScreenImage();
            $ImageDev->screenId = $screenId;
            $ImageDev->imageId = $image->id;
            $ImageDev->save();
        }
        $arr = array();
        $arr2 = array();
        $screeIds = $request->input('screen');
        foreach ($screeIds as $screenId) {
            $deviceToken = DB::table('devices')->select('credentialsId')->where('screenId', '=', $screenId)->get();
            array_push($arr, $deviceToken[0]);
        }
        foreach ($arr as $item) {
            dump($item->credentialsId);
                $url = 'E:/Projects/bloog'.$path;
                $URL = 'http://localhost:8080/api/v1/'.$item->credentialsId.'/telemetry';
                $client = new Client(['headers' => ['Content-Type' => 'application/json',

                ]]);
                $request = $client->post($URL, ['json' => [
                    'url'=>$url,
                    'duration'=>$image->duration
                ]]);
                $data = $request->getBody()->getContents();
                $response = json_decode($data, true);
            }
        return redirect()->back()->with('success', 'Image uploaded successfully');


    }

    public function delete($id){

        $image = Image::find($id);
        $image->delete();
        return redirect()->back();
    }


}
