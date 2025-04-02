<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommonController;

use App\Http\Controllers\Frontend\HomeController;

use App\Http\Controllers\Frontend\JobsController;

use App\Http\Controllers\Frontend\EmployerController as Employer;

use App\Http\Controllers\Frontend\CandidateController;

// use App\Http\Controllers\admin\CMEController;

use App\Http\Controllers\admin\FaqController;

use App\Http\Controllers\admin\JobController;

// use App\Http\Controllers\admin\SeoController;

use App\Http\Controllers\admin\CityController;

use App\Http\Controllers\admin\RoleController;

use App\Http\Controllers\admin\UserController;

use App\Http\Controllers\Auth\LoginController;

// use App\Http\Controllers\admin\EventController;

// use App\Http\Controllers\admin\OrderController;

use App\Http\Controllers\admin\QueryController;

// use App\Http\Controllers\admin\TestsController;

// use App\Http\Controllers\admin\CentreController;

use App\Http\Controllers\admin\CouponController;

// use App\Http\Controllers\admin\DoctorController;

// use App\Http\Controllers\admin\JdLeadController;

// use App\Http\Controllers\admin\EnquireController;

// use App\Http\Controllers\admin\PatientController;

use App\Http\Controllers\admin\PaymentController;

use App\Http\Controllers\admin\CategoryController;

use App\Http\Controllers\admin\CustomerController;

// use App\Http\Controllers\admin\FacilityController;

// use App\Http\Controllers\admin\PackagesController;

use App\Http\Controllers\admin\SettingsController;

use App\Http\Controllers\admin\DashboardController;

use App\Http\Controllers\admin\DepartmentController;

use App\Http\Controllers\admin\FaqCategoryController;

use App\Http\Controllers\admin\TestimonialController;

// use App\Http\Controllers\admin\PressReleaseController;

// use App\Http\Controllers\admin\SpecialitiesController;

use App\Http\Controllers\admin\JobApplicationController;

use App\Http\Controllers\admin\NewsLetterSubscriptionController;

use App\Http\Controllers\admin\SubCategoryController;

use App\Http\Controllers\admin\CompanyController;

use App\Http\Controllers\admin\PartnerController;

use App\Http\Controllers\admin\NotificationController;

use App\Http\Controllers\admin\ServiceController;

use App\Http\Controllers\admin\IndustryController;

use App\Http\Controllers\Company\CompanyDashboardController;

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





