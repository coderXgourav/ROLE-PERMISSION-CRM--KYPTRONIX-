@include('admin.dashboard.header')


<body>
   <div > 
   	  <iframe src="{{url('/uploads')}}/{{$filename}}" width="100%;" height="800px;" ></iframe>
   </div>
 </body>

@include('admin.dashboard.footer')
