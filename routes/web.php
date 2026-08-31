<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\AchievementController;
use App\Models\Achievement;
use App\Http\Controllers\AttendanceController;
use App\Models\Coach;
use App\Http\Controllers\SponsorController;
use App\Models\Sponsor;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CashFlowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\JerseyController;
use App\Http\Controllers\CoachAttendanceController;
use App\Http\Controllers\CoachSalaryController;
// ==========================================
// PUBLIC ROUTES (Landing Page & Auth)
// ==========================================
Route::get('/', function () {
    $coaches = Coach::all();
    $achievements = Achievement::latest()->get();
    $sponsors = Sponsor::latest()->get();
    return view('welcome', compact('coaches', 'achievements', 'sponsors'));
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// SHARED ROUTES (Admin & Coach)
// ==========================================
Route::middleware(['auth', 'role:admin,coach'])->group(function () {

    // Dashboard Pelatih
    Route::get('/coach/dashboard', [CoachController::class, 'dashboard'])->name('coach.dashboard');

    // 1. Data Siswa
    Route::resource('students', StudentController::class);
    Route::patch('/students/{student}/toggle-status', [StudentController::class, 'toggleStatus'])->name('students.toggleStatus');

    // 2. Absensi
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::get('/attendances/student/{id}', [AttendanceController::class, 'show'])->name('attendances.show');

    // 3. Rapot & Nilai Siswa
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
    Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
    Route::get('/grades/{id}', [GradeController::class, 'show'])->name('grades.show');
    Route::get('/grades/{id}/edit', [GradeController::class, 'edit'])->name('grades.edit');
    Route::put('/grades/{id}', [GradeController::class, 'update'])->name('grades.update');
    Route::get('/grades/{student}/pdf', [GradeController::class, 'downloadPdf'])->name('grades.pdf');


    // 4. Data Transaksi (Pemasukan & Pengeluaran Khusus Pelatih & Admin)
    Route::get('/cash-flow', [CashFlowController::class, 'index'])->name('cash-flow.index');
    Route::post('/cash-flow', [CashFlowController::class, 'store'])->name('cash-flow.store');
});


// ==========================================
// STRICT ADMIN ONLY ROUTES
// ==========================================
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/coach-attendances', [CoachAttendanceController::class, 'index'])->name('coach-attendances.index');
    Route::post('/coach-attendances', [CoachAttendanceController::class, 'store'])->name('coach-attendances.store');
    Route::get('/coach-attendances/{coach}/history', [CoachAttendanceController::class, 'show'])->name('coach-attendances.show');

    Route::get('/salaries', [CoachSalaryController::class, 'index'])->name('salaries.index');
    Route::post('/salaries/generate', [CoachSalaryController::class, 'generate'])->name('salaries.generate');
    Route::post('/salaries/{id}/paid', [CoachSalaryController::class, 'markAsPaid'])->name('salaries.paid');

    // Rekap SPP (Khusus Admin)
    Route::get('/spp', [SppController::class, 'index'])->name('spp.index');
    Route::post('/spp/generate', [SppController::class, 'generate'])->name('spp.generate');
    Route::post('/spp/{id}/paid', [SppController::class, 'markAsPaid'])->name('spp.paid');
    Route::post('/spp/{id}/unpaid', [SppController::class, 'markAsUnpaid'])->name('spp.unpaid');
    Route::get('/spp/{id}/invoice', [SppController::class, 'showInvoice'])->name('spp.invoice');
    Route::post('/spp/{id}/update-amount', [SppController::class, 'updateAmount'])->name('spp.update-amount');

    // Manajemen User / Admin
    Route::resource('users', UserController::class)->names('admin.users');

    // Manajemen Jersey
    Route::resource('jerseys', JerseyController::class);

    // CRUD Sponsor
    Route::resource('admin/sponsors', SponsorController::class)->names('sponsors');

    // CRUD Pelatih
    Route::resource('admin/coaches', CoachController::class)->parameters(['coaches' => 'coach'])->names('coaches');

    // CRUD Prestasi
    Route::resource('admin/achievements', AchievementController::class)->names('achievements');
});
