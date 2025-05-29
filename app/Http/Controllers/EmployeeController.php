<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\EmployeeSalary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

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
    public function employeeViewdetails(Request $request, $id = "")
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            $auth_user_id = Auth::user()->id;
            $data['employeeData'] = Employee::with('manager', 'teamLeadEmployees')->where('id', $id)->first();
            $data['employeeImage'] = EmployeeDocument::where('emp_id', $id)->where('is_deleted', 0)->get();
            $data['employeeSalary'] = EmployeeSalary::where('emp_id', $id)->where('is_deleted', 0)->first();
            return view('frontend.employee_details', $data);
        }
    }
    public function salaryStracture(Request $request, $id = "")
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            $auth_user_id = Auth::user()->id;
            $data['employeeData'] = Employee::with('manager', 'teamLeadEmployees')->where('id', $id)->first();
            $data['employeeImage'] = EmployeeDocument::where('emp_id', $id)->where('is_deleted', 0)->get();
            $data['employeeSalary'] = EmployeeSalary::where('emp_id', $id)->where('is_deleted', 0)->first();
            return view('frontend.salary_stracture', $data);
        }
    }
    public function paySlip(Request $request, $id = "")
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            $auth_user_id = Auth::user()->id;
            $data['employeeData'] = Employee::with('manager', 'teamLeadEmployees')->where('id', $id)->first();
            $data['employeeImage'] = EmployeeDocument::where('emp_id', $id)->where('is_deleted', 0)->get();
            $data['employeeSalary'] = EmployeeSalary::where('emp_id', $id)->where('is_deleted', 0)->first();
            return view('frontend.emp_pay_slip', $data);
        }
    }
    public function viewEmployee()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            $data = Employee::where('status', '0')->where('is_deleted', 0)->orderBy('created_at', 'desc')->get();
            return view('frontend.allEmployee', ['data' => $data]);
        }
    }
    public function addEditEmployee(Request $request, $id = "")
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            $data['auth_user_id'] = Auth::user()->id;
            $data['mangerdata'] = Employee::where('role', '1')->where('status', '0')->where('is_deleted', 0)->orderBy('id', 'desc')->get();
            $data['teamleaddata'] = Employee::where('role', '2')->where('status', '0')->where('is_deleted', 0)->orderBy('id', 'desc')->get();
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
                    'dob'               => ['required', 'date'],
                    'joining_date'      => ['required', 'date'],

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
                    $image = $request->file('emp_photo');
                    $empimageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('assets/employee_photos'), $empimageName);
                    $imagePath = $empimageName;
                } else {
                    $imagePath = Null;
                }
                //cv upload
                if ($request->hasFile('emp_cv')) {
                    $image = $request->file('emp_cv');
                    $empCVName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('assets/employee_cv'), $empCVName);
                    $cvimagePath = $empCVName;
                } else {
                    $cvimagePath = Null;
                }
                //Create Employee
                $employee = Employee::create([
                    'emp_code'      => $empCode,
                    'fname'         => $request->fname,
                    'mname'         => $request->mname,
                    'lname'         => $request->lname,
                    'email'         => $request->email,
                    'dob'           => Carbon::parse($request->dob),
                    'joining_date'  => Carbon::parse($request->joining_date),
                    'department'    => $request->department,
                    'role'          => $request->role,
                    'gender'        => $request->gender,
                    'managerid'     => $request->managerid,
                    'team_lead_id'  => $request->teamLeadid,
                    'address_line1' => $request->address_line1,
                    'address_line2' => $request->address_line2,
                    'city'          => $request->city,
                    'district'      => $request->district,
                    'state'         => $request->state,
                    'pincode'       => $request->pincode,
                    'emp_cv'        => $cvimagePath,
                    'emp_photo'     => $imagePath,
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
                        'net_salary'         => $request->resultField ?? 0,
                        'increment'          => $request->increment ?? 0,
                        'incremented_salary' => $request->incrementSalary ?? 0,
                    ]);
                }
                if ($request->hasFile('doc_file')) {
                    foreach ($request->file('doc_file') as $file) {
                        $destinationPath = public_path('assets/employee_documents');
                        // Create the folder if it doesn't exist
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0755, true);
                        }
                        $fileName = $employee->id . '_' . time() . '_' . $file->getClientOriginalName();
                        $file->move($destinationPath, $fileName);
                        EmployeeDocument::create([
                            'emp_id'       => $employee->id,
                            'emp_document' => $fileName,
                        ]);
                    }
                }
                // Redirect back with success
                return redirect('all-employee')->with('success', 'Employee added successfully!');
            } else {
                $emp_id = $request->emp_id;
                // Update Employee
                $employee = Employee::findOrFail($emp_id);
                $employee->update([
                    'fname' => $request->fname,
                    'mname' => $request->mname,
                    'lname' => $request->lname,
                    'email' => $request->email,
                    'dob'           => Carbon::parse($request->dob),
                    'joining_date'  => Carbon::parse($request->joining_date),
                    'department' => $request->department,
                    'role'          => $request->role,
                    'gender' => $request->gender,
                    'managerid' => $request->managerid,
                    'team_lead_id'   => $request->teamLeadid,
                    'contact_no' => $request->contact_no,
                    'skills' => $request->skills,
                    'address_line1'      => $request->address_line1,
                    'address_line2'      => $request->address_line2,
                    'city'               => $request->city,
                    'district'           => $request->district,
                    'state'              => $request->state,
                    'pincode'       => $request->pincode,
                ]);

                //Handle photo upload
                if ($request->hasFile('emp_photo')) {
                    // Delete the old emp_photo if it exists
                    if (!empty($employee->emp_photo)) {
                        $oldemp_photoPath = public_path('assets/employee_photos/' . $employee->emp_photo);
                        if (file_exists($oldemp_photoPath)) {
                            unlink($oldemp_photoPath);
                        }
                    }
                    // Upload the new CV
                    $emp_profilephoto = $request->file('emp_photo');
                    $profilephotoName = time() . '.' . $emp_profilephoto->getClientOriginalExtension();
                    $emp_profilephoto->move(public_path('assets/employee_photos'), $profilephotoName);
                    // Update the database
                    $employee->update([
                        'emp_photo' => $profilephotoName,
                    ]);
                }
                //Employee CV
                if ($request->hasFile('emp_cv')) {
                    // Delete the old CV if it exists
                    if (!empty($employee->emp_cv)) {
                        $oldCvPath = public_path('assets/employee_cv/' . $employee->emp_cv);
                        if (file_exists($oldCvPath)) {
                            unlink($oldCvPath);
                        }
                    }
                    $cv = $request->file('emp_cv');
                    $cvName = time() . '.' . $cv->getClientOriginalExtension();
                    $cv->move(public_path('assets/employee_cv'), $cvName);
                    // Update the database
                    $employee->update([
                        'emp_cv' => $cvName,
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
                        $destinationPath = public_path('assets/employee_documents');
                        // Create the folder if it doesn't exist
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0755, true);
                        }
                        $fileName = $emp_id . '_' . time() . '_' . $file->getClientOriginalName();
                        $file->move($destinationPath, $fileName);
                        EmployeeDocument::create([
                            'emp_id'       => $emp_id,
                            'emp_document' => $fileName,
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
            ->where('status', '0')
            ->where('is_deleted', 0)
            ->get();
        return response()->json($teamLeads);
    }

    public function getaddSeniorEmployees($teamLeadId)
    {
        $seniorEmployees = Employee::where('team_lead_id', $teamLeadId)->where('state', 3)->get();
        return response()->json($seniorEmployees);
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
}
