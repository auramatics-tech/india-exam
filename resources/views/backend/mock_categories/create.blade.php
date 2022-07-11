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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Mock Categories Management</h5>
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
                <form action="{{ route('admin.mock.store') }}" method="post">
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
    $(document).on('change','#type',function(){
        var value = $(this).val();
        if(value == "Subcategory")
        {
            $('#cat_div').show();
        }
        else
        {
            $('#cat_div').hide();
        }
    })
</script>

<script>
    $(document).on('change', '#type', function() {
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
        }
        else if (type == 'Subcategory') {
            $('#cat_div').show();
        }
    }
</script>
@endsection