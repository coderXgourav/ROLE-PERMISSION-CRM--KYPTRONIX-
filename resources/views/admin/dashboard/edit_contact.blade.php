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
    <title>Edit User</title>
@endpush
<div class="row">
                    <div class="col-lg-12 mx-auto">
                        

                        <div class="card">
                            <form id="update_contact_form">
                            <div class="card-body p-4">
                                <h5 class="mb-4">Edit User</h5>
                                    
                                   <input type="hidden" name="user_id" value="{{$data['id']}}">
                                   <input type="hidden" name="permissions_id" value="{{$permissions_data['permission_id']}}">
                                   <?php if(!empty($team_manager_services)){?>
                                   <input type="hidden" name="team_manager_id" value="{{$team_manager_services['id']}}">

                                   <?php }elseif(!empty($customer_service)){?>
                                    <input type="hidden" name="customer_service" value="{{$customer_service->id}}">
                                   <?php } ?>
                                    <div class="row mb-3" >
                                        <label for="input42" class="col-sm-3 col-form-label">Account Name</label>
                                        <div class="col-sm-9">
                                            <div class="position-relative input-icon">
                                                <input type="text" class="form-control" placeholder="Type Account Name" name="account_name" value="{{$data['account_name']}}" required>
                                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                            </div>
                                        </div>
                                    </div>

                                      <div class="row mb-3">
                                        <label for="input42" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <div class="position-relative input-icon">
                                                <input type="password" class="form-control" placeholder="Password " name="password" value="{{$data['password']}}" required>
                                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-lock'></i></span>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row mb-3">
                                        <label for="input42" class="col-sm-3 col-form-label">Password Hint</label>
                                        <div class="col-sm-9"> 
                                            <div class="position-relative input-icon">
                                                <input type="text" class="form-control" placeholder="Type Password Hint" name="password_hint" value="{{$data['password_hint']}}"required>
                                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-lock'></i></span>
                                            </div> 
                                        </div>
                                    </div> 
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input type="hidden" name="change_password_upon_login" value="0">

                                                <input class="form-check-input" type="checkbox"  name="change_password_upon_login" value="1" <?php if($data['change_password_upon_login'] =='1'){echo 'checked';}?>> &nbsp;
                                                <label class="form-check-label" for="input48">Change Password upon next login</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input type="hidden" name="disable_account" value="0">

                                                <input class="form-check-input" value="1" type="checkbox"  name="disable_account" <?php if($data['disable_account'] =='1'){echo 'checked';}?>> &nbsp;
                                                <label class="form-check-label" for="input47">Disable Account</label>
                                            </div>
                                        </div>
                                    </div>

                                    {{@csrf_field()}}
                                    <div class="row mb-3" >
                                        <label for="input42" class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <div class="position-relative input-icon">
                                                <input type="text" class="form-control" placeholder="Type First Name" name="first_name" value="{{$data['first_name']}}" required>
                                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                            </div>
                                        </div>
                                    </div>

                                      <div class="row mb-3">
                                        <label for="input42" class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <div class="position-relative input-icon">
                                                <input type="text" class="form-control" placeholder="Type Last Name" name="last_name" value="{{$data['last_name']}}" required>
                                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row mb-3">
                                        <label for="input43" class="col-sm-3 col-form-label">Phone No</label>
                                        <div class="col-sm-9">
                                            <div class="position-relative input-icon">
                                                 <input type="number" class="form-control" name="phone" placeholder="Type Phone Number" value="{{$data['phone_number']}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="input44" class="col-sm-3 col-form-label">Email Address</label>
                                        <div class="col-sm-9">
                                            <div class="position-relative input-icon">
                                                <input type="email" class="form-control"  placeholder="Type Email Address" name="email" value="{{$data['email_address']}}" required> 
                                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-envelope'></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    
                                    
                                    <div class="row mb-3" >
                                        <label for="input42" class="col-sm-3 col-form-label">User Type</label>
                                        <div class="col-sm-9">
                                            <div class="position-relative input-icon">
                                                <select name="user_type" id="user_typ" class="form-control" required>
                                                    <option value="">Select User Type</option>
                                                    <option value="operation_manager"<?php if($data['user_type'] =='operation_manager'){echo 'selected';}?>>Operation Manager</option>
                                                    <option value="team_manager"<?php if($data['user_type'] =='team_manager'){echo 'selected';}?>>Team Manager</option>
                                                    <option value="customer_success_manager"<?php if($data['user_type'] =='customer_success_manager'){echo 'selected';}?>>Customer Success Manager</option>
                                                    <option value="bookkeeper"<?php if($data['user_type'] =='bookkeeper'){echo 'selected';}?>>Bookkeeper</option>
                                                </select>
                                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"  style="display:none;" id="service_field">
                                        <div class="row mb-3" >
                                        <label for="input42" class="col-sm-3 col-form-label">Choose Services</label>
                                        <div class="col-sm-9">
                                            <div class="position-relative input-icon"> 

                                                <select multiple name="services[]"  class="form-control">
                                                    <option value="">Select Services </option>
                                                    @if($data['user_type'] == 'team_manager')
                                                    @foreach ($s_data as $item)
                                                            <option value="{{$item->service_id}}">{{$item->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row"  style="display:none;" id="member_service">
                                        <div class="row mb-3" >
                                        <label for="input42" class="col-sm-3 col-form-label">Choose Services</label>
                                        <div class="col-sm-9">
                                            <div class="position-relative input-icon"> 
                                                <select  name="m_service"  class="form-control" required >
                                                    <option value="">Select Services </option>                                    
                                                    @if($data['user_type']=='customer_success_manager')

                                                    @foreach ($services as $item)
                                                            <option value="{{$item->service_id}}"<?php if($item->service_id == $customer_service->member_service_id){echo 'selected';}?>>{{$item->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
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
                                                <div class="form-check form-switch">     
                                                  <input type="hidden" name="service_manage" value="0">

                                                    <input class="form-check-input" value="1" name="service_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault1" <?php if($permissions_data['service_permission'] =='1'){echo 'checked';}?>>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault1">Service Manage</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">      
                                                 <input type="hidden" name="leads_manage" value="0">
                                                    <input class="form-check-input" name="leads_manage" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault2" <?php if($permissions_data['leads_permission'] =='1'){echo 'checked';}?>>

                                                    <label class="form-check-label" for="flexSwitchCheckDefault2">Lead Manage</label>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">            
                                                 <input type="hidden" name="invoice_permission" value="0">
                                                    <input class="form-check-input" name="invoice_permission" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault3" <?php if($permissions_data['invoice_permission'] =='1'){echo 'checked';}?>>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault3">Invoice Manage</label>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">       
                                                 <input type="hidden" name="payment_permission" value="0">
                                                  <input class="form-check-input" value="1" name="payment_permission" type="checkbox" role="switch" id="flexSwitchCheckDefault4" <?php if($permissions_data['payment_permission'] =='1'){echo 'checked';}?>>
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
                                                    <input class="form-check-input" value="1" name="customer_manage" type="checkbox" role="switch" id="flexSwitchCheckDefault6" <?php if($permissions_data['customer_permission'] =='1'){echo 'checked';}?> >
                                                    <label class="form-check-label" for="flexSwitchCheckDefault6">Customer Manage</label>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">             
                                                    <input type="hidden" name="email_sms_manage" value="0">
                                                    <input class="form-check-input" name="email_sms_manage" value="on" type="checkbox" role="switch" id="flexSwitchCheckDefault7" <?php if($permissions_data['email_sms_permission'] =='on'){echo 'checked';}?>>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault7">Email & SMS View </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">      
                                                   <input type="hidden" name="communication" value="0">
                                                    <input class="form-check-input" name="communication" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault8" <?php if($permissions_data['communication_permission'] =='1'){echo 'checked';}?>>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault8">Communication </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">         
                                                   <input type="hidden" name="report" value="0">
                                                    <input class="form-check-input" value="1" name="report" type="checkbox" role="switch" id="flexSwitchCheckDefault9" <?php if($permissions_data['report_permission'] =='1'){echo 'checked';}?>>
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

                                                    <input class="form-check-input" name="document_view" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault10"<?php if($permissions_data['document_view_permission'] =='1'){echo 'checked';}?> >
                                                    <label class="form-check-label" for="flexSwitchCheckDefault10">Document View </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">           
                                                   <input type="hidden" name="client_financial" value="0">
                                                   <input class="form-check-input" value="1" name="client_financial" type="checkbox" role="switch" id="flexSwitchCheckDefault12"<?php if($permissions_data['client_financial_data_permission'] =='1'){echo 'checked';}?>>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault12">Client Financial Data</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">           
                                                   <input type="hidden" name="client_contact_info" value="0">
                                                    <input class="form-check-input" value="1" name="client_contact_info" type="checkbox" role="switch" id="flexSwitchCheckDefault13" <?php if($permissions_data['client_contact_permission'] =='1'){echo 'checked';}?>>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault13">Client Contact Info</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">           
                                                   <input type="hidden" name="delete_client" value="0">
                                                    <input class="form-check-input" name="delete_client" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault15" <?php if($permissions_data['delete_client_record_permission'] =='1'){echo 'checked';}?> >
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

                                                    <input class="form-check-input" name="delete_all_record" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault19" <?php if($permissions_data['delete_all_record_permission'] =='1'){echo 'checked';}?>>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault19">Delete All Record</label>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">        
                                                   <input type="hidden" name="document_download" value="0">

                                                    <input class="form-check-input" name="document_download" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault20" <?php if($permissions_data['document_download_permission'] =='1'){echo 'checked';}?>>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault20">Document Download </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">           
                                                   <input type="hidden" name="lead_assign" value="0">
                                                    <input class="form-check-input" name="lead_assign" value="1" type="checkbox" role="switch" id="hello" <?php if($permissions_data['lead_assign_permission'] =='1'){echo 'checked';}?>>
                                                    <label class="form-check-label" for="hello">Lead Assign</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">           
                                                    <input type="hidden" name="email_template" value="0">                                                  
                                                    <input class="form-check-input" name="email_template" value="1" type="checkbox" role="switch" id="helo2" <?php if($permissions_data['email_template_permission'] =='1'){echo 'checked';}?>>
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

                                                    <input class="form-check-input" name="history_manage" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault131" <?php if($permissions_data['login_history_permission'] =='1'){echo 'checked';}?>>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault131">History Manage</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">           
                                                    <input type="hidden" name="member_manage" value="0">

                                                    <input class="form-check-input" name="member_manage" value="1" type="checkbox" role="switch" id="565" <?php if($permissions_data['customer_success_manager_permission']>0){echo 'checked';}?>>
                                                    <label class="form-check-label" for="565">Manage Customer Success Manager</label>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">           
                                                    <input type="hidden" name="manager_manage" value="0">
                                                    <input class="form-check-input" name="manager_manage" value="1" type="checkbox" role="switch" id="211" <?php if($permissions_data['team_manager_permission'] =='1'){echo 'checked';}?>>
                                                    <label class="form-check-label" for="211">Team Manager Manage</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <div class="d-flex align-items-center gap-3">
                                                <div class="form-check form-switch">              
                                                    <input type="hidden" name="user_registration" value="0">

                                                    <input class="form-check-input" name="user_registration" value="1" type="checkbox" role="switch" id="1000"<?php if($permissions_data['user_registration_permission'] =='1'){echo 'checked';}?> >
                                                    <label class="form-check-label" for="1000">Create New User or Registration User</label>
                                                </div>
                                            </div>
                                        </div>
                                        	<div class="col-sm-3">
												<div class="d-flex align-items-center gap-3">
												<div class="form-check form-switch">
													<input type="hidden" name="package" value="0">
													<input class="form-check-input" name="package" value="1" type="checkbox" role="switch" id="3002" <?php if($permissions_data['package_permission'] =='1'){echo 'checked';}?> >
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
                                                <button type="submit" class="btn btn-primary px-4" style="height:46px;" id="btn">Submit</button>
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
               

<script>
    var user_type = $('#user_typ').val();
    if(user_type == 'team_manager'){
        document.getElementById("service_field").style.display="block";
    }else{
        document.getElementById("service_field").style.display="none";
    }

    if(user_type == 'customer_success_manager'){
        document.getElementById("member_service").style.display="block";
    }else{
        document.getElementById("member_service").style.display="none";
    }
</script>
                