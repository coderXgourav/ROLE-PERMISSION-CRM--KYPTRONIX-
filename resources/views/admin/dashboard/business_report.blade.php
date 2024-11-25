

@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
<style>
@media only screen and (max-width: 1500px) {

}

</style>
@push('title')
    <title>Business Report</title>
@endpush
<div class="row">
                    <div class="col-lg-8 mx-auto">
						

						<div class="card">
							<form id="business_report" action="{{ route('admin.business-report-pdf') }}" method="GET">
								{{@csrf_field()}}
								<input type="hidden" id="reset">
							<div class="card-body p-4">
								   <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Report</label>
										<div class="col-sm-9">
									    	<div class="position-relative input-icon">

											  <select name="reports" class="form-select" id="reports" required>
					                        	<option value="">Select</option>
					                            <option value="1">Paid Report</option>
					                            <option value="2">Unpaid Report</option>
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