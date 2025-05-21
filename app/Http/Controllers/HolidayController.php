<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function holidayList()
    {
        $holiday = Holiday::with('employee')->get();
        return view('frontend.attendencetable',compact('holiday'));
    } 
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'reason' => 'required|string'
        ]);

        Holiday::create($request->all());

        return redirect()->back()->with('message' , 'Holiday added');
    }
}
