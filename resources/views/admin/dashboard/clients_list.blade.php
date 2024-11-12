
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title>Client</title>
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
									</tr>
								</thead>
								<tbody>
                                    @if(count($clients)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($clients as $key => $value)
                                    <tr id="{{$value->customer_id }}">
										<td>{{$i++}}</td>
										<td>{{$value->customer_name}}</td>
										<td>{{$value->service_names}}</td>
										<td>{{$value->customer_number}}</td>
										<td>{{$value->customer_email}}</td>
										
									
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="5" style="text-align: center; color:red;"><b> Records Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table>
							<div>{{$clients->links()}}</div>
						</div>
					</div>
				</div>
@include('admin.dashboard.footer')
<script>
	 $('#myTable').DataTable({
	 });
</script>
