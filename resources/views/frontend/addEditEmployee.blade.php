@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
@endphp
<!-- Sidebar -->
@include('frontend.common.sidebar')
<!-- End Sidebar -->
@include('frontend.common.navbar')

<style>
    .image-container {
        position: relative;
        display: inline-block;
        margin: 5px;
    }

    .image-container img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .remove-icon {
        position: absolute;
        top: 2px;
        right: 6px;
        background: rgba(255, 0, 0, 0.8);
        color: white;
        font-weight: bold;
        padding: 2px 6px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 16px;
        line-height: 1;
    }

    .remove-icon:hover {
        background: red;
    }
</style>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Employee Management</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add Employee</div>
                    </div>
                    <form action="/post-add-employee" method="post" id="add-employee" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="emp_id"
                                value="{{ !empty($editEmployee->id) ? $editEmployee->id : 0 }}">

                            <!-- Row 1 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="fname" class="form-control"
                                            value="{{ !empty($editEmployee->fname) ? $editEmployee->fname : '' }}"
                                            placeholder="Enter First Name" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input type="text" name="mname" class="form-control"
                                            value="{{ !empty($editEmployee->mname) ? $editEmployee->mname : '' }}"
                                            placeholder="Enter Middle Name" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="lname" class="form-control"
                                            value="{{ !empty($editEmployee->lname) ? $editEmployee->lname : '' }}"
                                            placeholder="Enter Last Name" />
                                    </div>
                                </div>
                            </div>

                            <!-- Row 2 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ !empty($editEmployee->email) ? $editEmployee->email : '' }}"
                                            placeholder="Enter Email" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of birth</label>
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ $editEmployee->dob ? Carbon::parse($editEmployee->dob)->format('Y-m-d') : '' }}" placeholder="Enter Date of birth" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date Joined</label>
                                        <input type="date" name="joining_date" class="form-control"
                                            value="{{ $editEmployee->joining_date ? Carbon::parse($editEmployee->joining_date)->format('Y-m-d') : '' }}"
                                            placeholder="Enter Date Joined" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <input type="text" name="department" class="form-control"
                                            value="{{ !empty($editEmployee->department) ? $editEmployee->department : '' }}"
                                            placeholder="Enter Department" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <select class="form-control" name="role">
                                            <option value="">Select Designation</option>
                                            <option value="1"
                                                {{ !empty($editEmployee->role) && $editEmployee->role == '1' ? 'selected' : '' }}>
                                                Manager</option>
                                            <option value="2"
                                                {{ !empty($editEmployee->role) && $editEmployee->role == '2' ? 'selected' : '' }}>
                                                Team Lead</option>
                                            <option value="3"
                                                {{ !empty($editEmployee->role) && $editEmployee->role == '3' ? 'selected' : '' }}>
                                                Senior Employee</option>
                                            <option value="4"
                                                {{ !empty($editEmployee->role) && $editEmployee->role == '4' ? 'selected' : '' }}>
                                                Junior Employee</option>
                                            <option value="5"
                                                {{ !empty($editEmployee->role) && $editEmployee->role == '5' ? 'selected' : '' }}>
                                                HR</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <!-- Row 3 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Manager Name</label>
                                        <select class="form-control" name="managerid" id = "managerid">
                                            <option value="">Select Manager</option>
                                            @foreach ($mangerdata as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ !empty($editEmployee->managerid) && $editEmployee->managerid == $item->id ? 'selected' : '' }}>
                                                    {{ $item->fname }} {{ $item->mname }} {{ $item->lname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Team Lead</label>
                                        <select class="form-control" name="teamLeadid" id = "teamLeadSelect"
                                            data-selected-teamlead="{{ $editEmployee->team_lead_id ?? '' }}">
                                            <option value="">Select Team Lead</option>
                                            @foreach ($teamleaddata as $tlitem)
                                                <option value="{{ $tlitem->id }}"
                                                    {{ !empty($editEmployee->team_lead_id) && $editEmployee->team_lead_id == $tlitem->id ? 'selected' : '' }}>
                                                    {{ $tlitem->fname }} {{ $tlitem->mname }} {{ $tlitem->lname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control" name="contact_no"
                                            value="{{ !empty($editEmployee->contact_no) ? $editEmployee->contact_no : '' }}"
                                            placeholder="Enter Mobile No." />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Passport Size Photo</label>
                                        <input type="file" name="emp_photo" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- Row 4 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upload CV</label>
                                        <input type="file" name="emp_cv" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Gender</label>
                                    <div class="d-flex gap-3 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender"
                                                value="Male" id="genderMale"
                                                {{ !empty($editEmployee->gender) && $editEmployee->gender == 'Male' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="genderMale">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender"
                                                value="Female" id="genderFemale"
                                                {{ !empty($editEmployee->gender) && $editEmployee->gender == 'Female' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="genderFemale">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>Upload Documents (pdf only) Maximum 5 documents allowed </label>
                                        <div id="fileInputsContainer">
                                            <div class="file-input-group d-flex align-items-center mb-2">
                                                <input type="file" name="doc_file[]" class="form-control me-2">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="removeFileInput(this)">−</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="limitMessage" class="text-danger mt-2" style="display: none;">Maximum 5
                                        documents allowed.</div>
                                </div>
                            </div>
                            <button type="button" onclick="addFileInput()"
                                class="btn btn-primary btn-round mt-2">Add More Documents</button>

                            @if (!empty($editEmployee->id))
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Employee Documents</h4>
                                            <div class="row">
                                                <div id="product-images" class="col-md-12 mt-4">
                                                    @foreach ($employeeImage as $empImagerow)
                                                        @php
                                                            $file = $empImagerow->emp_document;
                                                            $filePath = asset($file);
                                                            $extension = Str::lower(
                                                                pathinfo($file, PATHINFO_EXTENSION),
                                                            );
                                                        @endphp
                                                        <div class="image-container single_image"
                                                            data-id="{{ $empImagerow->id }}">
                                                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                                <img src="{{ $filePath }}" class="img-thumbnail"
                                                                    style="width: 120px; height: 120px;">
                                                            @else
                                                                <a href="{{ $filePath }}" target="_blank">
                                                                    <img src="{{ asset('assets/img/pdf-icon.png') }}"
                                                                        class="img-thumbnail"
                                                                        style="width: 50px; height: 50px;"
                                                                        title="View PDF">
                                                                </a>
                                                            @endif
                                                            <span class="remove-icon"
                                                                onclick="removeEmpDocuments({{ $empImagerow->id }})">&times;</span>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-header">
                            <div class="card-title">Employee Address</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="addressLine1" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="addressLine1"
                                        name = "address_line1" placeholder="House No, Street Name"
                                        value="{{ !empty($editEmployee->address_line1) ? $editEmployee->address_line1 : '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address_line2" class="form-label">Address Line 2</label>
                                    <input type="text" class="form-control" id="address_line2"
                                        name = "address_line2"
                                        value="{{ !empty($editEmployee->address_line2) ? $editEmployee->address_line2 : '' }}"
                                        placeholder="Landmark (optional)">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City/Town</label>
                                    <input type="text" class="form-control" id="city" name = "city"
                                        value="{{ !empty($editEmployee->city) ? $editEmployee->city : '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="district" class="form-label">District</label>
                                    <input type="text" class="form-control" id="district" name = "district"
                                        value="{{ !empty($editEmployee->district) ? $editEmployee->district : '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <select class=" form-control form-select" id="state" name="state">
                                        <option selected disabled>Choose...</option>
                                        <option value="Andhra Pradesh"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Andhra Pradesh' ? 'selected' : '' }}>
                                            Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Arunachal Pradesh' ? 'selected' : '' }}>
                                            Arunachal Pradesh</option>
                                        <option value="Assam"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Assam' ? 'selected' : '' }}>
                                            Assam</option>
                                        <option value="Bihar"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Bihar' ? 'selected' : '' }}>
                                            Bihar</option>
                                        <option value="Chhattisgarh"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Chhattisgarh' ? 'selected' : '' }}>
                                            Chhattisgarh</option>
                                        <option value="Goa"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Goa' ? 'selected' : '' }}>
                                            Goa</option>
                                        <option value="Gujarat"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Gujarat' ? 'selected' : '' }}>
                                            Gujarat</option>
                                        <option value="Haryana"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Haryana' ? 'selected' : '' }}>
                                            Haryana</option>
                                        <option value="Himachal Pradesh"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Himachal Pradesh' ? 'selected' : '' }}>
                                            Himachal Pradesh</option>
                                        <option value="Jharkhand"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Jharkhand' ? 'selected' : '' }}>
                                            Jharkhand</option>
                                        <option value="Karnataka"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Karnataka' ? 'selected' : '' }}>
                                            Karnataka</option>
                                        <option value="Kerala"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Kerala' ? 'selected' : '' }}>
                                            Kerala</option>
                                        <option value="Madhya Pradesh"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Madhya Pradesh' ? 'selected' : '' }}>
                                            Madhya Pradesh</option>
                                        <option value="Maharashtra"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Maharashtra' ? 'selected' : '' }}>
                                            Maharashtra</option>
                                        <option value="Manipur"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Manipur' ? 'selected' : '' }}>
                                            Manipur</option>
                                        <option value="Meghalaya"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Meghalaya' ? 'selected' : '' }}>
                                            Meghalaya</option>
                                        <option value="Mizoram"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Mizoram' ? 'selected' : '' }}>
                                            Mizoram</option>
                                        <option value="Nagaland"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Nagaland' ? 'selected' : '' }}>
                                            Nagaland</option>
                                        <option value="Odisha"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Odisha' ? 'selected' : '' }}>
                                            Odisha</option>
                                        <option value="Punjab"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Punjab' ? 'selected' : '' }}>
                                            Punjab</option>
                                        <option value="Rajasthan"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Rajasthan' ? 'selected' : '' }}>
                                            Rajasthan</option>
                                        <option value="Sikkim"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Sikkim' ? 'selected' : '' }}>
                                            Sikkim</option>
                                        <option value="Tamil Nadu"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Tamil Nadu' ? 'selected' : '' }}>
                                            Tamil Nadu</option>
                                        <option value="Telangana"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Telangana' ? 'selected' : '' }}>
                                            Telangana</option>
                                        <option value="Tripura"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Tripura' ? 'selected' : '' }}>
                                            Tripura</option>
                                        <option value="Uttar Pradesh"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Uttar Pradesh' ? 'selected' : '' }}>
                                            Uttar Pradesh</option>
                                        <option value="Uttarakhand"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Uttarakhand' ? 'selected' : '' }}>
                                            Uttarakhand</option>
                                        <option value="West Bengal"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'West Bengal' ? 'selected' : '' }}>
                                            West Bengal</option>
                                        <option value="Andaman and Nicobar Islands"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Andaman and Nicobar Islands' ? 'selected' : '' }}>
                                            Andaman and Nicobar Islands</option>
                                        <option value="Chandigarh"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Chandigarh' ? 'selected' : '' }}>
                                            Chandigarh</option>
                                        <option value="Dadra Nagar Haveli & Daman Diu"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Dadra Nagar Haveli & Daman Diu' ? 'selected' : '' }}>
                                            Dadra Nagar Haveli & Daman Diu</option>
                                        <option value="Delhi"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Delhi' ? 'selected' : '' }}>
                                            Delhi</option>
                                        <option value="Jammu and Kashmir"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Jammu and Kashmir' ? 'selected' : '' }}>
                                            Jammu and Kashmir</option>
                                        <option value="Ladakh"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Ladakh' ? 'selected' : '' }}>
                                            Ladakh</option>
                                        <option value="Lakshadweep"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Lakshadweep' ? 'selected' : '' }}>
                                            Lakshadweep</option>
                                        <option value="Puducherry"
                                            {{ !empty($editEmployee->state) && $editEmployee->state == 'Puducherry' ? 'selected' : '' }}>
                                            Puducherry</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="pincode" class="form-label">PIN Code</label>
                                    <input type="text" class="form-control" id="pincode" name = "pincode"
                                        maxlength="6"
                                        value="{{ !empty($editEmployee->pincode) ? $editEmployee->pincode : '' }}"
                                        pattern="\d{6}" placeholder="e.g. 560001" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="card-title">Salary Details</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>Basic</label>
                                        <input type="number" class="form-control salary" id="sal-1"
                                            value="{{ !empty($employeeSalary->basic) ? $employeeSalary->basic : '' }}"
                                            name = "basic" placeholder="0" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>HRA</label>
                                        <input type="number" class="form-control salary" id="sal-2"
                                            value="{{ !empty($employeeSalary->hra) ? $employeeSalary->hra : '' }}"
                                            name = "hra" placeholder="0" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>Conv. All</label>
                                        <input type="number" class="form-control salary" id="sal-3"
                                            value="{{ !empty($employeeSalary->conv_allowance) ? $employeeSalary->conv_allowance : '' }}"
                                            name = "conv_all" placeholder="0" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>Trans. All</label>
                                        <input type="number" class="form-control salary" id="sal-4"
                                            value="{{ !empty($employeeSalary->trans_allowance) ? $employeeSalary->trans_allowance : '' }}"
                                            name = "trans_all" placeholder="0" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>Others</label>
                                        <input type="number" class="form-control salary" id="sal-5"
                                            value="{{ !empty($employeeSalary->others) ? $employeeSalary->others : '' }}"
                                            name = "others" placeholder="0" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>Medical Allowance</label>
                                        <input type="number" class="form-control salary" id="sal-6"
                                            value="{{ !empty($employeeSalary->medical_allowance) ? $employeeSalary->medical_allowance : '' }}"
                                            name = "medical_allowance" placeholder="0" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>PF Employer</label>
                                        <input type="number" class="form-control salary" id="sal-7"
                                            value="{{ !empty($employeeSalary->pf_employer) ? $employeeSalary->pf_employer : '' }}"
                                            name = "pf_employer" placeholder="0" />
                                    </div>

                                    <div class="form-group">
                                        <label>ESI Employer</label>
                                        <input type="number" class="form-control salary" id="sal-9"
                                            value="{{ !empty($employeeSalary->esi_employer) ? $employeeSalary->esi_employer : '' }}"
                                            name = "esi_employer" placeholder="0" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>Other Benefits</label>
                                        <input type="number" class="form-control salary" id="sal-10"
                                            value="{{ !empty($employeeSalary->other_benefits) ? $employeeSalary->other_benefits : '' }}"
                                            name="other_benefits" placeholder="0" />
                                    </div>
                                    <div class="form-group">
                                        <label>Bonus</label>
                                        <input type="number" class="form-control salary" id="sal-8"
                                            value="{{ !empty($employeeSalary->bonus) ? $employeeSalary->bonus : '' }}"
                                            name = "bonus" placeholder="0" />
                                    </div>
                                    <div class="form-group">
                                        <label for="variablePay"></label>
                                        <button type="button" class="btn btn-success"
                                            id="calculateBtn">Calculate</button>
                                        {{-- <button type="button" class="btn btn-danger"
                                                id="downloadBtn">Download</button> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Salary(Nett.)</label>
                                        <input type="number" class="form-control" id="resultField" placeholder="0"
                                            value="{{ !empty($employeeSalary->salary_nett) ? $employeeSalary->salary_nett : '' }}"
                                            name="resultField" readonly />
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Increment(%)</label>
                                        <input type="number" class="form-control" id="increment" placeholder="0"
                                            value="{{ !empty($employeeSalary->increment_percent) ? $employeeSalary->increment_percent : '' }}"
                                            name="increment" readonly />
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Salary</label>
                                        <input type="number" class="form-control" id="incrementSalary"
                                            name="incrementSalary" placeholder="0" name="fixedsalary"
                                            value="{{ !empty($employeeSalary->incremented_salary) ? $employeeSalary->incremented_salary : '' }}"
                                            readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.common.footer')

    <script>
        document.getElementById('add-employee').addEventListener('submit', function(e) {
            let isValid = true;
            let messages = [];

            // Helper to check if input is empty
            function checkRequired(name, label) {
                const field = document.querySelector(`[name="${name}"]`);
                if (!field || !field.value.trim()) {
                    isValid = false;
                    messages.push(`${label} is required.`);
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            }
            // Check text fields
            checkRequired('fname', 'First Name');
            checkRequired('lname', 'Last Name');
            checkRequired('email', 'Email Address');
            checkRequired('department', 'Department');
            checkRequired('state', 'Designation');
            //checkRequired('managerid', 'Manager');
            //checkRequired('teamLeadid', 'Team Lead');
            //checkRequired('seniorEmployeeid', 'Senior Employee');
            checkRequired('contact_no', 'Mobile');

            // Optional: validate email format
            const email = document.querySelector('[name="email"]');
            if (email && email.value.trim() && !/^\S+@\S+\.\S+$/.test(email.value)) {
                isValid = false;
                messages.push("Invalid email format.");
                email.classList.add('is-invalid');
            }

            // Optional: mobile number format
            const mobile = document.querySelector('[name="contact_no"]');
            if (mobile && mobile.value.trim() && !/^\d{10}$/.test(mobile.value)) {
                isValid = false;
                messages.push("Mobile number must be 10 digits.");
                mobile.classList.add('is-invalid');
            }

            // If not valid, stop form submission and show alert
            if (!isValid) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: messages.join('<br>'),
                });
            }
        });

        $('#calculateBtn').on('click', function() {
            let sum = 0;
            $('.salary').each(function() {
                sum += parseFloat($(this).val()) || 0;
            })
            $('#resultField').val(sum);
            $('#incrementSalary').val(sum);

            let passMark = document.getElementById("mark").value
            let besic = document.getElementById("sal-1").value
            if (passMark > 0) {
                let increment = document.getElementById("increment").value
                let afterIncrement = 0
                let finalSalary = 0
                afterIncrement = (besic * increment) / 100
                finalSalary = sum + afterIncrement
                document.getElementById("incrementSalary").value = finalSalary;
            }
        });

        function addFileInput() {
            const container = document.getElementById('fileInputsContainer');
            const currentInputs = container.querySelectorAll('.file-input-group');

            if (currentInputs.length >= 5) {
                document.getElementById('limitMessage').style.display = 'block';
                return;
            }
            const newInputGroup = document.createElement('div');
            newInputGroup.className = 'file-input-group d-flex align-items-center mb-2';

            newInputGroup.innerHTML = `
            <input type="file" name="doc_file[]" class="form-control me-2">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeFileInput(this)">−</button>
        `;

            container.appendChild(newInputGroup);
            // Hide the limit message if it was showing before
            document.getElementById('limitMessage').style.display = 'none';
        }

        function removeFileInput(button) {
            const group = button.closest('.file-input-group');
            group.remove();
            // Hide limit message if inputs are below the limit after removal
            const container = document.getElementById('fileInputsContainer');
            const currentInputs = container.querySelectorAll('.file-input-group');
            if (currentInputs.length < 5) {
                document.getElementById('limitMessage').style.display = 'none';
            }
        }

        function removeEmpDocuments(docId) {
            Swal.fire({
                title: 'Delete this document?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url('employee-delete-documents') }}/' + docId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.success) {
                                $(`.image-container[data-id='${docId}']`).remove();
                                Swal.fire('Deleted!', '', 'success');
                            } else {
                                Swal.fire('Failed to delete.', '', 'error');
                            }
                        },
                        error: () => Swal.fire('Error occurred.', '', 'error')
                    });
                }
            });
        }

        $(document).ready(function() {
            // When manager is selected
            $('#managerid').on('change', function() {
                var managerId = $(this).val();

                if (managerId) {
                    $.ajax({
                        url: '/get-team-leads/' + managerId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#teamLeadSelect').empty().append(
                                '<option value="">Select Team Lead</option>');
                            $.each(data, function(key, value) {
                                $('#teamLeadSelect').append(
                                    '<option value="' + value.id + '">' +
                                    value.fname + ' ' +
                                    (value.mname ? value.mname + ' ' : '') +
                                    value.lname +
                                    '</option>'
                                );
                            });
                        }
                    });
                }
            });

        });
    </script>
    </body>

    </html>
