
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
						<div class="table-responsive">
							<table id="myTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No.</th>
										<th>Name</th>
										<th>Mobile No.</th>
										<th>Email</th>
										<th>Service</th>
										<th>Assigned to Manager</th>
										<th>Assigned to Team member</th>
										<th>Document</th>
										<th style="text-align: center">Action</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($data as $key => $value)
                                    <?php
                                      if(!empty($value->team_member)){
	                                      $main_user_id = json_decode($value->team_member);
	                                      $main_user_data=DB::table('main_user')
	                                      ->select('main_user.first_name','main_user.last_name')
	                                      ->whereIn('main_user.id',$main_user_id)
	                                      ->get();
	                                   }
	                                   if(!empty($value->customer_service_id)){
	                                      $team_manager=DB::table('main_user')
	                                   	  ->select('main_user.first_name','main_user.last_name')
	                                   	  ->join('team_manager_services','team_manager_services.team_manager_id','=','main_user.id')
	                                      ->where('team_manager_services.managers_services_id',$value->customer_service_id)
	                                      ->get();
 
	                                   }
                                     ?>
                                    <tr id="{{$value->customer_id}}">
										<td>{{$i++}}</td>
										<td>{{$value->customer_name}}</td>
										<td>{{$value->customer_number}}</td>
										<td>{{$value->customer_email}}</td>
										<td>{{$value->service_names}}</td>
										<td><?php if(!empty($team_manager)){ 
                                                  foreach($team_manager as $val){
                                                      echo $val->first_name .' ' . $val->last_name.'<br>';


                                              } } ?>
                                              	
                                        </td>
										<td>
                                              <?php if(!empty($main_user_data)){ 
                                                  foreach($main_user_data as $val){
                                                      echo $val->first_name .' ' . $val->last_name.'<br>';


                                              } } ?>
										</td>
										 @php
										  $id = encrypt($value->customer_id);
									    @endphp								     
										<td> <a href="{{route('admin.document',['id'=>$id])}}" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                       </td>
									   <td colspan="3" style="display: flex; justify-content:center;">
									   {{-- <center> --}}
									 <input type="hidden" id="phone-number" type="text" value="{{$value->customer_number}}"  />
								      <input type="hidden" name="role" value="{{$admin_data->user_type}}">
								     <input type="hidden" name="user_id" value="{{$admin_data->id}}">
								   
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
										<td colspan="14" style="text-align: center; color:red;"><b> Records Not Found..!</b></td>
										
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
