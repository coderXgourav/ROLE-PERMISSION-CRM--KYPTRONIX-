@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}

<style>
@media only screen and (max-width: 1500px) {
  #phone{
width: 100% !important;
  }
}

</style>
@push('title')
    <title>Add Contact</title>
@endpush
<div class="row">
	<div class="col-md-2 d-none"></div>
    <div class="col-md-10 m-auto py-4">
    <div class="card">
        <div class="card-header bg-dark text-white p-3">
            <h5 class="mb-0 text-light">
                <i class="fas fa-user-plus me-2"></i> Staff Registration
            </h5>
        </div>
        <div class="card-body p-4">
            <form id="add_contact_form">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" placeholder="Type Username" id="username" name="username" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email Address<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="Type Email" id="email" name="email" required> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password  <span class="text-danger"> *</span></label>
                        <input type="password" class="form-control" placeholder="Type Password" id="password" name="password" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="password_hint" class="form-label" >Disable Account <span class="text-danger"> *</span></label>
                        <select name="disable_account" id="" class="form-control" required >
							<option value="">Account Status</option>
							<option value="0">Enable</option>
							<option value="1">Disable</option>
						</select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name  <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required placeholder="Type First Name">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name  <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="last_name" placeholder="Type Last Name" name="last_name" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone Number  <span class="text-danger"> *</span></label>
                        <input type="tel" class="form-control"  name="phone" required placeholder="Type Phone Number"> 
                        {{-- <input type="tel" class="form-control" id="phone" name="phone" required> --}}
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="staff_type" class="form-label">Staff Type  <span class="text-danger"> *</span></label>
                        <select class="form-select" id="staff_type" name="user_type" required>
                            <option value="">Select Staff Type</option>
                       @foreach ($roles as $item)
					   <option value="{{$item->role_name}}">{{$item->modern_name}}</option>
					   @endforeach
                        </select>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Choose Services  <span class="text-danger"> *</span></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                           
                            
                            @foreach($services as $service)
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" 
                                               id="{{ $service->service_id }}" 
                                               name="services[]" 
                                               value="{{ $service->service_id}}" required> &nbsp;
                                        <label class="form-check-label" for="{{ $service->service_id }}">
                                            {{ $service->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-light">
                            <i class="fas fa-shield-alt me-2"></i> Permissions Management
                        </h6>
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="toggleAllPermissions">
                            <label class="form-check-label text-white" for="toggleAllPermissions">Toggle All Permissions</label>
                        </div>
                    </div>

                    <div class="card-body">
                        @php
                        $permissionGroups = [
                            'Service Management' => [
                                ['name' => 'service_add', 'label' => 'Add Service'],
                                ['name' => 'service_view', 'label' => 'View Service'],
                                ['name' => 'service_edit', 'label' => 'Edit Service'],
                                ['name' => 'service_details_view', 'label' => 'View Service Details']
                            ],
                            'Role Management' => [
                                ['name' => 'role_edit', 'label' => 'Edit Role']
                            ],
                            'Staff Management' => [
                                ['name' => 'staff_registration', 'label' => 'Staff Registration'],
                                ['name' => 'staff_view', 'label' => 'View Staffs'],
                                ['name' => 'staff_edit', 'label' => 'Edit Staff'],
                                ['name' => 'staff_details_view', 'label' => 'View Staff Details']
                            ],
                            'Package Management' => [
                                ['name' => 'package_add', 'label' => 'Add Package'],
                                ['name' => 'package_view', 'label' => 'View Packages'],
                                ['name' => 'package_edit', 'label' => 'Edit Packages']
                            ],
                            'Reports Management' => [
                                ['name' => 'report_count', 'label' => 'Count Report'],
                                ['name' => 'report_staff', 'label' => 'Staff Report'],
                                ['name' => 'report_individual', 'label' => 'Individual Report'],
                                ['name' => 'report_business', 'label' => 'Business Report']
                            ],
                            'Leads Management' => [
                                ['name' => 'leads_add', 'label' => 'Add Leads'],
                                ['name' => 'leads_view', 'label' => 'View Leads'],
                                ['name' => 'leads_import_individual', 'label' => 'Import Individual Leads'],
                                ['name' => 'leads_import_business', 'label' => 'Import Business Leads']
                            ],
                            'Clients Management' => [
                                ['name' => 'clients_view', 'label' => 'View Clients']
                            ],
                            'Assign Management' => [
                                ['name' => 'assign_manage', 'label' => 'Assign Manage']
                            ],
                            'Invoice Management' => [
                                ['name' => 'invoice_view', 'label' => 'View Invoice']
                            ],
                            'Communication Management' => [
                                ['name' => 'email_view', 'label' => 'View Email'],
                                ['name' => 'sms_view', 'label' => 'View SMS']
                            ],
                            'Payments Management' => [
                                ['name' => 'payments_successful', 'label' => 'Successful Payments'],
                                ['name' => 'payments_failed', 'label' => 'Failed Payments']
                            ],
                            'Login History' => [
                                ['name' => 'login_history_view', 'label' => 'View Login History']
                            ]
                        ];
                        @endphp

                        @foreach($permissionGroups as $groupName => $permissions)
                            <div class="card mb-3">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <p class="mb-0 text-primary">
                                        <i class="fas fa-folder-open me-2"></i>{{ $groupName }}
                                    </p>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" 
                                               class="form-check-input group-toggle" 
                                               id="{{ Str::slug($groupName) }}-toggle"
                                               data-group="{{ Str::slug($groupName) }}">
                                        <label class="form-check-label" for="{{ Str::slug($groupName) }}-toggle">
                                            Toggle Group
                                        </label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($permissions as $permission)
                                            <div class="col-md-3 col-sm-6 mb-2">
                                                <div class="form-check form-switch">
                                                    <input type="hidden" 
                                                           name="{{ $permission['name'] }}" 
                                                           value="0">
                                                    <input 
                                                        type="checkbox" 
                                                        class="form-check-input permission-checkbox {{ Str::slug($groupName) }}-checkbox"
                                                        id="{{ $permission['name'] }}" 
                                                        name="{{ $permission['name'] }}" 
                                                        value="1"
                                                        data-group="{{ Str::slug($groupName) }}"
                                                        {{ old($permission['name'], $currentPermissions[$permission['name']] ?? false) ? 'checked' : '' }}
                                                    >
                                                    <label 
                                                        class="form-check-label" 
                                                        for="{{ $permission['name'] }}"
                                                    >
                                                        {{ $permission['label'] }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
				 <div class="mt-3 text-center ">
                    <button type="submit" class="btn btn-success">Register Staff</button>
                    <button type="reset" class="btn btn-danger ms-2">Reset</button>
                </div>
            </form> <br> <br><br> <br>
        </div>
    </div>
</div>
				</div>
				
											<?php if(count($services)<1){
												?>
												<script>
													 document.getElementById("message").style.display = "block";
												
													 document.getElementById("btn").style.display = "none";
													 document.getElementById("btn2").style.display = "none";
												</script>
												<?php
											} ?>
<script>
					

function resetCheckboxes(checkedBox) {

    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="user_type"]');
    checkboxes.forEach(checkbox => {
        if (checkbox !== checkedBox) {
            checkbox.checked = false;
        }
    });
}
//$('#sub_services').hide();
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle all permissions
    const toggleAllCheckbox = document.getElementById('toggleAllPermissions');
    const allPermissionCheckboxes = document.querySelectorAll('.permission-checkbox');
    const groupToggleCheckboxes = document.querySelectorAll('.group-toggle');

    toggleAllCheckbox.addEventListener('change', function() {
        allPermissionCheckboxes.forEach(checkbox => {
            checkbox.checked = toggleAllCheckbox.checked;
        });
        
        groupToggleCheckboxes.forEach(groupToggle => {
            groupToggle.checked = toggleAllCheckbox.checked;
        });
    });

    // Group-level toggling
    groupToggleCheckboxes.forEach(groupToggle => {
        groupToggle.addEventListener('change', function() {
            const group = this.dataset.group;
            const groupCheckboxes = document.querySelectorAll(`.${group}-checkbox`);
            
            groupCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });

            // Uncheck "Toggle All" if not all groups are selected
            updateToggleAllState();
        });
    });

    // Individual checkbox change handling
    allPermissionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const group = this.dataset.group;
            const groupCheckboxes = document.querySelectorAll(`.${group}-checkbox`);
            const groupToggle = document.getElementById(`${group}-toggle`);

            // Check if all checkboxes in the group are checked
            const allChecked = Array.from(groupCheckboxes).every(cb => cb.checked);
            groupToggle.checked = allChecked;

            // Update "Toggle All" state
            updateToggleAllState();
        });
    });

    // Function to update "Toggle All" checkbox state
    function updateToggleAllState() {
        const allChecked = Array.from(allPermissionCheckboxes).every(cb => cb.checked);
        toggleAllCheckbox.checked = allChecked;
    }
});
</script>
				
@include('admin.dashboard.footer')