
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
										<th>Title</th>
										<th>Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($data as $key => $value)
                                    <tr id="{{$value->package_id}}">
										<td>{{$i++}}</td>
										<td>{{$value->title}}</td>
										<td>{{$value->price}}</td>
										@php
										$package_id = Crypt::encrypt($value->package_id);
									   @endphp
										<td>
										
										  <div class="d-flex order-actions">
											<a href="{{route('admin.edit-package',['id'=>$package_id])}}" class="bg-primary" style="color:white"><i class='bx bxs-edit'></i></a>

												<a href="javascript:;" onclick="DeletePackage({{$value->package_id}})"  class="ms-3 bg-danger" style="color: white"><i class='bx bxs-trash'></i></a>
											 </div>
										</td>
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
