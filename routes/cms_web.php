<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CMSControllers\DashboardController;
use App\Http\Controllers\CMSControllers\DeveloperTeamController;
use App\Http\Controllers\CMSControllers\UserManagementController;
use App\Http\Controllers\CMSControllers\RolesAndPermissionController;
use App\Http\Controllers\CMSControllers\WebsiteCoreSettingsController;
use App\Http\Controllers\CMSControllers\HomePageBannerManagementController;
use App\Http\Controllers\CMSControllers\DynamicContentPageManagamentController;
use App\Http\Controllers\CMSControllers\FooterManagementController;
use App\Http\Controllers\CMSControllers\SocialLinkController;
use App\Http\Controllers\CMSControllers\WebsiteMenuManagementController;
use App\Http\Controllers\CMSControllers\DynamicFormManagementController;
use App\Http\Controllers\CMSControllers\GalleryManagementController;
use App\Http\Controllers\CMSControllers\NewsManagementController;
use App\Http\Controllers\CMSControllers\TenderManagementController;
use App\Http\Controllers\CMSControllers\EventsManagementController;
use App\Http\Controllers\CMSControllers\ModuleManagementController;
use App\Http\Controllers\CMSControllers\SystemLogsController;
use App\Http\Controllers\CMSControllers\DataManagementController;
use App\Http\Controllers\CMSControllers\CareerManagementController;
use App\Http\Controllers\CMSControllers\EmpDepartDesignationController;
use App\Http\Controllers\CMSControllers\EmployeeDirectoryController;
use App\Http\Controllers\CMSControllers\PopupAdvertisingController;
use App\Http\Controllers\CMSControllers\RecentActivityController;
use App\Http\Controllers\CMSControllers\RtiAssetsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware(['auth','prevent-back-history','EnsureTokenIsValid'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dev-team', [DeveloperTeamController::class, 'index'])->name('dev-team');
    
    Route::prefix('user')->group(function(){
        Route::get('/user-create', [UserManagementController::class, 'create'])->name('user.create');
        Route::get('/user-list', [UserManagementController::class, 'index'])->name('user.list');
        Route::get('/user-edit', [UserManagementController::class, 'edit'])->name('user.edit');
    });
    
    Route::prefix('role')->group(function(){
        Route::get('/role-create', [RolesAndPermissionController::class, 'createRoles'])->name('role.create');
        Route::get('/role-edit', [RolesAndPermissionController::class, 'edit'])->name('role.edit');
        Route::get('/role-list', [RolesAndPermissionController::class, 'roleIndex'])->name('role.list');
    });
    
    Route::prefix('permission')->group(function(){
        Route::get('/permission-create', [RolesAndPermissionController::class, 'create'])->name('permission.create');
        Route::get('/permission-list', [RolesAndPermissionController::class, 'permissionIndex'])->name('permission.list');
    });
    
    Route::prefix('menu')->group(function(){
        Route::get('/menu-create', [WebsiteMenuManagementController::class, 'create'])->name('menu.create');
        Route::get('/menu-edit', [WebsiteMenuManagementController::class, 'edit'])->name('menu.edit');
        Route::get('/menu-list', [WebsiteMenuManagementController::class, 'index'])->name('menu.list');
    });
    
    Route::prefix('homebanner')->group(function(){
        Route::get('/homebanner-create', [HomePageBannerManagementController::class, 'create'])->name('homebanner.create');
        Route::get('/homebanner-edit', [HomePageBannerManagementController::class, 'edit'])->name('homebanner.edit');
        Route::get('/homebanner-list', [HomePageBannerManagementController::class, 'index'])->name('homebanner.list');
    });
    
    Route::prefix('contentpage')->group(function(){
        Route::get('/contentpage-create', [DynamicContentPageManagamentController::class, 'create'])->name('contentpage.create');
        Route::get('/contentpage-edit', [DynamicContentPageManagamentController::class, 'edit'])->name('contentpage.edit');
        Route::get('/contentpage-list', [DynamicContentPageManagamentController::class, 'index'])->name('contentpage.list');
    });
    
    Route::prefix('websitecoresetting')->group(function(){
        Route::get('/websitecoresetting-create', [WebSiteCoreSettingsController::class, 'create'])->name('websitecoresetting.create');
        Route::get('/websitecoresetting-edit', [WebSiteCoreSettingsController::class, 'edit'])->name('websitecoresetting.edit');
        Route::get('/logo-list', [WebSiteCoreSettingsController::class, 'indexLogo'])->name('logo.list');
        Route::get('/footercontent-list', [WebSiteCoreSettingsController::class, 'indexFooterContent'])->name('footercontent.list');
        Route::get('/sociallink-list', [WebSiteCoreSettingsController::class, 'indexSocialLink'])->name('sociallink.list');
    });
    
    Route::prefix('gallerymanagement')->group(function(){
        Route::get('/gallerymanagement-create', [GalleryManagementController::class, 'create'])->name('gallerymanagement.create');
        Route::get('/gallerymanagement-list', [GalleryManagementController::class, 'index'])->name('gallerymanagement.list');
    });
    
    Route::prefix('news')->group(function(){
        Route::get('/news-create', [NewsManagementController::class, 'create'])->name('news.create');
        Route::get('/news-edit', [NewsManagementController::class, 'edit'])->name('news.edit');
        Route::get('/news-list', [NewsManagementController::class, 'index'])->name('news.list');
    });
    
    Route::prefix('tender')->group(function(){
        Route::get('/tender-create', [TenderManagementController::class, 'create'])->name('tender.create');
        Route::get('/tender-edit', [TenderManagementController::class, 'edit'])->name('tender.edit');
        Route::get('/tender-list', [TenderManagementController::class, 'index'])->name('tender.list');
    });
    
    Route::prefix('event')->group(function(){
        Route::get('/event-create', [EventsManagementController::class, 'create'])->name('event.create');
        Route::get('/event-edit', [EventsManagementController::class, 'edit'])->name('event.edit');
        Route::get('/event-list', [EventsManagementController::class, 'index'])->name('event.list');
        });
    
    Route::prefix('module')->group(function(){
        Route::get('/module-create', [ModuleManagementController::class, 'create'])->name('module.create');
        Route::get('/module-list', [ModuleManagementController::class, 'index'])->name('module.list');
        Route::get('/module-edit', [ModuleManagementController::class, 'edit'])->name('module.edit');
        });
    
    Route::prefix('faq')->group(function(){
        Route::get('/faq-create', [DynamicFormManagementController::class, 'faqCreate'])->name('faq.create');
        Route::get('/faq-list', [DynamicFormManagementController::class, 'faqIndex'])->name('faq.list');
        Route::get('/faq-edit', [DynamicFormManagementController::class, 'faqEdit'])->name('faq.edit');
        });
    
    Route::prefix('audittrail')->group(function(){
        Route::get('/audittrail-create', [SystemLogsController::class, 'create'])->name('audittrail.create');
        Route::get('/audittrail-list', [SystemLogsController::class, 'index'])->name('audittrail.list');
        Route::get('/audittrail-edit', [SystemLogsController::class, 'edit'])->name('audittrail.edit');
        });
    
    Route::prefix('datamanagement')->group(function(){
        //Route::get('/audittrail-create', [SystemLogsController::class, 'create'])->name('audittrail.create');
        Route::get('/contactus-list', [DataManagementController::class, 'contactUSIndex'])->name('datamanagement.list-contact');
        Route::get('/feedback-list', [DataManagementController::class, 'FeedbackIndex'])->name('datamanagement.list-feedback');
        //Route::get('/audittrail-edit', [SystemLogsController::class, 'edit'])->name('audittrail.edit');
        });
    
    Route::prefix('recentactivity')->group(function(){
        Route::get('/recentactivity-create', [RecentActivityController::class, 'create'])->name('recentactivity.create');
        Route::get('/recentactivity-list', [RecentActivityController::class, 'index'])->name('recentactivity.list');
        Route::get('/recentactivity-edit', [RecentActivityController::class, 'edit'])->name('recentactivity.edit');
        });
    Route::prefix('popupadvertising')->group(function(){
        Route::get('/popupadvertising-create', [PopupAdvertisingController::class, 'create'])->name('popupadvertising.create');
        Route::get('/popupadvertising-list', [PopupAdvertisingController::class, 'index'])->name('popupadvertising.list');
        Route::get('/popupadvertising-edit', [PopupAdvertisingController::class, 'edit'])->name('popupadvertising.edit');
        });
    
    Route::prefix('employeedirectory')->group(function(){
        Route::get('/employeedirectory-create', [EmployeeDirectoryController::class, 'create'])->name('employeedirectory.create');
        Route::get('/employeedirectory-list', [EmployeeDirectoryController::class, 'index'])->name('employeedirectory.list');
        Route::get('/employeedirectory-edit', [EmployeeDirectoryController::class, 'edit'])->name('employeedirectory.edit');
        });
    
    Route::prefix('departmentdesignation')->group(function(){
        Route::get('/departmentdesignation-create', [EmpDepartDesignationController::class, 'create'])->name('departmentdesignation.create');
        Route::get('/departmentdesignation-list', [EmpDepartDesignationController::class, 'index'])->name('departmentdesignation.list');
        Route::get('/departmentdesignation-edit', [EmpDepartDesignationController::class, 'edit'])->name('departmentdesignation.edit');
        });
    
    Route::prefix('careers')->group(function(){
        Route::get('/careers-create', [EmpDepartDesignationController::class, 'create'])->name('careers.create');
        Route::get('/careers-list', [EmpDepartDesignationController::class, 'index'])->name('careers.list');
        Route::get('/careers-edit', [EmpDepartDesignationController::class, 'edit'])->name('careers.edit');
        });
    
    Route::prefix('rtiassets')->group(function(){
        Route::get('/rtiassets-create', [RtiAssetsController::class, 'create'])->name('rtiassets.create');
        Route::get('/rtiassets-list', [RtiAssetsController::class, 'index'])->name('rtiassets.list');
        Route::get('/rtiassets-edit', [RtiAssetsController::class, 'edit'])->name('rtiassets.edit');
        });
    });

require __DIR__ .'/api_route.php';
//include_once('api_route.php');


