<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\TicketController;

use App\Http\Controllers\admin\ScheduleController;

use App\Http\Controllers\admin\AttendanceController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\WorkFromHomeController;
use App\Http\Controllers\admin\SubDepartmentController;
use App\Http\Controllers\admin\LogoRequirementController;
use App\Http\Controllers\admin\WebsiteRequirementController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Clears route and config caches and optimizes the app to ensure the latest changes are applied.
Route::get('run_all', function () {
    Artisan::call('route:clear');
    Artisan::call('optimize');
    Artisan::call('config:clear');
    return 'run all success';
});

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Auth::routes();




Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

Route::get('/logoRecruitment/create', function () {
    return view('admin.forms.logo_form');
});
// changes
Route::get('/website_requirements/create', function () {
    return view('admin.forms.web_form');
})->name('website_requirements.create');




// changes end
Route::middleware(['auth'])->middleware('officeWifi')->group(function () {


    Route::get('/logoRecruitment', [LogoRequirementController::class, 'index'])->name('logoRecruitment.index');
    Route::get('/website_requirements', [WebsiteRequirementController::class, 'index'])->name('website_requirements.index');
    Route::get('website_requirements/{id}/edit', [WebsiteRequirementController::class, 'edit'])->name('website_requirements.edit');
    Route::get('logoRecruitment/{id}/edit', [LogoRequirementController::class, 'edit'])->name('logoRecruitment.edit');

    Route::post('/submit-logo-requirement', [LogoRequirementController::class, 'store'])->name('logoRecruitment');
    Route::post('/submit-website-requirement', [WebsiteRequirementController::class, 'store'])->name('websiteRecruitment');
    Route::post('/submit-website-requirement', [WebsiteRequirementController::class, 'store'])->name('websiteRecruitment');



    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/checkin', [AttendanceController::class, 'checkin'])->name('attendance.checkin');
    Route::post('/attendance/checkout', [AttendanceController::class, 'checkout'])->name('attendance.checkout');
    Route::get('/get-sub-departments/{department}', [DepartmentController::class, 'getSubDepartments']);
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/client/fetch', [TicketController::class, 'fetchClient'])->name('client.fetch');
    Route::get('/attachments/download/{id}', [TicketController::class, 'download'])->name('attachments.download');
    Route::get('/attachments/download/{id}', [TicketController::class,'comment_download'])->name('attachments.comment.download');
    Route::get('tickets/{ticketId}/attachments/download-all', [TicketController::class, 'downloadAll'])->name('attachments.downloadAll');
    Route::resources([
        'departments' => DepartmentController::class,
        'subDepartments' => SubDepartmentController::class,
        'roles' => RoleController::class,
        'users' => UserController::class,
        'work_from_home' => WorkFromHomeController::class,
        'schedules' => ScheduleController::class,
        'tickets' => TicketController::class
    ]);
});
