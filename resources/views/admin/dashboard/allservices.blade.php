
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title> Service Table</title>
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
										<th>Service Name</th>
										<th>Date</th>
										<th>Details Show</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($data as $key => $value)
                                    <tr id="{{$value->service_id}}">
										<td>{{$i++}}</td>
										<td>{{$value->name}}</td>
										<td>{{$value->created_at}}</td>
										@php
										$service_id = Crypt::encrypt($value->service_id);
									   @endphp
										<td>   <a href="{{route('admin.view-service',['id'=>$service_id])}}" class="btn btn-primary btn-sm radius-30 px-4">View Details</a></td>
										<td>
										
											 <div class="d-flex order-actions">
											<a href="{{route('admin.edit-service',['id'=>$service_id])}}" class="bg-primary" style="color:white"><i class='bx bxs-edit'></i></a>
											@if ($admin_data->user_type=="admin")
												<a href="javascript:;"  onclick="DeleteService({{$value->service_id}})"  class="ms-3 bg-danger" style="color: white"><i class='bx bxs-trash'></i></a>
												
											@endif
											 </div>
										</td>
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="5" style="text-align: center; color:red;"><b> Records Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table>
							<div>
								{{$data->links()}}
							</div>
						</div>
					</div>
				</div>
@include('admin.dashboard.footer')
<script>
	 $('#myTable').DataTable({
	 });
</script>
