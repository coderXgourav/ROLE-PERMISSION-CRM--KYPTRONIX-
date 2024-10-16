@include('admin.dashboard.header')
{{-- <!-- @extends('team.dashboard.header') --> --}}

@push('title')
    <title>Email Text</title>
@endpush
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Forms</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                    <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Text Email Here.
                </li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="row">
        {{-- <div class="col-md-4 m-auto">
                                            <div class="card">
                                               <div class="p-3">
                                           <h6>Template 1</h6>
Dear <br>

We are excited to introduce our latest offering to you! [Briefly describe your product or service and highlight its benefits or special features].
<center> <br> <button class="btn-sm btn btn-success" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Show</button>&nbsp;<button class="btn-sm btn btn-primary" >Use Template</button></center>
                                               </div>
                                            </div>
                                        </div> --}}
        {{-- <div class="col-md-4 m-auto">
                                            <div class="card">
                                               <div class="p-3">
                                           <h6>Template 1</h6>
Dear <br>

We are excited to introduce our latest offering to you! [Briefly describe your product or service and highlight its benefits or special features].
<center> <br> <button class="btn-sm btn btn-success" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Show</button>&nbsp;<button class="btn-sm btn btn-primary" >Use Template</button></center>
                                               </div>
                                            </div>
                                        </div> --}}
        {{-- <div class="col-md-4 m-auto">
                                            <div class="card">
                                               <div class="p-3">
                                           <h6>Template 1</h6>
Dear <br>

We are excited to introduce our latest offering to you! [Briefly describe your product or service and highlight its benefits or special features].
<center> <br> <button class="btn-sm btn btn-success" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Show</button>&nbsp;<button class="btn-sm btn btn-primary" >Use Template</button></center>
                                               </div>
                                            </div>
                                        </div> --}}

    </div>
</div>
<form id="email_send">
    {{ @csrf_field() }}
    <textarea id="editor2" name="editor2"></textarea>
    <input type="hidden" name="customer_id" value="{{ $id }}">

    <div style="display: flex; justify-content:center; margin-top:15px;">
        <button type="submit" id="btn" style="height:46px;" class="m-auto btn btn-primary">Send Email </button>

    </div>

</form>
{{-- THIS IS FIRST TEMPLATE MODAL  --}}
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Email Template Design </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="email">
                <p><b>Dear </b>,</p>

                <p>We are excited to introduce our latest offering to you! [Briefly describe your product or service and
                    highlight its benefits or special features].</p>

                <p>To learn more, visit our website: [Link to Your Website]</p>
                <p>
                    If you have any questions or need assistance, feel free to contact our support team at [Contact
                    Email or Phone Number].</p>

                <p>Thank you for considering our product/service. We look forward to serving you!</p> <br>

                Best regards, <br>
                [Your Company Name]
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                    data-bs-dismiss="modal">Send Email</button>
            </div>
        </div>
    </div>
</div>
{{-- THIS IS FIRST TEMPLATE MODAL  --}}

<script>
    CKEDITOR.replace('editor2');
</script>




@include('admin.dashboard.footer')
