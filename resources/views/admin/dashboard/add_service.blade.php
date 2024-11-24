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
				<form id="add_service_form">
					{{@csrf_field()}}
					<input type="hidden" id="reset">
					<input type="hidden" name="user_type" value="{{$admin_data->user_type}}">
				<div class="card-body p-4">
					<h5 class="mb-4">Add Service </h5>
						<div class="row mb-3">
							<label for="input42" class="col-sm-3 col-form-label">Service Name <span style="color:red;">*</span></label>
							<div class="col-sm-9">
								<div class="position-relative input-icon flex">
									<input type="text" class="form-control" placeholder="Type Service Name" name="name" id="name" required>
									<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
								</div>
							</div>
						</div> 
						<div id="subcategoryList" class="row mb-3 " >
							<label for="input42" class="col-sm-3 col-form-label">Sub Service Name</label>
							<div class="col-sm-9">
								<div class="position-relative input-icon"  style="display: flex; gap:10px ">
									<input type="text" class="form-control"  placeholder="Type Sub Service Name" data-name="name" name="subcategory[]"  >
									 <button type="button" class="btn-remove btn btn-danger btn-sm" onclick="removeSubcategory(this)">Remove</button>
									<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
								</div>
							</div>
						</div> 

			
							<br>
					    
						<div class="row">
							<label class="col-sm-3 col-form-label"></label>
							<div class="col-sm-9">
								<div class="d-md-flex d-grid align-items-center gap-3">
									<button type="submit" class="btn btn-primary px-4" style="height:46px;" id="btn">Submit</button>
						<button type="button" class="btn btn-success px-4 btn-add" onclick="addSubcategory()" style="height:46px;" id="btn">Add Sub Service</button>


							   </div>
							</div>
						</div>
					</div>
				</form>
				</div>
		</div>
	</div>

	<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					
				</div>


           

			</div>

<script type="text/javascript">
	    function addSubcategory() {
            const subcategoryList = document.getElementById('subcategoryList');
            const subcategoryGroup = document.createElement('div');
            subcategoryGroup.classList.add('subcategory-group');
            
            subcategoryGroup.innerHTML = `
               <div id="subcategoryList" class="row my-3">
							<label for="input42" class="col-sm-3 col-form-label">Sub Service Name</label>
							<div class="col-sm-9">
								<div class="position-relative input-icon d-flex"  style="display: flex; gap:10px " >
									<input type="text" class="form-control subcategory-input"  placeholder="Type Sub Service Name" data-name="name" name="subcategory[]">
									 <button type="button" class="btn-remove btn btn-danger btn-sm" onclick="removeSubcategory(this)">Remove</button>
									<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
								</div>
							</div>
						</div> 
            `;


            
            subcategoryList.appendChild(subcategoryGroup);
        }

        // Remove subcategory function
        function removeSubcategory(button) {
            button.closest('.subcategory-group').remove();
        }

</script>
				
@include('admin.dashboard.footer')
