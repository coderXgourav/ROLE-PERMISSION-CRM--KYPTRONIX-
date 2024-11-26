
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title>Login History</title>
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
										<th>Role</th>
										<th>Type</th>
										<th>IP Address</th>
										<th>Image</th>
										<th>Location</th>
										<th>Date</th>
										<th> Time</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($data as $key => $value)
                                    <tr>
										<td>{{$i++}}</td>
										<td>{{ucwords($value->first_name)}} {{ucwords($value->last_name)}}</td>
										<td>{{$value->modern_name}}</td>
										<td>{{ucwords($value->operation)}}</td>
										<td>{{$value->ip_address}}</td>
										<td><img src="{{url('/staff_images')}}/{{$value->image}}" alt="" style="width: 175px;"></td>
										<td>{{$value->city, $value->country}}</td>
									<td>{{ $value->logged_in_at ? \Carbon\Carbon::parse($value->logged_in_at)->format('d-m-Y') : 'N/A' }}</td>

									<td>{{ $value->logged_in_at ? \Carbon\Carbon::parse($value->logged_in_at)->format('h:i A') : 'N/A' }}</td>

									
								
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="6" style="text-align: center; color:red;"><b> Records Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table> <br>
							<div>{{$data->links()}}</div>
						</div>
					</div>
				</div>
@include('admin.dashboard.footer')
<script>
	 $('#myTable').DataTable({
	 });
</script>