Route::group(['namespace' => 'Auth'], function () {

    

    // Common routes



    Route::get('common/location-name',[CommonController::class,'getCompanyLocationNameById']);

    Route::get('common/job-type-name',[CommonController::class,'getJobTypeNameById']);

    Route::get('common/job-category-name',[CommonController::class,'getJobCategoryNameById']);

    Route::get('common/job-experience-name',[CommonController::class,'getjobExperienceNameById']);

    Route::get('common/job-licensecertificate-name',[CommonController::class,'getLicenseCertificateNameById']);

    /**

     * Frontend Routes

     */

    Route::get('post-task',[HomeController::class, "postTask"])->name('home.postTask');

    Route::get('categories',[HomeController::class, "categories"])->name('home.categories');

    Route::get('companies',[HomeController::class, "companies"])->name('home.companies');

    Route::get('services',[HomeController::class, "services"])->name('home.services');

    Route::get('testimonials',[HomeController::class, "testimonials"])->name('home.testimonials');

    Route::get('aboutus',[HomeController::class, "aboutus"])->name('home.aboutus');

    Route::get('development',[HomeController::class, "development"])->name('home.development');

    Route::get('business',[HomeController::class, "business"])->name('home.business');

    Route::get('tech-it',[HomeController::class, "techIt"])->name('home.techIt');

    Route::get('finance',[HomeController::class, "finance"])->name('home.finance');

    Route::get('networking',[HomeController::class, "networking"])->name('home.networking');

    Route::get('blogs',[HomeController::class, "blogs"])->name('home.blogs');

    Route::get('blog/{slug}', [HomeController::class, "blogDetails"]);

    Route::get('/get-password',[HomeController::class, "getPassword"]);

    Route::get('/', [HomeController::class, "index"]);


    Route::get('/jobs', [HomeController::class, "jobs"])->name('home.jobs');

    // API for fetch all active jobs in front-end 
    Route::get('/jobsListApi', [HomeController::class, "jobsListApi"]);

    // API for fetch job detals by id jobs in front-end 
    Route::get('/jobDetailsApi/{slug}', [HomeController::class, "jobDetailsApi"]);
   
    Route::get('/job/{slug}', [HomeController::class, "jobsDetais"]);
    Route::get('/jobs/{category}/{jobid}', [JobsController::class, "details"]);

    

    // Route::get('/company/{companyurl}', [Employer::class, "details"]);

    Route::any('login',[HomeController::class, "login"]);
    Route::get('registration',[HomeController::class, "registration"]);

    Route::any('user/registration', [HomeController::class, "userRegistration"])->name('user.register');

    Route::any('company/registration', [HomeController::class, "comapnyRegistration"])->name('company.register');

    // Route::any('/signin', [HomeController::class, "signin"]);

    Route::post('auth/user/registration',[HomeController::class, "userRegistrationNew"])->name('auth.user.register');

    Route::post('auth/company/registration',[HomeController::class, "companyRegistrationNew"])->name('auth.company.registration');

    /**

     * Frontend Routes

     */

    Route::get('/company/login', [LoginController::class, "companyLogin"]);

    Route::post('/company/auth/login', [LoginController::class, "companyLogin"]);

    Route::get('/admin', [LoginController::class, "index"]);

    Route::any('/user/login', [LoginController::class, "userLogin"])->name('user.login');

    Route::get('/admin/login', [LoginController::class, "index"])->name('admin.login');

    Route::post('/admin/auth/login', [LoginController::class, "login"]);

    Route::get('/logout', [LoginController::class, "logout"]);

});



Route::get('/ajax/cities/{state_id}', [CommonController::class, "getAjaxCities"]);

Route::get('/ajax/subcategories', [CommonController::class, "getAjaxSubCategories"]);

Route::get('/ajax/specilities', [CommonController::class, "getAjaxSpecilities"]);

Route::get('/ajax/checkSeoSlug', [CommonController::class, "checkSeoSlug"]);



// Route::group([ 'namespace' => 'admin'], function () {

//     Route::any('/search-tests', [TestsController::class,"searchTestsFrontend"]);

//     Route::any('/ajax/fetchtests', [TestsController::class,"searchTestsAjax"]);

//     });



// Compnay Route



