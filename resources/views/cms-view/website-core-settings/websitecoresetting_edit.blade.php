@extends('cms-view.layouts.main')
@section('title')
@parent
| {{__('Website Core Setting')}}
@endsection
@section('pageTitle')
{{ __('Website Core Setting') }}
@endsection
@section('breadcrumbs')
{{ __('Website Core Setting Edit') }}
@endsection
@push('post-scripts')
<script src="{{ asset('public/form-js/websitecoresetting-edit.js') }}"></script>
@endpush
@section('content')
<input type="hidden" id="urlListData" data-info="{{ $crudUrlTemplate }}">
<div class="post d-flex flex-column-fluid" id="kt_post">
<div id="kt_content_container" class="container-xxl">
<div class="card card-flush">
   <!--begin::Card body-->
   <div class="card-body">
      <!--begin:::Tabs-->
      <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
         <!--begin:::Tab item-->
         @if(isset($data) && $data !='')
         <li class="nav-item">
            <a class="nav-link text-active-primary d-flex align-items-center pb-5 active" data-bs-toggle="tab" href="#kt_header_settings_general" id="edit">
            <i class="ki-outline ki-home fs-2 me-2"></i> Header Footer Logo
            </a>
         </li>
         @endif
         <!--end:::Tab item-->
      </ul>
      <!--end:::Tabs-->
      <!--begin:::Tab content-->
      <div class="tab-content" id="myTabContent">
         <!--begin:::Tab pane-->
         @if(isset($data) && $data !='')
         <div class="tab-pane fade show active" id="kt_header_settings_general" role="tabpanel">
            <!--begin::Form-->
            <form class="forms-sample row col-md-12" id="kt_core_website_settings_form" enctype="multipart/form-data">
               @csrf
               <!--begin::Heading-->
               <div class="row mb-7">
                  <div class="col-md-9 offset-md-3">
                     <h2>Logo Settings</h2>
                  </div>
               </div>
               <div id="co"></div>
               <!--end::Heading-->
               <!--begin::Input group-->
               <div class="row fv-row mb-7">
                  <div class="col-md-3 text-md-end">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mt-3">
                        <span class="required">Title</span>
                        <span class="ms-1"  data-bs-toggle="tooltip" title="Set the title of the store for SEO." >
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>            
                     </label>
                     <!--end::Label-->
                  </div>
                  <div class="col-md-9">
                     <!--begin::Input-->
                     <input type="text" class="form-control form-control-solid logo_title" name="logo_title" id="logo_title_error" value="{{ $data->logo_title ?? ''}}" accept="image/*" />
                     <!--end::Input-->
                  </div>
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row fv-row mb-7">
                  <div class="col-md-3 text-md-end">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mt-3">
                        <span>Header Logo</span>
                        <span class="ms-1"  data-bs-toggle="tooltip" title="Set keywords for the store separated by a comma." >
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>           
                      </label>
                     <!--end::Label-->
                  </div>
                  <div class="col-md-9">
                     <!--begin::Input-->
                     <input type="file" class="form-control form-control-solid header_logo" name="header_logo" id="header_logo_error" accept=".png, .jpg, .jpeg" />
                     <!--end::Input-->
                  </div>
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row py-5">
                  <div class="col-md-9 offset-md-3">
                     <div class="d-flex">
                        <button type="reset" data-kt-ecommerce-settings-type="cancel" class="btn btn-light me-3">{{config('FormField.cancel_button')}}</button>
                        <button type="submit" data-kt-settings-type="submit" id="kt_coreWebsiteSetting_submit" class="btn btn-primary submit-coreWebsiteSetting-btn">
                        <span class="indicator-label">{{config('FormField.save_button')}}</span>
                        <span class="indicator-progress">
                           Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        </button>
                     </div>
                  </div>
               </div>
               <!--end::Action buttons-->
            </form>
            <!--end::Form-->            
         </div>
         @endif
         <!--end:::Tab pane-->
      </div>
      <!--end:::Tab content-->
   </div>
   <!--end::Card body-->
</div>
@endsection