<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .header .date {
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .leads-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        
        .leads-table thead {
            background-color: #2c3e50;
            color: white;
        }
        
        .leads-table th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }
        
        .leads-table td {
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            font-size: 13px;
        }
        
        .leads-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .leads-table tbody tr:hover {
            background-color: #f1f3f4;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-enabled {
            background-color: #e1f7e1;
            color: #2e7d32;
        }
        
        .status-disabled {
            background-color: #ffebee;
            color: #c62828;
        }
        
        .no-records {
            text-align: center;
            padding: 30px;
            color: #dc3545;
            font-weight: bold;
        }
        
        .summary-section {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="header">
        <div><img src="{{url('/assets/images/logo-icon.png')}}"></div>
       
        @if($reports==1)
        <h1>Paid Leads Report</h1>
        @endif
        @if($reports==2)
        <h1>UnPaid Leads Report</h1>
        @endif
      
        <div class="date">Generated on: <?php echo date('F d, Y'); ?></div>
    </div>

    <table class="leads-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Lead Name</th>
                <th>Mobile No.</th>
                <th>Email</th>
                <th>Service</th>
                <th>Price</th>
                <th>City</th>
                <th>State</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if(count($leads_data) > 0)
                @php $i=1; @endphp
                @foreach($leads_data as $key => $value)
                    <tr id="{{$value->customer_id}}">
                        <td>{{$i++}}</td>
                        <td><strong>{{$value->customer_name}}</strong></td>
                        <td>{{$value->customer_number}}</td>
                        <td>{{$value->customer_email}}</td>
                        <td>{{$value->service_names}}</td>
                        <td>{{$value->price}}</td>
                        <td>{{$value->city}}</td>
                        <td>{{$value->state}}</td>
                        <td>
                            <span class="status-badge {{ $value->status == '1' ? 'status-disabled' : 'status-enabled' }}">
                                {{ $value->status == '1' ? 'Disabled' : 'Enabled' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="no-records">No Records Found!</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="summary-section">
        <strong>Summary:</strong>
        <p>Total Leads: {{ count($leads_data) }}</p>
     <!--    @if(count($leads_data) > 0)
            <p>Active Leads: {{ $leads_data->where('status', '0')->count() }}</p>
            <p>Inactive Leads: {{ $leads_data->where('status', '1')->count() }}</p>
        @endif -->
    </div>

    <div class="footer">
        <p>This is a computer-generated document. No signature required.</p>
    </div>
</body>
</html>