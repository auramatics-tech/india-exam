@extends('backend.layouts.master')
@section('css')
<style>
    .si_icon{
        font-size: 22px;
    color: #0067ac;
    }
    .si_left{
        justify-content: space-between;
    }
</style>
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                    <!--end::Page Title-->
                </div>
                <!--end::Info-->
            </div>
        </div>
        <div class="container">
<div class="row">
<div class="col-lg-3 col-md-3 col-12">
<div class="card">
      <div class="card-body">
          <div class="d-flex si_left">
          <h5 class="card-title">Categories</h5>
        <i class="fa fa-th-large si_icon" aria-hidden="true"></i>
          </div>
        <h3 class="card-text">{{$categories}}</h3>
      </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-12">
<div class="card">
      <div class="card-body">
      <div class="d-flex si_left">
          <h5 class="card-title">Subcategories</h5>
        <i class="fa fa-th-large si_icon" aria-hidden="true"></i>
          </div>
        <h3 class="card-text">{{$subcategories}}</h3>
      </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-12">
<div class="card">
      <div class="card-body">
      <div class="d-flex si_left">
          <h5 class="card-title">Topics</h5>
        <i class="fa fa-th-large si_icon" aria-hidden="true"></i>
          </div>
        <h3 class="card-text">{{$topics}}</h3>
      </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-12">
<div class="card">
      <div class="card-body">
      <div class="d-flex si_left">
          <h5 class="card-title">Questions</h5>
        <i class="fa fa-th-large si_icon" aria-hidden="true"></i>
          </div>
        <h3 class="card-text">{{$questions}}</h3>
      </div>
    </div>
</div>
</div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Dashboard-->
                <!--end::Dashboard-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@endsection
<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
<amp-analytics type="gtag" data-credentials="include">
<script type="application/json">
{
  "vars" : {
    "gtag_id": "<GA_MEASUREMENT_ID>",
    "config" : {
      "<GA_MEASUREMENT_ID>": { "groups": "default" }
    }
  }
}
</script>
</amp-analytics>