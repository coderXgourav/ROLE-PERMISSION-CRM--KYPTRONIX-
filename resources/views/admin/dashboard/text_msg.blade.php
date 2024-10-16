@include('admin.dashboard.header')
{{-- <!-- @extends('team.dashboard.header') --> --}}

@push('title')
<title>Send Message</title>
@endpush
 {{-- <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script> --}}
     <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Forms</div>
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item">
                    <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Text Message Here
                  </li>
                </ol>
              </nav>
            </div>
          </div>
<form id="message_send">
    {{@csrf_field()}}
  <textarea  name="message" style="width:100%; margin-top:20px; height:170px;" required></textarea>
  <input type="hidden" name="customer_id" value="{{$id}}"> 

  <div style="display: flex; justify-content:center; margin-top:15px;"> 
    <button type="submit" id="btn" style="height:46px;" class="m-auto btn btn-primary">Send Message </button>
 
  </div>
</form>

  {{-- <script>
    CKEDITOR.replace('editor2');
  </script> --}}


     

@include('admin.dashboard.footer')
