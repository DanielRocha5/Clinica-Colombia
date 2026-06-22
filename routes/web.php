<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('home');
});

Route::get('/crearCuenta', function () {
    return view('crearCuenta');
})->name('crearCuenta');
Route::post('/register', [AuthController::class, 'registerUser'])->name('register');

Route::get('/iniciarSesion', function () {
    return view('iniciarSesion');
})->name('iniciarSesion');
Route::post('/iniciarSesion', [LoginController::class, 'login'])->name('login');

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/citas', [CitaController::class, 'index'])->name('admin.citas');
    Route::post('/admin/citas/{id}/aceptar', [CitaController::class, 'aceptar'])->name('admin.citas.aceptar');
    Route::post('/admin/citas/{id}/cancelar', [CitaController::class, 'cancelar'])->name('admin.citas.cancelar');

    Route::get('/admin/informacion', [InfoController::class, 'index'])->name('admin.informacion');

    Route::get('/admin/empleados',           [EmpleadoController::class, 'index'])->name('admin.empleados');
    Route::post('/admin/empleados',          [EmpleadoController::class, 'store'])->name('admin.empleados.store');
    Route::get('/admin/empleados/{id}/edit', [EmpleadoController::class, 'edit'])->name('admin.empleados.edit');
    Route::put('/admin/empleados/{id}',      [EmpleadoController::class, 'update'])->name('admin.empleados.update');
    Route::delete('/admin/empleados/{id}',   [EmpleadoController::class, 'destroy'])->name('admin.empleados.destroy');

    Route::get('/admin/informacion/pdf',      [PdfController::class, 'index'])->name('pdf.index');
    Route::get('/admin/informacion/pdf/{id}', [PdfController::class, 'generar'])->name('pdf.generar');

    Route::get('/admin/informacion/export', [InfoController::class, 'exportExcel'])->name('admin.informacion.export');
});

Route::middleware(['auth:sanctum', 'role:user'])->group(function () {

    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/citas/agendarCita',  [CitaController::class, 'create'])->name('citas.agendarCita');
    Route::post('/citas/agendarCita', [CitaController::class, 'store'])->name('citas.store');
    Route::middleware('auth')->post('/chat', [ChatController::class, 'responder']);
    });