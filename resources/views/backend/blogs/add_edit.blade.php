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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Blogs Management</h5>
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
                <form action="{{ route('admin.blogs.save') }}" method="post" enctype="multipart/form-data">
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
                                    <label>Title<span class="text-danger">*</span></label>
                                    <input type="hidden" name="id" value="{{ isset($blog->id) ? $blog->id : '' }}">
                                    <input type="text" class="form-control" required name="title" value="{{ isset($blog->title) ? $blog->title : '' }}" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>SLug<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="slug" value="{{ isset($blog->slug) ? $blog->slug : '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Thumbnail Description</label>
                                    <textarea class="form-control" name="thumbnail_description">{{ isset($blog->thumbnail_description) ? $blog->thumbnail_description : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">States</label>
                                    <select name="state" class="form-control">
                                        @if(count($states))
                                        @foreach($states as $state)
                                        <option value="{{$state->id}}" @if(isset($blog->state) && $blog->state == $state->id) selected @endif>{{$state->state}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control ckeditor" name="description" id="solution">{{ isset($blog->description) ? $blog->description : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Thumbnail image</label>
                                    <input type="file" name="image" accept=".jpeg,.png,.jpg,.gif" class="form-Control">
                                </div>
                            </div>
                            @if(isset($blog->image))
                            <div class="col-md-12 d-flex">
                                <div class="form-group">
                                    <img src="{{asset('blog/images/'.$blog->image)}}" alt="" width="300" height="300" >
                                </div>
                                <a href="javascript:" class="deleteRecord" rel="{{$blog->id}}" rel1="delete-blog-img"><i class="fas fa-trash text-danger"></i></a>
                            </div>
                            @endif
                        </div>
                        <div class="">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Upload PDF</label>
                                    <input type="file" name="blog_pdf" accept=".doc,.docx,.pdf" class="form-Control">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="col-md-12">
                                <div class="form-group" id="links_body">
                                    <label><b>Links</b></label>
                                    <button type="button" class="btn btn-primary float-right" id="add_links">Add Links</button>
                                    @if(isset($blog->id))
                                    @foreach($blog->get_links as $key => $links)
                                    <div class="row">
                                        <div class="col-5">
                                            <label>Link title</label>
                                            <input type="text" name="link_title[]" class="form-control" value="{{$links->title}}">
                                        </div>
                                        <div class="col-5">
                                            <label>Link</label>
                                            <input type="text" name="link[]" class="form-control" value="{{$links->link}}">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary mt-4 remove_link">Remove</button>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Link title</label>
                                            <input type="text" name="link_title[]" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label>Link</label>
                                            <input type="text" name="link[]" class="form-control">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="px-4 d-flex">
                            <div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                            <div">
                                <a href="{{route('admin.blogs')}}"><button type="button" class="btn btn-primary mr-2 mb-2">Cancel</button></a>
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
            filebrowserUploadMethod: 'form',
            height: 500
        });
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        var html ='<div class="row">\n\
                        <div class="col-5">\n\
                            <label>Link title</label>\n\
                            <input type="text" name="link_title[]" class="form-control">\n\
                        </div>\n\
                        <div class="col-5">\n\
                            <label>Link</label>\n\
                            <input type="text" name="link[]" class="form-control">\n\
                        </div>\n\
                        <div class="col-2">\n\
                        <button type="button" class="btn btn-primary mt-4 remove_link">Remove</button>\n\
                        </div>\n\
                    </div>';
    $(document).on('click', '#add_links', function() {
        $('#links_body').append(html);
    })
    $(document).on('click', '.remove_link', function() {
        $(this).closest('.row').remove();
    })
</script>
@endsection