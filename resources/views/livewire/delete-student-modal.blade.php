<!-- resources/views/livewire/delete-student-modal.blade.php -->
<div wire:ignore.self class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-light" id="deleteStudentModalLabel">Delete Student</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close" onclick="$('#deleteStudentModal').modal('hide')"></button>
      </div>
      
      <div class="modal-body">
        <strong class="text-primary">Student ID - {{ $id }}</strong>
        <h4 class="text-primary">Name: {{ $full_name }}</h4>
        <p>Are you sure you want to delete this student?</p>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#deleteStudentModal').modal('hide')">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="$('#deleteStudentModal').modal('hide')" wire:click="deleteStudent()">Delete</button>
      </div>
      
    </div>
  </div>
</div>