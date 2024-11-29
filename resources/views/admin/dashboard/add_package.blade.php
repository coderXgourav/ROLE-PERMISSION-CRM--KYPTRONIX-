@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
<style>
@media only screen and (max-width: 1500px) {

}
</style>

@push('title')
    <title>Add Package</title>
@endpush
<div class="row">
                <div class="container-fluid">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm border-0 p-4">
            <form id="add_package_form"  method="POST">
                @csrf
                <input type="hidden" id="reset">
                <input type="hidden" name="user_type" >
                
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="mb-0 me-3">
                            <i class='bx bx-package text-primary me-2'></i>Add New Package
                        </h5>
                        <hr class="flex-grow-1 ms-3">
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">
                            <span class="fw-bold text-muted">Services</span>
                        </label>
                        <div class="col-sm-9" style="display: flex; align-items:center; flex-wrap:wrap">
                            @foreach($services as $item)
                                <div class="me-3 mb-2 d-flex align-items-center">
                                    <input type="checkbox" 
                                           class="form-check-input services-checkbox me-2" 
                                           name="service_id" 
                                           value="{{ $item->service_id }}" 
                                           onclick="resetCheckboxes(this)" 
                                           required>
                                    <span class="text-muted">{{ $item->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row mb-3" id="sub_services" style="display:none; color: red">
                        <label class="col-sm-3 col-form-label">
                            <span class="fw-bold text-muted">Sub Services</span>
                        </label>
                        <div class="col-sm-9">
                            <div id="subservices" class="d-flex flex-wrap gap-2"></div>
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">
                            <span class="fw-bold text-muted">Package Title</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class='bx bx-detail text-muted'></i>
                                </span>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       placeholder="Enter Package Title" 
                                       name="title" 
                                       id="title" 
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">
                            <span class="fw-bold text-muted">Price</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class='bx bx-dollar text-muted'></i>
                                </span>
                                <input type="number" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       placeholder="Enter Package Price" 
                                       name="price" 
                                       id="price" 
                                       step="0.01" 
                                       required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                   <br>
                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" 
                                    class="btn btn-primary" 
                                    id="btn">
                             Submit Package
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
				
<script type="text/javascript">
	$('#sub_services').hide();
	    $(document).ready(function() {
            $('.services-checkbox').on('change', function() {
                var selectedServiceIds = [];
                $('.services-checkbox:checked').each(function() {
                    selectedServiceIds.push($(this).val());
                });

                if (selectedServiceIds.length === 0) {
                	$('#sub_services').hide();
                    $('#subservices').html('');
                    return;
                }

                $.ajax({
                    url: '/admin/package_subservices/' + selectedServiceIds.join(','),
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var subserviceHtml = '';
                        if (response.length > 0) {
                            response.forEach(function(subservices) {
                                subserviceHtml += '<input type="checkbox" class="form-check-input subservice-checkbox" name="subservices[]" value="' + subservices.id + '" />  ' +  subservices.service_name;
                            });
                        } else {
                            subserviceHtml = 'No subservices available for the selected service.';
                        }
                        $('#sub_services').show();
                        $('#subservices').html(subserviceHtml);
                    },
                    error: function() {
                        alert('Error fetching subservices.');
                    }
                });
            });
        });
	    function resetCheckboxes(checkedBox) {

	    	const checkboxes = document.querySelectorAll('input[type="checkbox"][name="service_id"]');
	    	checkboxes.forEach(checkbox => {
	    		if (checkbox !== checkedBox) {
	    			checkbox.checked = false;
	    		}
	    	});
	    }

</script>				
@include('admin.dashboard.footer')