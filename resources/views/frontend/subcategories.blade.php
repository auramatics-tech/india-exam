@extends('frontend.layouts.master')
@section('content')
    <section class="si_sec_text su_height">
        <div class="container py-4 container_padding">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="py-3 border shadow rounded px-4 bg-white">
                        <h5 class="si_heading1"><a href="{{ route('home') }}">Home</a> » <a
                                href="">{{ isset($category->name) ? $category->name : get_category(request()->cat_id)->name }}</a>
                        </h5>
                        <hr>
                        <div class="row">
                            @php
                                $count = count($subcategories) / 2;
                            @endphp
                            @if (count($subcategories))
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <ul class="list-unstyled si_icons si_list">
                                        @foreach ($subcategories as $key => $val)
                                            @if ($key <= $count)

                                                <li><i class="fas fa-angle-right"></i><a
                                                        href="{{ next_url($val) }}">{{ $val->name }}</a></li>


                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <ul class="list-unstyled si_icons si_list">
                                        @foreach ($subcategories as $key => $val)
                                            @if ($key > $count)
                                            <li><i class="fas fa-angle-right"></i><a
                                                        href="{{ next_url($val) }}">{{ $val->name }}</a></li>

                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
    </section>
@endsection
