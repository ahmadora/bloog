<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\DefaultValueResolver;

class ScreenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.screen.service');
    }

    public function create()
    {
        $customers = DB::table('customers')->select('*')->pluck('title', 'customerId');
        return view("admin.screen.create", compact('customers', $customers));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $screen = new Screen();
        $screen->name = $request->input('screen');
        $screen->customerId = $request->input('customers');
        $screen->location = $request->input('location');
        $screen->save();
        return redirect()->route('showScreen');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $string = '';
        $userId = Auth::user()->id;
        if ($userId == 1) {
            $screens = Screen::all();
            foreach ($screens as $screen){
                $devices = Device::where('screenId','=',$screen->id);
            }
//            dd($screens);
            return view('admin.screen.show', compact('screens'));
        } else {
            if (Auth::user()->isActive) {
                $customerId = DB::table('users')->select('customerId')->where('id', '=', $userId)->get();
                $array = json_decode(json_encode($customerId), true);
                foreach ($array as $id) {$string = $id;}
                $screens = DB::table('screens')->select('*')->where('customerId', '=', $string['customerId'])->get();
//                dd($screens);
                return view('admin.screen.show', compact('screens'));
            } else {
                return view('404');
            }
        }
    }
//    public function assign(Request $request){
//        dd();
//        $deviceId = $request->input('device')[0];
//        $screenId = $request->input('submit');
//
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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

    public function destroy($id)
    {
        //
    }
}
