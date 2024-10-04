
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title>My Clients</title>
@endpush
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
					
<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="myTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No.</th>
										<th>Name</th>
										<th>Mobile No.</th>
										<th>Email</th>
										<th>Message</th>
										<th style="text-align: center">Action</th>

									</tr>
								</thead>
								<tbody>
                                    @if(count($client_data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($client_data as $key => $value)
                                    <tr id="{{$value->customer_id}}">
										<td>{{$i++}}</td>
										<td>{{$value->customer_name}}</td>
										<td>{{$value->customer_number}}</td>
										<td>{{$value->customer_email}}</td>
										<td>{{$value->msg}}</td>
										<td colspan="3" style="display: flex; justify-content:center;">
												  @php
										  $id = encrypt($value->customer_id);
									  @endphp
								    <a href="#"  class="btn btn-success"><i class="fa fa-phone" aria-hidden="true"></i></a>
									&nbsp;
                                   <div id="volume-indicators">
									
										<a href="#"  class="btn btn-primary "><i class="fa fa-envelope" aria-hidden="true"></i></a>
										
										<a href="#" class="btn btn-warning" ><i class="fa fa-commenting" aria-hidden="true"></i></a>
                                     </div>
									</td>
									
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="6" style="text-align: center; color:red;"><b>Not Found..!</b></td>
										
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
