<?php 
/******** API Controllers */
use App\Http\Controllers\CMSControllers\Api\CommonAPIController;
use App\Http\Controllers\CMSControllers\Api\WebsiteMenuManagementAPIController;
use App\Http\Controllers\CMSControllers\Api\UserManagementAPIController;
use App\Http\Controllers\CMSControllers\Api\WebsiteCoreSettingsAPIController;
use App\Http\Controllers\CMSControllers\Api\RolesAndPermissionAPIController;
use App\Http\Controllers\CMSControllers\Api\FooterManagementAPIController;
use App\Http\Controllers\CMSControllers\Api\SocialLinksAPIController;
use App\Http\Controllers\CMSControllers\Api\TenderManagementAPIController;
use App\Http\Controllers\CMSControllers\Api\DynamicContentPageManagamentAPIController;
use App\Http\Controllers\CMSControllers\Api\EventsManagementAPIController;
use App\Http\Controllers\CMSControllers\Api\NewsManagementAPIController;
use App\Http\Controllers\CMSControllers\Api\GalleryManagementAPIController;
use App\Http\Controllers\CMSControllers\Api\HomePageBannerAPIController;
use App\Http\Controllers\CMSControllers\Api\ModuleManagementAPIController;
use App\Http\Controllers\CMSControllers\Api\SystemLogsAPIController;
use App\Http\Controllers\CMSControllers\Api\DynamicPagesAPIController;
use App\Http\Controllers\CMSControllers\Api\DataManagementAPIController;
use App\Http\Controllers\CMSControllers\Api\CareerManagementAPIController;
use App\Http\Controllers\CMSControllers\Api\EmpDepartDesignationAPIController;
use App\Http\Controllers\CMSControllers\Api\EmployeeDirectoryAPIController;
use App\Http\Controllers\CMSControllers\Api\PopupAdvertisingAPIController;
use App\Http\Controllers\CMSControllers\Api\RecentActivityAPIController;
use App\Http\Controllers\CMSControllers\Api\RtiAssetsAPIController;


