@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}

@push('title')
    <title>Update Email Or Username </title>
@endpush

	<div class="card">
        <form id="change_username_form">
	      			<div class="card-body p-4">
								<h5 class="mb-4">Update Name , Email Or Username </h5> <br>
                                <div class="row mb-3">
										<label for="input35" class="col-sm-3 col-form-label">Enter First Name</label>
										<div class="col-sm-9">
											<input type="text" name="new_first_name" class="form-control" placeholder="Type First Name">
										</div>
									</div>
									 <div class="row mb-3">
										<label for="input35" class="col-sm-3 col-form-label">Enter Last Name</label>
										<div class="col-sm-9">
											<input type="text" name="new_last_name" class="form-control" placeholder="Type Last Name">
										</div>
									</div>
								
									<div class="row mb-3">
										<label for="input35" class="col-sm-3 col-form-label">Enter New Email</label>
										<div class="col-sm-9">
											<input type="email" name="new_email" class="form-control" id="input35" placeholder="Type Your New Email" >
										</div>
										{{@csrf_field()}}
									</div>
									<div class="row mb-3">
										<label for="input36" class="col-sm-3 col-form-label">Enter New Username</label>
										<div class="col-sm-9">
											<input type="text" name="new_account_name" class="form-control" id="password" placeholder="Type Your New Username" >
										</div>
									</div>
									
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<div class="d-md-flex d-grid align-items-center gap-3">
												<button style='width:175px; height:45px;'  type="submit" class="btn btn-primary" id="btn"> Update</button>
												<button style='width:175px; height:45px;' type="reset" class="btn btn-light px-4">Reset</button>
											</div>
										</div>
									</div>
							</div>
                     </form>

						</div>
    @include('admin.dashboard.footer')
	