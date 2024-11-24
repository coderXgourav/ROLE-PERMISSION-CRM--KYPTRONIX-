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
                    <div class="col-lg-8 mx-auto">
						

						<div class="card">
							<form id="add_package_form">
								{{@csrf_field()}}
								<input type="hidden" id="reset">
								<input type="hidden" name="user_type" value="{{$admin_data->user_type}}">
							<div class="card-body p-4">
								<h5 class="mb-4">Add Package </h5>
								   <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Service</label>
										<div class="col-sm-9" style="display: flex;  align-items:center; flex-wrap:wrap">
												@foreach($services as $item)
												<div style="display:flex; align-items:center;">
													<input type="checkbox" class="services-checkbox" name="service_id" value="{{$item->service_id}}" onclick="resetCheckboxes(this)" required   style="width: 25px">  &nbsp; <span>{{$item->name}}</span>
												 &nbsp;&nbsp;</div>
												
												@endforeach
										</div>
									</div>

									<div class="row mb-3" id="sub_services">
										<label for="input42" class="col-sm-3 col-form-label">Sub Service</label>
										<div class="col-sm-9">
											<div id="subservices"></div>
										</div>
									</div> 
								
									<div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Package Title</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Package Title" name="title" id="title" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
											</div>
										</div>
									</div> 
								    <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Price</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="number" class="form-control" placeholder="Package Price" name="price" id="price" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
											</div>
										</div>
									</div> 
								   <!--  <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Short Description</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
											    <input type="text" class="form-control" placeholder="Package Short Description" name="desc" id="desc">
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
											</div>
										</div>
									</div> -->
								   
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<div class="d-md-flex d-grid align-items-center gap-3">
												<button type="submit" class="btn btn-primary px-4" style="height:46px;" id="btn">Submit</button>

										   </div>
										</div>
									</div>
								</div>
							</form>
							</div>


								 
					</div>
				</div><!--end row-->
				
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