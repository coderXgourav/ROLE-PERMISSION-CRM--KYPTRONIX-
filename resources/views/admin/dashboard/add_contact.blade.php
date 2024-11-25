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
                    <div class="col-lg-12 mx-auto">
						

						<div class="card">
							<form id="add_contact_form">
							<div class="card-body p-4">
								<h5 class="mb-4">Staff Registration </h5>
								<div id="message" style="display: none; ">
									<div class="" style=" background: #16bccfa3; padding: 15px; border-radius: 5px;">
										<h5 class="text-center"> Please Add at Least One Service</h5>
									</div>
									<br><br>
								</div>
								    
									
									<div class="row mb-3" >
										<label for="input42" class="col-sm-3 col-form-label">Username</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Account Name" name="account_name" required >
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
											</div>
										</div>
									</div>

                                      <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Password</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="password" class="form-control" placeholder="Password " name="password" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-lock'></i></span>
											</div>
										</div>
									</div> 
									<div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Password Hint</label>
										<div class="col-sm-9"> 
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Password Hint" name="password_hint" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-lock'></i></span>
											</div> 
										</div>
									</div> 
									<div class="row mb-3">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-4">
											<div class="form-check">
												<input type="hidden" name="after_login_setting_change" value="0">
												<input class="form-check-input" type="checkbox" id="input48" name="after_login_setting_change" value="1"> &nbsp;
												<label class="form-check-label" for="input48">Change Password upon next login</label>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-check">
												<input type="hidden" name="disable_account" value="0">

												<input class="form-check-input" value="1" type="checkbox" id="input47" name="disable_account"> &nbsp;
												<label class="form-check-label" for="input47">Disable Account</label>
											</div>
										</div>
									</div>

									{{@csrf_field()}}
									<div class="row mb-3" >
										<label for="input42" class="col-sm-3 col-form-label">First Name</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type First Name" name="first_name" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
											</div>
										</div>
									</div>

                                      <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Last Name</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Last Name" name="last_name" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
											</div>
										</div>
									</div> 
									<div class="row mb-3">
										<label for="input43" class="col-sm-3 col-form-label">Phone No</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												 <input type="number" class="form-control" name="phone" placeholder="Type Phone Number"  required>
												  <input type="hidden" id="country_code" name="country_code" value="">
											</div>
										</div>
									</div>
									<div class="row mb-3">
										<label for="input44" class="col-sm-3 col-form-label">Email Address</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="email" class="form-control"  placeholder="Type Email Address" name="email" required> 
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-envelope'></i></span>
											</div>
										</div>
									</div>
                                    

									

                                    
									
									<div class="row mb-3" >
										<label for="input42" class="col-sm-3 col-form-label">Staff Type</label>
										<div class="col-sm-9">
											<div style="    display: flex;align-items: center;gap: 10px;}">
												       @foreach($roles as $val)
												<div><input type="checkbox" id="role".{{$val->id}}  name="user_type" onclick="resetCheckboxes(this)" value="{{$val->id}}"  style="width: 25px"> </div>
												<label style="cursor: pointer" for="role".{{$val->id}} >{{$val->role_name}}</label>
												   @endforeach                                 
											</div>
										</div>
									</div>

										{{-- <div class="row mb-3" >
										<label for="input42" class="col-sm-3 col-form-label">Staff Type</label>
										<div class="col-sm-9">
											<div style=" display: flex;align-items: center;gap: 10px;}">
												     <input type="radio" name="role" value="customer_success_manager" required>                               
												     <input type="radio" name="role" value="team_manager" required>                               
												     <input type="radio" name="role" value="admin" required>                               
												     <input type="radio" name="role" value="bookkeeper" required>                               
											</div>
										</div>
									</div> --}}



 									<div class="row"  id="service_field">
										<div class="row mb-3" >
										<label for="input42" class="col-sm-3 col-form-label">Choose Services</label>
										<div class="col-sm-9">
										
                                    <div style="display: flex;align-items: center;gap: 10px;}">
													@foreach ($services as $item)

													
												    <div>
														
														<input type="checkbox" id={{$item->service_id}}  name="services[]" class="services-checkbox"value="{{$item->service_id}}"  style="width: 25px"> 
													</div>
													<label style="cursor: pointer" for={{$item->service_id}}>{{$item->name}}</label>

											
													@endforeach
													</div>
													
												
										</div>

										<div class="row"  id="service_field">
											<div class="row mb-3" >
											<label for="input42" class="col-sm-3 col-form-label">Allow Manage System</label>
											<div class="col-sm-9">
											
										    <div style="display: flex;align-items: center;gap: 10px;}">
								<div>
										
				<input type="radio" id="manage1"  name="manage" class="services-checkbox"value="0"  style="width: 25px"><label for="manage1" style="cursor: pointer">Manage only Assigned Leads</label> 
								</div>
								<div>
										
									<input type="radio" id="manage2"  name="manage" class="services-checkbox"value="1"  style="width: 25px"> <label for="manage2" style="cursor: pointer">Manage Total Service Leads</label>
													</div>
														</div>
														
													
											</div>
									</div>
								 </div>
								 
								<!--	<div class="row mb-3" id="sub_services">
										<label for="input42" class="col-sm-3 col-form-label">Sub Service</label>
										<div class="col-sm-9">
											<div id="subservices"></div>
										</div>
									</div> -->
								
                                    
								


										<div class="row mb-3" >
										<label for="input42" class="col-sm-3 col-form-label">User Privilage</label>
						          <div class="col-sm-9">
									<div class="row">
										{{-- <div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="admin" value="0">
													<input class="form-check-input" value="1" name="admin" type="checkbox" role="switch" id="flexSwitchCheckDefault122" >
													<label class="form-check-label" for="flexSwitchCheckDefault122">Admin</label>
												</div>
						                    </div>
										</div> --}}
											<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch" class="om">
													<input type="hidden" name="service_manage" value="0">
													<input class="form-check-input" value="1" name="service_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault1" >
													<label class="form-check-label" for="flexSwitchCheckDefault1">Service Manage</label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3" class="tm">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="leads_manage" value="0">
													<input class="form-check-input" name="leads_manage" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault2" >

													<label class="form-check-label" for="flexSwitchCheckDefault2">Lead Manage</label>
												</div>
						                    </div>
										</div>
											<div class="col-sm-3" class="tm">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="invoice_manage" value="0">
													<input class="form-check-input" name="invoice_manage" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault3" >
													<label class="form-check-label" for="flexSwitchCheckDefault3">Invoice Manage</label>
												</div>
						                    </div>
										</div>
											<div class="col-sm-3" class="admin">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="payment_manage" value="0">
													<input class="form-check-input" value="1" name="payment_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault4" >
													<label class="form-check-label" for="flexSwitchCheckDefault4">Payment Manage</label>
												</div>
						                    </div>
										</div>
											
								</div>
					     </div>
						 
						 <div class="col-sm-12">
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
								
									<div class="row">
										
										<div class="col-sm-3" class="tm"> 
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="customer_manage" value="0">
													<input class="form-check-input" value="1" name="customer_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault6" >
													<label class="form-check-label" for="flexSwitchCheckDefault6">Customer Manage</label>
												</div>
						                    </div>
										</div>
											<div class="col-sm-3" class="tm">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="email_sms_manage" value="0">
													<input class="form-check-input" name="email_sms_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault7" >
													<label class="form-check-label" for="flexSwitchCheckDefault7">Email & SMS View </label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3" class="tm">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="communication" value="0">
													<input class="form-check-input" name="communication" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault8" >
													<label class="form-check-label" for="flexSwitchCheckDefault8">Communication </label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3" class="admin">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="report" value="0">
													<input class="form-check-input" value="1" name="report" type="checkbox" role="switch" id="flexSwitchCheckDefault9" >
													<label class="form-check-label" for="flexSwitchCheckDefault9">Report</label>
												</div>
						                    </div>
										</div>
								</div>
					        </div>
							</div>
						 </div>

						 	<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
								
									<div class="row">
											
											<div class="col-sm-3" class="csm">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="document_view" value="0">
													<input class="form-check-input" name="document_view" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault10" >
													<label class="form-check-label" for="flexSwitchCheckDefault10">Document View </label>
												</div>
						                    </div>
										</div>
								</div>
					        </div>
							</div>
							<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
								
									<div class="row">
											
									
											<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="document_download" value="0">
													<input class="form-check-input" name="document_download" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault20" >
													<label class="form-check-label" for="flexSwitchCheckDefault20">Document Download </label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="lead_assign" value="0">
													<input class="form-check-input" name="lead_assign" value="1" type="checkbox" role="switch" id="hello" >
													<label class="form-check-label" for="hello">Lead Assign</label>
												</div>
						                    </div>
										</div>
										
								</div>
					        </div>
							</div>
							<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
									<div class="row">
									
											<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="history_manage" value="0">
													<input class="form-check-input" name="history_manage" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault131" >
													<label class="form-check-label" for="flexSwitchCheckDefault131">History Manage</label>
												</div>
						                    </div>
										</div>

									

										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="user_registration" value="0">
													<input class="form-check-input" name="user_registration" value="1" type="checkbox" role="switch" id="1000" >
													<label class="form-check-label" for="1000"> User/Role Manage</label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="package" value="0">
													<input class="form-check-input" name="package" value="1" type="checkbox" role="switch" id="3002" >
													<label class="form-check-label" for="3002">Package Manage</label>
												</div>
						                    </div>
										</div>
										
									
								</div>
					        </div>
							</div>	

						 </div>
						 	<br>


									</div>
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<div class="d-md-flex d-grid align-items-center gap-3">
												<button type="submit" class="btn btn-primary px-4" style="height:46px;" id="btn" onclick="addTeamMember()">Submit</button>
												<button style="height:46px;" id="btn2" type="reset" class="btn btn-light px-4">Reset</button>
											</div>
										</div>
									</div>
								</div>
							</form>
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
	/*let user = checkedBox.value;
	if(user==="operation_manager"){
		$('#sub_services').hide();
		document.getElementById("service_field").style.display="none";
	}else if(user==="team_manager"){
		$('#sub_services').hide();
		document.getElementById("service_field").style.display="block";
	}else if(user==="customer_success_manager"){
		document.getElementById("service_field").style.display="block";
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
                                subserviceHtml += '<input type="checkbox" class="form-check-input subservice-checkbox" name="subservices[]" value="' + subservices.id + '" />  ' +    subservices.service_name+' ';
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


	}*/

    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="user_type"]');
    checkboxes.forEach(checkbox => {
        if (checkbox !== checkedBox) {
            checkbox.checked = false;
        }
    });
}
//$('#sub_services').hide();
</script>
				
@include('admin.dashboard.footer')