Route::middleware('company')->group(function () {

    Route::prefix('company')->group(function () {

        Route::get('dashboard', [CompanyDashboardController::class, "dashboard"]);

        Route::post('location-create', [CompanyDashboardController::class, "createCompanyLocation"])->name('company.location.create');

        Route::put('location-update/{id}', [CompanyDashboardController::class, "updateCompanyLocation"])->name('company.location.update');

        Route::get('location/delete/{id}', [CompanyDashboardController::class, "deleteLocation"]);

        Route::get('logout', [CompanyDashboardController::class, "logout"]);

        Route::any('change-password', [CompanyDashboardController::class, "changePassword"])->name('company.changePass');

        Route::get('profile', [CompanyDashboardController::class, "companyprofile"])->name('company.profile');

        Route::post('profile/update', [CompanyDashboardController::class, "companyprofileUpdate"])->name('company.profile.update');

        

        // Manage Shift

        Route::get('shift', [App\Http\Controllers\Company\ShiftController::class, 'index'])->name('company.shift.list');

        Route::get('shift/create', [App\Http\Controllers\Company\ShiftController::class, 'add'])->name('company.shift.create');

        Route::post('shift/create', [App\Http\Controllers\Company\ShiftController::class, 'add'])->name('company.staff.store');

        Route::any('shift/edit/{id}', [App\Http\Controllers\Company\ShiftController::class, 'edit']);

        Route::get('shift/update-status/{id}/{status}',[App\Http\Controllers\Company\ShiftController::class, 'updateStatus']);



        /**

         * Department

         */

        Route::get('company-departments',[App\Http\Controllers\Company\CompanydepartmentController::class, 'index'])->name('company.department.list');

        Route::post('company-department-store',[App\Http\Controllers\Company\CompanydepartmentController::class, 'add'])->name('company.companyDepartment.store');



        Route::get('department/update-status/{id}/{status}',[App\Http\Controllers\Company\CompanydepartmentController::class, 'updateStatus']);

        Route::any('department/delete/{id}', [App\Http\Controllers\Company\CompanydepartmentController::class, "delete"]);

        /**

         * ManageRole & User

         */

        Route::get('manage-role-and-user',[App\Http\Controllers\Company\ManageRoleUserController::class, 'index'])->name('company.manageroleanduser.list');

        Route::get('manage-role-and-user-add', [App\Http\Controllers\Company\ManageRoleUserController::class, 'add'])->name('company.manageroleanduser.add');

        Route::post('manage-role-and-user-store', [App\Http\Controllers\Company\ManageRoleUserController::class, 'add'])->name('company.manageroleanduser.store');

        Route::any('manage-role-and-user/edit/{id}',[App\Http\Controllers\Company\ManageRoleUserController::class, 'edit'])->name('company.manageroleanduser.edit');

        Route::any('manage-role-and-user/assign/{id}',[App\Http\Controllers\Company\ManageRoleUserController::class, 'assign'])->name('company.manageroleanduser.assign');

        /**

         * Designation

         */

        Route::get('designation', [App\Http\Controllers\Company\DesignationController::class, 'index'])->name('company.designation.list');

        Route::post('designation/create', [App\Http\Controllers\Company\DesignationController::class, 'add'])->name('company.designation.store');

        Route::any('designation/edit/{id}', [App\Http\Controllers\Company\DesignationController::class, 'edit']);

        Route::get('designation/update-status/{id}/{status}',[App\Http\Controllers\Company\DesignationController::class, 'updateStatus']);

        Route::any('designation/delete/{id}', [App\Http\Controllers\Company\DesignationController::class, "delete"]);

        /**

         * Designation Category

         */

        Route::get('designation-category', [App\Http\Controllers\Company\DesignationCategoryController::class, 'index'])->name('company.designation_cate.list');

        Route::post('designation-category/create', [App\Http\Controllers\Company\DesignationCategoryController::class, 'add'])->name('company.designation_cate.store');

        Route::any('designation-category/edit/{id}', [App\Http\Controllers\Company\DesignationCategoryController::class, 'edit']);

        Route::get('designation-category/update-status/{id}/{status}',[App\Http\Controllers\Company\DesignationCategoryController::class, 'updateStatus']);

        Route::any('designation-category/delete/{id}', [App\Http\Controllers\Company\DesignationCategoryController::class, "delete"]);

        /**

         * Jobs

         */

        Route::get('/jobs/list', [App\Http\Controllers\Company\JobController::class, "index"])->name('company.job.list');

        Route::any('/jobs/add', [App\Http\Controllers\Company\JobController::class, "add"]);

        Route::any('/jobs/edit/{id}', [App\Http\Controllers\Company\JobController::class, "edit"]);

        Route::put('/jobs/update/{id}', [App\Http\Controllers\Company\JobController::class, "update"])->name('company.job.update');

        Route::get('/jobs/export', [App\Http\Controllers\Company\JobController::class, "exportExcel"]);

        Route::any('/jobs/delete/{id}', [App\Http\Controllers\Company\JobController::class, "delete"]);

        Route::any('/jobs/update-status/{id}/{status}', [App\Http\Controllers\Company\JobController::class, "updateStatus"]);

        /**

         * Roaster

         */

        Route::get('/roster', [App\Http\Controllers\Company\RotasController::class, "index"])->name('company.roaster.index');

        Route::post('/rotas/shift/create', [App\Http\Controllers\Company\RotasController::class,'create'])->name('company.roster.shift.create');

        Route::delete('/rotas/destroy/{id}', [App\Http\Controllers\Company\RotasController::class,'destroyee'])->name('company.rotas.destroy');

        Route::any('/rotas/shift/update', [App\Http\Controllers\Company\RotasController::class,'update'])->name('company.roster.shift.update');

        Route::post('hidedayoff', [RotasController::class,'hidedayoff'])->name('hidedayoff');

        Route::post('hideleave', [RotasController::class,'hideleave'])->name('hideleave');

        Route::post('/rotas/clear_week', [RotasController::class,'clear_week'])->name('rotas.clear_week');

        Route::post('/rotas/add_dayoff', [RotasController::class,'add_dayoff'])->name('rotas.add_dayoff');

        Route::post('/rotas/send_email_rotas', [RotasController::class,'send_email_rotas'])->name('rotas.send_email_rotas');

        Route::post('copy_week_sheet', [RotasController::class,'copy_week_sheet'])->name('copy.week.sheet');

        Route::post('/rotas/publish_week', [RotasController::class,'publish_week'])->name('rotas.publish_week');

        Route::post('/rotas/un_publish_week', [RotasController::class,'un_publish_week'])->name('rotas.un_publish_week');

        Route::post('/rotas/shift_copy', [RotasController::class,'shift_copy'])->name('rotas.shift_copy');

    });

});



