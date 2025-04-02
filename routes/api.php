<?php

use Illuminate\Http\Request;
use App\Http\Middleware\clientToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CMEController;
use App\Http\Controllers\API\SeoController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\FAQsController;
use App\Http\Controllers\API\JobsController;
use App\Http\Controllers\API\QueryController;
use App\Http\Controllers\API\StateController;
use App\Http\Controllers\API\TestsController;
use App\Http\Controllers\API\CentreController;
use App\Http\Controllers\API\CommonController;
use App\Http\Controllers\API\CouponController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\EventsController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\FacilityController;
use App\Http\Controllers\API\PackagesController;
use App\Http\Controllers\API\SettingsController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\PGOptionsController;
use App\Http\Controllers\API\SpecilityController;
use App\Http\Controllers\API\AttachmentController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\LeadCaptureController;
use App\Http\Controllers\API\TestimonialController;
use App\Http\Controllers\API\PressReleaseController;
use App\Http\Controllers\API\NewsLetterSubscriptionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([ 'namespace' => 'API'], function () {
    // Route::any('/api-get-token', [DashboardController::class,"generateBasicToken"]);
    });
Route::group(['prefix' => '', 'namespace' => 'API', 'middleware' => 'basicToken'], function () {
   

    Route::any('/jobs', [JobsController::class,"list"]);
    Route::any('/job/{slug}', [JobsController::class,"details"]);
    Route::any('/job/details/{id}', [JobsController::class,"detailsById"]);

    

    /**
     * Sent OTP
     */

    // Route::any('/send-otp', [AuthController::class,"sentOtp"]);
    // Route::any('/verify-otp', [AuthController::class,"verifyOtp"]);

    /**
     * Booking Create
     */

  

    // Route::any('/apply-job', [JobsController::class,"applyJob"]);
 

    /***
     * CRM Lead Tracker
     */


});
 