<?php 

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\RoomBookingController;
use App\Http\Controllers\SpaBookingController;
use App\Http\Controllers\ActivityBookingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FerryIDController;

// ADMIN controllers
use App\Http\Controllers\Admin\StaffManagementController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminActivityController;
use App\Http\Controllers\Admin\AdminSpaController;

// Models
use App\Models\Room;
use App\Models\Activity;
use App\Models\Spa;
use App\Models\RoomBooking;
use App\Models\SpaBooking;
use App\Models\ActivityBooking;


/*
|--------------------------------------------------------------------------
| LANDING PAGE (HOME)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home', [
        'rooms'      => Room::all(),
        'activities' => Activity::all(),
        'spaItems'   => Spa::all(),
    ]);
})->name('landing');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomLoginController::class, 'login'])->name('custom.login');
Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.admin-dashboard');
        })->name('dashboard');

        Route::resource('staff', StaffManagementController::class);

        Route::resource('rooms', AdminRoomController::class)->only([
            'index', 'create', 'store', 'destroy'
        ]);

        Route::resource('activities', AdminActivityController::class)->only([
            'index', 'create', 'store', 'destroy'
        ]);

        Route::resource('spa', AdminSpaController::class)->only([
            'index', 'create', 'store', 'destroy'
        ]);

        /*
        |------------------------------------------------------------------
        | FERRY ID MANAGEMENT — ADMIN
        |------------------------------------------------------------------
        */
        Route::get('/ferry-ids', [FerryIDController::class, 'index'])
            ->name('ferry.index');

        Route::post('/ferry-ids/generate', [FerryIDController::class, 'generate'])
            ->name('ferry.generate');
    });


/*
|--------------------------------------------------------------------------
| CUSTOMER AREA
|--------------------------------------------------------------------------
| Ferry ID is VALIDATED AT REGISTRATION
| No middleware blocking here
*/
Route::middleware(['auth', 'customer'])->group(function () {

    Route::get('/customer/dashboard', function () {
        return view('dashboards.customer', [
            'rooms'             => Room::all(),
            'activities'        => Activity::all(),
            'spaItems'          => Spa::all(),
            'roomBookings'      => RoomBooking::where('user_id', Auth::id())->latest()->get(),
            'spaBookings'       => SpaBooking::where('user_id', Auth::id())->latest()->get(),
            'activityBookings'  => ActivityBooking::where('user_id', Auth::id())->latest()->get(),
        ]);
    })->name('customer.dashboard');

    // ROOM
    Route::get('/book/room/{roomName}', [RoomBookingController::class, 'showForm'])
        ->name('room.book.form');

    Route::post('/book/room/{roomName}/confirm', [RoomBookingController::class, 'confirm'])
        ->name('room.book.confirm');

    Route::post('/book/room/{roomName}/store', [RoomBookingController::class, 'store'])
        ->name('room.book.store');

    // SPA
    Route::get('/book/spa/{treatmentName}', [SpaBookingController::class, 'showForm'])
        ->name('spa.book.form');

    Route::post('/book/spa/{treatmentName}/confirm', [SpaBookingController::class, 'confirm'])
        ->name('spa.book.confirm');

    Route::post('/book/spa/{treatmentName}/store', [SpaBookingController::class, 'store'])
        ->name('spa.book.store');

    // ACTIVITY
    Route::get('/book/activity/{activityName}', [ActivityBookingController::class, 'showForm'])
        ->name('activity.book.form');

    Route::post('/book/activity/{activityName}/confirm', [ActivityBookingController::class, 'confirm'])
        ->name('activity.book.confirm');

    Route::post('/book/activity/{activityName}/store', [ActivityBookingController::class, 'store'])
        ->name('activity.book.store');

    // CANCEL
    Route::post('/customer/bookings/room/{id}/cancel', [RoomBookingController::class, 'cancel'])
        ->name('customer.booking.room.cancel');

    Route::post('/customer/bookings/spa/{id}/cancel', [SpaBookingController::class, 'cancel'])
        ->name('customer.booking.spa.cancel');

    Route::post('/customer/bookings/activity/{id}/cancel', [ActivityBookingController::class, 'cancel'])
        ->name('customer.booking.activity.cancel');
});


/*
|--------------------------------------------------------------------------
| STAFF AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'staff'])->group(function () {

    // DASHBOARD
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])
        ->name('staff.dashboard');

    /*
    |------------------------------------------------------------------
    | FERRY ID MANAGEMENT — STAFF
    |------------------------------------------------------------------
    */
    Route::get('/ferry-ids', [FerryIDController::class, 'index'])
        ->name('staff.ferry.index');

    Route::post('/ferry-ids/generate', [FerryIDController::class, 'generate'])
        ->name('staff.ferry.generate');

    // CUSTOMER LIST
    Route::get('/staff/customers', [StaffController::class, 'customers'])
        ->name('staff.customers');

    // SELECT BOOKING TYPE
    Route::get('/staff/customers/{customerId}/select-booking', 
        [StaffController::class, 'selectBookingType']
    )->name('staff.booking.select');

    /*
    |------------------------------------------------------------------
    | STAFF — SELECT ROOM / SPA / ACTIVITY
    |------------------------------------------------------------------
    */
    Route::get('/staff/customers/{customerId}/select-room',
        [StaffController::class, 'selectRoom']
    )->name('staff.select.room');

    Route::get('/staff/customers/{customerId}/select-spa',
        [StaffController::class, 'selectSpa']
    )->name('staff.select.spa');

    Route::get('/staff/customers/{customerId}/select-activity',
        [StaffController::class, 'selectActivity']
    )->name('staff.select.activity');

    /*
    |------------------------------------------------------------------
    | ROOM — STAFF
    |------------------------------------------------------------------
    */
    Route::get('/staff/customers/{customerId}/book-room/{roomName}', 
        [StaffController::class, 'roomForm']
    )->name('staff.room.form');

    Route::post('/staff/customers/{customerId}/book-room/{roomName}/store', 
        [StaffController::class, 'roomStore']
    )->name('staff.room.store');

    /*
    |------------------------------------------------------------------
    | SPA — STAFF
    |------------------------------------------------------------------
    */
    Route::get('/staff/customers/{customerId}/book-spa/{treatmentName}', 
        [StaffController::class, 'spaForm']
    )->name('staff.spa.form');

    Route::post('/staff/customers/{customerId}/book-spa/{treatmentName}/store', 
        [StaffController::class, 'spaStore']
    )->name('staff.spa.store');

    /*
    |------------------------------------------------------------------
    | ACTIVITY — STAFF
    |------------------------------------------------------------------
    */
    Route::get('/staff/customers/{customerId}/book-activity/{activityName}', 
        [StaffController::class, 'activityForm']
    )->name('staff.activity.form');

    Route::post('/staff/customers/{customerId}/book-activity/{activityName}/store', 
        [StaffController::class, 'activityStore']
    )->name('staff.activity.store');

    /*
    |------------------------------------------------------------------
    | CANCEL ANY BOOKING (STAFF)
    |------------------------------------------------------------------
    */
    Route::post('/staff/bookings/{type}/{id}/cancel', 
        [StaffController::class, 'cancel']
    )->name('staff.booking.cancel');
});
