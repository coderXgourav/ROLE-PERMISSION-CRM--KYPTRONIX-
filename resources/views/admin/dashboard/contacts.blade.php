
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
								<div >
									@if ($admin_data->user_type!="team_manager")

									<form action="/admin/contacts/" method="GET">
										<div class="row">
										<div class="col-md-4">
												
								<!-- <select name="filter"  class="form-control" id="" >
									<option value="">Filter Users</option>
									<option value="Operation Managers"  {{ request('filter') == 'Operation Managers' ? 'selected' : '' }}>Operation Managers</option>
									<option value="Team Managers"  {{ request('filter') == 'Team Managers' ? 'selected' : '' }}>Team Managers</option>
									<option value="Customer Success Manager"  {{ request('filter') == 'Customer Success Manager' ? 'selected' : '' }}>Customer Success Manager</option>
								</select>
                                 --> 
                                  <select class="form-select" id="" name="filter" required onchange="StaffType(this.value)">
			                            <option value="">Filter Users</option>
			                       @foreach ($roles as $item)
			                       <option value="{{$item->id}}" {{ request('filter') == '$item->id' ? 'selected' : '' }}>{{$item->modern_name}}</option>
			                       @endforeach
			                        </select>

										</div>
										<div class="col-md-2"><button type="submit" class="btn btn-success">Search</button></div>
									</div>
								
								</form> <br>
								@endif

								</div>
								<thead>
									<tr>
										<th>No.</th>
										<th>Name</th>
										<th>User Type</th>
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
                                    <tr id="{{$value->id}}">
										<td>{{$i++}}</td>
										<td>{{ucwords($value->first_name)}} {{ucwords($value->last_name)}}</td>
										<td>{{ucwords($value->modern_name)}}</td>
										<td>{{$value->phone_number}}</td>
										<td>{{$value->email_address}}</td>
										
										  @php
										   $user_id = Crypt::encrypt($value->id);
										  @endphp
									

									<td>  
										 <a href="{{route('admin.view_team_member',['id'=>$user_id])}}" class="btn btn-primary btn-sm radius-30 px-4">View Details</a></td>
										<td>
										
											 <div class="d-flex order-actions">
									
											<a href="{{route('admin.edit',['id'=>$value->id])}}" class="bg-primary" style="color:white"><i class='bx bxs-edit'></i></a>
												
		                                    @if ($admin_data->user_type=="admin")
												<a href="javascript:;"  onclick="DeleteTeam({{$value->id}})"  class="ms-3 bg-danger" style="color: white"><i class='bx bxs-trash'></i></a>
											@endif
											
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
							{{$data->links()}}
						</div>
					</div>
				</div>
@include('admin.dashboard.footer')
<script>
	 $('#myTable').DataTable({
	 });
</script>
