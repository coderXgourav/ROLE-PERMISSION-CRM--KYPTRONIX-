@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
<style>
@media only screen and (max-width: 1500px) {
 
}

</style>
@push('title')
    <title>Edit Package</title>
@endpush
<div class="row">
                    <div class="col-lg-8 mx-auto">
						

						<div class="card">
							<form id="update_package_form">
								{{@csrf_field()}}
								<input type="hidden" id="package_id"  name="package_id" value="{{$data->package_id}}">
							<div class="card-body p-4">
								<h5 class="mb-4">Edit Package </h5>
										<div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Package Title</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Package Title" name="title" id="title" value="{{$data->title}}">
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
											</div>
										</div>
									</div> 
								    <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Price</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="number" class="form-control" placeholder="Package Price" name="price" id="price" value="{{$data->price}}">
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
											</div>
										</div>
									</div> 
								     <div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Short Description</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
											    <input type="text" class="form-control" placeholder="Package Short Description" name="desc" id="desc" value="{{$data->desc}}">
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
				</div><!--end row-->
				
				
@include('admin.dashboard.footer')