@include('admin.dashboard.header')
{{-- <!-- @extends('team.dashboard.header') --> --}}
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
                    <div class="col-lg-8 mx-auto">
							<div style="display: flex; justify-content:right; margin-bottom:10px;">
							<a href="{{route('admin.import')}}" class="btn btn-sm btn-primary">Import Client</a> &nbsp; 
							<a href="{{route('admin.export')}}" class="btn btn-sm btn-success">Export </a>
						</div>

						<div class="card">
							<form id="add_customer_form">

							<div class="card-body p-4">
								<h5 class="mb-4">Add New Lead  </h5>
								   <div class="row mb-3">
								   	<label for="input42" class="col-sm-3 col-form-label">Service <span class="text-danger">*</span></label>
								    	<div class="col-sm-9">
								    	  <!-- <select name="customer_service_id" id="customer_service_id" class="form-control">
											   <option value="">Select services</option>
											      @foreach ($all_services as $services)
										  	       <option value="{{$services->service_id}}">{{$services->name}}</option>
											       @endforeach
										    </select>-->
										    @foreach ($all_services as $services)
										    <input type="checkbox" name="customer_service_id" value="{{$services->service_id}}"> 
										    {{$services->name}}											
											@endforeach
													
										</div>
								   </div>
								  <div class="row mb-3">
								   	<label for="input42" class="col-sm-3 col-form-label">Type <span class="text-danger">*</span></label>
								    	<div class="col-sm-9">
										    <input type="checkbox" name="type" value="1" id="type1" onchange="check_individual()"> Individual
										    <input type="checkbox" name="type" value="2" id="type2"onchange="check_business()"> Business
										</div>
								   </div>
								  <div class="individual">
									<div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label"> First Name <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type First Name" name="first_name" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
											</div>
										</div>
									</div> 
									<div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label"> Middle Name</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Middle Name" name="middle_name">
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
											</div>
										</div>
									</div> 
									<div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label"> Last Name <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Last Name" name="last_name" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
											</div>
										</div>
									</div> 
									<div class="row mb-3">
										<label for="input43" class="col-sm-3 col-form-label">Phone No <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												 <input type="tel" id="phone" class="form-control" name="phone" placeholder="Type Phone Number" style="width: 575px;" required>
                                                 <input type="hidden" id="country_code" name="country_code" value="">												
											</div>
										</div>
									</div>
									<div class="row mb-3">
										<label for="input44" class="col-sm-3 col-form-label">Email Address <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="email" class="form-control"  placeholder="Type Email Address" name="email" required> 
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-envelope'></i></span>
											</div>
										</div>
									</div>
									<div class="row mb-3">
										<label for="input44" class="col-sm-3 col-form-label">Date of Birth <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="date" class="form-control"  placeholder="Type Date of Birth" name="dob" required> 
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div>
									
									<div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Address</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Address" name="address">
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div> 
								    <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">City</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type City" name="city">
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div> 
								    <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">State</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type State" name="state">
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div> 
									 <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Zip Code</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Zip Code" name="zip">
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div> 
								     <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">SSN</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type SSN" name="ssn">
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div> 
								 
								   </div>
									{{@csrf_field()}}
									<div class="business">
										<div class="row mb-3">
											<label for="input42" class="col-sm-3 col-form-label">Business Name <span class="text-danger">*</span></label>
											<div class="col-sm-9">
												<div class="position-relative input-icon">
													<input type="text" class="form-control" placeholder="Type Business Name" name="business_name" required>
													<span class="position-absolute top-50 translate-middle-y"></span>
												</div>
											</div>
										</div> 
                                        <div class="row mb-3">
											<label for="input42" class="col-sm-3 col-form-label">Industry</label>
											<div class="col-sm-9">
												<div class="position-relative input-icon">
													<input type="text" class="form-control" placeholder="Type Industry" name="industry">
													<span class="position-absolute top-50 translate-middle-y"></span>
												</div>
											</div>
										</div> 
										<div class="row mb-3">
										<label for="input43" class="col-sm-3 col-form-label">Phone No <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												 <input type="tel" id="phone" class="form-control" name="business_phone_no" placeholder="Type Phone Number" style="width: 575px;" required>
                                                 <input type="hidden" id="country_code" name="country_code" value="">												
											</div>
										</div>
									</div>
									
                                        <div class="row mb-3">
										<label for="input44" class="col-sm-3 col-form-label">Email Address <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="email" class="form-control"  placeholder="Type Email Address" name="business_email" required> 
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-envelope'></i></span>
											</div>
										</div>
									</div>
									<div class="row mb-3">
											<label for="input42" class="col-sm-3 col-form-label">EIN/Tax</label>
											<div class="col-sm-9">
												<div class="position-relative input-icon">
													<input type="text" class="form-control" placeholder="Type EIN/Tax" name="ein">
													<span class="position-absolute top-50 translate-middle-y"></span>
												</div>
											</div>
										</div> 
                                        <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Address</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Address" name="business_address">
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div> 
								    <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">City</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type City" name="business_city">
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div> 
								    <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">State</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type State" name="business_state">
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div> 
									 <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Zip Code</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Zip Code" name="business_zip">
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div> 
									 <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Title</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Title" name="business_title">
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div> 
								   
								    <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Point of Contact</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Point of Contact" name="point_of_contact">
												<span class="position-absolute top-50 translate-middle-y"></span>
											</div>
										</div>
									</div> 
								    
									</div>
                                   <div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<div class="d-md-flex d-grid align-items-center gap-3">
												<button type="submit" class="btn btn-primary px-4" style="height:46px;" id="btn" onclick="">Submit</button>
												<button style="height:46px;" type="reset" class="btn btn-light px-4">Reset</button>
											</div>
										</div>
									</div>
								</div>
							</form>
							</div>


								 
					</div>
				</div><!--end row-->
                <script type="text/javascript">
                	$('.individual').hide();
                	$('.business').hide();
					function check_individual(){
					  var checkedValue=$("#type1").is(":checked");

                       if(checkedValue==true){
                       	 $('.individual').show();
                       }else{
                       	 $('.individual').hide();

                       }
					}
					function check_business(){
					  var checkedValue=$("#type2").is(":checked");

                       if(checkedValue==true){
                       	 $('.business').show();
                       }else{
                       	 $('.business').hide();

                       }
					}
                </script>
@include('admin.dashboard.footer')
