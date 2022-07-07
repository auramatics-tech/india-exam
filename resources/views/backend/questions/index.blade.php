@extends('backend.layouts.master')
@section ('css')
<style>
    table tr td img{
        height: 100%;
        width: 100%;
    }
    .form-switch {
        padding-left: 5.5em;
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Questions</h5>
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
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Questions
                            <span class="d-block text-muted pt-2 font-size-sm">Edit questions details and delete
                                questions</span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{route('admin.create_questions')}}" class="new_record btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>New Record </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Search Form-->
                    <!--begin::Search Form-->
                    <div class="mb-7">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-xl-8">
                                <div class="row align-items-center">
                                    <div class="col-md-4 my-2 my-md-0">
                                        <div class="input-icon">
                                            <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                            <span>
                                                <i class="flaticon2-search-1 text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                            </div>
                        </div>
                    </div>

                    @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <!--end::Search Form-->
                    <!--begin: Datatable-->
                    <table class="datatable datatable-bordered datatable-head-custom table-responsive" id="kt_datatable">
                        <thead>
                            <tr>
                                <th title="Field #1">Sr No</th>
                                <th title="Field #2">topics</th>
                                <th title="Field #2">type</th>
                                <th title="Field #6">Action</th>
                                <th title="Field #6">Active/deactive</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($questions))
                            @foreach($questions as $key => $question)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>
                                    @if(count($question->get_question_category))
                                    @foreach($question->get_question_category as $k => $v)
                                    {{get_category($v->topic_id)->name}} ,
                                    @endforeach
                                    @endif
                                </td>
                                <td>{{ ($question->type == 1)? "mcq":'single answer' }}</td>
                                <td>
                                    <a href="{{route('admin.questions_edit',$question->id)}}" style="text-decoration: none; margin-left:15px;">
                                        <i class="far fa-edit"></i>
                                    </a>
                                  
                                </td>
                                <td>
                                <div class="form-check form-switch">
                                        <input class="form-check-input act" type="checkbox" role="switch" id="flexSwitchCheckChecked" @if(isset($question->active) && $question->active == '1') data-status="0" @else data-status="1" @endif @if(isset($question->active) && $question->active == '1') checked @endif value="{{ $question->id }}" >
                                        <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->

@endsection

@section('script')
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('backend/assets/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
     $(document).on('click', '.act', function() {
        var que_id = $(this).val();
        var status = $(this).attr('data-status');
        $.ajax({ //create an ajax request to display.php
            type: "POST",
            url: "{{route('admin.active_update')}}",
            data: {
                que_id: que_id,
                status: status,
                "_token": "{{csrf_token()}}",
            },
            dataType: "html", //expect html to be returned                
            success: function(response) {
                //alert(response);
            }

        });
    });
</script>
<!--end::Page Scripts-->
@endsection

