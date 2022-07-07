@extends('backend.layouts.master')

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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Categories</h5>
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
                        <h3 class="card-label">Discussion
                            <span class="d-block text-muted pt-2 font-size-sm">Approved discussion details and delete
                                discussion</span>
                        </h3>
                    </div>
                     <h5 class="si_heading1"><a class="si_heading2" href="">{{isset($category->name) ? $category->name : ''}}</a> </h5><hr> 
                </div>
                <div class="card-body">
                         <!-- <h5 class="si_heading1"><a class="si_heading2" href="">{{isset($category->name) ? $category->name : ''}}</a> </h5><hr>  -->
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
                    <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                        <thead>
                            <tr>
                                <th title="Field #1">Id</th>
                                <th title="Field #2">Name</th>
                                <th title="Field #2">Email</th>
                                <th title="Field #3">Comments</th>
                                <th title="Field #3">created at</th>
                                <th title="Field #6">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($discussions))
                            @foreach($discussions as $discussion)
                            <tr>
                                <td>{{ $discussion->id }}</td>
                                <td>{{ $discussion->name }}</td>
                                <td>{{ $discussion->email }}</td>
                                <td>{{ $discussion->comments }}</td>
                                <td>{{ $discussion->created_at }}</td>
                                <td>
                                    <a class="deleteRecord" rel="{{ $discussion->id }}" rel1="discussion-delete" href="java-script:" style="text-decoration: none; color:red;">

                                        <i class="far fa-trash-alt"></i>&nbsp;
                                    </a>
                                    @if($discussion->approved == 0)
                                    <a href="{{route('admin.approved',$discussion->id)}}" type="button">Approved</button> </a>
                                    @endif
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
<!--end::Page Scripts-->

@endsection