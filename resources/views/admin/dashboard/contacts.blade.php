
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title>Team Members</title>
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
										<th>Name</th>
										<th>Service</th>
										<th>Mobile No.</th>
										<th>Email</th>
										<th>Show Details</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($data as $key => $value)
                                    <tr id="{{$value->user_id}}">
										<td>{{$i++}}</td>
										<td>{{$value->name}}</td>
										<td>{{$value->service_name}}</td>
										<td>{{$value->phone_number}}</td>
										<td>{{$value->email}}</td>
										
										  @php
										   $user_id = Crypt::encrypt($value->user_id);
										  @endphp
									

									<td>  
										 <a href="{{route('admin.view_team_member',['id'=>$user_id])}}" class="btn btn-primary btn-sm radius-30 px-4">View Details</a></td>
										<td>
										
											 <div class="d-flex order-actions">
											<a href="{{route('admin.edit',['id'=>$user_id])}}" class="bg-primary" style="color:white"><i class='bx bxs-edit'></i></a>

												<a href="javascript:;"  onclick="DeleteTeam({{$value->user_id}})"  class="ms-3 bg-danger" style="color: white"><i class='bx bxs-trash'></i></a>
											 </div>
										</td>
									
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="7" style="text-align: center; color:red;"><b>Team Records Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table>
						</div>
					</div>
				</div>
@include('admin.dashboard.footer')
<script>
	 $('#myTable').DataTable({
	 });
</script>
