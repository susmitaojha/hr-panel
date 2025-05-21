<!-- Sidebar -->
@include('frontend.common.sidebar')
<!-- End Sidebar -->
@include('frontend.common.navbar')
@php use Illuminate\Support\Str; @endphp
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
                                            <option value="">Select Role</option>
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
                                                    {{ !empty($project->managerid) && $project->managerid == $item->id ? 'selected' : '' }}>
                                                    {{ $item->fname }} {{ $item->mname }} {{ $item->lname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Team Lead</label>
                                        <select class="form-control" name="teamLeadid" id = "teamLeadSelect">
                                            <option value="">Select Team Lead</option>
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
                                        <label>Skills</label>
                                        <textarea class="form-control" name="skills" rows="3" placeholder="Enter Skills">{{ !empty($editEmployee->skills) ? $editEmployee->skills : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Gender</label>
                                    <div class="d-flex gap-3 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="Male"
                                                id="genderMale"
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
                                    <div id="limitMessage" class="text-danger mt-2" style="display: none;">Maximum 5 documents allowed.</div>
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
                                                            <span class="remove-icon" onclick="removeEmpDocuments({{ $empImagerow->id }})">&times;</span>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.common.footer')

<script>
    document.getElementById('add-employee').addEventListener('submit', function (e) {
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
        checkRequired('role', 'Designation');
        checkRequired('managerid', 'Manager');
        checkRequired('teamLeadid', 'Team Lead');
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

    $(document).ready(function () {
        // When manager is selected
        $('#managerid').on('change', function () {
            var managerId = $(this).val();

            if (managerId) {
                $.ajax({
                    url: '/get-team-leads/' + managerId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#teamLeadSelect').empty().append('<option value="">Select Team Lead</option>');
                        $('#seniorEmployeeSelect').empty().append('<option value="">Select Senior Employee</option>');
                        $.each(data, function (key, value) {
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
