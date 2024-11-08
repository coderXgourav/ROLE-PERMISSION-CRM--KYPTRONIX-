
@include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title>Document</title>
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
										<th>File</th>
										<th>Created at</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @if(count($document_data)>0)
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($document_data as $key => $value)
                                    <tr id="{{$value->paid_customer_id}}">
										<td>{{$i++}}</td>
										<td>{{$value->file}}</td>
										<td>{{$value->created_at}}</td>
										<td>
											<a href="{{url('/admin/view-file')}}/{{$value->file}}"  class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>

										</td>
									</tr>
                                    @endforeach
                                    @else 
                                    <tr>
										<td colspan="5" style="text-align: center; color:red;"><b> Documents Not Found..!</b></td>
										
									</tr>
                                    @endif
									
								</tbody>
							
							</table>
							<div>{{$document_data->links()}}</div>
						</div>
					</div>
				</div>
@include('admin.dashboard.footer')
<script>
	 $('#myTable').DataTable({
	 });
</script>
