@extends('backend.layouts.master')
@section('css')
<style>
    .select_type {
        border: 1px solid #aaa;
        height: 32px;
        padding: 2px 4px 2px 4px;
    }

    .form-control:focus {
        border-color: black;
    }

    .si_space_style {
        justify-content: space-between;
    }

    button {
        min-width: 100px;
    }

    #inputFormRow {
        padding: 0px 18px;
    }

    @media (max-width:480px) {
        button {
            min-width: 100%;
        }

        .si_padding {
            padding: 1px 1px 1px 1px;
        }

        .si_display_style {
            display: flex;
        }
    }

    .jump_btn {
        color: #FFFFFF;
        background-color: #3699FF;
        border-color: #3699FF;
        width: 80px;
        text-align: center;
        height: 31px;
    }
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 49px !important;
        user-select: none;
        -webkit-user-select: none;
    }
</style>
@endsection
@section('content')

<!--begin::Content-->

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Announcements Management</h5>

                    <!--end::Page Title-->
                </div>

                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom gutter-b example example-compact">
                <form action="{{ route('admin.announcements.save') }}" method="post">
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            <li>All field are mandatory</li>
                        </ul>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class=blogs"row px-4">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <!-- <div class="form-group">
                                        <label>Text<span class="text-danger">*</span></label>
                                        <textarea name="text" required class="form-control" cols="30" rows="10">{{ isset($announcement->text) ? $announcement->text : '' }}</textarea>
                                    </div> -->
                                <label for="">Blogs :</label>
                                <input type="hidden" name="id" value="{{ isset($announcement->id) ? $announcement->id : '' }}">
                                <select class="form-control py-3 select2" name="blog_id">
                                    <option value="">Select Blog</option>
                                    @if(count($blogs))
                                    @foreach($blogs as $blog)
                                    <option @if(isset($announcement->blog_id) && $announcement->blog_id == $blog->id) selected @endif value="{{$blog->id}}">{{$blog->title}}</option>
                                    @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="px-4 d-flex py-3">
                            <div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                            <div">
                                <a href="{{route('admin.announcements')}}"><button type="button" class="btn btn-primary mr-2 mb-2">Cancel</button></a>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->
@endsection
@section('script')

<script src="{{ asset('ckeditor4/ckeditor.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.config.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';
    CKEDITOR.replace('question', {
        filebrowserUploadUrl: HOST_URL + "/ck-image?_token={{ csrf_token() }}",
        filebrowserUploadMethod: 'form'
    });
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection