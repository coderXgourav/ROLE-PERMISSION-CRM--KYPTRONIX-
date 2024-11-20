
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
									<form id="filterForm" method="GET">
										<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="card-title mb-0">Filter Leads</h5>
    </div>
    <div class="card-body">
        <form id="filterForm" method="GET" class="needs-validation">
            <div class="row g-3">
                <!-- Service Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-floating">
                        <select name="service" class="form-select" id="serviceFilter">
                            <option value="">All Services</option>
                            @foreach ($services as $item)
                                <option value="{{ $item->service_id }}" {{ request('service') == $item->service_id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="serviceFilter">Service</label>
                    </div>
                </div>

                <!-- Name Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="lead_name" name="lead_name" 
                               placeholder="Enter name" value="{{ request('lead_name') }}">
                        <label for="lead_name">Name</label>
                    </div>
                </div>

                <!-- Email Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="lead_email" 
                               placeholder="Enter email" value="{{ request('lead_email') }}">
                        <label for="email">Email</label>
                    </div>
                </div>

                <!-- Phone Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="ph_number" name="lead_ph_number" 
                               placeholder="Enter phone" value="{{ request('lead_ph_number') }}">
                        <label for="ph_number">Phone Number</label>
                    </div>
                </div>

                <!-- City Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="city" name="lead_city" 
                               placeholder="Enter city" value="{{ request('lead_city') }}">
                        <label for="city">City</label>
                    </div>
                </div>

                <!-- State Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="state" name="lead_state" 
                               placeholder="Enter state" value="{{ request('lead_state') }}">
                        <label for="state">State</label>
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-floating">
                        <select name="status" class="form-select" id="status">
                            <option value="">All Status</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Enable</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Disable</option>
                        </select>
                        <label for="status">Status</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-md-3 col-sm-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-2"></i>Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
										<div class="row">
										<div class="col-md-3">
											<select name="service"  class="form-control" id="serviceFilter" >
												<option value="">Filter Services</option>
												@foreach ($services as $item)
													<option  value="{{$item->service_id}}">{{$item->name}}</option>
												@endforeach
												
											</select>
										</div>
										<div class="col-md-3">
											<input type="text" name="lead_name" id="lead_name" placeholder="Name" class="form-control">
										</div>
									    <div class="col-md-3">
											<input type="text" name="lead_email" placeholder="Email" id="email" class="form-control">
										</div>
									     <div class="col-md-3">
											<input type="text" name="lead_ph_number" id="ph_number" placeholder="Number" class="form-control">
										</div>
									    <div class="col-md-3">
											<input type="text" name="lead_city" id="city" placeholder="City" class="form-control">
										</div>
									   <div class="col-md-3">
											<input type="text" name="lead_state" placeholder="State" id="state" class="form-control">
										</div>
									    <div class="col-md-3">
											<select name="status"  class="form-control" id="status">
												<option value="">Status</option>
													<option  value="0">Enable</option>
													<option  value="1">Disable</option>
												
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
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Get filter values
        let service = Array.from(document.getElementById('serviceFilter').selectedOptions).map(option => option.value);
        let status = Array.from(document.getElementById('status').selectedOptions).map(option => option.value);

        let lead_name = document.getElementById('lead_name').value;
        let lead_email = document.getElementById('email').value;
        let lead_ph_number = document.getElementById('ph_number').value;
        let lead_city = document.getElementById('city').value;
        let lead_state = document.getElementById('state').value;

        // Prepare the data for the AJAX request
        let filterData = {
            service: service,
            status:status,
            lead_name:lead_name,
            lead_email:lead_email,
            lead_ph_number:lead_ph_number,
            lead_city:lead_city,
            lead_state:lead_state
        };

        // Send AJAX request to Laravel backend
        fetch('/admin/service_filter?' + new URLSearchParams(filterData).toString())
            .then(response => response.json())
            .then(data => {
                // Handle the response and update the UI
                let myTable = document.getElementById('myTable');
                myTable.innerHTML='';
                serviceResults.innerHTML = '';
                
                data.forEach(service => {
                    let serviceElement = document.createElement('div');
                    serviceElement.innerHTML = ``;
                    serviceResults.appendChild(serviceElement);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
//{service.name}
</script>
