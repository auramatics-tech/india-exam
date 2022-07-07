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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Categories Management</h5>
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
                <form action="{{ route('admin.store') }}" method="post">
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            <li>All field are mandatory</li>
                        </ul>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input type="hidden" class="form-control" name="id" value="{{ isset($form->id) ? $form->id : '' }}" />
                                    <input type="text" class="form-control" name="name" value="{{ isset($form->name) ? $form->name : '' }}" placeholder="Name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Slug<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="slug" value="{{ isset($form->slug) ? $form->slug : '' }}" placeholder="mcq-question-on-competitive-reasoning" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category Type<span class="text-danger">*</span></label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="0">Select type</option>
                                        <option @if (isset($form->type) && $form->type == 'Category') selected @endif value="Category">Category</option>
                                        <option @if (isset($form->type) && $form->type == 'Subcategory') selected @endif value="Subcategory">Subcategory
                                        </option>
                                        <option @if (isset($form->type) && $form->type == 'Subcategory1') selected @endif value="Subcategory1">Subcategory1
                                        </option>
                                        <option @if (isset($form->type) && $form->type == 'Subcategory2') selected @endif value="Subcategory2">Subcategory2
                                        </option>
                                        <option @if (isset($form->type) && $form->type == 'Topics') selected @endif value="Topics">Topics</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="cat_div" style="display: none;">
                                <div class="form-group">
                                    <label>Category<span class="text-danger">*</span></label>
                                    <select class="form-control" id="category" name="parent_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option @if ((isset($form->parent_id) && $form->parent_id == $category->id) || (isset($data['category']) && $data['category']->id == $category->id)) selected @endif value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="subcategory"  style="display: none;">
                                <div class="form-group">
                                    <label>Subcategory<span class="text-danger">*</span></label>
                                    <select class="form-control" id="subcategory_select" name="subcategory">
                                        <option value="">Select Subcategory</option>
                                        @foreach ($subcategories as $subcategory)
                                        <option @if ((isset($form->parent_id) && $form->parent_id == $subcategory->id) || (isset($data['subcategory']) && $data['subcategory']->id == $subcategory->id)) selected @endif value="{{ $subcategory->id }}">
                                            {{ $subcategory->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 subcategory_topics" id="subcategory1" style="display: none;">
                                <div class="form-group">
                                    <label>Subcategory1<span class="text-danger sub-danger">*</span></label>
                                    <select class="form-control" id="subcategory1_select" name="subcategory1">
                                        <option value="">Select Subcategory1</option>
                                        @foreach ($subcategories1 as $subcategory)
                                        <option @if ((isset($form->parent_id) && $form->parent_id == $subcategory->id) || (isset($data['subcategory1']) && $data['subcategory1']->id == $subcategory->id)) selected @endif value="{{ $subcategory->id }}">
                                            {{ $subcategory->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 subcategory_topics" id="subcategory2" style="display: none;">
                                <div class="form-group">
                                    <label>Subcategory2<span class="text-danger sub-danger">*</span></label>
                                    <select class="form-control" id="subcategory2_select" name="subcategory2">
                                        <option value="">Select Subcategory2</option>
                                        @foreach ($subcategories2 as $subcategory)
                                        <option @if ((isset($form->parent_id) && $form->parent_id == $subcategory->id) || (isset($data['subcategory2']) && $data['subcategory2']->id == $subcategory->id)) selected @endif value="{{ $subcategory->id }}">
                                            {{ $subcategory->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
<script>
    $(document).on('change', '#type', function() {
        $('#subcategory_select').html('');
        $('#subcategory1_select').html('');
        $('#subcategory2_select').html('');
        $("#category").val('')
        var cate_type = $(this).val();
        change_div(cate_type)
    })
    $(document).ready(function() {
        var cate_type_ = $('#type').val();
        change_div(cate_type_)
    })
    function change_div(type) {
        if(type == 'Category' || type == '0'){
            $('#cat_div').hide();
            $('#subcategory').hide();
            $('#subcategory1').hide();
            $('#subcategory2').hide();
            $("#category").attr('required', false);
            $("#subcategory_select").attr('required', false);
            $("#subcategory1_select").attr('required', false);
            $("#subcategory2_select").attr('required', false);
        }
        else if (type == 'Subcategory') {
            $('#cat_div').show();
            $('#subcategory').hide();
            $('#subcategory1').hide();
            $('#subcategory2').hide();
            $("#category").attr('required', true);
            $("#subcategory_select").attr('required', false);
            $("#subcategory1_select").attr('required', false);
            $("#subcategory2_select").attr('required', false);
        } else if (type == 'Subcategory1') {
            $('#cat_div').show();
            $('#subcategory').show();
            $('#subcategory1').hide();
            $('#subcategory2').hide();
            $("#category").attr('required', true);
            $("#subcategory_select").attr('required', true);
            $("#subcategory1_select").attr('required', false);
            $("#subcategory2_select").attr('required', false);
        } else if (type == 'Subcategory2') {
            $('#cat_div').show();
            $('#subcategory').show();
            $('#subcategory1').show();
            $('#subcategory2').hide();
            $("#category").attr('required', true);
            $("#subcategory_select").attr('required', true);
            $("#subcategory1_select").attr('required', true);
            $("#subcategory2_select").attr('required', false);
        } else if (type == 'Topics') {
            $('#cat_div').show();
            $('#subcategory').show();
            $('#subcategory1').show();
            $('#subcategory2').show();
            $("#category").attr('required', true);
            $("#subcategory_select").attr('required', true);
            $("#subcategory1_select").attr('required', false);
            $("#subcategory2_select").attr('required', false);
        }
    }
</script>
<script>
    $(document).on('change', '#category', function() {
        var cat = $(this).val()
        get_subcat(cat)
    })

    function get_subcat(cat) {
        $.ajax({
            url: "{{ route('admin.get_subcategories') }}",
            method: 'POST',
            data: {
                cat: cat,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                var subcategory_html = '<option value=""></option>';
                $('#subcategory_select').html('');
                var subcategory = $('#subcategory_select').attr('data-subcategory');
                $.each(data, function(k, v) {
                    if (subcategory && v.id == subcategory) {
                        subcategory_html += "<option selected value='" + v.id + "'>" + v.name + "</option>";
                    } else {
                        subcategory_html += "<option value='" + v.id + "'>" + v.name + "</option>";
                    }
                })
                $('#subcategory_select').html(subcategory_html);
            }
        })
    }

    $(document).on('change', '#subcategory_select', function() {
        var subcat1 = $(this).val()
        get_subcat1(subcat1)
    })

    function get_subcat1(subcat1) {
        $.ajax({
            url: "{{ route('admin.get_subcategories1') }}",
            method: 'POST',
            data: {
                subcat: subcat1,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                var subcategory_html = '<option value=""></option>';
                $('#subcategory1_select').html('');
                var subcategory = $('#subcategory1_select').attr('data-subcategory');
                $.each(data, function(k, v) {
                    if (subcategory && v.id == subcategory) {
                        subcategory_html += "<option selected value='" + v.id + "'>" + v.name + "</option>";
                    } else {
                        subcategory_html += "<option value='" + v.id + "'>" + v.name + "</option>";
                    }
                })
                $('#subcategory1_select').html(subcategory_html);
            }
        })
    }

    $(document).on('change', '#subcategory1_select', function() {
        var subcat2 = $(this).val()
        get_subcat2(subcat2)
    })

    function get_subcat2(subcat2) {
        $.ajax({
            url: "{{ route('admin.get_subcategories2') }}",
            method: 'POST',
            data: {
                subcat: subcat2,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                var subcategory_html = '<option value=""></option>';
                $('#subcategory2_select').html('');
                var subcategory = $('#subcategory2_select').attr('data-subcategory');
                $.each(data, function(k, v) {
                    if (subcategory && v.id == subcategory) {
                        subcategory_html += "<option selected value='" + v.id + "'>" + v.name + "</option>";
                    } else {
                        subcategory_html += "<option value='" + v.id + "'>" + v.name + "</option>";
                    }
                })
                $('#subcategory2_select').html(subcategory_html);
            }
        })
    }
</script>
@endsection