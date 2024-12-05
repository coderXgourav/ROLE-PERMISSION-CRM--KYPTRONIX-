
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title> Role Table</title>
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
										<th>Role Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($data as $key => $value)
                                    <tr id="{{$value->id}}">
										<td>{{$i++}}</td>
										<td>{{ucwords($value->role_name)}}</td>
										@php
										$role_id = Crypt::encrypt($value->id);
									   @endphp
										<td>
										
											 <div class="d-flex order-actions">
											    <a href="{{route('admin.edit-role',['id'=>$role_id])}}" class="bg-primary" style="color:white"><i class='bx bxs-edit'></i></a>
												{{-- <a href="javascript:;"  onclick="DeleteRole({{$value->id}})"  class="ms-3 bg-danger" style="color: white"><i class='bx bxs-trash'></i></a> --}}
												
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
