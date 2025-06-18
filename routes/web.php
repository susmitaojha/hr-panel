<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AttendanceController;

route::get('/',[AuthController::class,'login']);
route::get('/admin',[AuthController::class,'login']);
route::get('/registration',[AuthController::class,'registration']);
route::post('/post-registration',[AuthController::class,'postRegistration']);
route::post('/post-login',[AuthController::class,'postLogin']);
route::get('/logout',[AuthController::class,'logout']);

route::get('/home',[EmployeeController::class,'index']);
route::get('/all-employee',[EmployeeController::class,'viewEmployee']);
route::get('/all-terminated-employee',[EmployeeController::class,'viewTerminatedEmployee']);
route::get('/all-closed-employee',[EmployeeController::class,'viewClosedEmployee']);
route::get('/employee-details/{id}',[EmployeeController::class,'employeeViewdetails']);
route::get('/employee-salary-stracture/{id}',[EmployeeController::class,'salaryStracture']);
route::get('/employee-pay-slip/{id}',[EmployeeController::class,'paySlip']);
Route::get('/add-edit-employee/{id}', [EmployeeController::class, 'addEditEmployee']);
route::post('/post-add-employee',[EmployeeController::class,'addpostEmployee']);
Route::delete('/employee-delete-documents/{id}', [EmployeeController::class, 'empDocDestroy']);
Route::get('/delete-employee/{id}', [EmployeeController::class, 'deleteEmployee']);
Route::get('/get-team-leads/{managerId}', [EmployeeController::class, 'getaddTeamLeads']);
Route::get('/get-senior-employees/{teamLeadId}', [EmployeeController::class, 'getaddSeniorEmployees']);
Route::get('/employee-salary-stracture/pdf/{id}', [EmployeeController::class, 'downloadSalaryStracturePdf']);
Route::get('employee-pay-slip-pdf/{id}', [EmployeeController::class, 'downloadPayslip']);
route::post('/bonus-store/',[EmployeeController::class,'postEmployeeBonusStore']);
Route::get('/fetch-employee-bonus', [EmployeeController::class, 'fetchBonus']);

route::get('/junior-employee',[EmployeeController::class,'displayjunior']);
route::get('/senior-employee',[EmployeeController::class,'displaysenior']);
route::get('/team-lead',[EmployeeController::class,'displayteamlead']);
route::get('/employee-form',[EmployeeController::class,'employeeForm']);
route::get('/teamlead-form',[EmployeeController::class,'teamleadForm']);
route::get('/employee/{id}/edit',[EmployeeController::class,'edit'])->name('employee.edit');
route::put('/employee/{id}',[EmployeeController::class,'update'])->name('employee.update');
route::delete('/employee/{id}',[EmployeeController::class,'deleteEmployee'])->name('employee.delete');

route::get('/attendence',[AttendanceController::class,'attendence']);
route::get('/attendence-list',[AttendanceController::class,'attendenceList']);
Route::get('/attendence/{id}', [AttendanceController::class, 'show']);
Route::post('/attendance-store', [AttendanceController::class, 'store']);

route::get('/view-project',[ProjectController::class,'index']);
route::get('/add-edit-project/{id}',[ProjectController::class,'appEditProject']);
route::post('/post-add-edit-project',[ProjectController::class,'addProject']);
Route::get('/delete-project/{id}', [ProjectController::class, 'deleteProject']);
route::get('/assign-project/{id}',[ProjectController::class,'assignProject']);
route::post('/post-assign-employees',[ProjectController::class,'postAssignEmployees']);




