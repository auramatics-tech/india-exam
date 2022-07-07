@extends('backend.layouts.master')

@section('content')
<style>
.select_type {
    border: 1px solid #aaa;
    height: 32px;
        padding: 2px 4px 2px 4px;
}
.form-control:focus {
    border-color: black;
}
.si_space_style{
    justify-content: space-between;
}
button{
   min-width:100px;
}
.ans_ck{
        min-height:80px;
}
#inputFormRow {
    padding: 0px 18px;
}

@media (max-width:480px){
    button{
   min-width:100%;
}
.si_padding{
    padding: 1px 1px 1px 1px;
}
.si_padding button{
    display: flex;
}
.si_display_style{
    display: flex;
}
}
</style>
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
                <form action="{{route('admin.questions_store')}}" method="post">
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
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Category<span class="text-danger">*</span></label>
                                    <input type="hidden" class="form-control" name="id" value="{{ isset($questions->id) ? $questions->id : '' }}" />
                                    <select class="form-control select2" id="category" name="category[]" multiple="multiple">
                                        @if(count($categories))
                                        @foreach($categories as $category)
                                        <option @if(isset($cat_arr) && in_array($category->id,$cat_arr)) selected @endif
                                            value="{{ $category->id}}">{{ $category->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Subcategory<span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="subcategory" name="subcategory[]" multiple="multiple" data-subcat="{{isset($questions->subcategory) ? $questions->subcategory : ''}}">
                                        <option value=""></option>
                                        @if( isset($questions->id) && count($subcategories) )
                                        @foreach($subcategories as $key => $val)
                                        <option @if(isset($subcat_arr) && in_array($val->id,$subcat_arr)) selected @endif value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Topics<span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="topics" name="topics[]" multiple="multiple" data-topics="{{isset($questions->topics) ? $questions->topics : ''}}">
                                        <option value=""></option>
                                        @if( isset($questions->id) &&
                                        count($topics))
                                        @foreach($topics as $key => $val)
                                        <option @if(isset($topics_arr) && in_array($val->id,$topics_arr)) selected @endif value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Type<span class="text-danger">*</span></label>
                                    <select class="form-control select_type" id="type" name="type">
                                        <option value=""></option>
                                        <option @if(isset($questions->type) && $questions->type == '1') selected @endif
                                            value="1">Mcq</option>
                                        <option @if(isset($questions->type) && $questions->type == '2') selected @endif
                                            value="2">Single answer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Question<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="question" id="question" style="width: 100%;">{{ isset($questions->question) ? $questions->question : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                @if(isset($questions) && (count($questions->get_answers)))
                                @php
                                $i=0 ;
                                @endphp
                                @foreach($questions->get_answers as $key => $val)
                                <div id="inputFormRow">
                                    <div class="input-group mb-3 si_space_style">
                                        <div class="col-12">
                                            <label>Options {{++$key}}<span class="text-danger">*</span></label>
                                            <textarea style="width:90% " id="editor_{{$i}}" class="ckeditor ans_ck" name="answers[]">{{isset($val->answers) ? $val->answers : ''}}</textarea>
                                        </div>
                                        <div class="text-center">
                                            <p>Correct answer<p>
                                            <input type="checkbox" @if(isset($val->is_corrected) && $val->is_corrected == 1) checked @endif class="radio__" name="is_correct[{{$i}}][]" value="1" >
                                            <label>
                                                <i id="true" class="fas fa-check mt-2" style="color:green;"></i>
                                            </label>
                                        </div>
                                        <div class=" text-center">
                                            <p>Action</p>
                                            <button id="removeRow" type="button" style="padding:7px;" class="btn btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                                @endif
                                <div id="newRow">
                                </div>
                                <div class="px-4">
                                    <button id="addRow" type="button" class="btn btn-info mb-3">Add answers</button>
                                </div>
                            </div>
                               <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Solution<span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="solution" id="solution" style="width: 100%;">{{ isset($questions->solution) ? $questions->solution : '' }}</textarea>
                                        </div>
                                    </div>
                        </div>
                        <div class="row px-4">
                            <div class="form-group col-lg-8 col-md-8 col-12">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-12 text-right si_display_style">
                                    <a href="" class="si_padding"><button type="submit" class="btn btn-primary mr-2"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button></a>
                                    <a href="" class="si_padding"><button type="submit" class="btn btn-primary mr-2">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button></a>
                                    <a href="" class="si_padding"><button type="submit" class="btn btn-primary mr-2">Add</button></a>
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
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('question', {
        filebrowserUploadUrl: HOST_URL+"/ck-image?_token={{csrf_token()}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('solution', {
        filebrowserUploadUrl: HOST_URL+"/ck-image?_token={{csrf_token()}}",
        filebrowserUploadMethod: 'form'
    });
    $(".ans_ck").each(function() {
        let ck_id = $(this).attr('id');
        CKEDITOR.replace(ck_id, {
            filebrowserUploadUrl: HOST_URL+"/ck-image?_token={{csrf_token()}}",
            filebrowserUploadMethod: 'form'
        });
    });
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
    $(document).on('change', '#category', function() {
        var cat = $(this).val();
        get_subcategory(cat);

    });
    // $(document).ready(function() {
    //     var cat_ = $('#category').val();
    //     get_subcategory(cat_);
    //     var subcat_ = $('#subcategory').attr('data-subcat');
    //     get_topics(subcat_);
    // })

    function get_subcategory(cat) {
        $.ajax({
            url: "{{ route('admin.get_sub_cat') }}",
            method: 'POST',
            data: {
                cat: cat,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                var html = '';
                $('#subcategory').html('');
                var subcat = $('#subcategory').attr('data-subcat');
                $.each(data, function(k, v) {
                    if (subcat && v.id == subcat) {
                        html += "<option selected value='" + v.id + "'>" + v.name + "</option>";
                    } else {
                        html += "<option value='" + v.id + "'>" + v.name + "</option>";
                    }
                })
                $('#subcategory').append(html);
            }
        })
    }
</script>
<script>
    $(document).on('change', '#subcategory', function() {
        var subcat = $(this).val();
        get_topics(subcat);
    });

    function get_topics(subcat) {
        $.ajax({
            url: "{{ route('admin.get_topics') }}",
            method: 'POST',
            data: {
                subcat: subcat,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                var topics_html = '';
                $('#topics').html('');
                var topics = $('#topics').attr('data-topics');
                $.each(data, function(k, v) {
                    if (topics && v.id == topics) {
                        topics_html += "<option selected value='" + v.id + "'>" + v.name + "</option>";
                    } else {
                        topics_html += "<option value='" + v.id + "'>" + v.name + "</option>";
                    }
                })
                $('#topics').html(topics_html);
            }
        })
    }
</script>
<script type="text/javascript">
    // add row
    @if(isset($questions) && (count($questions->get_answers)))
    var check_count = {{ count($questions->get_answers)}};
    @else
    var check_count = 0;
    @endif
    $("#addRow").click(function() {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group d-block mb-3">';
        html += '<div class="input-group-append row d-flex justify-content-between"> <div class="col-lg-8 col-md-12 col-sm-12"><label class="pb-4">Options ' + (check_count + 1) + '<span class="text-danger">*</span></label> <textarea id="editor_' + check_count + '" class="ckeditor col-lg-6 col-md-12 col-sm-12" name="answers[]"></textarea></div> ';
        html += '<div class="su_right col-lg-2 col-md-12 col-sm-12 py-3 py-md-3 d-lg-block d-md-flex d-flex text-center"> <div class="pb-4">Correct Answer</div>';
        html += '<div class=""><input type="checkbox" class="radio__" name="is_correct[' + check_count + '][]" value="1" >  <label><i id="true" class="fas fa-check" style="color:green;"></i></label></div></div>';
        html += '<div class="su_right col-lg-2 col-md-12 col-sm-12 py-3 py-md-3 d-lg-block d-md-flex d-flex text-center"><div class="pb-4">Action</div> ';
        html += '<div><button id="removeRow" type="button" class="btn btn-danger">Remove</button></div> </div>';
        html += '</div></div>';

        $('#newRow').append(html);
        var editorId = 'editor_' + check_count;
        CKEDITOR.replace('editor_' + check_count, {
            filebrowserUploadUrl: HOST_URL+"/ck-image?_token={{csrf_token()}}",
            filebrowserUploadMethod: 'form'
        });
        check_count++;
    });
    // remove row
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
        check_count--;
    });
</script>
@endsection