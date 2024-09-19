<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\userController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/consultation', function () {
    return view('services.consultation');
});

Route::get('/grooming', function () {
    return view('services.grooming');
});

Route::get('/vaccine', function () {
    return view('services.vaccine');
});

Route::get('/surgery', function () {
    return view('services.surgery');
});


Route::get('/home', function () {
    return view('home');
});

Route::get('/log', function () {
    return view('log');
});

Route::get('/form', function () {
    return view('form');
});

Route::get('/myapp', function () {
    return view('myappointment');
});

Route::get('/myprofile', function () {
    return view('profile');
});

Route::get('/payment', function () {
    return view('payment');
});


// Route::get('/receipt', function () {
//     return view('receipt');
// });

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [PetController::class, "index"]);
Route::get('/', [PetController::class, "index"]);
Route::get('/consultation', [PetController::class, "consultation"]);
Route::get('/grooming', [PetController::class, "grooming"]);
Route::get('/vaccine', [PetController::class, "vaccine"]);
Route::get('/surgery', [PetController::class, "surgery"]);
Route::post('/create1', [AppointmentController::class, "store"]);
Route::get('/myapp', [AppointmentController::class, "myapp"]);
Route::put('/profileedit/{id}', [userController::class, "update"]);
Route::get('/invoice/{id}', [AppointmentController::class, "invoice"]);
Route::get('/payment/{id}', [AppointmentController::class, "payment"]);
Route::post('/receipt/{id}', [PaymentController::class, "store"]);


// Route::middleware(['auth', 'role:customer'])->group(function () {
// });

Route::resource('user', userController::class);

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/adm', function () {
        return view('admin.admin');
    });

    Route::get('/adm-app', function () {
        return view('admin.appointment');
    });

    Route::get('/adm-pet', function () {
        return view('admin.pet');
    });

    Route::get('/adm-petedit', function () {
        return view('admin.petedit');
    });

    Route::get('/adm-petcreate', function () {
        return view('admin.petcreate');
    });

    Route::get('/adm-services', function () {
        return view('admin.services');
    });

    Route::get('/adm-servicesedit', function () {
        return view('admin.servicesedit');
    });

    Route::get('/adm-servicescreate', function () {
        return view('admin.servicescreate');
    });

    Route::get('/adm-gallery', function () {
        return view('admin.gallery');
    });

    Route::get('/adm-galleryedit', function () {
        return view('admin.galleryedit');
    });

    Route::get('/adm-gallerycreate', function () {
        return view('admin.gallerycreate');
    });

    Route::get('/adm-clinic', function () {
        return view('admin.clinic');
    });

    Route::get('/adm-clinicedit', function () {
        return view('admin.clinicedit');
    });

    Route::get('/adm-cliniccreate', function () {
        return view('admin.cliniccreate');
    });

    Route::get('/adm-user', function () {
        return view('admin.user');
    });

    Route::get('/adm-usercreate', function () {
        return view('admin.usercreate');
    });

    Route::get('/adm-session', function () {
        return view('admin.session');
    });

    Route::get('/adm-sessioncreate', function () {
        return view('admin.sessioncreate');
    });

    Route::get('/app-recap', function () {
        return view('admin.app-recap');
    });

    Route::get('/adm-pet', [PetController::class, "adm_pet"]);
    Route::get('/adm-petedit', [petController::class, "petedit"]);
    Route::resource('pets', PetController::class);
    Route::get('/petedit_test/{id}', [PetController::class, "peteditf"]);
    Route::put('/petedit_test/{id}', [PetController::class, "update"]);
    Route::post('/petedit_create', [PetController::class, "store"]);

    Route::resource('session', PetController::class);
    Route::get('/petedit_test/{id}', [PetController::class, "peteditf"]);
    Route::put('/petedit_test/{id}', [PetController::class, "update"]);
    Route::post('/petedit_create', [PetController::class, "store"]);

    Route::resource('services', ServiceController::class);
    Route::get('/adm-services', [ServiceController::class, "index"]);
    Route::get('/servicesedit/{id}', [ServiceController::class, "edit"]);
    Route::put('/servicesedit/{id}', [ServiceController::class, "update"]);
    Route::post('/services_create', [ServiceController::class, "store"]);

    Route::resource('gallery', GalleryController::class);
    Route::get('/adm-gallery', [GalleryController::class, "index"]);
    Route::get('/galleryedit/{id}', [GalleryController::class, "edit"]);
    Route::put('/galleryedit/{id}', [GalleryController::class, "update"]);
    Route::post('/gallery_create', [GalleryController::class, "store"]);

    Route::resource('clinic', ClinicController::class);
    Route::get('/adm-clinic', [ClinicController::class, "index"]);
    Route::get('/clinicedit/{id}', [ClinicController::class, "edit"]);
    Route::put('/clinicedit/{id}', [ClinicController::class, "update"]);
    Route::post('/clinic_create', [ClinicController::class, "store"]);

    Route::resource('session', SessionController::class);
    Route::get('/adm-session', [SessionController::class, "index"]);
    Route::get('/sessionedit/{id}', [SessionController::class, "edit"]);
    Route::put('/sessionedit/{id}', [SessionController::class, "update"]);
    Route::post('/session_create', [SessionController::class, "store"]);

    Route::get('/adm-user', [userController::class, "index"]);
    Route::get('/useredit/{id}', [userController::class, "editadm"]);
    Route::put('/useredit/{id}', [userController::class, "updateadm"]);
    Route::post('/user_create', [userController::class, "store"]);
    Route::get('/adm', [userController::class, "admin"]);
    // Route::get('/adm', [userController::class, "show"]);

    // Route::get('/profileedit/{id}', [userController::class, "edit"]);
    // Route::put('/profileedit/{id}', [userController::class, "update"]);

    Route::resource('appointment', AppointmentController::class);
    Route::get('/appedit/{id}', [AppointmentController::class, "edit"]);
    Route::put('/appedit/{id}', [AppointmentController::class, "update"]);
    Route::get('/adm-app', [AppointmentController::class, "index"]);
    Route::get('/app-recap', [AppointmentController::class, "recap"]);
});
