@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}

@push('title')
    <title>Password Change</title>
@endpush

	<div class="card">
        <form id="change_password_form">
	      			<div class="card-body p-4">
								<h5 class="mb-4">Change Password </h5>
									<div class="row mb-3">
										<label for="input35" class="col-sm-3 col-form-label">Enter Old Password</label>
										<div class="col-sm-9">
											<input type="text" name="old" class="form-control" id="input35" placeholder="Type Your Old Password" required>
										</div>
										{{@csrf_field()}}
									</div>
									<div class="row mb-3">
										<label for="input36" class="col-sm-3 col-form-label">Enter New Password</label>
										<div class="col-sm-9">
											<input type="password" name="new" class="form-control" id="password" placeholder="Type New Password" required>
										</div>
									</div>
									<div class="row mb-3">
										<label for="input37" class="col-sm-3 col-form-label">Enter Confirm Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control" name="confirm" id="input37" placeholder="Type Confirm Password" required>
										</div>
									</div>
									
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<div class="d-md-flex d-grid align-items-center gap-3">
												<button style='width:175px; height:45px;'  type="submit" class="btn btn-primary" id="MyBtn">Change Password</button>
												<button style='width:175px; height:45px;' type="reset" class="btn btn-light px-4">Reset</button>
											</div>
										</div>
									</div>
							</div>
                     </form>

						</div>
    @include('admin.dashboard.footer')
	