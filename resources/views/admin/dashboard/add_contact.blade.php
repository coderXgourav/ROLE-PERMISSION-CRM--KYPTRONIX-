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
								<h5 class="mb-4">User Registration </h5>
								    
									
									<div class="row mb-3" >
										<label for="input42" class="col-sm-3 col-form-label">Account Name</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Type Account Name" name="account_name" required>
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
										<label for="input42" class="col-sm-3 col-form-label">User Type</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<select name="user_type" id="" class="form-control" required>
													<option value="">Select User Type</option>
													<option value="operation_manager">Operation Manager</option>
													<option value="team_manager">Team Manager</option>
													<option value="customer_success_manager">Customer Success Manager</option>
													<option value="bookkeeper">Bookkeeper</option>
												</select>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
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
												<div class="form-check form-switch">
													<input type="hidden" name="service_manage" value="0">
													<input class="form-check-input" value="1" name="service_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault1" >
													<label class="form-check-label" for="flexSwitchCheckDefault1">Service Manage</label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="leads_manage" value="0">
													<input class="form-check-input" name="leads_manage" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault2" >

													<label class="form-check-label" for="flexSwitchCheckDefault2">Lead Manage</label>
												</div>
						                    </div>
										</div>
											<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="invoice_manage" value="0">
													<input class="form-check-input" name="invoice_manage" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault3" >
													<label class="form-check-label" for="flexSwitchCheckDefault3">Invoice Manage</label>
												</div>
						                    </div>
										</div>
											<div class="col-sm-3">
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
										
										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="customer_manage" value="0">
													<input class="form-check-input" value="1" name="customer_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault6" >
													<label class="form-check-label" for="flexSwitchCheckDefault6">Customer Manage</label>
												</div>
						                    </div>
										</div>
											<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="email_sms_manage" value="0">
													<input class="form-check-input" name="email_sms_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault7" >
													<label class="form-check-label" for="flexSwitchCheckDefault7">Email & SMS View </label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="communication" value="0">
													<input class="form-check-input" name="communication" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault8" >
													<label class="form-check-label" for="flexSwitchCheckDefault8">Communication </label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3">
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
											
											<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="document_view" value="0">
													<input class="form-check-input" name="document_view" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault10" >
													<label class="form-check-label" for="flexSwitchCheckDefault10">Document View </label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="client_financial" value="0">
													<input class="form-check-input" value="1" name="client_financial" type="checkbox" role="switch" id="flexSwitchCheckDefault12" >
													<label class="form-check-label" for="flexSwitchCheckDefault12">Client Financial Data</label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="client_contact_info" value="0">
													<input class="form-check-input" value="1" name="client_contact_info" type="checkbox" role="switch" id="flexSwitchCheckDefault13" >
													<label class="form-check-label" for="flexSwitchCheckDefault13">Client Contact Info</label>
												</div>
						                    </div>
										</div>
										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="delete_client" value="0">
													<input class="form-check-input" name="delete_client" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault15" >
													<label class="form-check-label" for="flexSwitchCheckDefault15">Delete Client Record</label>
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
													<input type="hidden" name="delete_all_record" value="0">
													<input class="form-check-input" name="delete_all_record" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault19" >
													<label class="form-check-label" for="flexSwitchCheckDefault19">Delete All Record</label>
												</div>
						                    </div>
										</div>
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
										<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="email_template" value="0">
													
													<input class="form-check-input" name="email_template" value="1" type="checkbox" role="switch" id="helo2" >
													<label class="form-check-label" for="helo2">Email Template </label>
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
												<button style="height:46px;" type="reset" class="btn btn-light px-4">Reset</button>
											</div>
										</div>
									</div>
								</div>
							</form>
							</div>


								 
					</div>
				</div><!--end row-->
				
				
@include('admin.dashboard.footer')