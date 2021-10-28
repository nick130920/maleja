<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Service;

use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    public function index(){
        return view('/calendario');
    }

    public function create(Request $request){
        $user_id = FacadesAuth::user()->id;
        $validacion = Validator::make($request->all(), [
            'start' => ['required','date'],
            'phone_number' => ['required', 'numeric', 'max:4000000000'],
            'service_id' => ['required'],
            'title' => ['required'],
            'event' => ['required'],
        ]);

        if ($validacion->fails()) {
            return redirect()->back()->withInput()->withErrors($validacion->errors());
        }
        $code = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < 6; $i++) $code .= $pattern[mt_rand(0, $max)];
        $calendar = new Calendar();
        $calendar->start = $request->input('start');
        $calendar->code = $code;
        $calendar->phone_number = $request->input('phone_number');
        $calendar->service_id = $request->input('service_id');
        $calendar->title = $request->input('title');
        $calendar->body = $request->input('event');
        $calendar->url = "/calendar/" . $code . "/N13/" . $user_id;
        $calendar->user_id = $user_id;

        // $class->save(); //INSERT
        // $calendar = Calendar::create([
        //     'start' => $request->start,
        //     'code' => $code,
        //     'phone_number' => $request->phone_number,
        //     'service_id' => $request->service_id,
        //     'title' => $request->title,
        //     'body' => $request->event,
        //     'url' => "/calendar/".$request->start.$code."N13".$user_id,
        //     'user_id' => $user_id,
        // ]);
        $calendar->save();

        return redirect()->back();
    }
}
