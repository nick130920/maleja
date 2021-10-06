<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    public function index(){
        return view('/calendario');
    }

    public function create(Request $request){
        $calendar = new Calendar;
        $validacion = Validator::make($request->all(), [
            'start' => ['required|date|max:255'],
            'phone_number' => ['required', 'number', 'email', 'max:10'],
            'type' => ['required'],
            'title' => ['required'],
            'body' => ['required'],
            'url' => ['required'],
            'user_id' => ['required'],
        ]);

        if ($validacion->fails()) {
            return redirect()->back()->withInput()->withErrors($validacion->errors());
        }

        $calendar = Calendar::create([
            'start' => $request->start,
            'phone_number' => $request->phone_number,
            'type' => $request->type,
            'title' => $request->title,
            'body' => $request->body,
            'url' => $request->url,
            'user_id' => $request->user_id,
        ]);

        return redirect("/dashboard");
    }
}
