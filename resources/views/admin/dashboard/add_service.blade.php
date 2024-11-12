@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
<style>
@media only screen and (max-width: 1500px) {

}

</style>
@push('title')
    <title>Add Service</title>
@endpush
<!-- <div class="row">
      <div class="col-lg-8 mx-auto">
			

			<div class="card">
				<form id="add_service_form">
					{{@csrf_field()}}
					<input type="hidden" id="reset">
					<input type="hidden" name="user_type" value="{{$admin_data->user_type}}">
				<div class="card-body p-4">
					<h5 class="mb-4">Add Service </h5>
						<div class="row mb-3">
							<label for="input42" class="col-sm-3 col-form-label">Service Name</label>
							<div class="col-sm-9">
								<div class="position-relative input-icon">
									<input type="text" class="form-control" placeholder="Type Service Name" name="name" id="name" required>
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
	</div> -->

	<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<!--<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Repeater</li>
							</ol>
						</nav>
					</div>-->
					<!--<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>-->
				</div>
				<!--end breadcrumb-->

               <form id="add_service_form">

				<!-- Repeater Html Start -->
                <div id="repeater">
                    <!-- Repeater Heading -->

                      <div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center justify-content-between">
								<h5 class="mb-0">Add Service</h5>
								<button class="btn btn-primary repeater-add-btn px-4">Add</button>
							</div>
						</div>
					  </div>
					
                    <!-- Repeater Items -->
					{{@csrf_field()}}
					 <input type="hidden" id="reset">
					 <input type="hidden" name="user_type" value="{{$admin_data->user_type}}">
				     <div>
						<div class="card">
							<div class="card-body">
								<div class="mb-3">
										<label for="" class="form-label">Service Name</label>
										<input type="text" class="form-control" id="name" placeholder="Type Service Name" name="name" required>
									</div>
									
							</div>
						</div>
                    </div>
                    
                    <div class="items" data-group="test">
						<div class="card">
							<div class="card-body">	
								<!-- Repeater Content -->
								<div class="item-content">
									<div class="mb-3">
										<label for="inputEmail1" class="form-label">Sub Service Name</label>
										<input type="text" class="form-control" id="sub_service_name" placeholder="Type Sub Service Name" data-name="name" name="sub_service_name[]">
									</div>
								</div>
								<!-- Repeater Remove Btn -->
								<div class="repeater-remove-btn">
									<button class="btn btn-danger remove-btn px-4">
										Remove
									</button>
								</div>
							</div>
						</div>
                    </div>
                    
                </div>
                <!-- Repeater End -->
				<button type="submit" class="btn btn-primary px-4" style="height:46px; align-items: center;" id="btn">Submit</button>
               </form>

			</div>


				
@include('admin.dashboard.footer')
	<script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{url('assets/js/jquery.min.js')}}"></script>
	<script src="{{url('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{url('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{url('assets/plugins/form-repeater/repeater.js')}}"></script>
	<script>
        /* Create Repeater */
        $("#repeater").createRepeater({
            showFirstItemToDefault: false,
        });
    </script>