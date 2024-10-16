 @include('admin.dashboard.header')
 {{-- @extends('admin.dashboard.header') --}}
@push('title')
    <title>Email Template</title>
@endpush
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                    <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Add New Email Template
                </li>
            </ol>
        </nav>
    </div>
</div>

<form id="email_template_send">
    {{ @csrf_field() }}
    <input type="text" name="email_title" class="form-control" placeholder="Title" required><br>
    <textarea id="editor2" name="editor2"></textarea>
    <input type="hidden" name="main_user_id" value="{{$admin_data->id}}">
    <div style="display: flex; justify-content:center; margin-top:15px;">
        <button type="submit" id="btn" style="height:46px;" class="m-auto btn btn-primary">Save</button>
 
    </div>

</form>

<script>
    CKEDITOR.replace('editor2');
</script>




@include('admin.dashboard.footer')
