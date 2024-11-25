<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
</head>
<body>
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
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($leads_data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($leads_data as $key => $value)
                                    <tr id="{{$value->customer_id}}">
										<td>{{$i++}}</td>
										<td>{{$value->customer_name}}</td>
										<td>{{$value->customer_number}}</td>
										<td>{{$value->customer_email}}</td>
										<td>{{$value->service_names}}</td>
										<td>{{$value->city}}</td>
										<td>{{$value->state}}</td>
										<td>
											<?php if($value->status == '1'){
											   echo 'Disable';}else{ echo 'Enable';}?></td>


									
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="9" style="text-align: center; color:red;"><b> Records Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table>
							
</body>
</html>
