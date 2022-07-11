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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Mock Test</h5>
                        
                        <!--end::Page Title-->
                    </div>
                    
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
            </div>
            @if(isset(request()->mock_test_id) && request()->mock_test_id)
            <div class="col-lg-7 col-md-10 col-12 justify-content-end si_display_style d-block d-lg-flex d-md-flex">
                <a class="deleteRecord" rel="{{ $mock_test->id }}" rel1="mock-test-delete"
                    href="java-script:" style="text-decoration: none;"><button type="button"
                        class="btn btn-danger mr-2 mb-2">Delete</button></a>
                        @if(next_mock_test_id($mock_test->id, $subcategory->id, '<'))
                        <a href="{{ isset($mock_test->id) ? route('admin.mock_test', ['id' => $sub_category_id, 'mock_test_id' => next_mock_test_id($mock_test->id, $subcategory->id, '<')]) : '' }}"
                    class="si_padding"><button type="button"
                        class="btn btn-primary mr-2 mb-2">Previous</button></a>
                        @endif
                @if(next_mock_test_id($mock_test->id,$subcategory->id, '>'))
                <a href="{{ isset($mock_test->id) ? route('admin.mock_test', ['id' => $sub_category_id, 'mock_test_id' => next_mock_test_id($mock_test->id, $subcategory->id, '>')]) : '' }}"
                    class="si_padding"><button type="button"
                        class="btn btn-primary mr-2 mb-2">Next</button></a>
                @endif
                <a href="{{ route('admin.mock_test', $sub_category_id) }}" class="si_padding"><button
                        type="button" class="btn btn-primary mr-2 mb-2">Add</button></a>
                <select class="form-control jump_btn mb-2" name="jump_to" id="jump_to">
                    <option selected value="">Jump To</option>
                    @if (count($mock_test_array))
                        @foreach ($mock_test_array as $key => $mock)
                            <option @if (isset(request()->mock_test_id) && request()->mock_test_id == $mock) selected @endif value="{{ $mock }}">
                                {{ ++$key }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            @endif
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="card card-custom gutter-b example example-compact">
                    <form action="{{ route('admin.mock_test.save') }}" method="post">
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
                                        <input type="hidden" name="id" value="{{ isset($mock_test->id) ? $mock_test->id : '' }}">
                                        <input type="hidden" name="subcategory_id" value="{{ isset($sub_category_id) ? $sub_category_id : '' }}">
                                        <textarea class="form-control" name="text">{{ isset($mock_test->text) ? $mock_test->text : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Time</label>
                                        <input type="number" class="form-control" required name="time" placeholder="in mins"
                                            value="{{ isset($mock_test->time) ? $mock_test->time : '' }}" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="px-4 d-flex">
                               <div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </div>
                                <div>
                                    <a href=""><button type="button" class="btn btn-primary mr-2 mb-2">Cancel</button></a>
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

        
        $(document).on('change', '#jump_to', function() {
            var mock_test_id = $(this).val();
            window.location.href = HOST_URL + '/mock-test/{{$sub_category_id}}?mock_test_id=' + mock_test_id;
        })
    </script>
@endsection