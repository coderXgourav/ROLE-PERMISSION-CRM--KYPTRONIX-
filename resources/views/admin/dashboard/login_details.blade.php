
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title>Package</title>
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
										<th>Date</th>
										<th>Total Login Time</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($daily_login_times)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($daily_login_times as $key => $value)
                                    <tr>
										<td>{{$i++}}</td>
										<td>{{$value['date']}}</td>
										<td>{{$value['hours']}} hours {{$value['minutes']}} minutes</td>
										
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="5" style="text-align: center; color:red;"><b> Records Not Found..!</b></td>
										
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
