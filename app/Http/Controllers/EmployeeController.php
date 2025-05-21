<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Manager;
use App\Models\EmployeeDocument;
use App\Models\EmployeeSalary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            $auth_user_id = Auth::user()->id;
            $data = Employee::with('manager')->orderBy('created_at', 'desc')->get();
            return view('frontend.home', ['data' => $data]);
        }
    }
    public function viewEmployee()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            $data = Employee::where('is_deleted', 0)->orderBy('id', 'desc')->get();
            return view('frontend.allEmployee', ['data' => $data]);
        }
    }
    public function addEditEmployee(Request $request, $id = "")
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            $data['auth_user_id'] = Auth::user()->id;
            $data['mangerdata'] = Employee::where('role', '1')->where('is_deleted', 0)->orderBy('id', 'desc')->get();
            $data['editEmployee'] = Employee::find($id);
            $data['employeeImage'] = EmployeeDocument::where('emp_id', $id)->where('is_deleted', 0)->get();
            $data['employeeSalary'] = EmployeeSalary::where('emp_id', $id)->where('is_deleted', 0)->first();
            return view('frontend.addEditEmployee', $data);
        }
    }
    public function empDocDestroy($id)
    {
        $empDocument = EmployeeDocument::find($id);
        if ($empDocument) {
            Storage::disk('public')->delete('employee_documents/' . $empDocument->emp_document);
            $empDocument->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
    public function addpostEmployee(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            if ($request->emp_id == 0) {

                $data = $request->validate([
                    'fname'             => ['required', 'string', 'max:255'],
                    'lname'             => ['required', 'string', 'max:255'],
                    'email'             => ['required', 'email', 'max:255', Rule::unique('employees', 'email')],
                    'department'        => ['required', 'string', 'max:255'],
                    'gender'            => ['required', Rule::in(['Male', 'Female'])],
                    'role'              => ['required', 'integer'],
                ]);

                $prefix = 'DPW';
                //Get latest employee code
                $latest = Employee::where('emp_code', 'like', $prefix . '%')
                                ->orderBy('emp_code', 'desc')
                                ->first();
                if ($latest) {
                    $lastNumber = (int) substr($latest->emp_code, strlen($prefix));
                    $newNumber = $lastNumber + 1;
                } else {
                    $newNumber = 1;
                }
                $empCode = $prefix . str_pad($newNumber, 2, '0', STR_PAD_LEFT);

                //Photo upload
                if ($request->hasFile('emp_photo')) {
                    if ($request->file('emp_photo')->isValid()) {
                        $filename = time() . '.' . $request->file('emp_photo')->getClientOriginalExtension();
                        $path = $request->file('emp_photo')->storeAs('public/emp_photos', $filename);
                        $data['emp_photo'] = $path;
                    }
                }
                //Create Employee
                $employee = Employee::create([
                    'emp_code'      => $empCode,
                    'fname'         => $request->fname,
                    'mname'         => $request->mname,
                    'lname'         => $request->lname,
                    'email'         => $request->email,
                    'department'    => $request->department,
                    'gender'        => $request->gender,
                    'role'          => $request->role,
                    'managerid'     => $request->managerid,
                    'team_lead_id'  => $request->teamLeadid,
                    'contact_no'    => $request->contact_no,
                    'skills'        => $request->skills,
                    'emp_photo'     => $request->file('emp_photo'),
                ]);
                if (! $employee) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Failed to add employee. Please try again.');
                }
                //Optional: salary record
                if (!is_null($request->basic)) {
                    EmployeeSalary::create([
                        'emp_id'             => $employee->id,
                        'basic'              => $request->basic,
                        'hra'                => $request->hra ?? 0,
                        'conv_allowance'     => $request->conv_all ?? 0,
                        'trans_allowance'    => $request->trans_all ?? 0,
                        'others'             => $request->others ?? 0,
                        'medical_allowance'  => $request->medical_allowance ?? 0,
                        'pf_employer'        => $request->pf_employer ?? 0,
                        'esi_employer'       => $request->esi_employer ?? 0,
                        'bonus'              => $request->bonus ?? 0,
                        'other_benefits'     => $request->other_benefits ?? 0,
                        'net_salary'         => $request->input('resultField', 0),
                        'increment'          => $request->input('increment', 0),
                        'incremented_salary' => $request->input('incrementSalary', 0),
                    ]);
                }
                //Optional: documents upload
                if ($request->hasFile('doc_file')) {
                    foreach ($request->file('doc_file') as $file) {
                        $path = $file->store('public/employee_documents');
                        $fileName = basename($path);
                        EmployeeDocument::create([
                            'emp_id'        => $employee->id,
                            'emp_document'  => $fileName,
                        ]);
                    }
                }
                // Redirect back with success
                return redirect()->back()->with('success', 'Employee added successfully!');
            } else {
                $emp_id = $request->emp_id;
                // Update Employee
                $employee = Employee::findOrFail($emp_id);
                $employee->update([
                    'fname' => $request->fname,
                    'mname' => $request->mname,
                    'lname' => $request->lname,
                    'email' => $request->email,
                    'department' => $request->department,
                    'gender' => $request->gender,
                    'role' => $request->role,
                    'managerid' => $request->managerid,
                    'team_lead_id'   => $request->teamLeadid,
                    'contact_no' => $request->contact_no,
                    'skills' => $request->skills,
                ]);

                //Handle photo upload
                if ($request->hasFile('emp_photo')) {
                    // Delete old photo if exists
                    if ($employee->emp_photo && Storage::disk('public')->exists('employee_photos/' . $employee->emp_photo)) {
                        Storage::disk('public')->delete('employee_photos/' . $employee->emp_photo);
                    }
                    //Save new photo
                    $photo = $request->file('emp_photo');
                    $photoName = time() . '.' . $photo->getClientOriginalExtension();
                    $photo->storeAs('employee_photos', $photoName, 'public');
                    //Update employee with new photo name
                    $employee->update([
                        'emp_photo' => $photoName,
                    ]);
                }
                // Update Employee Salary
                if (!is_null($emp_id) && $request->has('basic')) {
                    $salary = EmployeeSalary::where('emp_id', $employee->id)->first();

                    if ($salary) {
                        $salary->update([
                            'basic' => $request->basic,
                            'hra' => $request->hra,
                            'conv_allowance' => $request->conv_all,
                            'trans_allowance' => $request->trans_all,
                            'others' => $request->others,
                            'medical_allowance' => $request->medical_allowance,
                            'pf_employer' => $request->pf_employer,
                            'esi_employer' => $request->esi_employer,
                            'bonus' => $request->bonus,
                            'other_benefits' => $request->other_benefits,
                            'salary_nett' => $request->resultField,
                            'increment_percent' => $request->increment,
                            'incremented_salary' => $request->incrementSalary,
                        ]);
                    }
                }
                // Handle documents (optional)
                if ($request->hasFile('doc_file')) {
                    foreach ($request->file('doc_file') as $file) {
                        $path = $file->store('public/employee_documents');
                        $fileName = basename($path);
                        EmployeeDocument::create([
                            'emp_id'        => $employee->id,
                            'emp_document'  => $fileName,
                        ]);
                    }
                }
                return redirect()->back()->with('success', 'Employee details updated successfully.');
            }
        }
    }
    public function getaddTeamLeads($managerId)
    {
        $teamLeads = Employee::where('managerid', $managerId)
            ->where('role', 2)
            ->get();
        return response()->json($teamLeads);
    }

    public function getaddSeniorEmployees($teamLeadId)
    {
        $seniorEmployees = Employee::where('team_lead_id', $teamLeadId)->where('role', 3)->get();
        return response()->json($seniorEmployees);
    }

    public function displayjunior()
    {
        $data = Employee::with('manager')->where('role', 'junior')->get();
        return view('frontend.junioremployee', ['data' => $data]);
    }
    public function displaysenior()
    {
        $data = Employee::with('manager')->where('role', 'senior')->get();
        return view('frontend.senioremployee', ['data' => $data]);
    }
    public function displayteamlead()
    {
        $data = Employee::with('manager')->where('role', 'teamlead')->get();
        return view('frontend.teamlead', ['data' => $data]);
    }
    public function displaymanager()
    {
        $data = Employee::where('role', 'manger')->get();
        return view('frontend.manager', ['data' => $data]);
    }
    public function employeeForm()
    {
        $data = Manager::all();
        return view('frontend.addEmployeeform', compact('data'));
    }
    public function teamleadForm()
    {
        $data = Manager::all();
        return view('frontend.addteamleadform', compact('data'));
    }
    public function managerForm()
    {
        return view('frontend.addmanagerform');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('frontend.editemployeeform', compact('employee'));
    }

    public function deleteEmployee($id)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            $employee = Employee::find($id);
            if ($employee) {
                $employee->is_deleted = 1;
                $employee->save();

                return redirect()->back()->with('success', 'Employee marked as deleted.');
            }
            return redirect()->back()->with('error', 'Employee not found.');
        }
    }
    public function attendenceindex()
    {
        return response()->json(Employee::select('id', 'name')->get());
    }

    public function attendenceshow($id)
    {
        return response()->json(Employee::findOrFail($id));
    }
}
