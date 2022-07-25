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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Questions Management</h5>
                        
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
                    <form action="{{ route('admin.save_mutliple_questions') }}" method="post">
                        @csrf
                        @if(session()->has('errors'))
                            <div class="alert alert-danger">
                                {{ session()->get('errors') }}
                            </div>
                        @endif
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row px-4">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Question<span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="question[]"
                                            multiple="multiple">
                                            @if (count($questions))
                                                @foreach ($questions as $question)
                                                    <option value="{{ $question->id }}">
                                                        {!! $question->question !!}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Category<span class="text-danger">*</span></label>
                                        <select class="form-control select_type" id="type" name="category">
                                            @if (count($categories))
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="px-4 d-flex">
                               <div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </div>
                                <div">
                                    <a href=""><button type="button"
                                        class="btn btn-primary mr-2 mb-2">Cancel</button></a>
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
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
