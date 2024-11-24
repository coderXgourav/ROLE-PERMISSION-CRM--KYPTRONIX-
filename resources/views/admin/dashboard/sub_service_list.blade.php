
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title>Sub Service</title>
@endpush
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="myTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No.</th>
										<th>Sub Service</th>
										@if ($admin_data->user_type=="admin")

										<th>Action</th>
										@endif

									</tr>
								</thead>
								<tbody>
                                    @if(count($sub_service)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($sub_service as $key => $value)

                                    <tr id="{{$value->id }}">
										<td>{{$i++}}</td>
										<td>{{$value->service_name}}</td>
										@if ($admin_data->user_type=="admin")
										<td>
											@php
										     $service_id = Crypt::encrypt($value->service_id);
									        @endphp
										
										 <div class="d-flex order-actions">

											<a href="{{route('admin.edit-service',['id'=>$service_id])}}" class="bg-primary" style="color:white"><i class='bx bxs-edit'></i></a>
												<a href="javascript:;"  onclick="DeleteSubService({{$value->id}})"  class="ms-3 bg-danger" style="color: white"><i class='bx bxs-trash'></i></a>
												
										 </div>
										
										</td>
										@endif
	
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="5" style="text-align: center; color:red;"><b>Sub Service Not Found!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table>
							<div>{{$sub_service->links()}}</div>
						</div>
					</div>
				</div>
@include('admin.dashboard.footer')
<script>
	 $('#myTable').DataTable({
	 });
</script>
