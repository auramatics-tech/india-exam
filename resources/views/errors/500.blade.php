@extends('frontend.layouts.master')

@section('content')

<style>
.alert {
    margin-bottom: 0px;
}
.su_height{
    min-height: 85vh;
    display:flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
.su_heading{
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    padding: 20px;
}
.su_heading1{
    text-align: center;
    font-size: 15px;
    font-weight: 700;
}
</style>

<div class="container">
    <div class="su_height">
        <h2 class="display-3">404</h2>
        <p class="display-5 su_heading">Oops! Something is wrong.</p>
        <p class="display-5 su_heading1">This page isn't available</p>
        <a href="{{url('/')}}" class="btn btn-primary" style="background-color: #0067ac; border-color:#0067ac;margin-top: 20px;">Home Page</a>
    </div>
</div>
@endsection