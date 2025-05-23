@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
<style>
@media only screen and (max-width: 1500px) {
 
}

</style>
@push('title')
    <title>Edit Role</title>
@endpush
<div class="row">
                    <div class="col-lg-8 mx-auto">
						

						<div class="card">
							<form id="update_role_form">
								{{@csrf_field()}}
								<input type="hidden" id="role_id"  name="role_id" value="{{$data->id}}">
							<div class="card-body p-4">
								<h5 class="mb-4">Edit Service </h5>

								<div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Service</label>	
										<div class="col-sm-9">
											<div class="position-relative input-icon" style="display: flex;  align-items: center; gap:15px;">
												@foreach ($service as $item)
													<input type="checkbox"  name="service[]"  required value="{{$item->service_id}}" style="width: 20px" id="{{$item->service_id}}"	@if($data->main_service_id==$item->service_id) {{"checked"}} @endif  />
												
													 <label for="{{$item->service_id}}">{{$item->name}}</label>
												@endforeach
											</div>
										</div>
									</div> 

									<div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Role Name</label>	
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" name="name" placeholder="Type Role Name" value="{{ucwords($data->role_name)}}" required >
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
											</div>
										</div>
									</div> 
									
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<div class="d-md-flex d-grid align-items-center gap-3">
												<button type="submit" class="btn btn-primary px-4" style="height:46px;" id="btn" onclick="updateRoles()">Update</button>
												

										   </div>
										</div>
									</div>
								</div>
							</form>
							</div>


								 
					</div>
				</div><!--end row-->
				
	@include('admin.dashboard.footer')