@include('admin.dashboard.header')
{{-- <!-- @extends('team.dashboard.header') --> --}}
@push('title')
    <title>Add Contact</title>
@endpush

<div>
			<div>
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3"></div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Lead Details </li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
					<a href="{{route('admin.create-invoice',['id'=>$customer_data->customer_id])}}" type="button" class="btn btn-success">Generate Invoice</a>
						
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-10 m-auto">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
											<img src="{{url('assets/images/team.png')}}" alt="Team Member" class="rounded-circle p-1 bg-primary" width="120">

											<div class="mt-3">
												<h4>{{$customer_data->customer_name}}</h4>
												<p class="text-secondary mb-1">Email -{{$customer_data->customer_email}}</p>
												<p class="text-muted font-size-sm">Number -{{$customer_data->customer_number}}</p>
												<?php if(!empty($services_data)){?>
												<p class="text-muted font-size-sm">Service Name - <?php foreach($services_data as $val){echo $val->service_names;}?></p>
											    <?php } ?>
												<!--<button class="btn btn-primary">Follow</button>
												<button class="btn btn-outline-primary">Message</button>-->
											</div>
											<?php $id=encrypt($customer_data->customer_id);?>
											 <a href="{{route('admin.chat',['id'=>$id])}}" class="btn btn-primary btn-sm">Show Remarks</a>
                                    
										</div>
										<hr class="my-4" />
										<ul class="list-group list-group-flush">
											<?php if(!empty($team_member)){
												foreach($team_member as $value){ ?>

											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										 	<a href="">

												<h6 class="mb-0">
													<!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>-->
												Team Member - </h6></a>
												<span class="text-secondary">
													<?=$value->first_name.' '. $value->last_name;?></span>
											</li>
										   <?php }} ?>
										
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										       <a href="{{route('admin.view_invoice_per_customer',['id'=>$customer_data->customer_id])}}">

												<h6 class="mb-0"><!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>-->Invoice</h6></a>
												<span class="text-secondary">{{$invoice}}</span>
											</li>
											@foreach ($managers as $item)
													<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
											   <a href="">
												<h6 class="mb-0">Team Manager -</h6></a>
												<span class="text-secondary">{{$item->first_name}} {{$item->last_name}}</span>
											</li>
											@endforeach
										
											<!--<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
												<span class="text-secondary">codervent</span>
											</li>-->
										</ul>
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<!-- <div class="col d-flex">
									<div class="card radius-10 w-100 overflow-hidden">
										<div class="card-body">
											<div class="d-flex align-items-center">
												<div>
													<h5 class="mb-0">Sales Overiew</h5>
												</div>
												<div class="dropdown ms-auto">
													<a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
														data-bs-toggle="dropdown"><i
															class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
													</a>
													<ul class="dropdown-menu">
														<li><a class="dropdown-item" href="javascript:;">Action</a>
														</li>
														<li><a class="dropdown-item" href="javascript:;">Another action</a>
														</li>
														<li>
															<hr class="dropdown-divider">
														</li>
														<li><a class="dropdown-item" href="javascript:;">Something else
																here</a>
														</li>
													</ul>
												</div>
											</div>
											<div class="mt-5" id="chart20"></div>
										</div>
										<div class="card-footer bg-transparent border-top-0">
											<div
												class="d-flex align-items-center justify-content-between text-center">
												<div>
													<h6 class="mb-1 font-weight-bold">$289.42</h6>
													<p class="mb-0 text-secondary">Last Week</p>
												</div>
												<div class="mb-1">
													<h6 class="mb-1 font-weight-bold">$856.14</h6>
													<p class="mb-0 text-secondary">Last Month</p>
												</div>
												<div>
													<h6 class="mb-1 font-weight-bold">$987,25</h6>
													<p class="mb-0 text-secondary">Last Year</p>
												</div>
											</div>
										</div>
									</div>
								</div>	
							     <div class="card">
									<div class="card-body">
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$customer_data['customer_name']}}" disabled />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Phone No.</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$customer_data['customer_number']}}" disabled />
											</div>
										</div>
                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$customer_data['customer_email']}}" disabled />
											</div>
										</div>
                                         <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Service</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="" disabled />
											</div>
										</div>

									</div>
								</div>-->
								
								
								<!-- <div class="row">
									<div class="col-sm-12">
										<div class="card">
											<div class="card-body">
												<h5 class="d-flex align-items-center mb-3">Project Status</h5>
												<p>Web Design</p>
												<div class="progress mb-3" style="height: 5px">
													<div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<p>Website Markup</p>
												<div class="progress mb-3" style="height: 5px">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<p>One Page</p>
												<div class="progress mb-3" style="height: 5px">
													<div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<p>Mobile Template</p>
												<div class="progress mb-3" style="height: 5px">
													<div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<p>Backend API</p>
												<div class="progress" style="height: 5px">
													<div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</div>
								</div>-->			
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@include('admin.dashboard.footer')