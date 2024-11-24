@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
<style>
@media only screen and (max-width: 1500px) {

}

</style>
@push('title')
    <title>Add Service</title>
@endpush
<div class="row">
      <div class="col-lg-10 mx-auto">
			

			<div class="card">
				<form id="add_role_form">
					{{@csrf_field()}}
					<input type="hidden" id="reset">
				<div class="card-body p-4">
					<h5 class="mb-4">Add Role </h5>
						<div class="row mb-3">
							<label for="input42" class="col-sm-3 col-form-label">Role Name <span style="color:red;">*</span></label>
							<div class="col-sm-9">
								<div class="position-relative input-icon flex">
									<input type="text" class="form-control" placeholder="Type Role Name" name="name" id="name" required>
									<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
								</div>
							</div>
						</div> 					    
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
	</div>

	
				
@include('admin.dashboard.footer')