// User Route



Route::middleware('user')->group(function () {

    Route::prefix('user')->group(function () {

        Route::get('dashboard', [App\Http\Controllers\User\UserDashboardController::class, "index"]);

        Route::get('logout', [App\Http\Controllers\User\UserDashboardController::class, "logout"]);

        Route::any('change-password', [App\Http\Controllers\User\UserDashboardController::class, "changePassword"])->name('user.changePass');

        Route::get('profile', [App\Http\Controllers\User\UserDashboardController::class, "userprofile"])->name('user.profile');

        Route::post('profile/update', [App\Http\Controllers\User\UserDashboardController::class, "userprofileUpdate"])->name('user.profile.update');

    });

});



Route::get('build-a-resume', [CandidateController::class, "cvPreview"]);

Route::get('build-a-resume/cv/preview', [CandidateController::class, "cvPreview"]);

Route::get('build-a-resume/cv/download', [CandidateController::class, "download"]);

Route::group(['prefix' => 'account', 'namespace' => 'Frontend','middleware' => 'Candidatesession'], function () {

    Route::get('dashboard', [CandidateController::class, "dashboard"]);

    Route::get('appliedjobs', [CandidateController::class, "dashboard"]);

    Route::get('workexperience', [CandidateController::class, "workexperience"]);

    Route::get('skills', [CandidateController::class, "skills"]);

    Route::get('education', [CandidateController::class, "education"]);

    Route::get('certifications', [CandidateController::class, "certifications"]);

    Route::get('recognition', [CandidateController::class, "recognition"]);

    Route::get('settings', [CandidateController::class, "settings"]);

    Route::get('onboarding', [CandidateController::class, "onboarding"]);

    Route::get('cv/preview/{resumethemeid}', [CandidateController::class, "cvPreview"]);

    Route::get('cv/preview', [CandidateController::class, "cvPreview"]);

    Route::get('cv/download', [CandidateController::class, "download"]);

});



Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'Checksession'], function () {

    // Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {



    /**

     *  admin/dashboard

     */

    Route::get('dashboard', [DashboardController::class, "dashboard"]);

    Route::any('change-password',[DashboardController::class, "changePass"])->name('admin.changePass');

    /* * User Management

     */

    // Route::get('/', 'UserController@index');

    Route::get('/users/list', [UserController::class, "index"]);

    Route::any('/users/add-user', [UserController::class, "addUser"]);

    Route::any('/users/edit/{id}', [UserController::class, "editUser"]);

    Route::any('/users/delete/{id}', [UserController::class, "delete"]);

    Route::any('/users/update-status/{id}/{status}', [UserController::class, "updateStatus"]);

    /**

     * Comapny

     */

    Route::get('/company/list', [CompanyController::class, "index"]);

    Route::any('/company/add-user', [CompanyController::class, "addUser"]);

    Route::any('/company/edit/{id}', [CompanyController::class, "editUser"]);

    Route::any('/company/delete/{id}', [CompanyController::class, "delete"]);

    Route::any('/company/update-status/{id}/{status}', [CompanyController::class, "updateStatus"]);

    Route::any('/company/user-verify/{user_id}/{status}',[CompanyController::class, "companyUserVerify"]);

    /**

     * PartnerController

     */

    Route::get('/partner/list', [PartnerController::class, "index"]);

    Route::any('/partner/add-user', [PartnerController::class, "addUser"]);

    Route::any('/partner/edit/{id}', [PartnerController::class, "editUser"]);

    Route::any('/partner/delete/{id}', [PartnerController::class, "delete"]);

    Route::any('/partner/update-status/{id}/{status}', [PartnerController::class, "updateStatus"]);

     /**

     * Service Master

     */

    Route::get('/services/list', [ServiceController::class, "index"]);

    Route::any('/services/add', [ServiceController::class, "add"]);

    Route::any('/services/edit/{id}', [ServiceController::class, "edit"]);

    Route::any('/services/delete/{id}', [ServiceController::class, "delete"]);

    Route::any('/services/update-status/{id}/{status}', [ServiceController::class, "updateStatus"]);

    /**

     * Category Master

     */

    Route::get('/categories/list', [CategoryController::class, "index"]);

    Route::any('/categories/add', [CategoryController::class, "add"]);

    Route::get('/categories/export', [CategoryController::class, "exportExcel"]);

    Route::any('/categories/edit/{id}', [CategoryController::class, "edit"]);

    Route::any('/categories/delete/{id}', [CategoryController::class, "delete"]);

    Route::any('/categories/update-status/{id}/{status}', [CategoryController::class, "updateStatus"]);

    Route::get('/categories/addhomepage/{id}/{is_home_display}', [CategoryController::class, "addHomePage"]);



    /**

     * Sub Category Master

     */

    Route::get('/subcategories/list', [SubCategoryController::class, "index"]);

    Route::get('/subcategories/list/{category_id}', [SubCategoryController::class, "index"]);

    Route::any('/subcategories/add/', [SubCategoryController::class, "add"]);

    Route::get('/subcategories/export', [SubCategoryController::class, "exportExcel"]);

    Route::any('/subcategories/add/{id}', [SubCategoryController::class, "add"]);

    Route::any('/subcategories/edit/{id}/{category_id}', [SubCategoryController::class, "edit"]);

    Route::any('/subcategories/delete/{id}', [SubCategoryController::class, "delete"]);

    Route::any('/subcategories/update-status/{id}/{status}', [SubCategoryController::class, "updateStatus"]);





    /**

     *  Departments Master

     */

    Route::get('/departments/list', [DepartmentController::class, "index"]);

    Route::any('/departments/add', [DepartmentController::class, "add"]);

    Route::get('/departments/export', [DepartmentController::class, "exportExcel"]);

    Route::any('/departments/edit/{id}', [DepartmentController::class, "edit"]);

    Route::any('/departments/update-status/{id}/{status}', [DepartmentController::class, "updateStatus"]);

    Route::any('/departments/delete/{id}', [DepartmentController::class, "delete"]);

    Route::get('/departments/import', [DepartmentController::class, "showImportForm"]);

    Route::post('/departments/import/store',[DepartmentController::class, "import"])->name('admin.department.import');



    /**

     *  Industry Master

     */

    Route::get('/industries/list', [IndustryController::class, "index"]);

    Route::any('/industries/add', [IndustryController::class, "add"]);

    Route::get('/industries/export', [IndustryController::class, "exportExcel"]);

    Route::any('/industries/edit/{id}', [IndustryController::class, "edit"]);

    Route::any('/industries/update-status/{id}/{status}', [IndustryController::class, "updateStatus"]);

    Route::any('/industries/delete/{id}', [IndustryController::class, "delete"]);



    /**

     * Payment Master

     */

    Route::get('/payment/list', [PaymentController::class, "index"]);

    Route::any('/payment/add', [PaymentController::class, "add"]);

    Route::get('/payment/edit', [PaymentController::class, "edit"]);



    /**

     * Facility Master

     */

    // Route::get('/facility/list', [FacilityController::class,"index"]);

    // Route::any('/facility/add', [FacilityController::class,"add"]);

    // Route::any('/facility/delete/{id}', [FacilityController::class,"delete"]);

    // Route::any('/facility/edit/{id}', [FacilityController::class,"edit"]);

    // Route::any('/facility/update-status/{id}/{status}', [FacilityController::class,"updateStatus"]);







    /**

     * Package Master

     */

    // Route::get('/packages/list', [PackagesController::class,"index"]);

    // Route::any('/packages/add', [PackagesController::class,"add"]);

    // Route::any('/packages/edit/{id}', [PackagesController::class,"edit"]);

    // Route::get('/packages/export', [PackagesController::class,"exportExcel"]);

    // Route::any('/packages/update-status/{id}/{status}', [PackagesController::class,"updateStatus"]);

    // Route::any('/packages/delete/{id}', [PackagesController::class,"delete"]);







    /**

     * City Master

     */

    Route::get('/city/list', [CityController::class, "index"]);

    Route::any('/city/add', [CityController::class, "add"]);

    Route::get('/city/export', [CityController::class, "exportExcel"]);

    Route::any('/city/edit/{city_id}', [CityController::class, "edit"]);

    Route::any('/city/update-status/{city_id}/{status}', [CityController::class, "updateStatus"]);





    /**

     * newslettersubscription

     */

    Route::get('/newslettersubscription/list', [NewsLetterSubscriptionController::class, "index"]);

    // Route::any('/newslettersubscription/add', [NewsLetterSubscriptionController::class,"add"]);

    //  Route::any('/newslettersubscription/edit/{id}', [NewsLetterSubscriptionController::class,"edit"]);

    Route::get('/newslettersubscription/export', [NewsLetterSubscriptionController::class, "exportExcel"]);

    Route::any('/newslettersubscription/delete/{id}', [NewsLetterSubscriptionController::class, "delete"]);

    Route::any('/newslettersubscription/update-status/{city_id}/{status}', [NewsLetterSubscriptionController::class, "updateStatus"]);



    /**

     * faqs

     */

    Route::get('/faqs/list', [FaqController::class, "index"]);

    Route::any('/faqs/add', [FaqController::class, "add"]);

    Route::any('/faqs/edit/{id}', [FaqController::class, "edit"]);

    Route::get('/faqs/export', [FaqController::class, "exportExcel"]);

    Route::any('/faqs/delete/{id}', [FaqController::class, "delete"]);

    Route::any('/faqs/update-status/{city_id}/{status}', [FaqController::class, "updateStatus"]);



    /**

     * faqcategories

     */

    Route::get('/faqcategories/list', [FaqCategoryController::class, "index"]);

    Route::any('/faqcategories/add', [FaqCategoryController::class, "add"]);

    Route::any('/faqcategories/edit/{id}', [FaqCategoryController::class, "edit"]);

    Route::any('/faqcategories/delete/{id}', [FaqCategoryController::class, "delete"]);

    Route::any('/faqcategories/update-status/{city_id}/{status}', [FaqCategoryController::class, "updateStatus"]);



    /**

     * press release

     */

    // Route::get('/pressrelease/list', [PressReleaseController::class,"index"]);

    // Route::any('/pressrelease/add', [PressReleaseController::class,"add"]);

    // Route::any('/pressrelease/edit/{id}', [PressReleaseController::class,"edit"]);

    // Route::get('/pressrelease/export', [PressReleaseController::class,"exportExcel"]);

    // Route::any('/pressrelease/delete/{id}', [PressReleaseController::class,"delete"]);

    // Route::any('/pressrelease/delete-image/{id}/{image_name}', [PressReleaseController::class,"deleteImage"]);

    // Route::any('/pressrelease/update-status/{city_id}/{status}', [PressReleaseController::class,"updateStatus"]);



    /**

     * events

     */

    // Route::get('/events/list', [EventController::class,"index"]);

    // Route::any('/events/add', [EventController::class,"add"]);

    // Route::any('/events/edit/{id}', [EventController::class,"edit"]);

    // Route::get('/events/export', [EventController::class,"exportExcel"]);

    // Route::any('/events/delete/{id}', [EventController::class,"delete"]);

    // Route::any('/events/delete-video/{id}/{video_name}', [EventController::class,"deleteVideo"]);

    // Route::any('/events/delete-image/{id}/{image_name}', [EventController::class,"deleteImage"]);

    // Route::any('/events/update-status/{city_id}/{status}', [EventController::class,"updateStatus"]);



    /**

     * admin/cme/list

     */

    // Route::get('/cme/list', [CMEController::class,"index"]);

    // Route::any('/cme/add', [CMEController::class,"add"]);

    // Route::any('/cme/edit/{id}', [CMEController::class,"edit"]);

    // Route::get('/cme/export', [CMEController::class,"exportExcel"]);

    // Route::any('/cme/delete/{id}', [CMEController::class,"delete"]);

    // Route::any('/cme/delete-image/{id}/{image_name}', [CMEController::class,"deleteImage"]);

    // Route::any('/cme/update-status/{city_id}/{status}', [CMEController::class,"updateStatus"]);



    /**

     * Jobs

     */

    Route::get('/jobs/list', [JobController::class, "index"]);

    Route::any('/jobs/add', [JobController::class, "add"]);

    Route::any('/jobs/edit/{id}', [JobController::class, "edit"]);

    Route::get('/jobs/export', [JobController::class, "exportExcel"]);

    Route::any('/jobs/delete/{id}', [JobController::class, "delete"]);

    Route::any('/jobs/update-status/{id}/{status}', [JobController::class, "updateStatus"]);



    /**

     * Applications

     */

    Route::get('/job-applications/list', [JobApplicationController::class, "index"]);

    Route::any('/job-applications/update-status/{id}/{status}', [JobApplicationController::class, "updateStatus"]);

    Route::any('/job-applications/details/{id}', [JobApplicationController::class, "view"]);

    Route::get('/job-applications/export', [JobApplicationController::class, "exportExcel"]);

    // Route::get('/job-applications/edit/{id}', [JobApplicationController::class,"edit"]);





    /**

     * Queries

     */

    Route::get('/queries/list', [QueryController::class, "index"]);

    Route::get('/queries/export', [QueryController::class, "exportExcel"]);

    Route::any('/queries/update-status/{city_id}/{status}', [QueryController::class, "updateStatus"]);



    /**

     * enquires

     */

    //     Route::get('/enquires/list', [EnquireController::class,"index"]);

    //     Route::any('/enquires/update-status/{city_id}/{status}', [EnquireController::class,"updateStatus"]);

    //     Route::get('/enquires/export', [EnquireController::class,"exportExcel"]);

    //    // Route::get('/queries/add', [EnquireController::class,"add"]);

    //     Route::any('/enquires/edit/{id}', [EnquireController::class,"edit"]);



    /**

     * partner enquiry

     */

    // Route::get('/partnerenquiry/list', [PartnerEnquireController::class,"index"]);

    // Route::any('/partnerenquiry/update-status/{city_id}/{status}', [PartnerEnquireController::class,"updateStatus"]);

    // Route::get('/partnerenquiry/export', [PartnerEnquireController::class,"exportExcel"]);

    // Route::any('/partnerenquiry/edit/{id}', [PartnerEnquireController::class,"edit"]);



    /**

     * customers

     */

    Route::get('/customers/list', [CustomerController::class, "index"]);

    Route::get('/customers/export', [CustomerController::class, "exportExcel"]);

    Route::any('/customers/add', [CustomerController::class, "add"]);

    Route::any('/customers/edit/{id}', [CustomerController::class, "edit"]);

    Route::any('/customers/delete/{id}', [CustomerController::class, "delete"]);

    Route::any('/customers/update-status/{city_id}/{status}', [CustomerController::class, "updateStatus"]);

    Route::any('/customers/user-verify/{user_id}/{status}', [CustomerController::class, "customerIsVerified"]);





    /**

     * testimonials

     */

    Route::get('/testimonials/list', [TestimonialController::class, "index"]);

    Route::get('/testimonials/export', [TestimonialController::class, "exportExcel"]);

    Route::any('/testimonials/add', [TestimonialController::class, "add"]);

    Route::any('/testimonials/edit/{id}', [TestimonialController::class, "edit"]);

    Route::any('/testimonials/delete/{id}', [TestimonialController::class, "delete"]);

    Route::any('/testimonials/update-status/{city_id}/{status}', [TestimonialController::class, "updateStatus"]);





    /**

     * seo

     */

    // Route::get('/seo/list', [SeoController::class,"index"]);

    // Route::any('/seo/add', [SeoController::class,"add"]);

    // Route::any('/seo/edit/{id}', [SeoController::class,"edit"]);

    // Route::get('/seo/export', [SeoController::class,"exportExcel"]);

    // Route::any('/seo/delete/{id}', [SeoController::class,"delete"]);

    // Route::any('/eo/update-status/{city_id}/{status}', [SeoController::class,"updateStatus"]);





    /**

     * seo

     */

    Route::get('/offers/list', [CouponController::class, "index"]);

    Route::any('/offers/add', [CouponController::class, "add"]);

    Route::get('/offers/export', [CouponController::class, "exportExcel"]);

    Route::any('/offers/edit/{id}', [CouponController::class, "edit"]);

    Route::any('/offers/delete/{id}', [CouponController::class, "delete"]);

    Route::any('/offers/update-status/{city_id}/{status}', [CouponController::class, "updateStatus"]);



    /**

     * bookings / orders

     */

    // Route::get('/orders/list', [OrderController::class,"index"]);

    // Route::any('/orders/add', [OrderController::class,"add"]);

    // Route::any('/orders/edit/{id}', [OrderController::class,"edit"]);

    // Route::any('/orders/delete/{id}', [OrderController::class,"delete"]);

    // Route::get('/orders/export', [OrderController::class,"exportExcel"]);

    // Route::any('/orders/update-status/{city_id}/{status}', [OrderController::class,"updateStatus"]);

    // Route::any('/orders/edit/updateCustomer/{order_id}', [OrderController::class,"updateCustomer"]);

    // Route::any('/orders/edit/updatePatient/{order_id}', [OrderController::class,"updatePatient"]);

    // Route::any('/orders/edit/centreAllocation/{order_id}', [OrderController::class,"centreAllocation"]);



    /**

     * Roles

     */

    Route::get('/roles/list', [RoleController::class, "index"]);

    Route::any('/roles/permissions/{role_id}', [RoleController::class, "permissions"]);

    Route::any('/roles/edit/{role_id}', [RoleController::class, "edit"]);

    Route::any('/roles/add', [RoleController::class, "add"]);

    

    /**

     * Settings

     */

    Route::any('/settings', [SettingsController::class, "index"]);

});



Route::get('/get-states/{country_id}', [CommonController::class, 'getStates']);

Route::get('/get-cities/{state_id}', [CommonController::class, 'getCities']);

// });

