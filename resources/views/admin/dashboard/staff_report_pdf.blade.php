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
       
        <h1>{{$role_details->modern_name}} Report</h1>
      
        <div class="date">Generated on: <?php echo date('F d, Y'); ?></div>
    </div>

    <table class="leads-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Mobile No.</th>
                <th>Email</th>
                <th>Service</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data) > 0)
                @php $i=1; @endphp
                @foreach($data as $key => $value)
                    <tr id="{{$value->id}}">
                        <td>{{$i++}}</td>
                        <td><strong>{{$value->first_name}} {{$value->last_name}}</strong></td>
                        <td>{{$value->phone_number}}</td>
                        <td>{{$value->email_address}}</td>
                        <td>{{$value->service_name}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="no-records">No Records Found!</td>
                </tr>
            @endif
        </tbody>
    </table>

  
    <div class="footer">
        <p>This is a computer-generated document. No signature required.</p>
    </div>
</body>
</html>