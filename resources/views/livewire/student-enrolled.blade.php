    <div>
        @if ($enrolledConfirm)
            {{-- Confirmation Message --}}
            <div class="card">
                <div class="card-body">
                    <div class="confirmation-section text-center my-5">
                        <div class="animated-icon">
                            <!-- You can add SVG or Font Awesome icon here -->
                            <i class="fas fa-check-circle fa-5x text-success animated-icon"></i>
                        </div>
                        <h3 class="mt-4">Enrollment Confirmed!</h3>
                        <p>
                            
                            <strong>Student Name:</strong> {{ $student->full_name ?? ($studentData['full_name'] ?? '') }}<br>
                            <strong>Enrollment Number:</strong> {{ $student->enrollment_number ?? ($studentData['enrollment_number'] ?? '') }}
                        
                        </p>
                        <p>Your registration has been successfully completed.</p>
                        <button class="btn btn-success mt-3" wire:click="finish">Finish</button>
                    </div>
                </div>
            </div>
        @endif
    </div>