@extends('backend.layouts.master')
@section('css')
    <style>
        .Search_btn {
            padding: 7px;
            font-size: 13px;
        }

        .Reset_btn {
            padding: 7px;
            font-size: 13px;
        }

        .si_margin {
            margin-left: 30px;
        }

        .cat_table thead tr th,
        .cat_table tbody tr td {
            border-bottom: 1px solid #EBEDF3;
        }

        .cat_table.table-responsive {
            display: table;
        }

        .table>:not(:first-child) {
            border-top: 1px solid currentColor;
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
                    <!-- <div class="d-flex align-items-baseline flex-wrap mr-5">
                        begin::Page Title
                        <h5 class="text-dark font-weight-bold my-1 ml-3">Categories</h5>
                        end::Page Title
                    </div> -->
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
                            <h3 class="card-label"> Announcements
                                <!-- <span class="d-block text-muted pt-2 font-size-sm">Edit categories details and delete
                                    categories</span> -->
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a href="{{ route('admin.announcements.add_edit') }}" class="new_record btn btn-primary font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <circle fill="#000000" cx="9" cy="15" r="6" />
                                            <path
                                                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                                fill="#000000" opacity="0.3" />
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
                                        <div class="col-md-12 my-2 my-md-0">
                                            <form method="get" action="" class="d-flex text-right" id="search">
                                                <div class="input-icon mx-2">
                                                    <input type="text" class="form-control" value="{{ isset(request()->q) ? request()->q : '' }}" name="q" placeholder="Search..."
                                                        id="kt_datatable_search_query" />
                                                    <span>
                                                        <i class="flaticon2-search-1 text-muted"></i>
                                                    </span>
                                                </div>
                                                <div class="mx-2">
                                                    <button type="submit" class="btn btn-primary Search_btn">
                                                        Search</button>
                                                </div>
                                            </form>
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
                        <div class="">
                            <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                                <thead>
                                    <tr>
                                        <th title="Field #1">Sr no</th>
                                        <th title="Field #2">Text</th>
                                        <th title="Field #3">Created at</th>
                                        <th title="Field #6">Action</th>
                                        <th title="Field #6">Active/Deactive</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @if (isset($announcements[0]) && count($announcements))
                                        @foreach ($announcements as $key => $announcement)
                                            <tr data-id="{{ $announcement->id }}" class="sort-tr">
                                                <td>{{ ++$key }}</td>
                                                <td>
                                                    <label class="ml-3">
                                                        {{ $announcement->text }}
                                                    </label>
                                                </td>
                                                <td>{{ $announcement->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('admin.announcements.add_edit', $announcement->id) }}"
                                                        style="text-decoration: none; color:green;">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                        <a class="deleteRecord" rel="{{$announcement->id}}" rel1="announcement-delete" href="java-script:" style="text-decoration: none; color:green;">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                </td>
                                                <td class="">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input act" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked" @if (isset($announcement->active) && $announcement->active == '1') data-status="0" @else data-status="1" @endif @if (isset($announcement->active) && $announcement->active == '1')
                                                        checked @endif value="{{ $announcement->id }}" >
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckChecked"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
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
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('backend/assets/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script type="text/javascript" src="jquery-1.3.2.js"> </script>
    <script>
        $(document).on('click', '.act', function() {
            var announcement_id = $(this).val();
            var status = $(this).attr('data-status');
            
            $.ajax({ //create an ajax request to display.php
                type: "POST",
                url: "{{ route('admin.announcement_active_update') }}",
                data: {
                    announcement_id: announcement_id,
                    status: status,
                    "_token": "{{ csrf_token() }}",
                },
                dataType: "html", //expect html to be returned                
                success: function(response) {
                    //alert(response);
                }

            });
        });
    </script>
@endsection
