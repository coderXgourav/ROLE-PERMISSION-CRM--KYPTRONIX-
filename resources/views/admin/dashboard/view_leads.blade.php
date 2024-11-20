
@include('admin.dashboard.header')

 {{-- <!-- @extends('team.dashboard.header') --> --}}
@push('title')
    <title>My Clients</title>
@endpush

<style>
/* Custom Gradient Background */
.bg-gradient-primary {
    background:#008cff;
}

/* Custom Input Styling */
.custom-input {
	height: 50px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    padding: 12px;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
}

.custom-input:focus {
    border-color: #4158d0;
    box-shadow: 0 0 0 0.2rem rgba(65, 88, 208, 0.25);
    background-color: #fff;
}

/* Custom Select Styling */
.custom-select {
	height: 50px;

    border-radius: 8px;
    border: 1px solid #e0e0e0;
    padding: 12px;
    background-color: #f8f9fa;
    cursor: pointer;
}

.custom-select:focus {
    border-color: #4158d0;
    box-shadow: 0 0 0 0.2rem rgba(65, 88, 208, 0.25);
    background-color: #fff;
}

/* Gradient Button */
.btn-gradient {
    background: #008cff;
    border: none;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(65, 88, 208, 0.3);
}

/* Form Label Styling */
.form-label {
    font-weight: 500;
    font-size: 0.9rem;
}

/* Card Styling */
.card {
    transition: all 0.3s ease;
}

/* .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
} */

/* Responsive Adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 1rem;
    }
    
    .btn-gradient {
        padding: 10px 20px;
    }
}
</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
					<div class="card-body">
						
						
							

						<div class="table-responsive">
								<div >
									<form id="filterForm" method="GET">
										  <div class="card-header bg-white py-3">
    </div>
    {{-- <div class="card-body">
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
    </div> --}}

	<div class="card shadow-lg border-0 bg-white rounded-lg">
    <div class="card-header bg-gradient-primary text-white py-3 rounded-top">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">
                <i class="bi bi-funnel-fill me-2"></i>Advanced Lead Filter
            </h5>
           
			<div>
 <button type="button" class="btn btn-danger btn-sm" onclick="clearFilters()">
                <i class="bi bi-arrow-counterclockwise"></i> Clear Filters
            </button>
			<a href="{{route('admin.export')}}" class="btn btn-sm btn-success">Export Leads</a>
			</div>
        </div>
    </div>
    
    <div class="card-body p-4">
        <form id="filterForm" method="GET" class="needs-validation">
            <div class="row g-4">
                <!-- Service Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-group custom-select-wrapper">
                        <label for="serviceFilter" class="form-label text-muted mb-2">
                            <i class="bi bi-gear-fill me-1"></i> Service
                        </label>
                        <select name="service" class="form-select custom-select filter custom-input" id="serviceFilter" >
                            <option value="">All Services</option>
                            @foreach ($services as $item)
                                <option value="{{ $item->service_id }}" 
                                    {{ request('service') == $item->service_id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Name Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="lead_name" class="form-label text-muted mb-2">
                            <i class="bi bi-person-fill me-1"></i> Name
                        </label>
                        <input type="text" class="form-control custom-input " id="lead_name" name="lead_name" 
                               placeholder="Search by name" value="{{ request('lead_name') }}">
                    </div>
                </div>

                <!-- Email Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="email" class="form-label text-muted mb-2">
                            <i class="bi bi-envelope-fill me-1"></i> Email
                        </label>
                        <input type="email" class="form-control custom-input" id="email" name="lead_email" 
                               placeholder="Search by email" value="{{ request('lead_email') }}">
                    </div>
                </div>

                <!-- Phone Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="ph_number" class="form-label text-muted mb-2">
                            <i class="bi bi-telephone-fill me-1"></i> Phone
                        </label>
                        <input type="text" class="form-control custom-input" id="ph_number" name="lead_ph_number" 
                               placeholder="Search by phone" value="{{ request('lead_ph_number') }}">
                    </div>
                </div>

                <!-- City Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="city" class="form-label text-muted mb-2">
                            <i class="bi bi-building me-1"></i> City
                        </label>
                        <input type="text" class="form-control custom-input" id="city" name="lead_city" 
                               placeholder="Search by city" value="{{ request('lead_city') }}">
                    </div>
                </div>

                <!-- State Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="state" class="form-label text-muted mb-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> State
                        </label>
                        <input type="text" class="form-control custom-input" id="state" name="lead_state" 
                               placeholder="Search by state" value="{{ request('lead_state') }}">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="status" class="form-label text-muted mb-2">
                            <i class="bi bi-toggle-on me-1"></i> Status
                        </label>
                        <select name="status" class="form-select custom-select custom-input" id="status">
                            <option value="">All Status</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                                <i class="bi bi-check-circle-fill text-success"></i> Enable
                            </option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>
                                <i class="bi bi-x-circle-fill text-danger"></i> Disable
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-md-3 col-sm-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 btn-sm " style="height: 50px" >
                        <i class="bi bi-search me-2"></i>Search Leads
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
								
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
	 
<script>
function clearFilters() {
    const form = document.getElementById('filterForm');
    const inputs = form.getElementsByTagName('input');
    const selects = form.getElementsByTagName('select');
    
    // Clear all inputs
    for(let input of inputs) {
        input.value = '';
    }
    
    // Reset all selects
    for(let select of selects) {
        select.selectedIndex = 0;
    }
    
    // Submit the form
    form.submit();
}
</script>
  

</script>
