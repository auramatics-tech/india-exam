@extends('frontend.layouts.master')
@section('content')
    <section class="si_sec_text su_height">
        <div class="container py-4 container_padding">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="py-3 border shadow rounded px-4 bg-white">
                        <h5 class="si_heading1"><a class="" href="">{{ isset($category->name) ? $category->name : '' }}</a>
                        </h5>
                        <hr>
                        <p><a href="{{ route('home') }}">Home</a> » <a
                                href="">{{ isset($category->name) ? $category->name : '' }}</a> » List of Topics</p>
                        <div class="row">
                            @php
                                $count = count($subcategories) / 2;
                            @endphp
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="list-unstyled si_icons si_list">
                                    @if (count($subcategories))
                                        @foreach ($subcategories as $key => $subcategory)
                                            @if ($key <= $count)
                                                @if (count($subcategory->get_topic_subcategory)) <li><i class="fas
                                                fa-angle-right"></i><a
                                                href="{{ route('questions', $subcategory->id) }}">{{ $subcategory->name }}</a></li> @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="col-lg-6 col-lg-6 col-sm-12">
                                <ul class="list-unstyled si_icons si_list">
                                    @if (count($subcategories))
                                        @foreach ($subcategories as $key => $subcategory)
                                            @if ($key > $count)
                                                @if (count($subcategory->get_topic_subcategory))
                                                    <li><i class="fas fa-angle-right"></i><a
                                                            href="{{ route('questions', $subcategory->id) }}">{{ $subcategory->name }}</a>
                                                    </li>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </section>
@endsection
