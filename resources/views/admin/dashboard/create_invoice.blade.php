@include('admin.dashboard.header')
{{-- @extends('admin.dashboard.header') --}}
<style>
@media only screen and (max-width: 1500px) {
 
}

</style>
@push('title')
    <title>Invoice</title>
@endpush
<div class="row">
                    <div class="col-lg-8 mx-auto">
						

						<div class="card">
							<form id="create_invoice_form">
								{{@csrf_field()}}
						
							<div class="card-body p-4">
								<h5 class="mb-4"> </h5>
								 	<!--<div class="row mb-3">
										<label for="input42" class="col-sm-3 col-form-label">Date</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="date" class="form-control" placeholder="date" name="date" id="name" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
											</div>
										</div>
									</div> -->
									<!--<div class="row mb-3">
								   	<label for="input42" class="col-sm-3 col-form-label"></label>
								   	<div class="col-sm-9">
											<div class="position-relative input-icon">
											<input class="form-check-input" value="0" type="checkbox" id="custom_package" name="custom" onchange="check_custom()"> Custom
											
										   </div>
                                      </div>
								   			
								   </div>-->
								
									<div class="row mb-3 package">
								   	<label for="input42" class="col-sm-3 col-form-label">Package</label>
								   	<div class="col-sm-9">
											<div class="position-relative input-icon">
												<select  name="customer_package_tem_id" id="customer_package_tem_id" class="form-control" onchange="check_package(this.value)" required >
													<option value="">Select Package </option>
											        @if(count($package_data)>0)

													@foreach ($package_data as $item)
													<option value="{{$item->customer_package_tem_id}}">{{$item->title}}</option>
													@endforeach
													@endif
												</select>
                                            </div>
                                      </div>
								   			
								   </div>
								   	{{-- <div class="row mb-3 custom_title" style="display:none;">
										<label for="input42" class="col-sm-3 col-form-label">Title</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="text" class="form-control" placeholder="Title" name="title" id="title" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
											</div>
										</div>
									</div> 
								
									<div class="row mb-3" style="display:none;">
										<label for="input42" class="col-sm-3 col-form-label">Price</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<input type="number" class="form-control" placeholder="Price" name="price" id="price" required>
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
											</div>
										</div>
									</div> 
								    <div class="row mb-3" style="display:none;">
										<label for="input42" class="col-sm-3 col-form-label">Description</label>
										<div class="col-sm-9">
											<div class="position-relative input-icon">
												<textarea class="form-control" name="description" id="description"></textarea> 
												<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-detail'></i></span>
											</div>
										</div>
									</div>  --}}
								    
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<div class="d-md-flex d-grid align-items-center gap-3">
												<button type="submit" class="btn btn-primary px-4" style="height:46px;" id="btn" onclick="">Generate Invoice</button>

										   </div>
										</div>
									</div>
								</div>
							</form>
							</div>


								 
					</div>
				</div><!--end row-->
				<script type="text/javascript">
					  $('.custom_title').hide();
					  function check_custom(){
                         var checkedValue=$("#custom_package").is(":checked");
                         console.log(checkedValue);
                         if(checkedValue== true){
                         	$('.package').hide();
                         	$('#price').val('');
							$('#description').val('');
							$('.custom_title').show();
                         }else{
                            $('.package').show();
                            $('.custom_title').hide();

                          }
                         
					  }

						function check_package(package_id){
							 $.ajax({
							 	url: "/admin/get_package/" + package_id,
							 	method: "GET",
							 	dataType: "JSON",
							 	data: {package_id:package_id},
							 	contentType: false,
							 	processData: false,
							 	success: function (data) {
							 		console.log(data.price);
							 		$('#price').val(data.price);
							 	    $('#description').val(data.desc);

							    },
							   
	                         });


						}
				</script>
				
@include('admin.dashboard.footer')