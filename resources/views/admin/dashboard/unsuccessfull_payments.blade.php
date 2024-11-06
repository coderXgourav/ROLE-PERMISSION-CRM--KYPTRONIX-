@include('admin.dashboard.header')
{{-- <!-- @extends('team.dashboard.header') --> --}}
@push('title')
<title>Successfull Payments</title>
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
                        <th>Client/Business Name</th>
                        <th>Mobile No.</th>
                        <th>Email</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                        {{-- <th>Assigned To Team member</th> --}}
                        {{-- <th>Assigned To Manager</th> --}}
                        {{-- <th>Invoice Status</th> --}}
                        {{-- <th>Status</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if(count($data)>0)
                    @php
                    $i=1;
                    @endphp
                    @foreach($data as $key => $value)
                    <tr id="{{$value->customer_id}}">
                        <td>{{$i++}}</td>
                        <td>{{$value->customer_name}}</td>
                        <td>{{$value->customer_number}}</td>
                        <td>{{$value->customer_email}}</td>
                        <td>${{$value->amount}}</td>
                        <td>{{date('d-M-Y',strtotime($value->created_at))}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" style="text-align: center; color:red;"><b> Records Not Found..!</b></td>

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
$('#myTable').DataTable({});
</script>