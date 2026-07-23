<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div>
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="row">
            <div class="col">
                <div class="page-title-box">
                    <!-- <h2 class="page-title font-weight-bold text-uppercase">Students Details</h2> -->
                </div>
                @include('include.alert')
                @include('livewire/alert')
            </div>
        </div>
        <!-- End page title -->

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <!-- <h4 class="header-title mb-0 text-uppercase">Manage Students</h4> -->
                            <h3 class="mt-1">Total Students: {{ $totalStudents }}</h3>
                        </div>
                        <a href="{{ route('add-student') }}" class="btn btn-sm btn-primary waves-effect waves-light">
                            <i class="mdi mdi-plus-circle"></i> Add Student
                        </a>
                    </div>

                    <!-- Filters and Search -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="d-flex">
                                    <!-- Entries per page -->
                                    <div class="form-group mb-2 mr-4">
                                        <label class="mb-0">Show entries</label>
                                        <select wire:model.live.debounce.300ms="perPage" aria-controls="students-table" class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>

                                    <!-- Payment Status Filter -->
                                    <div class="form-group mb-2 mr-4">
                                        <label for="paymentStatusFilter" class="mb-0">Payment Status:</label>
                                        <select wire:model.live="filterPaymentStatus" id="paymentStatusFilter" class="form-control form-control-sm">
                                            <option value="">All</option>
                                            <option value="paid">Paid</option>
                                            <option value="unpaid">Unpaid</option>
                                            <!-- <option value="" {{ $this->filterPaymentStatus == '' ? 'selected' : '' }}>All</option>
                                            <option value="paid" {{ $this->filterPaymentStatus == 'paid' ? 'selected' : '' }}>Paid..</option>
                                            <option value="unpaid" {{ $this->filterPaymentStatus == 'unpaid' ? 'selected' : '' }}>Unpaid..</option> -->
                                        </select>
                                    </div>

                                    <!-- Course Filter -->
                                    <div class="form-group mb-2 mr-4">
                                        <label for="courseFilter" class="mb-0">Course:</label>
                                        <select wire:model.live="filterCourse" id="courseFilter" class="form-control form-control-sm">
                                            <option value="">All</option>
                                            <option value="Fullstack">Fullstack</option>
                                            <option value="Frontend">Frontend</option>
                                            <option value="Backend">Backend</option>
                                        </select>
                                    </div>
                                    <!-- Gender Filter -->
                                    <div class="form-group mb-2 mr-4">
                                        <label for="genderFilter" class="mb-0">Gender:</label>
                                        <select wire:model.live="filterGender" id="genderFilter" class="form-control form-control-sm">
                                            <option value="">All</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Search -->
                                <div class="form-group mb-2">
                                    <label class="mb-0">Search:</label>
                                    <input type="text" wire:model.live.debounce.250ms="searchTerm" placeholder="Search..." class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($students !== null && $students->isEmpty())
                        <h3>No results found.</h3>
                    @else
                    <!-- Students Table -->
                    <div style="overflow-y: auto; height: 365px;" class='table-responsive shadow-sm'>
                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100 table-bordered" id="students-table">
                            <thead class="thead-dark text-center" style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Enrollments</th>
                                    <th>Full Name</th>
                                    <th>Details</th>
                                    <th>Academic Info</th>
                                    <th>Payment Status</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td><b>{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}</b></td>
                                    <!-- Enrollments -->
                                    <td>
                                        <strong>{!! $this->highlight($student->enrollment_number ?? 'N/A') !!}</strong>
                                    </td>
                                    <!-- Full Name With Image-->
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ $student->photo_path ? asset('storage/' . $student->photo_path) : asset('assets/images/users/Guest-user.png') }}" alt="Image" class="rounded-circle" style="height:42px; width:42px;"/>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <strong>{!! $this->highlight($student->full_name) !!}</strong>
                                        </div>
                                    </td>
                                    <!-- Details: Mobile, Address -->
                                    <td>
                                        <ul class="list-unstyled">
                                            <li><b>Mobile:</b> {!! $this->highlight($student->mobile_number) !!}</li>
                                            <li><b>Address:</b> {!! $this->highlight($student->address) !!}</li>
                                            <li><b>DOB:</b> {{ $student->date_of_birth }}</li>
                                            <!-- <li><b>Enrollment No.:</b> {{ $student->enrollment_number }}</li> -->
                                        </ul>
                                    </td>
                                    <!-- Academic Info -->
                                    <td>
                                        <ul class="list-unstyled">
                                            <li><b>Course:</b> {!! $this->highlight($student->course_name) !!}</li>
                                            <li><b>Admission Date:</b> {{ $student->admission_date }}</li>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        @if ($student->payment_status == 'paid')
                                            <span class="badge badge-success" style="font-size: 12px; padding: 8px 12px;">Paid</span>
                                        @else
                                            <span type="button" wire:click="payFees({{ $student->id }})" class="badge badge-danger" style="font-size: 12px; padding: 8px 12px;">Unpaid</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a class="btn px-1" href="{{ route('edit-student', ['id' => $student->id]) }}">
                                                <i class="mdi mdi-pencil text-info font-18 vertical-middle"></i>
                                            </a>
                                            
                                            <button type="button" class="btn px-1" data-toggle="modal" data-bs-target="#deleteStudentModal" wire:click="deleteStudentPopup({{ $student->id }})">
                                                <i class="mdi mdi-delete text-danger font-18 vertical-middle"></i>
                                            </button>



                                                        {{-- Print button --}}
                                                        <a class="btn px-1" href="{{ route('print-student', ['id' => $student->id]) }}"><i
                                                            class="mdi mdi-printer text-success font-18 vertical-middle"></i>
                                                        </a>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @include('livewire/delete-student-modal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $students->links() }}
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
</div>

<!-- Script to show delete modal -->
@script
<script>
    $wire.on('studentpopupshow', () => {
        $('#deleteStudentModal').modal('show');
    });
</script>
@endscript