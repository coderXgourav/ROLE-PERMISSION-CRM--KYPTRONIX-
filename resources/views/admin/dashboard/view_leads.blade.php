
@include('admin.dashboard.header')
 {{-- <!-- @extends('team.dashboard.header') --> --}}
@push('title')
    <title>My Clients</title>
@endpush
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
					<div class="card-body">
						
						<div class="" style="display: flex; justify-content:space-between">	
							<div></div>
							<a href="{{route('admin.export')}}" class="btn btn-sm btn-success">Export Leads</a></div> 
							<div></div><br>

						<div class="table-responsive">
						
							<table id="myTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No.</th>
										<th>Lead/Business Name</th>
										<th>Mobile No.</th>
										<th>Email</th>
										<th>Service</th>
										{{-- <th>Assigned To Team member</th> --}}
										{{-- <th>Assigned To Manager</th> --}}
										{{-- <th>Invoice Status</th> --}}
										{{-- <th>Status</th> --}}
										<th style="text-align: center">Action</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($data as $key => $value)
                                    <tr id="{{$value->customer_id}}">
										<td>{{$i++}}</td>
										<td>{{$value->customer_name}}</td>
										<td>{{$value->customer_number}}</td>
										<td>{{$value->customer_email}}</td>
										<td>{{$value->name}}</td>
										{{-- <td>{{$value->first_name}} {{$value->last_name}}</td> --}}
										{{-- <td>{{$admin_data->first_name}} {{$admin_data->last_name}}</td> --}}
										{{-- <td></td> --}}
										{{-- <td><?php if($value->status == '1'){
											   echo 'Active';}else{ echo 'Disable';}?></td> --}}


										<td colspan="3" style="display: flex; justify-content:center;">
											
									  @php
										  $id = encrypt($value->customer_id);
									  @endphp
								     <input type="hidden" id="phone-number" type="text" value="{{$value->customer_number}}"  />
								      <input type="hidden" name="role" value="{{$admin_data->user_type}}">
								     <input type="hidden" name="user_id" value="{{$admin_data->id}}">
								    <!-- <button onclick="ConvertToClient({{$value->customer_id}},{{$admin_data->id}},'{{$admin_data->user_type}}')" type="button" class="btn btn-info"><i class="fa fa-exchange"></i></button>
                                     &nbsp;-->
								     <a href="{{route('admin.leads-view',['id'=>$id])}}" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    
                                 	 &nbsp;

									 <a href="{{ route('admin.call',['id'=>$id])}}"  class="btn btn-success"><i class="fa fa-phone" aria-hidden="true"></i></a>
									&nbsp;
                                   
                                    <div id="volume-indicators">
									
									   <a href="{{route('admin.send-email',['id'=>$id])}}"  class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i></a>
										
									   <a href="{{route('admin.send-message',['id'=>$id])}}" class="btn btn-secondary"><i class="fa fa-commenting" aria-hidden="true"></i></a>
                                       {{-- </center> --}}
									</td>
									
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="6" style="text-align: center; color:red;"><b> Records Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table>
							<div>{{$data->links()}}</div>
						</div>
					</div>
				</div>
		
@include('admin.dashboard.footer')
<script>
	 $('#myTable').DataTable({
	 });
</script>
