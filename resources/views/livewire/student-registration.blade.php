<div class="container-fluid pt-4">
    @php
        // Step variable ke hisab se rendering
    @endphp

    @if ($step == 1)
        {{-- Student Registration Form --}}
        <!-- aapka current form code yahan rahega -->

        
        <!-- Course Details Header -->
        <div class="card" style="max-height: 78vh; overflow-y: auto;">
            <div class="card-body p-3">
                <!-- Student Registration Header -->
                <!-- <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="font-weight-bold text-uppercase" style="font-size: 28px;">Student Registration</h4>
                    
                </div> -->

                

                <form wire:submit.prevent="submit" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">

                    <!-- Personal Info Section -->
                    <div class="mb-4 border p-4 rounded">
                        <h5 class="mb-3 font-weight-bold">Personal Information</h5>
                        <div class="row">
                            <div class="col-md-10 mb-3">
                                <div class="row">
                                    <!-- First Name -->
                                    <div class="col-md-4 mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control border-bottom" id="first_name" wire:model="first_name" placeholder="Enter first name" required>
                                        @error('first_name') <div class="text-danger small">{{ $message }}</div> @enderror
                                    </div>
                                    <!-- Last Name -->
                                    <div class="col-md-4 mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control border-bottom" id="last_name" wire:model="last_name" placeholder="Enter last name" required>
                                        @error('last_name') <div class="text-danger small">{{ $message }}</div> @enderror
                                    </div>
                                    <!-- Gender -->
                                    <div class="col-md-4 mb-3">
                                        <label for="gender" class="form-label">Select Gender</label>
                                        <select id="gender" class="form-control border-bottom" wire:model="gender" required>
                                            <option value="">--Select Gender--</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @error('gender') <div class="text-danger small">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Father Name -->
                                    <div class="col-md-4">
                                        <label for="father_name" class="form-label">Father Name</label>
                                        <input type="text" class="form-control border-bottom" id="father_name" wire:model="father_name" placeholder="Enter your father name" required>
                                        @error('father_name') <div class="text-danger small">{{ $message }}</div> @enderror
                                    </div>
                                    <!-- Mobile Number -->
                                    <div class="col-md-4">
                                        <label for="mobile_number" class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control border-bottom" id="mobile_number" wire:model="mobile_number" placeholder="Enter mobile number" required>
                                        @error('mobile_number') <div class="text-danger small">{{ $message }}</div> @enderror
                                    </div>
                                    <!-- Date of Birth -->
                                    <div class="col-md-4">
                                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control border-bottom" id="date_of_birth" wire:model="date_of_birth" required>
                                        @error('date_of_birth') <div class="text-danger small">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Photo -->
                            <div class="mb-3">
                                <div id="photo-upload" class="dashed-border rounded d-flex align-items-center justify-content-center position-relative" style="width: 130px; height: 154px; border: 2px dashed #999; cursor: pointer; overflow: hidden;">
                                    <!-- Jab upload nahi ho raha ho -->
                                    <div wire:loading.remove wire:target="photo" style="text-align:center;">
                                        @if(!$photoPreview)
                                            <i data-feather="user" style="font-size: 30px; color: #555;"></i>
                                            <div class="mt-2">Upload Photo</div>
                                        @endif
                                    </div>

                                    <!-- Jab upload ho raha ho (loading indicator) -->
                                    <div wire:loading wire:target="photo" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                        <!-- Bootstrap spinner -->
                                        <div class="spinner-border text-primary" role="status" style="width: 2rem; height: 2rem;">
                                        </div>
                                        <!-- <span class="visually-hidden">Loading...</span> -->
                                    </div>

                                    <!-- Photo preview -->
                                    @if($photoPreview)
                                        <img src="{{ $photoPreview }}" style="width:100%; height:100%; object-fit:cover;">
                                    @endif

                                    <!-- Hidden file input -->
                                    <input type="file" accept="image/*" wire:model="photo" style="position:absolute; inset:0; width:100%; height:100%; opacity:0; cursor:pointer;">
                                </div>
                                @error('photo') <div class="text-danger small mt-1 text-center">{{ $message }}</div> @enderror
                            </div>
                            
                        </div>

                        <!-- Address Fields -->
                        <div class="row mb-3">
                            <!-- State Dropdown -->
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <select class="form-control border-bottom" id="state" name="addressField[state]" wire:model.live="selectedState">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state['name'] ?? $state }}">{{ $state['name'] ?? $state }}</option>
                                    @endforeach
                                </select>
                                @error('addressField.state') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <!-- City Dropdown -->
                            <div class="col-md-4">
                                <label for="city" class="form-label">City</label>
                                <select class="form-control border-bottom" id="city" name="addressField[city]" wire:model.live="selectedCity">
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city['name'] ?? $city }}">{{ $city['name'] ?? $city }}</option>
                                    @endforeach
                                </select>
                                @error('addressField.city') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <!-- Pincode Input -->
                            <div class="col-md-4">
                                <label for="pincode" class="form-label">Pincode</label>
                                <input type="text" class="form-control border-bottom" id="pincode" wire:model="addressField.pincode" placeholder="Enter Pincode">
                                @error('addressField.pincode') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>


                        <!-- Address -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control border-bottom" id="address" wire:model="address" placeholder="Enter address" required>
                                @error('address') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                        

                        <!-- Next Buttons -->
                        <div class="pb-3 d-flex justify-content-end" style="gap: 15px;">
                            <button type="reset" class="btn btn-secondary" wire:click="resetForm">Reset</button>
                            <button type="button" class="btn btn-primary" wire:click="nextStep">Next</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>


    @elseif ($step == 2)
        {{-- Payment Options --}}
        <div class="card">
            <div class="card-body">

                <!-- Course Details -->
                <div class="mb-4 border p-4 rounded">
                    <h5 class="mb-3 font-weight-bold">Course Details</h5>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="row">
                                <!-- Admission Date -->
                                <div class="col-md-6 mb-3">
                                    <label for="admission_date" class="form-label">Admission Date</label>
                                    <input type="date" class="form-control border-bottom" id="admission_date" wire:model="admission_date" required>
                                    @error('admission_date') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                                <!-- Course Select -->
                                <div class="col-md-6 mb-3">
                                    <label for="course" class="form-label">Select Course</label>
                                    <select id="course" class="form-control border-bottom" wire:model.live="course" required>
                                        <option value="">--Select Course--</option>
                                        <option value="Fullstack">Fullstack Course</option>
                                        <option value="Backend">Backend Course</option>
                                        <option value="Frontend">Frontend Course</option>
                                    </select>
                                    @error('course') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Laptop Checkbox -->
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="with_laptop" wire:model.live="withLaptop" value="1">
                                        <label class="form-check-label" for="with_laptop">With Laptop (+₹15,000)</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- Placement Support Checkbox -->
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="earning_placement_support" wire:model.live="withPlacementSupport" value="1">
                                        <label class="form-check-label" for="earning_placement_support">Earning/Placement Support (+₹5,000)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <!-- Charges Summary -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Charges Summary</label>
                                    <div class="border p-2 rounded">
                                        <!-- Course Fee with course name -->
                                        <p class="mb-1 d-flex justify-content-between">
                                            <span>Course ({{ $course ?? 'N/A' }}) Fee:</span>
                                            <span>₹{{ $courseFee ?? 0 }}</span>
                                        </p>
                                        <!-- Laptop Charge -->
                                        <p class="mb-1 d-flex justify-content-between">
                                            <span>Laptop Charge:</span>
                                            <span>₹{{ $withLaptop ? $laptopCharge : 0 }}</span>
                                        </p>
                                        <!-- Earning/Placement Support -->
                                        <p class="mb-1 d-flex justify-content-between">
                                            <span>Earning/Placement Support:</span>
                                            <span>₹{{ $withPlacementSupport ? $placementSupportFee : 0 }}</span>
                                        </p>
                                        <hr>
                                        <!-- Total -->
                                        <h5 class="d-flex justify-content-between">
                                            <span>Total:</span>
                                            <span>₹{{ $totalAmount ?? 0 }}</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="payment-section text-center">
                        <h2>Payment Options</h2>
                        <h3 class="text-primary">Total Amount: ₹{{ $totalAmount ?? 0 }}</h3>
                        <!-- Payment Method Selection -->
                        <div class="mb-4">
                            <h5>Select Payment Method</h5>
                            <div class="d-flex justify-content-center align-items-center gap-7 flex-wrap">
                                {{-- Net Banking Icon --}}
                                <div class="m-2">
                                    <a href="#" wire:click.prevent="submit" class="d-flex flex-column align-items-center text-decoration-none mr-4" style="cursor:pointer;">
                                        <!-- <img src="https://img.icons8.com/color/96/000000/bank.png" alt="Net Banking" style="width:60px; height:60px;"> -->
                                        <img src="{{ asset('assets/images/payment-gatway/sbi_image.png') }}" alt="Net Banking" style="height:80px;">
                                        <!-- <span class="mt-2">Net Banking</span> -->
                                    </a>
                                </div>
                                
                                {{-- Credit/Debit Card Icon --}}
                                <div class="m-2">
                                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#paymentUnavailableModal" wire:click="paymentUnavailableModal()" class="d-flex flex-column align-items-center text-decoration-none mr-4" style="cursor:pointer;">
                                        <img src="https://img.icons8.com/color/96/000000/bank-card-front-side.png" alt="Credit/Debit Card" style="height:80px;">
                                        <!-- <span class="mt-2">Credit/Debit Card</span> -->
                                    </a>
                                </div>
                                {{-- UPI Icon --}}
                                <div class="m-2">
                                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#paymentUnavailableModal" wire:click="paymentUnavailableModal()" class="d-flex flex-column align-items-center text-decoration-none" style="cursor:pointer;">
                                        <img src="{{ asset('assets/images/payment-gatway/UPI-Logo-vector.svg') }}" alt="UPI" style="height:40px;">
                                        <!-- <span class="mt-2">UPI</span> -->
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('livewire/payment-unavailable-modal')

                    <div class="mt-3 d-flex justify-content-between">
                        <button class="btn btn-secondary" wire:click="previousStep">Previous</button>
                        <!-- <button class="btn btn-primary" wire:click="goToStep(3)">Payment Later</button> -->
                        <button class="btn btn-primary" wire:click="payLater">Payment Later</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<!-- Script to show delete modal -->
@script
<script>
    $wire.on('paymentUnavailablePopupShow', () => {
        $('#paymentUnavailableModal').modal('show');
    });
</script>
@endscript

