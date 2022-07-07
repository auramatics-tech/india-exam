@extends('frontend.layouts.master')
@section('content')
<section class="si_sec_text su_height">
    <div class="container container_padding  py-4">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="py-3 border shadow rounded px-4 bg-white">
                    <h5 class="si_heading1">Search results for {{request()->q}}
                    </h5>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <ul class="list-unstyled si_icons si_list">
                                @if(count($categories)) 
                                @foreach($categories as $key => $val)
                                <li><i class="fas fa-angle-right"></i><a href="{{route('home.data',$val->slug)}}">{{$val->name}}</a></li>
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