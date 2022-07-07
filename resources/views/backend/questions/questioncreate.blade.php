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
            @if(isset(request()->question_id) && request()->question_id)
            <div class="col-lg-7 col-md-10 col-12 justify-content-end si_display_style d-block d-lg-flex d-md-flex">
                <a class="deleteRecord" rel="{{ $questions->id }}" rel1="questions-delete"
                    href="java-script:" style="text-decoration: none;"><button type="button"
                        class="btn btn-danger mr-2 mb-2">Delete</button></a>
                        @if(next_question_id($questions->id, $topic->id, '<'))
                        <a href="{{ isset($questions->id) ? route('admin.questioncat', ['id' => $topic_id, 'question_id' => next_question_id($questions->id, $topic->id, '<')]) : '' }}"
                    class="si_padding"><button type="button"
                        class="btn btn-primary mr-2 mb-2">Previous</button></a>
                        @endif
                @if(next_question_id($questions->id,$topic->id, '>'))
                <a href="{{ isset($questions->id) ? route('admin.questioncat', ['id' => $topic_id, 'question_id' => next_question_id($questions->id, $topic->id, '>')]) : '' }}"
                    class="si_padding"><button type="button"
                        class="btn btn-primary mr-2 mb-2">Next</button></a>
                @endif
                <a href="{{ route('admin.questioncat', request()->id) }}" class="si_padding"><button
                        type="button" class="btn btn-primary mr-2 mb-2">Add</button></a>
                <select class="form-control jump_btn mb-2" name="jump_to" id="jump_to">
                    <option selected value="">Jump To</option>
                    @if (count($all_questions))
                        @foreach ($all_questions as $key => $question)
                            <option @if (isset(request()->question_id) && request()->question_id == $question) selected @endif value="{{ $question }}">
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
                    <form action="{{ route('admin.questions_store') }}" method="post">
                        @csrf
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    <li>All field are mandatory</li>
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" name="previous_id" value="{{ $topic_id }}">
                        <div class="card-body">
                            <div class="row px-4">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Category<span class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="id"
                                            value="{{ isset($questions->id) ? $questions->id : '' }}" />
                                        <select class="form-control select2" id="category" name="category[]"
                                            multiple="multiple">
                                            @if (count($data['categories']))
                                                @foreach ($data['categories'] as $category)
                                                    <option @if ((isset($data['selected_category']) && in_array($category['id'], $data['selected_category']) ||
                                                        (isset($data['category']) && $data['category']->id == $category['id'])))
                                                        selected @endif value="{{ $category['id'] }}">
                                                        {{ $category['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Subcategory<span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="subcategory" name="subcategory[]"
                                            multiple="multiple"
                                            data-subcat="{{ isset($questions->subcategory) ? $questions->subcategory : '' }}">
                                            <option value=""></option>
                                            @if (count($data['subcategories']))
                                                @foreach ($data['subcategories'] as $key => $val)
                                                    <option @if ((isset($data['selected_subcategory']) && in_array($val['id'], $data['selected_subcategory']) ||
                                                        (isset($data['subcategory']) && $data['subcategory']->id == $val['id'])))
                                                        selected @endif value="{{ $val['id'] }}">
                                                        {{ $val['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Subcategory1</label>
                                        <select class="form-control select2" id="subcategory1" name="subcategory1[]"
                                            multiple="multiple"
                                            data-subcat="{{ isset($questions->subcategory1) ? $questions->subcategory1 : '' }}">
                                            <option value=""></option>
                                            @if (isset($data['all_subcategories1']) && count($data['all_subcategories1']))
                                                @foreach ($data['all_subcategories1'] as $key => $val)
                                                    <option @if ((isset($data['selected_subcategory1']) && in_array($val['id'], $data['selected_subcategory1']) ||
                                                        (isset($data['subcategories1']) && $data['subcategories1']->id == $val['id'])))
                                                        selected @endif value="{{ $val['id'] }}">
                                                        {{ $val['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Subcategory2</label>
                                        <select class="form-control select2" id="subcategory2" name="subcategory2[]"
                                            multiple="multiple"
                                            data-subcat="{{ isset($questions->subcategory2) ? $questions->subcategory2 : '' }}">
                                            <option value=""></option>
                                            @if (isset($data['all_subcategories2']) && count($data['all_subcategories2']))
                                                @foreach ($data['all_subcategories2'] as $key => $val)
                                                    <option @if ((isset($data['selected_subcategory2']) && in_array($val['id'], $data['selected_subcategory2']) ||
                                                        (isset($data['subcategories2']) && $data['subcategories2']->id == $val['id'])))
                                                        selected @endif value="{{ $val['id'] }}">
                                                        {{ $val['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Topics<span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="topics" name="topics[]" multiple="multiple"
                                            data-topics="{{ isset($questions->topics) ? $questions->topics : '' }}">
                                            <option value=""></option>
                                            @if (count($data['all_topics']))
                                                @foreach ($data['all_topics'] as $key => $val)
                                                    <option @if ((isset($data['selected_topics']) && in_array($val['id'], $data['selected_topics']) ||
                                                        (isset($data['topic']) && $data['topic']->id == $val['id'])))
                                                        selected @endif value="{{ $val['id'] }}">
                                                        {{ $val['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Type<span class="text-danger">*</span></label>
                                        <select class="form-control select_type" id="type" name="type">
                                            <option @if (isset($questions->type) && $questions->type == '1') selected @endif value="1">Mcq</option>
                                            <option @if (isset($questions->type) && $questions->type == '2') selected @endif value="2">Single answer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Question<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="question"
                                            id="question">{{ isset($questions->question) ? $questions->question : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="">
                                    @if (isset($questions) && count($questions->get_answers))
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($questions->get_answers as $key => $val)
                                            <div id="inputFormRow">
                                                <div class="input-group mb-3 si_space_style">
                                                    <div>
                                                        <label>Options {{ ++$key }}<span
                                                                class="text-danger">*</span></label>
                                                        <textarea id="editor_{{ $i }}" class="ckeditor ans_ck"
                                                            name="answers[]">{{ isset($val->answers) ? $val->answers : '' }}</textarea>
                                                    </div>
                                                    <div class="text-center">
                                                        <p>Correct answer
                                                        <p>
                                                            <input type="checkbox" @if (isset($val->is_corrected) && $val->is_corrected == 1) checked @endif class="radio__"
                                                                name="is_correct[{{ $i }}][]" value="1">
                                                            <label>
                                                                <i id="true" class="fas fa-check mt-2"
                                                                    style="color:green;"></i>
                                                            </label>
                                                    </div>
                                                    <div class=" text-center">
                                                        <p>Action</p>
                                                        <button id="removeRow" type="button" style="height:20% padding:7px;"
                                                            class="btn btn-danger">Remove</button>
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
                                        <label>Solution</label>
                                        <textarea class="form-control ckeditor" name="solution"
                                            id="solution">{{ isset($questions->solution) ? $questions->solution : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 d-flex">
                               <div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </div>
                                <div">
                                    <a href="{{ route('category_data',['type'=>'Topics','id'=>$topic->parent_id]) }}"><button type="button"
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
        CKEDITOR.config.mathJaxLib ='//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';
        CKEDITOR.replace('question', {
            filebrowserUploadUrl: HOST_URL + "/ck-image?_token={{ csrf_token() }}",
            filebrowserUploadMethod: 'form'
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
            $('#subcategory1').html('');
            get_data(subcat,'subcategory1');
            $('#topics').html('');
            get_data(subcat,'topics');
        });

        $(document).on('change', '#subcategory1', function() {
            var subcat = $(this).val();
            $('#subcategory2').html('');
            get_data(subcat,'subcategory2');
            get_data(subcat,'topics');
        });

        $(document).on('change', '#subcategory2', function() {
            var subcat = $(this).val();
            get_data(subcat,'topics');
        });
        
        function get_data(subcat,type) {
            $.ajax({
                url: "{{ route('admin.get_topics') }}",
                method: 'POST',
                data: {
                    type: type,
                    subcat: subcat,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    var topics_html = '';
                    var topics = $('#'+type).attr('data-topics');
                    $.each(data, function(k, v) {
                        if (topics && v.id == topics) {
                            topics_html += "<option selected value='" + v.id + "'>" + v.name +
                                "</option>";
                        } else {
                            topics_html += "<option value='" + v.id + "'>" + v.name + "</option>";
                        }
                    })
                    $('#'+type).append(topics_html);
                }
            })
        }

    </script>
    <script type="text/javascript">
        // add row
        @if (isset($questions) && count($questions->get_answers))
            var check_count = {{ count($questions->get_answers) }};
        @else
            var check_count = 0;
        @endif
        $("#addRow").click(function() {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group d-block mb-3">';
            html +=
                '<div class="input-group-append row d-flex justify-content-between"> <div class="col-lg-8 col-md-12 col-sm-12"><label class="pb-4">Options ' +
                (check_count + 1) + '<span class="text-danger">*</span></label> <textarea id="editor_' +
                check_count + '" class="ckeditor col-lg-6 col-md-12 col-sm-12" name="answers[]"></textarea></div> ';
            html +=
                '<div class="su_right col-lg-2 col-md-12 col-sm-12 py-3 py-md-3 d-lg-block d-md-flex d-flex text-center"> <div class="pb-4">Correct Answer</div>';
            html += '<div class=""><input type="checkbox" class="radio__" name="is_correct[' + check_count +
                '][]" value="1" >  <label><i id="true" class="fas fa-check" style="color:green;"></i></label></div></div>';
            html +=
                '<div class="su_right col-lg-2 col-md-12 col-sm-12 py-3 py-md-3 d-lg-block d-md-flex d-flex text-center"><div class="pb-4">Action</div> ';
            html += '<div><button id="removeRow" type="button" class="btn btn-danger">Remove</button></div> </div>';
            html += '</div></div>';

            $('#newRow').append(html);
            var editorId = 'editor_' + check_count;
            CKEDITOR.replace('editor_' + check_count, {
                filebrowserUploadUrl: HOST_URL + "/ck-image?_token={{ csrf_token() }}",
                filebrowserUploadMethod: 'form'
            });
            check_count++;
        });
        // remove row
        $(document).on('click', '#removeRow', function() {
            $(this).closest('#inputFormRow').remove();
            check_count--;
        });
        
        $(document).on('change', '#jump_to', function() {
            var q_id = $(this).val();
            window.location.href = HOST_URL + '/question/{{ request()->id }}?question_id=' + q_id;
        })

    </script>
@endsection
