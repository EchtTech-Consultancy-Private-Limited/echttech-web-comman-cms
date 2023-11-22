<div class="aside-menu flex-column-fluid">
   <div
      class="hover-scroll-overlay-y py-2"
      id="kt_aside_menu_wrapper"
      data-kt-scroll="true"
      data-kt-scroll-activate="{default: false, lg: true}"
      data-kt-scroll-height="auto"     
      data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
      data-kt-scroll-wrappers="#kt_aside_menu" 
      data-kt-scroll-offset="0"
      >
      <!-- <//?php //dd($modelname) ?> -->
      <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
         <div  class="menu-item here show menu-accordion" >
            <span class="menu-link" >
               <span  class="menu-icon" ><i class="ki-outline ki-home fs-2"></i></span>
               <span  class="menu-title" style="transform: rotateZ(0deg);">
            <a href="{{ route('dashboard') }}">Dashboards</a></span>
            <span  class="menu-arrow" style="transform: rotate(90deg) !important;"></span></span><!--end:Menu link--><!--begin:Menu sub-->
         </div>
         <div  class="menu-item pt-5" >
            <div  class="menu-content" ><span class="menu-heading fw-bold text-uppercase fs-7">Pages Management</span></div>
         </div>
         <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['user/user-list','role/role-create','role/role-list','permission/permission-list']) }} {{ (request()->is('role/role-create/*')) ? 'hover show' : '' }}{{ (request()->is('role/role-list/*')) ? 'hover show' : '' }}{{ (request()->is('user/user-list/*')) ? 'hover show' : '' }}{{ (request()->is('permission/permission-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span class="menu-icon" ><i class="ki-outline ki-address-book fs-2"></i></span><span  class="menu-title" >User Management</span><span class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div  class="menu-sub menu-sub-accordion {{ set_active(['role/role-create','role/role-list','user/role-list']) }} {{ (request()->is('role/role-create/*')) ? 'show' : '' }}{{ (request()->is('role/role-list/*')) ? 'show' : '' }}{{ (request()->is('user/role-list/*')) ? 'show' : '' }}" >
               <div  data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['user/list']) }}{{ (request()->is('user/list/*')) ? 'hover show' : '' }} mb-1" >
                  <span class="menu-link" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Users</span><span class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
                  <div  class="menu-sub menu-sub-accordion {{ set_active(['user/user-list']) }} {{ (request()->is('user/user-list/*')) ? 'show' : '' }}{{ (request()->is('user/user-list/*')) ? 'show' : '' }}" >
                     <div  class="menu-item" >
                        <a class="menu-link {{ set_active1(['user/user-list']) }} {{ (request()->is('user/user-list/*')) ? 'active' : '' }}" href="{{ route('user.list') }}" ><span class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >User List</span></a><!--end:Menu link-->
                     </div>
                  </div>
               </div>
               @if(isset(Auth::user()->role_id) == '1' && Auth::user()->role_id == '1')
               <div data-kt-menu-trigger="click"  class="menu-item menu-accordion {{ set_active(['role/role-create','role/role-list']) }} {{ (request()->is('role/role-create/*')) ? 'hover show' : '' }}{{ (request()->is('role/role-list/*')) ? 'hover show' : '' }}" >
                  <span class="menu-link" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span>
                  <span  class="menu-title" >Roles</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
                  <div class="menu-sub menu-sub-accordion {{ set_active(['role/role-create','role/role-list']) }} {{ (request()->is('role/role-create/*')) ? 'show' : '' }}{{ (request()->is('role/role-list/*')) ? 'show' : '' }}" >
                     <div class="menu-item" >
                        <a class="menu-link {{ set_active1(['role/role-create']) }} {{ (request()->is('role/role-create/*')) ? 'active' : '' }}" href="{{ route('role.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Roles Create</span></a><!--end:Menu link-->
                        <a class="menu-link {{ set_active1(['role/role-list']) }} {{ (request()->is('role/role-list/*')) ? 'active' : '' }}" href="{{ route('role.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Roles List</span></a><!--end:Menu link-->
                     </div>
                  </div>
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['permission/permission-list']) }} {{ (request()->is('permission/permission-list/*')) ? 'active' : '' }}"  href="{{ route('permission.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Permissions</span></a><!--end:Menu link-->
               </div>
               @endif
            </div>
         </div>
         <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['employeedirectory/employeedirectory-create','employeedirectory/employeedirectory-list']) }}{{ (request()->is('employeedirectory/employeedirectory-create/*')) ? 'hover show' : '' }} {{ (request()->is('employeedirectory/employeedirectory-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span class="menu-icon" ><i class="ki-outline ki-user fs-2"></i></span>
            <span class="menu-title" >Employee Directory </span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion {{ set_active(['employeedirectory/employeedirectory-create','employeedirectory/employeedirectory-list']) }}{{ (request()->is('employeedirectory/employeedirectory-create/*')) ? 'show' : '' }} {{ (request()->is('employeedirectory/employeedirectory-list/*')) ? 'show' : '' }}" >
               <div class="menu-item" >
                  <a class="menu-link {{ set_active1(['employeedirectory/employeedirectory-create']) }} {{ (request()->is('employeedirectory/employeedirectory-create/*')) ? 'active' : '' }}"  href="{{ route('employeedirectory.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create</span></a><!--end:Menu link-->
                  <a class="menu-link {{ set_active1(['employeedirectory/employeedirectory-list']) }} {{ (request()->is('employeedirectory/employeedirectory-list/*')) ? 'active' : '' }}"  href="{{ route('employeedirectory.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >List</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['departmentdesignation/departmentdesignation-list','departmentdesignation/departmentdesignation-create']) }} {{ (request()->is('departmentdesignation/departmentdesignation-list/*')) ? 'hover show' : '' }}{{ (request()->is('departmentdesignation/departmentdesignation-create/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span class="menu-icon" ><i class="ki-outline ki-abstract-26 fs-2"></i></span>
            <span class="menu-title" >Department & Designation</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion {{ set_active(['departmentdesignation/departmentdesignation-list','departmentdesignation/departmentdesignation-create']) }} {{ (request()->is('departmentdesignation/departmentdesignation-list/*')) ? 'show' : '' }}{{ (request()->is('departmentdesignation/departmentdesignation-create/*')) ? 'show' : '' }}" >
               <div class="menu-item" >
                  <a class="menu-link {{ set_active1(['departmentdesignation/departmentdesignation-create']) }} {{ (request()->is('departmentdesignation/departmentdesignation-create/*')) ? 'active' : '' }}"  href="{{ route('departmentdesignation.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create</span></a><!--end:Menu link-->
                  <a class="menu-link {{ set_active1(['departmentdesignation/departmentdesignation-list']) }} {{ (request()->is('departmentdesignation/departmentdesignation-list/*')) ? 'active' : '' }}"  href="{{ route('departmentdesignation.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >List</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['recentactivity/recentactivity-list','recentactivity/recentactivity-create']) }} {{ (request()->is('recentactivity/recentactivity-list/*')) ? 'hover show' : '' }}{{ (request()->is('recentactivity/recentactivity-create/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span class="menu-icon" ><i class="ki-outline ki-abstract-26 fs-2"></i></span>
            <span class="menu-title" >Recent Activity</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion {{ set_active(['recentactivity/recentactivity-list','recentactivity/recentactivity-create']) }} {{ (request()->is('recentactivity/recentactivity-list/*')) ? 'show' : '' }}{{ (request()->is('recentactivity/recentactivity-create/*')) ? 'show' : '' }}" >
               <div class="menu-item" >
                  <a class="menu-link {{ set_active1(['recentactivity/recentactivity-create']) }} {{ (request()->is('recentactivity/recentactivity-create/*')) ? 'active' : '' }}"  href="{{ route('recentactivity.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create</span></a><!--end:Menu link-->
                  <a class="menu-link {{ set_active1(['recentactivity/recentactivity-list']) }} {{ (request()->is('recentactivity/recentactivity-list/*')) ? 'active' : '' }}"  href="{{ route('recentactivity.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >List</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['rtiassets/rtiassets-create','rtiassets/rtiassets-list']) }}{{ (request()->is('rtiassets/rtiassets-create/*')) ? 'hover show' : '' }} {{ (request()->is('rtiassets/rtiassets-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span class="menu-icon" ><i class="ki-outline ki-abstract-26 fs-2"></i></span>
            <span class="menu-title" >RTI Assets</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion {{ set_active(['rtiassets/rtiassets-list','rtiassets/rtiassets-create']) }}{{ (request()->is('rtiassets/rtiassets-create/*')) ? 'show' : '' }} {{ (request()->is('rtiassets/rtiassets-list/*')) ? 'show' : '' }}" >
               <div class="menu-item">
                  <a class="menu-link {{ set_active1(['rtiassets/rtiassets-create']) }} {{ (request()->is('rtiassets/rtiassets-create/*')) ? 'active' : '' }}"  href="{{ route('rtiassets.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create</span></a><!--end:Menu link-->
                  <a class="menu-link {{ set_active1(['rtiassets/rtiassets-list']) }} {{ (request()->is('rtiassets/rtiassets-list/*')) ? 'active' : '' }}"  href="{{ route('rtiassets.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >List</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div data-kt-menu-trigger="click"  class="menu-item menu-accordion {{ set_active(['faq/faq-list']) }} {{ (request()->is('faq/faq-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span  class="menu-icon" ><i class="ki-outline ki-abstract-39 fs-2"></i></span>
            <span  class="menu-title" >Dynamic Form Pages </span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div  class="menu-sub menu-sub-accordion {{ set_active(['faq/faq-list']) }} {{ (request()->is('faq/faq-list/*')) ? 'show' : '' }}" >
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['faq/faq-list']) }} {{ (request()->is('faq/faq-list/*')) ? 'active' : '' }}"  href="{{ route('faq.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create FAQ</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div  data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['menu/menu-create','menu/menu-list']) }} {{ (request()->is('menu/menu-create/*')) ? 'hover show' : '' }}{{ (request()->is('menu/menu-list/*')) ? 'hover show' : '' }}">
            <span class="menu-link" ><span class="menu-icon" ><i class="ki-outline ki-chart-pie-3 fs-2"></i></span>
            <span  class="menu-title" >Website Menu </span><span  class="menu-arrow" ></span></span>
            <div  class="menu-sub menu-sub-accordion menu-active-bg {{ set_active(['menu/menu-create','menu/menu-list']) }} {{ (request()->is('menu/menu-create/*')) ? 'show' : '' }}{{ (request()->is('menu/menu-list/*')) ? 'show' : '' }}" >
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['menu/menu-create']) }} {{ (request()->is('menu/menu-create/*')) ? 'active' : '' }}"  href="{{ route('menu.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create </span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['menu/menu-list']) }} {{ (request()->is('menu/menu-list/*')) ? 'active' : '' }}"  href="{{ route('menu.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >List</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div  data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['websitecoresetting/websitecoresetting-create','websitecoresetting/logo-list','websitecoresetting/footercontent-list','websitecoresetting/sociallink-list']) }} {{ (request()->is('websitecoresetting/websitecoresetting-create/*')) ? 'hover show' : '' }}{{ (request()->is('websitecoresetting/logo-list/*')) ? 'hover show' : '' }}
         {{ (request()->is('websitecoresetting/footercontent-list/*')) ? 'hover show' : '' }}{{ (request()->is('websitecoresetting/sociallink-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span  class="menu-icon" ><i class="ki-outline ki-chart-pie-3 fs-2"></i></span><span  class="menu-title" >Website Core Settings</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div  class="menu-sub menu-sub-accordion menu-active-bg {{ set_active(['websitecoresetting/websitecoresetting-create','websitecoresetting/logo-list','websitecoresetting/footercontent-list','websitecoresetting/sociallink-list']) }} {{ (request()->is('websitecoresetting/websitecoresetting-create/*')) ? 'show' : '' }}{{ (request()->is('websitecoresetting/logo-list/*')) ? 'show' : '' }}
            {{ (request()->is('websitecoresetting/footercontent-list/*')) ? 'show' : '' }}{{ (request()->is('websitecoresetting/sociallink-list/*')) ? 'show' : '' }}" >
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['websitecoresetting/websitecoresetting-create']) }} {{ (request()->is('websitecoresetting/websitecoresetting-create/*')) ? 'active' : '' }}"  href="{{ route('websitecoresetting.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Setting</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['websitecoresetting/logo-list']) }} {{ (request()->is('websitecoresetting/logo-list/*')) ? 'active' : '' }}"  href="{{ route('logo.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Logo Listing</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['websitecoresetting/footercontent-list']) }} {{ (request()->is('websitecoresetting/footercontent-list/*')) ? 'active' : '' }}"  href="{{ route('footercontent.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Footer Content Listing</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['websitecoresetting/sociallink-list']) }} {{ (request()->is('websitecoresetting/sociallink-list/*')) ? 'active' : '' }}"  href="{{ route('sociallink.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Social Link Listing</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div  data-kt-menu-trigger="click"  class="menu-item menu-accordion {{ set_active(['homebanner/homebanner-create','homebanner/homebanner-list']) }} {{ (request()->is('homebanner/homebanner-create/*')) ? 'hover show' : '' }}{{ (request()->is('homebanner/homebanner-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span  class="menu-icon" ><i class="ki-outline ki-bucket fs-2"></i></span><span  class="menu-title" >Home Page Banner</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div  class="menu-sub menu-sub-accordion menu-active-bg {{ set_active(['homebanner/homebanner-create','homebanner/homebanner-list']) }} {{ (request()->is('homebanner/homebanner-create/*')) ? 'show' : '' }}{{ (request()->is('homebanner/homebanner-list/*')) ? 'show' : '' }}" >
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['homebanner/homebanner-create']) }} {{ (request()->is('homebanner/homebanner-create/*')) ? 'active' : '' }}"  href="{{ route('homebanner.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['homebanner/homebanner-list']) }} {{ (request()->is('homebanner/homebanner-list/*')) ? 'active' : '' }}"  href="{{ route('homebanner.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >List</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div  data-kt-menu-trigger="click"  class="menu-item menu-accordion {{ set_active(['contentpage/contentpage-create','contentpage/contentpage-list']) }} {{ (request()->is('contentpage/contentpage-create/*')) ? 'hover show' : '' }}{{ (request()->is('contentpage/contentpage-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span  class="menu-icon" ><i class="ki-outline ki-call fs-2"></i></span><span  class="menu-title" >Dynamic Content Page</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div  class="menu-sub menu-sub-accordion {{ set_active(['contentpage/contentpage-create','contentpage/contentpage-list']) }} {{ (request()->is('contentpage/contentpage-create/*')) ? 'show' : '' }}{{ (request()->is('contentpage/contentpage-list/*')) ? 'show' : '' }}" >
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['contentpage/contentpage-create']) }} {{ (request()->is('contentpage/contentpage-create/*')) ? 'active' : '' }}"  href="{{ route('contentpage.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Page Create</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['contentpage/contentpage-list']) }} {{ (request()->is('contentpage/contentpage-list/*')) ? 'active' : '' }}"  href="{{ route('contentpage.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Listing</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div  data-kt-menu-trigger="click"  class="menu-item menu-accordion {{ set_active(['gallerymanagement/gallerymanagement-create','gallerymanagement/gallerymanagement-list']) }} {{ (request()->is('gallerymanagement/gallerymanagement-create/*')) ? 'hover show' : '' }}{{ (request()->is('gallerymanagement/gallerymanagement-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span  class="menu-icon" ><i class="ki-outline ki-element-7 fs-2"></i></span><span  class="menu-title" >Gallery Management</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div  class="menu-sub menu-sub-accordion {{ set_active(['gallerymanagement/gallerymanagement-create','gallerymanagement/gallerymanagement-list']) }} {{ (request()->is('gallerymanagement/gallerymanagement-create/*')) ? 'hover show' : '' }}{{ (request()->is('gallerymanagement/gallerymanagement-list/*')) ? 'hover show' : '' }}" >
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['gallerymanagement/gallerymanagement-create']) }} {{ (request()->is('gallerymanagement/gallerymanagement-create/*')) ? 'active' : '' }}"  href="{{ route('gallerymanagement.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Photo & Video Create</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link  {{ set_active1(['gallerymanagement/gallerymanagement-list']) }} {{ (request()->is('gallerymanagement/gallerymanagement-list/*')) ? 'active' : '' }}"   href="{{ route('gallerymanagement.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Listing</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div  data-kt-menu-trigger="click"  class="menu-item menu-accordion {{ set_active(['news/news-create','news/news-list']) }} {{ (request()->is('news/news-create/*')) ? 'hover show' : '' }}{{ (request()->is('news/news-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span  class="menu-icon" ><i class="ki-outline ki-element-7 fs-2"></i></span><span  class="menu-title" >News Management</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div  class="menu-sub menu-sub-accordion {{ set_active(['news/news-create','news/news-list']) }} {{ (request()->is('news/news-create/*')) ? 'hover show' : '' }}{{ (request()->is('news/news-list/*')) ? 'hover show' : '' }}" >
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['news/news-create']) }} {{ (request()->is('news/news-create/*')) ? 'active' : '' }}"  href="{{ route('news.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['news/news-list']) }} {{ (request()->is('news/news-list/*')) ? 'active' : '' }}"  href="{{ route('news.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >List</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div  data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['tender/tender-create','tender/tender-list']) }} {{ (request()->is('tender/tender-create/*')) ? 'hover show' : '' }}{{ (request()->is('tender/tender-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span class="menu-icon" ><i class="ki-outline ki-element-7 fs-2"></i></span><span  class="menu-title" >Tenders Management</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div  class="menu-sub menu-sub-accordion {{ set_active(['tender/tender-create','tender/tender-list']) }} {{ (request()->is('tender/tender-create/*')) ? 'show' : '' }}{{ (request()->is('tender/tender-list/*')) ? 'show' : '' }}" >
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['tender/tender-create']) }} {{ (request()->is('tender/tender-create/*')) ? 'active' : '' }}" href="{{ route('tender.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['tender/tender-list']) }} {{ (request()->is('tender/tender-list/*')) ? 'active' : '' }}" href="{{ route('tender.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >List</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div  data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['event/event-create','event/event-list']) }} {{ (request()->is('event/event-create/*')) ? 'hover show' : '' }}{{ (request()->is('event/event-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span  class="menu-icon" ><i class="ki-outline ki-abstract-25 fs-2"></i></span><span  class="menu-title" >Events Management</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div  class="menu-sub menu-sub-accordion {{ set_active(['event/event-create','event/event-list']) }} {{ (request()->is('event/event-create/*')) ? 'show' : '' }}{{ (request()->is('event/event-list/*')) ? 'show' : '' }}" >
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['event/event-create']) }} {{ (request()->is('event/event-create/*')) ? 'active' : '' }}" href="{{ route('event.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['event/event-list']) }} {{ (request()->is('event/event-list/*')) ? 'active' : '' }}" href="{{ route('event.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >List</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         <div  class="menu-item pt-5" >
            <div  class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Apps</span></div>
         </div>
         <div  data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['datamanagement/contactus-list','datamanagement/list-feedback']) }} {{ (request()->is('datamanagement/contactus-list/*')) ? 'hover show' : '' }}{{ (request()->is('datamanagement/feedback-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span  class="menu-icon" ><i class="ki-outline ki-abstract-41 fs-2"></i></span><span  class="menu-title" >Data Management</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div  class="menu-sub menu-sub-accordion {{ set_active(['datamanagement/contactus-list','datamanagement/list-feedback']) }} {{ (request()->is('datamanagement/contactus-list/*')) ? 'show' : '' }}{{ (request()->is('datamanagement/feedback-list/*')) ? 'show' : '' }}" >
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['datamanagement/contactus-list']) }} {{ (request()->is('datamanagement/contactus-list/*')) ? 'active' : '' }}" href="{{ route('datamanagement.list-contact') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Contact List</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['datamanagement/list-feedback']) }} {{ (request()->is('datamanagement/list-feedback/*')) ? 'active' : '' }}" href="{{ route('datamanagement.list-feedback') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Feedback List</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link" href="#" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Text</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         @if(isset(Auth::user()->role_id) == '1' && Auth::user()->role_id == '1')
         <div  data-kt-menu-trigger="click" class="menu-item menu-accordion {{ set_active(['module/module-create','module/module-list']) }} {{ (request()->is('module/module-create/*')) ? 'hover show' : '' }}{{ (request()->is('module/module-list/*')) ? 'hover show' : '' }}" >
            <span class="menu-link" ><span  class="menu-icon" ><i class="ki-outline ki-chart fs-2"></i></span><span  class="menu-title" >Module Management</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
            <div  class="menu-sub menu-sub-accordion {{ set_active(['module/module-create','module/module-list']) }} {{ (request()->is('module/module-create/*')) ? 'show' : '' }}{{ (request()->is('module/module-list/*')) ? 'show' : '' }}" >
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['module/module-create']) }} {{ (request()->is('module/module-create/*')) ? 'active' : '' }}"  href="{{ route('module.create') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Create</span></a><!--end:Menu link-->
               </div>
               <div  class="menu-item" >
                  <a class="menu-link {{ set_active1(['module/module-list']) }} {{ (request()->is('module/module-list/*')) ? 'active' : '' }}"  href="{{ route('module.list') }}" ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >List</span></a><!--end:Menu link-->
               </div>
            </div>
         </div>
         @endif
         @if(isset(Auth::user()->role_id) == '1' && Auth::user()->role_id == '1')
         <div  class="menu-item pt-5" >
            <div  class="menu-content" ><span class="menu-heading fw-bold text-uppercase fs-7">Logs</span></div>
         </div>
         <div  class="menu-item" >
            <a class="menu-link {{ set_active1(['audittrail/audittrail-list']) }} {{ (request()->is('audittrail/audittrail-list/*')) ? 'active' : '' }}" href="{{ route('audittrail.list') }}"><span  class="menu-icon" ><i class="ki-outline ki-rocket fs-2"></i></span><span  class="menu-title" >Audit Trail</span></a><!--end:Menu link-->
         </div>
         <div  class="menu-item pt-5" >
            <div  class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Help</span></div>
         </div>
         <div  class="menu-item" >
            <a class="menu-link {{ set_active1(['dev-team']) }} {{ (request()->is('dev-team/*')) ? 'active' : '' }}" href="{{ route('dev-team') }}"><span  class="menu-icon" ><i class="ki-outline ki-rocket fs-2"></i></span><span  class="menu-title" >Developer</span></a><!--end:Menu link-->
         </div>
         <div  class="menu-item">
            <a class="menu-link" href="#" target="_blank" ><span  class="menu-icon" ><i class="ki-outline ki-abstract-26 fs-2"></i></span><span  class="menu-title" >Documentation</span></a><!--end:Menu link-->
         </div>
         @endif
      </div>
   </div>
</div>