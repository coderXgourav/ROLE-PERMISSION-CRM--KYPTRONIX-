
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
								<div >
									<form id="filterForm" action="/admin/service_filter" method="GET">
										<div class="row">
										<div class="col-md-3">
											<select name="service"  class="form-control" id="serviceFilter" >
												<option value="">Filter Services</option>
												@foreach ($services as $item)
													<option  value="{{$item->service_id}}" {{ request('service') == $item->service_id ? 'selected' : '' }}>{{$item->name}}</option>
												@endforeach
												
											</select>
										</div>
										<div class="col-md-3">
											<input type="text" name="lead_name" id="lead_name" placeholder="Name" class="form-control" value="{{@request('lead_name')}}">
										</div>
									    <div class="col-md-3">
											<input type="text" name="lead_email" placeholder="Email" id="email" class="form-control"  value="{{@request('lead_email')}}">
										</div>
									     <div class="col-md-3">
											<input type="text" name="lead_ph_number" id="ph_number" placeholder="Number" class="form-control" value="{{@request('lead_ph_number')}}">
										</div>
									    <div class="col-md-3">
											<input type="text" name="lead_city" id="city" placeholder="City" class="form-control" value="{{@request('lead_city')}}">
										</div>
									   <div class="col-md-3">
											<input type="text" name="lead_state" placeholder="State" id="state" class="form-control" value="{{@request('lead_state')}}">
										</div>
									    <div class="col-md-3">
											<select name="status"  class="form-control" id="status" >
												<option value="">Status</option>
													<option {{ request('status') ==0? 'selected' : '' }}  value="0" >Enable</option>
													<option {{ request('status') ==1? 'selected' : '' }}   value="1" >Disable</option>
												
											</select>
										</div>
										
										<div class="col-md-2"><button type="submit" class="btn btn-success">Search</button></div>
									</div>
								
								</form> <br>
								</div>
						    <div id="serviceResults"></div>
							<table id="myTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No.</th>
										<th>Lead/Business Name</th>
										<th>Mobile No.</th>
										<th>Email</th>
										<th>Service</th>
										<th>City</th>
										<th>State</th>
										{{-- <th>Assigned To Team member</th> --}}
										{{-- <th>Assigned To Manager</th> --}}
										{{-- <th>Invoice Status</th> --}}
										<th>Status</th>
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
										<td>{{$value->service_names}}</td>
										<td>{{$value->city}}</td>
										<td>{{$value->state}}</td>

										{{-- <td>{{$value->city}}</td> --}}
										{{-- <td>{{$value->state}}</td> --}}
										{{-- <td>{{$value->first_name}} {{$value->last_name}}</td> --}}
										{{-- <td>{{$admin_data->first_name}} {{$admin_data->last_name}}</td> --}}
										{{-- <td></td> --}}
										 <td>
											<?php if($value->status == '1'){
											   echo 'Disable';}else{ echo 'Enable';}?></td>


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
										<td colspan="9" style="text-align: center; color:red;"><b> Records Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table> </br>
							<div>{{$data->links()}}</div>
						</div>
					</div>
				</div>
		
@include('admin.dashboard.footer')
<script>
	 $('#myTable').DataTable({
	 });
  

</script>
