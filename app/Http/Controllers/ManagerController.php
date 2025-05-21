<?php

namespace App\Http\Controllers;
use App\Models\Manager;
use App\Models\Employee;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function displaymanager()
    {
        $data = Manager::where('role','manger')->get();
        return view('frontend.manager',['data' => $data]);
    }
    public function managerForm()
    {
        return view('frontend.addmanagerform');
    }
    public function editmanager($id){
        $employee = Manager::findOrFail($id);
        return view('frontend.editmanagerform', compact('employee'));
    }
    public function addManager(Request $req)
    {
       $validated = $req->validate([
        'fname' => 'required|string|min:3',
        'mname' => 'nullable|string|min:5',
        'lname' => 'required|string|min:3',
        'email' => 'required|string',
        'gender' => 'required|string',
        'designation' => 'required|string',
        'role' => 'required|string',
        'skills'=>'required',
        'fixedsalary'=> 'required|string'
       ]);
       Manager::create($validated);
       return redirect()->back()->with('success','Employee Added Succesfully');
    }
    public function update(Request $req, $id){
        $validated = $req->validate([
            'fname' => 'required|string|min:3',
            'mname' => 'nullable|string|min:5',
            'lname' => 'required|string|min:3',
            'email' => 'required|string',
            'gender' => 'required|string',
            'designation' => 'required|string',
            'role' => 'required|string',
            'skills'=>'required',
            'fixedsalary'=> 'required|string'
        ]);
        $employee = Employee::findOrFail($id);
        $employee->update($validated);
        return redirect()->back()->with('success','Employee Details Updated Succesfully');
    }

}
