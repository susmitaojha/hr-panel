<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Holiday;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function attendence()
    {
        $data = Employee::all();
        return view('frontend.attendenceform',compact('data'));
    }
    public function attendenceList()
    {
        $data = Attendance::with('employee')->get();
        //$holiday = Holiday::with('employee')->get();
        return view('frontend.attendencetable',compact('data','holiday'));
    }
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('frontend.attendenceform', compact('employee'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'entry_time' => 'nullable',
            'exit_time' => 'nullable',
            'status' => 'required|in:Present,Late,Half Day,Absent,Work Form Home'
        ]);

        Attendance::updateOrCreate(
            ['employee_id' => $request->employee_id, 'date' => $request->date],
            $request->all()
        );

        return redirect()->back()->with('success','Attendance Filled Succesfully');
    }
}
