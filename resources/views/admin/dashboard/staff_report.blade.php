

@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
<style>
@media only screen and (max-width: 1500px) {

}

</style>
@push('title')
    <title>Staff Report</title>
@endpush
<div class="row">
                    <div class="col-lg-8 mx-auto">
						

						<div class="card">
							<form id="staff_report" action="{{ route('admin.staff-report-pdf') }}" method="GET" target="_blank">
								{{@csrf_field()}}
								<input type="hidden" id="reset">
							<div class="card-body p-4">
								   <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Service</label>
										<div class="col-sm-9">
									    	<div class="position-relative input-icon">

											  <select name="service" class="form-select" id="service" required>
					                        	<option value="">Select service</option>
					                        	@foreach($services_data as $val)
					                        	 <option value="{{$val->service_id}}">{{$val->name}}</option>
					                        	@endforeach
					                          </select>
				                            </div>
										</div>
									</div>

									
									<div class="row mb-3" id="user_type">
										<label for="input42" class="col-sm-3 col-form-label">Staff Type</label>
										<div class="col-sm-9">
									    	<div class="position-relative input-icon">

											  <select name="staff_type" class="form-select" id="staff_type" required>
					                        	<option value="">Select</option>
					                        	@foreach($staff_type as $value)
					                        	 <option value="{{$value->id}}">{{$value->modern_name}}</option>
					                        	@endforeach
					                          </select>
				                            </div>
										</div>
								
									</div> 
								   
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<div class="d-md-flex d-grid align-items-center gap-3">
												<button type="submit" class="btn btn-primary px-4" style="height:46px;" id="btn">View</button>

										   </div>
										</div>
									</div>
								</div>
							</form>
							</div>


								 
					</div>
				</div><!--end row-->
				

@include('admin.dashboard.footer')