/***************************** API URL Use For Data Migrate With DB*************************************** */
//Route::prefix('api')->group(function(){
    Route::middleware(['auth','prevent-back-history','logs','EnsureTokenIsValid'])->group(function () {

        Artisan::call('cache:clear');
        Artisan::call('storage:link');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        
        Route::group(['prefix' => 'api/v1'], function () {
    
            /****** Users Setting user:user */
            Route::post('/create-ues',[UserManagementAPIController::class,'store'])->name('user-save')->middleware('throttle:custom_Limit');
            Route::get('/list-ues',[UserManagementAPIController::class,'index'])->name('user-list');
            Route::get('/edit-ues/{id}',[UserManagementAPIController::class,'edit'])->name('user-edit');
            Route::post('/update-ues',[UserManagementAPIController::class,'update'])->name('user-update');
            Route::delete('/delete-ues/{id}',[UserManagementAPIController::class,'destroy'])->name('user-delete');
    
            /****** Roles Setting role:Role */
            Route::post('/create-role',[RolesAndPermissionAPIController::class,'permissionAdd'])->name('role-save');
            Route::get('/list-role',[RolesAndPermissionAPIController::class,'index'])->name('role-list');
            Route::get('/edit-role/{id}',[RolesAndPermissionAPIController::class,'edit'])->name('role-edit');
            Route::post('/update-role',[RolesAndPermissionAPIController::class,'permissionAdd'])->name('role-update');
            Route::delete('/delete-role/{id}',[RolesAndPermissionAPIController::class,'destroy'])->name('role-delete');
            
            /****** Permission Setting per:Permission */
            Route::post('/create-per',[HomePageBannerAPIController::class,'store'])->name('permission-save');
            Route::get('/list-per',[HomePageBannerAPIController::class,'index'])->name('permission-list');
            Route::get('/edit-per/{id}',[HomePageBannerAPIController::class,'edit'])->name('permission-edit');
            Route::post('/update-per/{id}',[HomePageBannerAPIController::class,'update'])->name('permission-update');
            Route::delete('/delete-per/{id}',[HomePageBannerAPIController::class,'destroy'])->name('permission-delete');
    
            /****** Website Menu Setting mm:main menu */
            Route::post('/create-mm',[WebsiteMenuManagementAPIController::class,'store'])->name('menu-save')->middleware('throttle:custom_Limit');
            Route::get('/list-mm',[WebsiteMenuManagementAPIController::class,'index'])->name('menu-list');
            Route::get('/edit-mm/{id}',[WebsiteMenuManagementAPIController::class,'edit'])->name('menu-edit');
            Route::post('/update-mm',[WebsiteMenuManagementAPIController::class,'update'])->name('menu-update');
            Route::delete('/delete-mm/{id}',[WebsiteMenuManagementAPIController::class,'destroy'])->name('menu-delete');
    
            /****** Website Core Setting cws:core website setting */
            Route::post('/create-cws',[WebsiteCoreSettingsAPIController::class,'store'])->name('headerLogo-save')->middleware('throttle:custom_Limit');
            Route::get('/list-logo',[WebsiteCoreSettingsAPIController::class,'indexLogo'])->name('logo-list');
            Route::get('/list-footercontent',[WebsiteCoreSettingsAPIController::class,'indexFooterContent'])->name('footercontent-list');
            Route::get('/list-sociallink',[WebsiteCoreSettingsAPIController::class,'indexSocialLink'])->name('sociallink-list');
            Route::get('/edit-cws/{id}',[WebsiteCoreSettingsAPIController::class,'edit'])->name('cws-edit');
            Route::post('/update-headerLogo',[WebsiteCoreSettingsAPIController::class,'headerLogoUpdate'])->name('headerLogo-update');
            Route::delete('/delete-cws/{id}',[WebsiteCoreSettingsAPIController::class,'destroy'])->name('cws-delete');
    
            /****** Footer Content Setting footer:Footer */
            Route::post('/create-footer',[FooterManagementAPIController::class,'store'])->name('footer-save')->middleware('throttle:custom_Limit');
            Route::get('/list-footer',[FooterManagementAPIController::class,'index'])->name('footer-list');
            Route::get('/edit-footer/{id}',[FooterManagementAPIController::class,'edit'])->name('footer-edit');
            Route::post('/update-footer',[FooterManagementAPIController::class,'update'])->name('footer-update');
            Route::delete('/delete-footer/{id}',[FooterManagementAPIController::class,'destroy'])->name('footer-delete');
    
            /****** Website Social Link Setting sl:social Link */
            Route::post('/create-sl',[SocialLinksAPIController::class,'store'])->name('socialLink-save')->middleware('throttle:custom_Limit');
            Route::get('/list-sl',[SocialLinksAPIController::class,'index']);
            Route::get('/edit-sl/{id}',[SocialLinksAPIController::class,'edit']);
            Route::post('/update-sl',[SocialLinksAPIController::class,'update'])->name('socialLink-update');;
            Route::delete('/delete-sl/{id}',[SocialLinksAPIController::class,'destroy']);
    
            /****** Module Setting mo:Module*/
            Route::post('/create-mo',[ModuleManagementAPIController::class,'store'])->name('module-save')->middleware('throttle:custom_Limit');
            Route::get('/list-mo',[ModuleManagementAPIController::class,'index'])->name('module-list');
            Route::get('/edit-mo/{id}',[ModuleManagementAPIController::class,'edit'])->name('module-edit');
            Route::post('/update-mo',[ModuleManagementAPIController::class,'update'])->name('module-update');
            Route::delete('/delete-mo/{id}',[ModuleManagementAPIController::class,'destroy'])->name('module-delete');
    
            /****** Tender Setting ten:tender */
            Route::post('/create-ten',[TenderManagementAPIController::class,'store'])->name('tender-save')->middleware('throttle:custom_Limit');
            Route::get('/list-ten',[TenderManagementAPIController::class,'index'])->name('tender-list');
            Route::get('/edit-ten/{id}',[TenderManagementAPIController::class,'edit'])->name('tender-edit');
            Route::post('/update-ten',[TenderManagementAPIController::class,'update'])->name('tender-update');
            Route::delete('/delete-ten/{id}',[TenderManagementAPIController::class,'destroy'])->name('tender-delete');
            Route::post('/delete-pdf',[TenderManagementAPIController::class,'deletePDFIMG'])->name('pdf-delete');
    
    
            /****** Content Page Setting cpi: content page information */
            Route::post('/create-cpi',[DynamicContentPageManagamentAPIController::class,'basicInformation'])->name('pagemetatag-save')->middleware('throttle:custom_Limit');
            Route::post('/create-cpi-content',[DynamicContentPageManagamentAPIController::class,'pageContent'])->name('pagecontent-save')->middleware('throttle:custom_Limit');
            Route::post('/create-cpi-gallery',[DynamicContentPageManagamentAPIController::class,'pageGallery'])->name('pagegallery-save')->middleware('throttle:custom_Limit');
            Route::post('/create-cpi-pdf',[DynamicContentPageManagamentAPIController::class,'pagePdf'])->name('pagepdf-save')->middleware('throttle:custom_Limit');
            Route::get('/list-cpi',[DynamicContentPageManagamentAPIController::class,'index'])->name('pagemetatag-list');
            Route::get('/edit-cpi/{id}',[DynamicContentPageManagamentAPIController::class,'edit'])->name('pagemetatag-edit');
            Route::post('/update-cpi',[DynamicContentPageManagamentAPIController::class,'updateBasicInformation'])->name('cpi-update');
            Route::post('/update-cpi-content',[DynamicContentPageManagamentAPIController::class,'updatePageContent'])->name('cpi-content-update');
            Route::post('/update-cpi-gallery',[DynamicContentPageManagamentAPIController::class,'updatePageGallery'])->name('cpi-gallery-update');
            Route::post('/update-cpi-pdf',[DynamicContentPageManagamentAPIController::class,'updatePagePdf'])->name('cpi-pdf-update');
            Route::delete('/delete-cpi/{id}',[DynamicContentPageManagamentAPIController::class,'destroy'])->name('pagemetatag-delete');
            Route::post('/delete-pdfimg',[DynamicContentPageManagamentAPIController::class,'deletePDFIMG'])->name('pdfimg-delete');
    
            /****** Event Setting eve:Event */
            Route::post('/create-eve',[EventsManagementAPIController::class,'store'])->name('event-save')->middleware('throttle:custom_Limit');
            Route::get('/list-eve',[EventsManagementAPIController::class,'index'])->name('event-list');
            Route::get('/edit-eve/{id}',[EventsManagementAPIController::class,'edit'])->name('event-edit');
            Route::post('/update-eve',[EventsManagementAPIController::class,'update'])->name('event-update');
            Route::delete('/delete-eve/{id}',[EventsManagementAPIController::class,'destroy'])->name('event-delete');
            Route::post('/delete-pdf',[EventsManagementAPIController::class,'deletePDFIMG'])->name('pdf-delete');
    
            /****** News Setting nw:News */
            Route::post('/create-nw',[NewsManagementAPIController::class,'store'])->name('news-save')->middleware('throttle:custom_Limit');
            Route::get('/list-nw',[NewsManagementAPIController::class,'index'])->name('news-list');
            Route::get('/edit-nw/{id}',[NewsManagementAPIController::class,'edit'])->name('news-edit');
            Route::post('/update-nw',[NewsManagementAPIController::class,'update'])->name('news-update');
            Route::delete('/delete-nw/{id}',[NewsManagementAPIController::class,'destroy'])->name('news-delete');
            Route::post('/delete-pdf',[NewsManagementAPIController::class,'deletePDFIMG'])->name('pdf-delete');
    
            /****** Gallery Setting pgl:photo Gallery vgl:video gallery*/
            Route::post('/create-pgl',[GalleryManagementAPIController::class,'storePhoto'])->name('photo-save')->middleware('throttle:custom_Limit');
            Route::post('/create-vgl',[GalleryManagementAPIController::class,'storeVideo'])->name('video-save')->middleware('throttle:custom_Limit');
            Route::get('/list-gl',[GalleryManagementAPIController::class,'index'])->name('photovideo-list');
            Route::get('/edit-gl/{id}',[GalleryManagementAPIController::class,'edit']);
            Route::post('/update-gl/{id}',[GalleryManagementAPIController::class,'update']);
            Route::delete('/delete-gl/{id}',[GalleryManagementAPIController::class,'destroy']);
    
            /****** Banner Setting bn:Banner*/
            Route::post('/create-bn',[HomePageBannerAPIController::class,'store'])->name('banner-save')->middleware('throttle:custom_Limit');
            Route::get('/list-bn',[HomePageBannerAPIController::class,'index'])->name('banner-list');
            Route::get('/edit-bn/{id}',[HomePageBannerAPIController::class,'edit'])->name('banner-edit');
            Route::post('/update-bn',[HomePageBannerAPIController::class,'update'])->name('banner-update');
            Route::delete('/delete-bn/{id}',[HomePageBannerAPIController::class,'destroy'])->name('banner-delete');
    
            /****** Audit Trail Setting aut:Audit Trail*/
            Route::post('/create-aut',[SystemLogsAPIController::class,'store'])->name('aut-save')->middleware('throttle:custom_Limit');
            Route::get('/list-aut',[SystemLogsAPIController::class,'index'])->name('aut-list');
            Route::get('/edit-aut/{id}',[SystemLogsAPIController::class,'edit'])->name('aut-edit');
            Route::post('/update-aut/{id}',[SystemLogsAPIController::class,'update'])->name('aut-update');
            Route::delete('/delete-aut/{id}',[SystemLogsAPIController::class,'destroy'])->name('aut-delete');
    
            /****** FAQ Setting faq:FAQ*/
            Route::post('/create-faq',[DynamicPagesAPIController::class,'faqStore'])->name('faq-save')->middleware('throttle:custom_Limit');
            Route::get('/list-faq',[DynamicPagesAPIController::class,'faqIndex'])->name('faq-list');
            Route::get('/edit-faq/{id}',[DynamicPagesAPIController::class,'edit'])->name('faq-edit');
            Route::post('/update-faq',[DynamicPagesAPIController::class,'faqUpdate'])->name('faq-update');
            Route::delete('/delete-faq/{id}',[DynamicPagesAPIController::class,'faqDestroy'])->name('faq-delete');
    
            /****** Data Management Setting dm:FAQ*/
            //Route::post('/create-faq',[DynamicPagesAPIController::class,'faqStore'])->name('faq-save');
            Route::get('/list-dmfeed',[DataManagementAPIController::class,'feedBackIndex'])->name('dm-list-feedback');
            Route::get('/list-dmcontact',[DataManagementAPIController::class,'contactUSIndex'])->name('dm-list-contactus');
           // Route::get('/edit-faq/{id}',[DynamicPagesAPIController::class,'edit'])->name('faq-edit');
            //Route::post('/update-faq/{id}',[DynamicPagesAPIController::class,'update'])->name('faq-update');
          //  Route::delete('/delete-faq/{id}',[DynamicPagesAPIController::class,'destroy'])->name('faq-delete');
    
            /****** Recent Activity Setting rc:Recent Activity*/
            Route::post('/create-rc',[RecentActivityAPIController::class,'store'])->name('recentactivity-save')->middleware('throttle:custom_Limit');
            Route::get('/list-rc',[RecentActivityAPIController::class,'index'])->name('recentactivity-list');
            Route::get('/edit-rc/{id}',[RecentActivityAPIController::class,'edit'])->name('recentactivity-edit');
            Route::post('/update-rc',[RecentActivityAPIController::class,'update'])->name('recentactivity-update');
            Route::delete('/delete-rc/{id}',[RecentActivityAPIController::class,'destroy'])->name('recentactivity-delete');
    
           /****** Popup Advertising Setting pa:Popup Advertising*/
           Route::post('/create-pa',[PopupAdvertisingAPIController::class,'store'])->name('popupadvertising-save')->middleware('throttle:custom_Limit');
           Route::get('/list-pa',[PopupAdvertisingAPIController::class,'index'])->name('popupadvertising-list');
           Route::get('/edit-pa/{id}',[PopupAdvertisingAPIController::class,'edit'])->name('popupadvertising-edit');
           Route::post('/update-pa',[PopupAdvertisingAPIController::class,'update'])->name('popupadvertising-update');
           Route::delete('/delete-pa/{id}',[PopupAdvertisingAPIController::class,'destroy'])->name('popupadvertising-delete');
    
            /****** Employee Directory Setting ed:Employee Directory*/
            Route::post('/create-ed',[EmployeeDirectoryAPIController::class,'store'])->name('employeedirectory-save')->middleware('throttle:custom_Limit');
            Route::get('/list-ed',[EmployeeDirectoryAPIController::class,'index'])->name('employeedirectory-list');
            Route::get('/edit-ed/{id}',[EmployeeDirectoryAPIController::class,'edit'])->name('employeedirectory-edit');
            Route::post('/update-ed',[EmployeeDirectoryAPIController::class,'update'])->name('employeedirectory-update');
            Route::delete('/delete-ed/{id}',[EmployeeDirectoryAPIController::class,'destroy'])->name('employeedirectory-delete');
    
            /****** Employee Department/Designation Setting edd:Employee Department/Designation*/
            Route::post('/create-edd',[EmpDepartDesignationAPIController::class,'store'])->name('departmentdesignation-save')->middleware('throttle:custom_Limit');
            Route::get('/list-edd',[EmpDepartDesignationAPIController::class,'index'])->name('departmentdesignation-list');
            Route::get('/edit-edd/{id}',[EmpDepartDesignationAPIController::class,'edit'])->name('departmentdesignation-edit');
            Route::post('/update-edd',[EmpDepartDesignationAPIController::class,'update'])->name('departmentdesignation-update');
            Route::delete('/delete-edd/{id}',[EmpDepartDesignationAPIController::class,'destroy'])->name('departmentdesignation-delete');
            
            /****** Career Setting career:Career*/
            Route::post('/create-career',[CareerManagementAPIController::class,'store'])->name('career-save')->middleware('throttle:custom_Limit');
            Route::get('/list-career',[CareerManagementAPIController::class,'index'])->name('career-list');
            Route::get('/edit-career/{id}',[CareerManagementAPIController::class,'edit'])->name('career-edit');
            Route::post('/update-career',[CareerManagementAPIController::class,'update'])->name('career-update');
            Route::delete('/delete-career/{id}',[CareerManagementAPIController::class,'destroy'])->name('career-delete');
    
            /****** RTI Assets Setting rtia:RTI Assets*/
            Route::post('/create-rtia',[RtiAssetsAPIController::class,'store'])->name('rtiassets-save')->middleware('throttle:custom_Limit');
            Route::get('/list-rtia',[RtiAssetsAPIController::class,'index'])->name('rtiassets-list');
            Route::get('/edit-rtia/{id}',[RtiAssetsAPIController::class,'edit'])->name('rtiassets-edit');
            Route::post('/update-rtia',[RtiAssetsAPIController::class,'update'])->name('rtiassets-update');
            Route::delete('/delete-rtia/{id}',[RtiAssetsAPIController::class,'destroy'])->name('rtiassets-delete');
    
    
        });
    });