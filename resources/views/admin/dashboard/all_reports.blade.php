
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title> Service Table</title>
@endpush
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="myTable" class="table table-striped" style="width:100%">
								<thead>
									<tr>
										<th>No.</th>
										<th>Service Name</th>
										<!-- <th>Team Manager</th>
										<th>Team Member</th>-->
										<th>Leads</th>
										<th>Invoice</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($data as $key => $value)
                                    <?php 
                                       $team_member=DB::table('main_user')
                                       ->join("permission",'permission.user_id','=','main_user.id')
                                       ->join('member_service','member_service.member_id','=','main_user.id')
                                       ->where('member_service.member_service_id','=',$value->service_id)
                                       ->distinct()
                                       ->get(['member_service.member_id'])
                                       ->count();
                                       $team_manager_service = DB::table('main_user')
									    ->join("permission",'permission.user_id','=','main_user.id')
									    ->join('team_manager_services','team_manager_services.team_manager_id','=','main_user.id')
									    ->where('team_manager_services.managers_services_id','=',$value->service_id)
									    ->count();

                                        $leads=DB::table('customer')
                                        ->where('customer.customer_service_id',$value->service_id)
                                        ->count();

									   $invoice=DB::table('invoices')
									   ->where('invoices.service_id',$value->service_id)
									   ->count();
                                    ?>
                                    <tr id="{{$value->service_id}}">
										<td>{{$i++}}</td>
										<td>{{$value->name}}</td>
										<!-- <td><a href="{{route('admin.team-manager-list',['id'=>$value->service_id])}}" style="text-decoration:none;">{{$team_manager_service}}</a></td>
										<td><a href="{{route('admin.team-member',['id'=>$value->service_id])}}" style="text-decoration:none;">
                                        {{$team_member}}</a></td>
										 -->
										 <td><a href="{{route('admin.show-leads-list',['id'=>$value->service_id])}}" style="text-decoration:none;">{{$leads}}</a></td>
                                   	    <td><a href="{{route('admin.service_invoices',['id'=>$value->service_id])}}" style="text-decoration: none;">{{$invoice}}</a></td>
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="5" style="text-align: center; color:red;"><b> Records Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table>
							<div>{{$data->links()}}</div>
						</div>
					</div>
				</div>
@include('admin.dashboard.footer')
