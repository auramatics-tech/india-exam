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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Important Date Management</h5>
                        
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
                    <form action="{{ route('admin.important_dates.save') }}" method="post">
                        @csrf
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    <li>All field are mandatory</li>
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row px-4">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Text<span class="text-danger">*</span></label>
                                        <input type="hidden" name="id" value="{{ isset($important_date->id) ? $important_date->id : '' }}">
                                        <textarea name="text" required class="form-control" cols="30" rows="10">{{ isset($important_date->text) ? $important_date->text : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 d-flex">
                               <div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </div>
                                <div">
                                    <a href="{{route('admin.important_dates')}}"><button type="button" class="btn btn-primary mr-2 mb-2">Cancel</button></a>
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
        CKEDITOR.config.mathJaxLib ='//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';
        CKEDITOR.replace('question', {
            filebrowserUploadUrl: HOST_URL + "/ck-image?_token={{ csrf_token() }}",
            filebrowserUploadMethod: 'form'
        });
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection