@extends('cms-view.layouts.main')
@section('title')
@parent
| {{__('Website Core Setting')}}
@endsection
@section('pageTitle')
{{ __('Website Core Setting') }}
@endsection
@section('breadcrumbs')
{{ __('Add') }}
@endsection
@push('post-scripts')
<script src="{{ asset('public/form-js/websitecoresetting-add.js') }}"></script>
@endpush
@section('content')
<input type="hidden" id="urlListData" data-info="{{ $crudUrlTemplate }}">
<div class="post d-flex flex-column-fluid" id="kt_post">
<div id="kt_content_container" class="container-xxl">
<div class="card card-flush">
   @if($textMessage =='')
   <!--begin::Card body-->
   <div class="card-body">
      <!--begin:::Tabs-->
      <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
         <!--begin:::Tab item-->
         <li class="nav-item">
            <a class="nav-link text-active-primary d-flex align-items-center pb-5 active" data-bs-toggle="tab" href="#kt_header_settings_general" id="edit">
            <i class="ki-outline ki-home fs-2 me-2"></i> Header Footer Logo
            </a>
         </li>
         <!--end:::Tab item-->
         <!--begin:::Tab item-->
         <li class="nav-item">
            <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_footer_content_settings">
            <i class="ki-outline ki-shop fs-2 me-2"></i> Footer Content
            </a>
         </li>
         <!--end:::Tab item-->
         <!--begin:::Tab item-->
         <li class="nav-item">
            <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_social_link_settings">
               <i class="ki-outline ki-abstract-39 fs-2 me-2"></i>  Social Link
            </a>
         </li>
         <!--end:::Tab item-->
         <!--begin:::Tab item-->
         <li class="nav-item">
            <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_popupadvertising_settings">
               <i class="ki-outline ki-abstract-39 fs-2 me-2"></i> Advertising Popup 
            </a>
         </li>
         <!--end:::Tab item-->
      </ul>
      <!--end:::Tabs-->
      <!--begin:::Tab content-->
      <div class="tab-content" id="myTabContent">
         <!--begin:::Tab pane-->
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
                     <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>            </label>
                     <!--end::Label-->
                  </div>
                  <div class="col-md-9">
                     <!--begin::Input-->
                     <input type="text" class="form-control form-control-solid logo_title" name="logo_title" id="logo_title_error" />
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
                     <input type="file" class="form-control form-control-solid header_logo" name="header_logo" id="header_logo_error" accept="image/*" />
                     <!--end::Input-->
                  </div>
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row py-5">
                  <div class="col-md-9 offset-md-3">
                     <div class="d-flex">
                        <button type="reset" data-kt-ecommerce-settings-type="cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" data-kt-settings-type="submit" id="kt_coreWebsiteSetting_submit" class="btn btn-primary submit-coreWebsiteSetting-btn">
                        <span class="indicator-label">Save</span>
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
         <!--end:::Tab pane-->
         <!--begin:::Tab pane-->
         <div class="tab-pane fade" id="kt_footer_content_settings" role="tabpanel">
            <!--begin::Form-->
            <form id="kt_footer_content_settings_form" class="form" enctype="multipart/form-data">
               @csrf
               <!--begin::Heading-->
               <div class="row mb-7">
                  <div class="d-flex flex-column gap-7 gap-lg-8">
                     <h2>Footer Content</h2>
                           <div>
                              <!--begin::Label-->
                              <label class="form-label required">Description (English)</label>
                              <!--end::Label-->
                              <!--begin::Editor-->
                                 <div class="min-h-200px mb-2 summernote kt_summernote_en" id="kt_summernote_en"></div>
                              <!--end::Editor-->
                              <!--begin::Description-->
                              <div class="text-muted fs-7">Set a description to the news for better visibility.</div>
                              <!--end::Description-->
                           </div>
                           <!--end::Input group-->
                           <!--begin::Input group-->
                           <div>
                              <!--begin::Label-->
                              <label class="form-label mt-8">विवरण (हिन्दी में)</label>
                              <!--end::Label-->
                              <!--begin::Editor-->
                                 <div class="min-h-200px mb-2 summernote kt_summernote_hi" id="kt_summernote_hi"></div>
                              <!--end::Editor-->
                              <!--begin::Description-->
                              <div class="text-muted fs-7">Set a description to the news for better visibility.</div>
                              <!--end::Description-->
                           </div>
                           <div class="row fv-row mb-7">
                           <div class="col-md-3 text-md-end">
                              <!--begin::Label-->
                              <label class="fs-6 fw-semibold form-label mt-3">
                              <span class="required">Locate Map Link</span>
                              <span class="ms-1"  data-bs-toggle="tooltip" title="Set the title of the store for SEO." >
                              <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>            </label>
                              <!--end::Label-->
                           </div>
                           <div class="col-md-9">
                              <!--begin::Input-->
                              <input type="text" class="form-control form-control-solid locate_map_link" name="locate_map_link" id="locate_map_link" value="" placeholder="https://..."  />
                              <!--end::Input-->
                           </div>
                        </div>
                     </div>
               </div>
               <div class="row py-5">
                  <div class="col-md-9 offset-md-3">
                     <div class="d-flex">
                        <!--begin::Button-->
                        <button type="reset" data-kt-ecommerce-settings-type="cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" data-kt-settings-type="submit" id="kt_coreWebsiteSetting_submit2" class="btn btn-primary submit-coreWebsiteSetting-btn2">
                        <span class="indicator-label">Save</span>
                        <span class="indicator-progress">
                           Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        </button>
                        <!--end::Button-->
                     </div>
                  </div>
               </div>
               <!--end::Action buttons-->
            </form>
            <!--end::Form-->            
         </div>
         <!--end:::Tab pane-->
         <!--begin:::Tab pane-->
         <div class="tab-pane fade" id="kt_social_link_settings" role="tabpanel">
            <!--begin::Form-->
            <form id="kt_social_link_settings_form" class="form" method="POST" enctype="multipart/form-data">
               @csrf
               <!--begin::Heading-->
               <div class="row mb-7">
                  <div class="col-md-9 offset-md-3">
                     <h2>Social Link</h2>
                  </div>
               </div>
               <!--end::Heading-->
               <!--begin::Input group-->
               <div class="row fv-row mb-7">
                  <div class="col-md-3 text-md-end">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mt-3">
                     <span class="required">Google Link</span>
                     <span class="ms-1"  data-bs-toggle="tooltip" title="Set the title of the store for SEO." >
                     <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>            </label>
                     <!--end::Label-->
                  </div>
                  <div class="col-md-9">
                     <!--begin::Input-->
                     <input type="text" class="form-control form-control-solid google_link" name="google_link" id="google_link_error" value="" placeholder="https://..."  />
                     <!--end::Input-->
                  </div>
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row fv-row mb-7">
                  <div class="col-md-3 text-md-end">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mt-3">
                     <span class="required">Linked In</span>
                     <span class="ms-1"  data-bs-toggle="tooltip" title="Set the title of the store for SEO." >
                     <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>            </label>
                     <!--end::Label-->
                  </div>
                  <div class="col-md-9">
                     <!--begin::Input-->
                     <input type="text" class="form-control form-control-solid linkedin" name="linkedin" id="linkedin_error" value="" placeholder="https://..."  />
                     <!--end::Input-->
                  </div>
               </div>
               <div class="row fv-row mb-7">
                  <div class="col-md-3 text-md-end">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mt-3">
                        <span class="required">Facebook</span>
                        <span class="ms-1"  data-bs-toggle="tooltip" title="Set the title of the store for SEO." >
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>            
                     </label>
                     <!--end::Label-->
                  </div>
                  <div class="col-md-9">
                     <!--begin::Input-->
                     <input type="text" class="form-control form-control-solid facebook" name="facebook" id="facebook_error" value="" placeholder="https://..."  />
                     <!--end::Input-->
                  </div>
               </div>
               <div class="row fv-row mb-7">
                  <div class="col-md-3 text-md-end">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mt-3">
                     <span class="">Twitter</span>
                     <span class="ms-1"  data-bs-toggle="tooltip" title="Set the title of the store for SEO." >
                     <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>            </label>
                     <!--end::Label-->
                  </div>
                  <div class="col-md-9">
                     <!--begin::Input-->
                     <input type="text" class="form-control form-control-solid twitter" name="twitter" id="twitter_error" value="" placeholder="https://..."  />
                     <!--end::Input-->
                  </div>
               </div>
               <div class="row fv-row mb-7">
                  <div class="col-md-3 text-md-end">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mt-3">
                     <span class="">Instagram</span>
                     <span class="ms-1"  data-bs-toggle="tooltip" title="Set the title of the store for SEO." >
                     <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>            
                  </label>
                     <!--end::Label-->
                  </div>
                  <div class="col-md-9">
                     <!--begin::Input-->
                     <input type="text" class="form-control form-control-solid instagram" name="instagram" id="instagram_error" value="" placeholder="https://..." />
                     <!--end::Input-->
                  </div>
               </div>
               <div class="row fv-row mb-7">
                  <div class="col-md-3 text-md-end">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mt-3">
                        <span class="">GitHub</span>
                        <span class="ms-1"  data-bs-toggle="tooltip" title="Set the title of the store for SEO." >
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>            
                     </label>
                     <!--end::Label-->
                  </div>
                  <div class="col-md-9">
                     <!--begin::Input-->
                     <input type="text" class="form-control form-control-solid github" name="github" id="github_error" value="" placeholder="https://..."   />
                     <!--end::Input-->
                  </div>
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row py-5">
                  <div class="col-md-9 offset-md-3">
                     <div class="d-flex">
                        <!--begin::Button-->
                        <button type="reset" data-kt-ecommerce-settings-type="cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" data-kt-settings-type="submit" id="kt_coreWebsiteSetting_submit3" class="btn btn-primary submit-coreWebsiteSetting-btn3">
                        <span class="indicator-label">Save</span>
                        <span class="indicator-progress">
                           Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        </button>
                        <!--end::Button-->
                     </div>
                  </div>
               </div>
               <!--end::Action buttons-->
            </form>
            <!--end::Form-->            
         </div>
         <!--end:::Tab pane-->
         <!--begin:::Tab pane-->
         <div class="tab-pane fade" id="kt_popupadvertising_settings" role="tabpanel">
            <!--begin::Form-->
            <form class="forms-sample row col-md-12" id="kt_popupadvertising_settings_form" enctype="multipart/form-data">
               @csrf
               <!--begin::Heading-->
               <div class="row mb-7">
                  <div class="col-md-9 offset-md-3">
                     <h2>Advertising Popup Settings</h2>
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
                     <input type="text" class="form-control form-control-solid popupadvertising_title" name="popupadvertising_title" id="popupadvertising_title" />
                     <!--end::Input-->
                  </div>
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row fv-row mb-7">
                  <div class="col-md-3 text-md-end">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mt-3">
                        <span>Image (jpg/jpeg/png/gif)</span>
                        <span class="ms-1"  data-bs-toggle="tooltip" title="Set keywords for the store separated by a comma." >
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>           
                      </label>
                     <!--end::Label-->
                  </div>
                  <div class="col-md-9">
                     <!--begin::Input-->
                     <input type="file" class="form-control form-control-solid popupadvertising_file" name="popupadvertising_file" id="popupadvertising_file" accept="image/*" />
                     <!--end::Input-->
                  </div>
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row fv-row mb-7">
                  <div class="col-md-3 text-md-end">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mt-3">
                        <span>Select From Date -> TO Date</span>
                        <span class="ms-1"  data-bs-toggle="tooltip" title="Set keywords for the store separated by a comma." >
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>           
                      </label>
                     <!--end::Label-->
                  </div>
                  <div class="col-md-3">
                     <!--begin::Input-->
                     <input type="date" class="form-control form-control-solid popupadvertising_from" name="popupadvertising_from" id="popupadvertising_from" />
                     <!--end::Input-->
                  </div>
                  <div class="col-md-3">
                     <!--begin::Input-->
                     <input type="date" class="form-control form-control-solid popupadvertising_to" name="popupadvertising_to" id="popupadvertising_to" />
                     <!--end::Input-->
                  </div>
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row py-5">
                  <div class="col-md-9 offset-md-3">
                     <div class="d-flex">
                        <button type="reset" data-kt-ecommerce-settings-type="cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" data-kt-settings-type="submit" id="kt_popupadvertising_submit" class="btn btn-primary submit-popupadvertising-btn">
                        <span class="indicator-label">Save</span>
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
         <!--end:::Tab pane-->
      </div>
      <!--end:::Tab content-->
   </div>
   <!--end::Card body-->
   @else
      {!! $textMessage !!}
     <div class="symbol symbol-100px text-center"> <img class="" src='{{ asset(config("constants.error.error_image")) }}' /></div>
   @endif
</div>
@endsection