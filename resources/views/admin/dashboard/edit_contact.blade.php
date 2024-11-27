
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
    <title>Update Contact</title>
@endpush
<div class="row">
                    <div class="col-lg-12 mx-auto">
						

						<div class="card">
							<form id="update_contact_form">
							<div class="card-body p-4">
								<h5 class="mb-4">User Update Form </h5>
								<div id="message" style="display: none; ">
									<div class="" style=" background: #16bccfa3;
    padding: 15px;
    border-radius: 5px;">
										<h5 class="text-center"> Please Add at Least One Service</h5>
									</div>
									<br><br>
								</div>
								    
									
									<div class="row mb-3" >
										<label for="input42" class="col-sm-3 col-form-label">Username</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" value="{{$user_details->account_name}}" placeholder="Type Account Name" name="account_name" required >
                                                <input type="hidden" name="main_user_id" value="{{$user_details->id}}">
                                                <input type="hidden" name="permissions_id" value="{{$user_details->permission_id }}">
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
											</div>
										</div>
									</div>

                                      <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Password</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="password" class="form-control" value="{{$user_details->password}}" placeholder="Password " name="password" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-lock'></i></span>
											</div>
										</div>
									</div> 
									<div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Password Hint</label>
										<div class="col-sm-9"> 
											<div class="position-relative input-icon">
												<input type="text" class="form-control" value="{{$user_details->password_hint}}" placeholder="Type Password Hint" name="password_hint" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-lock'></i></span>
											</div> 
										</div>
									</div> 
									<div class="row mb-3">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-4">
											<div class="form-check">
												<input type="hidden" name="after_login_setting_change" value="0">
												<input class="form-check-input" type="checkbox" id="input48" @if($user_details->change_password_upon_login>0) {{"checked"}} @endif name="after_login_setting_change" value="1"> &nbsp;
												<label class="form-check-label" for="input48">Change Password upon next login</label>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-check">
												<input type="hidden" name="disable_account" value="0">

												<input class="form-check-input" value="1"  @if($user_details->disable_account>0) {{"checked"}} @endif  type="checkbox" id="input47" name="disable_account"> &nbsp;
												<label class="form-check-label" for="input47">Disable Account</label>
											</div>
										</div>
									</div>

									{{@csrf_field()}}
									<div class="row mb-3" >
										<label for="input42" class="col-sm-3 col-form-label">First Name</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type First Name" value="{{$user_details->first_name}}" name="first_name" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
											</div>
										</div>
									</div>

                                      <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Last Name</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Last Name" value="{{$user_details->last_name}}" name="last_name" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
											</div>
										</div>
									</div> 
									<div class="row mb-3">
										<label for="input43" class="col-sm-3 col-form-label">Phone No</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												 <input type="number" class="form-control" value="{{$user_details->phone_number}}" name="phone" placeholder="Type Phone Number"  required>
												  <input type="hidden" id="country_code" name="country_code" value="">
											</div>
										</div>
									</div>
									<div class="row mb-3">
										<label for="input44" class="col-sm-3 col-form-label">Email Address</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="email" class="form-control" value="{{$user_details->email_address}}" placeholder="Type Email Address" name="email" required> 
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-envelope'></i></span>
											</div>
										</div>
									</div>
                                    

                                    
									
									<div class="row mb-3" >
										<label for="input42" class="col-sm-3 col-form-label">User Type</label>
										<div class="col-sm-9">
											<div style="    display: flex;
                                                align-items: center;
                                                      gap: 10px;
                                                   }">
												<div><input type="checkbox" @if($user_details->user_type == "operation_manager") {{"checked"}} @endif  name="user_type" onclick="resetCheckboxes(this)" value="operation_manager"  style="width: 25px"> </div>
												<div><p>Operation Manager</p></div>


												<div><input type="checkbox"  @if($user_details->user_type == "team_manager") {{"checked"}} @endif  name="user_type" onclick="resetCheckboxes(this)" value="team_manager"  style="width: 25px"> </div>
												<div><p>Team Manager</p></div>

													<div><input type="checkbox"  @if($user_details->user_type == "customer_success_manager") {{"checked"}} @endif name="user_type" onclick="resetCheckboxes(this)" value="customer_success_manager"  style="width: 25px"> </div>
												<div><p>Team Member</p></div>


											</div>
											
											{{-- <div class="position-relative input-icon">
												<select name="user_type" id="" class="form-control" required onchange="checkManager(this.value)">
													<option value="">Select User Type</option>
													<option value="operation_manager">Operation Manager</option>
													<option value="team_manager">Team Manager</option>
													<option value="customer_success_manager">Customer Success Manager</option>
												</select>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
											</div> --}}
										</div>
									</div>

 									<div class="row"  id="service_field">
										<div class="row mb-3" >
										<label for="input42" class="col-sm-3 col-form-label">Choose Services</label>
										<div class="col-sm-9">
                                          

                                        <div style="display: flex;align-items: center;gap: 10px;}">
													@foreach ($services as $item)
                                                 
												    <div>
														<input type="checkbox"    @if($services_he_manage->contains('service_id', $item->service_id)) checked @endif   name="services[]" value="{{$item->service_id}}"  style="width: 25px"> 
													</div>
													<div>{{$item->name}}</div>
											
													@endforeach
													</div>
												
										</div>
									</div>
									</div>

								


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
													<input class="form-check-input"  @if($user_details->service_permission>0) {{"checked"}} @endif value="1" name="service_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault1" >
													<label class="form-check-label" for="flexSwitchCheckDefault1">Service Manage</label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3" class="tm">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="leads_manage" value="0">
													<input class="form-check-input"  @if($user_details->leads_permission>0) {{"checked"}} @endif name="leads_manage"  value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault2" >

													<label class="form-check-label" for="flexSwitchCheckDefault2">Lead Manage</label>
												</div>
						                    </div>
										</div>
											<div class="col-sm-3" class="tm">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="invoice_manage" value="0">
													<input class="form-check-input" @if($user_details->invoice_permission>0) {{"checked"}} @endif  name="invoice_manage" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault3" >
													<label class="form-check-label" for="flexSwitchCheckDefault3">Invoice Manage</label>
												</div>
						                    </div>
										</div>
											<div class="col-sm-3" class="admin">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="payment_manage" value="0">
													<input class="form-check-input" value="1" @if($user_details->payment_permission>0) {{"checked"}} @endif name="payment_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault4" >
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
													<input class="form-check-input" value="1"  @if($user_details->customer_permission>0) {{"checked"}} @endif name="customer_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault6" >
													<label class="form-check-label" for="flexSwitchCheckDefault6">Customer Manage</label>
												</div>
						                    </div>
										</div>
											<div class="col-sm-3" class="tm">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="email_sms_manage" value="0">
													<input class="form-check-input"  value="1"  @if($user_details->email_sms_permission>0) {{"checked"}} @endif name="email_sms_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault7" >
													<label class="form-check-label" for="flexSwitchCheckDefault7">Email & SMS View </label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3" class="tm">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="communication" value="0">
													<input class="form-check-input"  @if($user_details->communication_permission>0) {{"checked"}} @endif name="communication" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault8" >
													<label class="form-check-label" for="flexSwitchCheckDefault8">Communication </label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3" class="admin">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="report" value="0">
													<input class="form-check-input"  @if($user_details->report_permission>0) {{"checked"}} @endif value="1" name="report" type="checkbox" role="switch" id="flexSwitchCheckDefault9" >
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
													<input class="form-check-input"  @if($user_details->document_view_permission>0) {{"checked"}} @endif name="document_view" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault10" >
													<label class="form-check-label" for="flexSwitchCheckDefault10">Document View </label>
												</div>
						                    </div>
										</div>
										{{-- <div class="col-sm-3" class="tm">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="client_financial" value="0">
													<input class="form-check-input" value="1" name="client_financial" type="checkbox" role="switch" id="flexSwitchCheckDefault12" >
													<label class="form-check-label" for="flexSwitchCheckDefault12">Client Financial Data</label>
												</div>
						                    </div>
										</div> --}}
										{{-- <div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="client_contact_info" value="0">
													<input class="form-check-input" value="1" name="client_contact_info" type="checkbox" role="switch" id="flexSwitchCheckDefault13" >
													<label class="form-check-label" for="flexSwitchCheckDefault13">Client Contact Info</label>
												</div>
						                    </div>
										</div> --}}
										{{-- <div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="delete_client" value="0">
													<input class="form-check-input" name="delete_client" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault15" >
													<label class="form-check-label" for="flexSwitchCheckDefault15">Delete Client Record</label>
												</div>
						                    </div>
										</div> --}}
											
								</div>
					        </div>
							</div>
							<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
								
									<div class="row">
											
										{{-- <div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="delete_all_record" value="0">
													<input class="form-check-input" name="delete_all_record" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault19" >
													<label class="form-check-label" for="flexSwitchCheckDefault19">Delete All Record</label>
												</div>
						                    </div>
										</div> --}}
											<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="document_download" value="0">
													<input class="form-check-input"  @if($user_details->document_download_permission>0) {{"checked"}} @endif name="document_download" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault20" >
													<label class="form-check-label" for="flexSwitchCheckDefault20">Document Download </label>
												</div>
						                    </div> 
										</div>
										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden"   name="lead_assign" value="0">
													<input @if($user_details->lead_assign_permission>0) {{"checked"}} @endif class="form-check-input" name="lead_assign" value="1" type="checkbox" role="switch" id="hello" >
													<label class="form-check-label" for="hello">Lead Assign</label>
												</div>
						                    </div>
										</div>
										{{-- <div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="email_template" value="0">
													
													<input class="form-check-input" name="email_template" value="1" type="checkbox" role="switch" id="helo2" >
													<label class="form-check-label" for="helo2">Email Template </label>
												</div>
						                    </div>
										</div> --}}
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
													<input class="form-check-input"  @if($user_details->login_history_permission>0) {{"checked"}} @endif name="history_manage" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault131" >
													<label class="form-check-label" for="flexSwitchCheckDefault131">History Manage</label>
												</div>
						                    </div>
										</div>

										{{-- <div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="member_manage" value="0">
													<input class="form-check-input" name="member_manage" value="1" type="checkbox" role="switch" id="565" >
													<label class="form-check-label" for="565">Manage Customer Success Manager</label>
												</div>
						                    </div>
										</div>

											<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="manager_manage" value="0">
													<input class="form-check-input" name="manager_manage" value="1" type="checkbox" role="switch" id="211" >
													<label class="form-check-label" for="211">Team Manager Manage</label>
												</div>
						                    </div>
										</div> --}} 

										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="user_registration" value="0">
													<input class="form-check-input"  @if($user_details->user_registration_permission>0) {{"checked"}} @endif name="user_registration" value="1" type="checkbox" role="switch" id="1000" >
													<label class="form-check-label" for="1000"> User/Role Manage</label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="package" value="0">
													<input class="form-check-input"  @if($user_details->package_permission>0) {{"checked"}} @endif name="package" value="1" type="checkbox" role="switch" id="3002" >
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
												<button type="submit" class="btn btn-primary px-4" style="height:46px;" id="btn" onclick="addTeamMember()">Update</button>
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


					// function checkManager(val){
					// 	if(val=="team_manager"){
					// 		document.getElementById("service_field").style.display="block";
					// 	}else{
					// 		document.getElementById("service_field").style.display="none";
					// 	}
					// 	if(val=="customer_success_manager"){
					// 		document.getElementById("member_service").style.display="block";
					// 	}else{
					// 		document.getElementById("member_service").style.display="none";
					// 	}
					// }

function resetCheckboxes(checkedBox) {
	let user_type = checkedBox.value;
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="user_type"]');
    checkboxes.forEach(checkbox => {
        if (checkbox !== checkedBox) {
            checkbox.checked = false;
        }
    });
}



				</script>
				
@include('admin.dashboard.footer')