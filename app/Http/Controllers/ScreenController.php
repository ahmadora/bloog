<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScreenController extends Controller
{

    public function index()
    {
        return view('admin.screen.service');
    }

    public function create()
    {
        $customers = DB::table('customers')->select('*')->pluck('title', 'customerId');
        return view("admin.screen.create", compact('customers', $customers));
    }

    public function store(Request $request)
    {
        $screen = new Screen();
        $screen->name = $request->input('screen');
        $screen->customerId = $request->input('customers');
        $screen->location = $request->input('location');
        $screen->save();
        return redirect()->route('showScreen');
    }

    public function show()
    {
        $string = '';
        $userId = Auth::user()->id;
        if ($userId == 1) {
            $screens = Screen::all();
            foreach ($screens as $screen) {
                $devices = Device::where('screenId', '=', $screen->id);
            }
            return view('admin.screen.show', compact('screens'));
        } else {
            if (Auth::user()->isActive) {
                $customerId = DB::table('users')->select('customerId')->where('id', '=', $userId)->get();
                $array = json_decode(json_encode($customerId), true);
                foreach ($array as $id) {
                    $string = $id;
                }
                $screens = DB::table('screens')->select('*')->where('customerId', '=', $string['customerId'])->get();
                return view('user.screen.show', compact('screens'));
            } else {
                return view('404');
            }
        }
    }

    public function edit(Request $request)
    {
        if ($request->input('delete')) {
            $screenId = $request->input('delete');
            $screen = Screen::destroy($screenId);
            return redirect()->back();
        } else {
            if ($request->input('uassign')) {
                $screenId = $request->input('uassign');
                Device::where('screenId', '=', $screenId)->update(['screenId' => null, 'availableScreen' => true]);
                $screen = Screen::destroy($screenId);
                return redirect()->back();
            }
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'screen' => 'required',
        ]);
        if (Auth::user()->id == 1) {
            $deviceName = $request->input('deviceName');
            $screenId = $request->input('screen');
            $deviceI = DB::table('devices')->select('*')->where('name', '=', $deviceName)->get();
            $screen = DB::table('screens')->select('*')->where('id', '=', $screenId)->get();
            DB::table('devices')->where('deviceId', '=', $deviceI[0]->deviceId)->update([
                'availableScreen' => false,
                'screenId' => $screen[0]->id
            ]);
            DB::table('screens')->where('id', '=', $screenId)->update([
                'available' => false,
                'deviceId' => $deviceI[0]->deviceId,
                'customerId' => $deviceI[0]->customerId
            ]);
            return view('admin.device.service');
        } else {
            return view('404');
        }
    }
}
