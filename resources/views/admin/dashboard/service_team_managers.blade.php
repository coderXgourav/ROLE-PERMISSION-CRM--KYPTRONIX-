
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title>Team Managers</title>
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
										{{-- <th>Service</th> --}}
										<th>Mobile No.</th>
										<th>Email</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($team_manager)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($team_manager as $key => $value)
                                    <tr id="{{$value->id }}">
										<td>{{$i++}}</td>
										<td>{{$value->first_name}} {{$value->last_name}}</td>
										{{-- <td>{{$value->service_name}}</td> --}}
										<td>{{$value->phone_number}}</td>
										<td>{{$value->email_address}}</td>
										
									
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="5" style="text-align: center; color:red;"><b>Team Managers Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table>
							<div>{{$team_manager->links()}}</div>
						</div>
					</div>
				</div>
@include('admin.dashboard.footer')
<script>
	 $('#myTable').DataTable({
	 });
</script>
