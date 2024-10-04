{{-- @include('admin.dashboard.header') --}}
 @include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}

  @push('title')
      <title>Dashboard</title>
  @endpush
         
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                      <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary">
                                                Total Team Member
                                            </p>
                                            <h4 class="my-1">{{$team_member}}</h4>
                                            <p
                                                class="mb-0 font-13 text-success"
                                            >
                                                <i
                                                    class="bx bxs-up-arrow align-middle"
                                                ></i
                                                ><a href="{{route('admin.team-member-lists')}}" class="text-success">View Team Members</a>
                                            </p>
                                        </div>
                                        
                                         <div
                                            class="widgets-icons bg-light-success text-success ms-auto"
                                        >
                                             <i class="bx bxs-group"></i>
                                        </div>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary">
                                                Total Leads 
                                            </p>
                                            <h4 class="my-1">{{$total_customer}}</h4>
                                            <p
                                                class="mb-0 font-13 text-success"
                                            >
                                                <i
                                                    class="bx bxs-up-arrow align-middle"
                                                ></i
                                                ><a href="{{route('admin.customer')}}" class="text-success">View Leads</a>
                                            </p>
                                        </div>
                                        
                                          <div
                                            class="widgets-icons bg-light-success text-success ms-auto"
                                        >
                                             <i class="bx bxs-group"></i>
                                        </div>
                                    </div>
                                    <div id="chart9"></div>
                                </div>
                            </div>
                            
                        </div>
                          
                           <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary">
                                               Assign Leads
                                            </p>
                                            <h4 class="my-1">{{$assign_customer}}</h4>
                                            <p
                                                class="mb-0 font-13 text-success"
                                            >
                                                <i
                                                    class="bx bxs-up-arrow align-middle"
                                                ></i
                                                ><a href="{{route('admin.assign')}}" class="text-success">View Assigned Leads</a>
                                            </p>
                                        </div>
                                        
                                          <div
                                            class="widgets-icons bg-light-success text-success ms-auto"
                                        >
                                             <i class="bx bxs-group"></i>
                                        </div>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                            
                        </div>
                           <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary">
                                               None Assign Leads
                                            </p>
                                            <h4 class="my-1">{{$none_assign_customer}}</h4>
                                            <p
                                                class="mb-0 font-13 text-success"
                                            >
                                                <i
                                                    class="bx bxs-up-arrow align-middle"
                                                ></i
                                                ><a href="{{route('admin.noneassign')}}" class="text-success">None Assign Leads</a>
                                            </p>
                                        </div>
                                        
                                         <div
                                            class="widgets-icons bg-light-success text-success ms-auto"
                                        >
                                             <i class="bx bxs-group"></i>
                                        </div>
                                    </div>
                                    <div id="chart5"></div>
                                </div>
                            </div>
                            
                        </div>
                           <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary">
                                                Total Email Send
                                            </p>
                                            <h4 class="my-1">{{$total_email}}</h4>
                                            <p
                                                class="mb-0 font-13 text-success"
                                            >
                                                <i class="bx bxs-up-arrow align-middle"
                                                ></i>
                                                <a href="{{route('admin.email')}}" class="text-success"> View Emails</a>
                                            </p>
                                        </div>
                                        
                                          <div
                                            class="widgets-icons bg-light-success text-success ms-auto"
                                        >
                                             <i class="bx bxs-group"></i>
                                        </div>
                                    </div>
                                    <div id="chart6"></div>
                                </div>
                            </div>
                            
                        </div>
                           <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary">
                                                Total SMS Send
                                            </p>
                                            <h4 class="my-1">{{$sms_count}}</h4>
                                            <p
                                                class="mb-0 font-13 text-success"
                                            >
                                                <i class="bx bxs-up-arrow align-middle"
                                                ></i>
                                                <a href="{{route('admin.sms')}}" class="text-success"> View SMS</a>
                                            </p>
                                        </div>
                                        
                                          <div
                                            class="widgets-icons bg-light-success text-success ms-auto"
                                        >
                                             <i class="bx bxs-group"></i>
                                        </div>
                                    </div>
                                    <div id="chart7"></div>
                                </div>
                            </div>
                        </div>
                     
                     
                    </div>
                    <div class="row row-cols-1 row-cols-lg-3">
						<div class="col d-flex">
							<div class="card radius-10 w-100">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h5 class="mb-0">Top Services</h5>
										</div>
										
									</div>
									<div class="mt-5" id="chart15"></div>
								</div>
								<ul class="list-group list-group-flush">
									<li
										class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Service 1
										<span class="badge bg-success rounded-pill">25</span>
									</li>
									<li
										class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Service 2
										<span class="badge bg-danger rounded-pill">10</span>
									</li>
									<li
										class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Service 3
										<span class="badge bg-primary rounded-pill">65</span>
									</li>
									<li
										class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Service 4
										<span class="badge bg-warning text-dark rounded-pill">14</span>
									</li>
								</ul>
							</div>
						</div>
						<div class="col d-flex">
							<div class="card radius-10 w-100">
								<div class="card-body">
									<p class="font-weight-bold mb-1 text-secondary">Customers</p>
									<div class="d-flex align-items-center">
										<div>
											<h4 class="mb-0">12,021</h4>
										</div>
										<div class>
											<p
												class="mb-0 align-self-center font-weight-bold text-success ms-2">4.4
												<i class='bx bxs-up-arrow-alt mr-2'></i>
											</p>
										</div>
									</div>
									<div id="chart21"></div>
								</div>
							</div>
						</div>
						<div class="col d-flex">
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
					</div>
                    <div class="row row-cols-1 row-cols-xl-2">
						<div class="col d-flex">
							<div class="card radius-10 w-100">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h5 class="mb-1">Store Metrics</h5>
											<p class="mb-0 font-13 text-secondary"><i
													class='bx bxs-calendar'></i>in last 30 days revenue</p>
										</div>
									
									</div>
									<div class="row row-cols-1 row-cols-sm-3 mt-4">
										<div class="col">
											<div>
												<p class="mb-0 text-secondary">Invoice</p>
												<h4 class="my-1">$4890</h4>
												<p class="mb-0 font-13 text-success"><i
														class='bx bxs-up-arrow align-middle'></i>$148 Since last
													month</p>
											</div>
										</div>
										<div class="col">
											<div>
												<p class="mb-0 text-secondary">Total Customers</p>
												<h4 class="my-1">12K</h4>
												<p class="mb-0 font-13 text-success"><i
														class='bx bxs-up-arrow align-middle'></i>12.3% Since last
													month</p>
											</div>
										</div>
										<div class="col">
											<div>
												<p class="mb-0 text-secondary">Total Clients</p>
												<h4 class="my-1">129K</h4>
												<p class="mb-0 font-13 text-danger"><i
														class='bx bxs-down-arrow align-middle'></i>2.4% Since last
													month</p>
											</div>
										</div>
									</div>
									<div id="chart4"></div>
								</div>
							</div>
						</div>
						<div class="col d-flex">
							<div class="card radius-10 w-100">
								<div class="card-header border-bottom-0">
									<div class="d-flex align-items-center">
										<div>
											<h5 class="mb-1">Team Manager</h5>
											<p class="mb-0 font-13 text-secondary"><i
													class='bx bxs-calendar'></i>in last 30 days revenue</p>
										</div>
										
									</div>
								</div>
								<div class="product-list p-3 mb-3">
									<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
										<div class="col-sm-6">
											<div class="d-flex align-items-center">
												<div class="product-img">
													<img src="{{url('/assets/images/team.png')}}" alt />
												</div>
												<div class="ms-2">
													<h6 class="mb-1">John Doe</h6>
												</div>
											</div>
										</div>
										<div class="col-sm">
											<h6 class="mb-1">$140.00</h6>
											<p class="mb-0">08-Aug-2024</p>

										</div>
										
									</div>
                                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
										<div class="col-sm-6">
											<div class="d-flex align-items-center">
												<div class="product-img">
													<img src="{{url('/assets/images/team.png')}}" alt />
												</div>
												<div class="ms-2">
													<h6 class="mb-1">Nexaa Doe</h6>
													{{-- <p class="mb-0">$240.00</p> --}}
												</div>
											</div>
										</div>
										<div class="col-sm">
											<h6 class="mb-1">$2140.00</h6>
											<p class="mb-0">345 Sales</p>
										</div>
										<div class="col-sm">
											<div id="chart5"></div>
										</div>
									</div>
                                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
										<div class="col-sm-6">
											<div class="d-flex align-items-center">
												<div class="product-img">
													<img src="{{url('/assets/images/team.png')}}" alt />
												</div>
												<div class="ms-2">
													<h6 class="mb-1">Hexi Doe</h6>
													{{-- <p class="mb-0">$240.00</p> --}}
												</div>
											</div>
										</div>
										<div class="col-sm">
											<h6 class="mb-1">$2140.00</h6>
											<p class="mb-0">345 Sales</p>
										</div>
										<div class="col-sm">
											<div id="chart5"></div>
										</div>
									</div>
                                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
										<div class="col-sm-6">
											<div class="d-flex align-items-center">
												<div class="product-img">
													<img src="{{url('/assets/images/team.png')}}" alt />
												</div>
												<div class="ms-2">
													<h6 class="mb-1">Nova Doe</h6>
													{{-- <p class="mb-0">$240.00</p> --}}
												</div>
											</div>
										</div>
										<div class="col-sm">
											<h6 class="mb-1">$2140.00</h6>
											<p class="mb-0">345 Sales</p>
										</div>
										<div class="col-sm">
											<div id="chart5"></div>
										</div>
									</div>
                                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
										<div class="col-sm-6">
											<div class="d-flex align-items-center">
												<div class="product-img">
													<img src="{{url('/assets/images/team.png')}}" alt />
												</div>
												<div class="ms-2">
													<h6 class="mb-1">Pitter Doe</h6>
													{{-- <p class="mb-0">$240.00</p> --}}
												</div>
											</div>
										</div>
										<div class="col-sm">
											<h6 class="mb-1">$2140.00</h6>
											<p class="mb-0">345 Sales</p>
										</div>
										<div class="col-sm">
											<div id="chart5"></div>
										</div>
									</div>
                                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
										<div class="col-sm-6">
											<div class="d-flex align-items-center">
												<div class="product-img">
													<img src="{{url('/assets/images/team.png')}}" alt />
												</div>
												<div class="ms-2">
													<h6 class="mb-1">Harry Doe</h6>
													{{-- <p class="mb-0">$240.00</p> --}}
												</div>
											</div>
										</div>
										<div class="col-sm">
											<h6 class="mb-1">$2140.00</h6>
											<p class="mb-0">345 Sales</p>
										</div>
										<div class="col-sm">
											<div id="chart5"></div>
										</div>
									</div>
                                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
										<div class="col-sm-6">
											<div class="d-flex align-items-center">
												<div class="product-img">
													<img src="{{url('/assets/images/team.png')}}" alt />
												</div>
												<div class="ms-2">
													<h6 class="mb-1">Alex ..</h6>
													{{-- <p class="mb-0">$240.00</p> --}}
												</div>
											</div>
										</div>
										<div class="col-sm">
											<h6 class="mb-1">$2140.00</h6>
											<p class="mb-0">345 Sales</p>
										</div>
										<div class="col-sm">
											<div id="chart5"></div>
										</div>
									</div>

								
								</div>
							</div>
						</div>
					</div>

                   
               
              
            <!--end page wrapper -->
            <!--start overlay-->
            <div class="overlay toggle-icon"></div>
            <!--end overlay-->
            <!--Start Back To Top Button-->
            <a href="javaScript:;" class="back-to-top"
                ><i class="bx bxs-up-arrow-alt"></i
            ></a>

            @include('admin.dashboard.footer')
          