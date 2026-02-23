<?php


use App\Http\Controllers\Auth\SecurityQuestionPasswordController;
use App\Livewire\Access\AccessLivewire; // dev by Techlink360
use App\Livewire\Products\ProductLivewire;
use App\Livewire\Purchases\PurchaseLivewire;
use App\Livewire\Suppliers\SupplierLivewire;

use App\Livewire\Sales\SaleLivewire;
use App\Livewire\Customers\CustomerLivewire;
use App\Livewire\Returns\ReturnLivewire;
use App\Livewire\Expenses\ExpenseLivewire;
use App\Livewire\Reports\ReportSalesLivewire;
use App\Livewire\Reports\ReportProfitLivewire;
use App\Livewire\Reports\ReportStockLivewire;
use App\Livewire\Categories\CategoriesLivewire;
use App\Livewire\Dashboard\DashboardLivewire;
use App\Livewire\Setup\DatabaseManagerLivewire;
use App\Livewire\Setup\SetupLivewire;
use App\Livewire\Setup\UserSetupLivewire;
use App\Livewire\Users\LivewireUsers;
use App\Livewire\Licenses\LicenseManagerLivewire;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLicense;
use App\Livewire\TrialBlocked;

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

Route::get('/', function () {
    return redirect(route('login'));
})->name('home');
// Route::get('/license.expired', function () {
//     return "expired";
// })->name('license.expired');
Route::get('/license-manager', LicenseManagerLivewire::class)->name('license.manager')->middleware(CheckLicense::class);
Route::get('/trial-blocked', TrialBlocked::class)->name('trial.blocked');
Route::get('/about', \App\Livewire\AboutLivewire::class)->name('about');
Route::get('/setup', UserSetupLivewire::class)->name('setup');
Route::get('/database/manager',DatabaseManagerLivewire::class)->name('database.manager');

if (config('auth.password_recovery') === 'questions') {
    Route::get('forgot-password-questions', [SecurityQuestionPasswordController::class, 'showForm'])->name('password.questions');
    Route::post('verify-questions', [SecurityQuestionPasswordController::class, 'verify'])->name('password.questions.verify');
    Route::get('reset-password-questions/{user}', [SecurityQuestionPasswordController::class, 'resetForm'])->name('password.questions.reset');
    Route::post('reset-password-questions/{user}', [SecurityQuestionPasswordController::class, 'reset'])->name('password.questions.update');
}

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'license',
])->group(function () {

     // ==============================
    // PUBLIC PAGES FOR ANY LOGGED USER
    // ==============================
    Route::get('/dashboard', DashboardLivewire::class)->name('dashboard');
    Route::get('/pos', \App\Livewire\Admin\POS\POSLivewire::class)->name('pos');
    Route::get('/returns/print/{id}', [\App\Http\Controllers\ReturnController::class, 'print'])
        ->name('returns.print');
    Route::get('/profile', \App\Livewire\Profile\ProfileLivewire::class)->name('profile');
    Route::get('/unauthorized', AccessLivewire::class)->name('unauthorized'); // dev by Techlink360
    

    // ==============================
    // SYSTEM ADMIN ONLY
    // ==============================
    Route::middleware('role:system,owner')->group(function () {
        Route::get('/users', LivewireUsers::class)->name('users'); // only system admin manages users
        Route::get('/audit-logs', \App\Livewire\Admin\AuditLogs\AuditLogLivewire::class)->name('audit-logs');
    });

    // ==============================
    // OWNER + SYSTEM ADMIN
    // ==============================
    Route::middleware('role:owner,system')->group(function () {
        Route::get('/categories', CategoriesLivewire::class)->name('categories');
        Route::get('/products', ProductLivewire::class)->name('products');
        Route::get('/suppliers', SupplierLivewire::class)->name('suppliers');
        Route::get('/purchases', PurchaseLivewire::class)->name('purchases');
        Route::get('/expenses', ExpenseLivewire::class)->name('expenses');
         Route::get('/sales', SaleLivewire::class)->name('sales');
        Route::get('/customers', CustomerLivewire::class)->name('customers');
        Route::get('/returns', ReturnLivewire::class)->name('returns');

        // Reports
        Route::get('/reports/sales', ReportSalesLivewire::class)->name('reports.sales');
        Route::get('/reports/profit', ReportProfitLivewire::class)->name('reports.profit');
        Route::get('/reports/stock', ReportStockLivewire::class)->name('reports.stock');
    });

    // ==============================
    // SELLER + OWNER + SYSTEM ADMIN
    // ==============================
    Route::middleware('role:seller,owner,system')->group(function () {
        Route::get('/sales', SaleLivewire::class)->name('sales');
        Route::get('/customers', CustomerLivewire::class)->name('customers');
        Route::get('/returns', ReturnLivewire::class)->name('returns');
        Route::get('/categories', CategoriesLivewire::class)->name('categories');
        Route::get('/products', ProductLivewire::class)->name('products');


        Route::get('/products', ProductLivewire::class)->name('products');
        Route::get('/suppliers', SupplierLivewire::class)->name('suppliers');
        Route::get('/purchases', PurchaseLivewire::class)->name('purchases');


    });

    // Route::get('/dashboard', DashboardLivewire::class)->name('dashboard');
    // Route::get('/users', LivewireUsers::class)->name('users');
    // Route::get('/categories', Categorieslivewire::class)->name('categories');
    // Route::get('/products', ProductLivewire::class)->name('products');
    // Route::get('/suppliers', SupplierLivewire::class)->name('suppliers');
    // Route::get('/purchases', PurchaseLivewire::class)->name('purchases');
    // Route::get('/sales', SaleLivewire::class)->name('sales');
    // Route::get('/customers', CustomerLivewire::class)->name('customers');
    // Route::get('/returns', ReturnLivewire::class)->name('returns');
    // Route::get('/expenses', ExpenseLivewire::class)->name('expenses');
    // Route::get('/reports/sales', ReportSalesLivewire::class)->name('reports.sales');
    // Route::get('/reports/profit', ReportProfitLivewire::class)->name('reports.profit');
    // Route::get('/reports/stock', ReportStockLivewire::class)->name('reports.stock');
    // Route::get('/pos', \App\Livewire\Admin\POS\POSLivewire::class)->name('pos');
    // Route::get('/returns/print/{id}', [\App\Http\Controllers\ReturnController::class, 'print'])->name('returns.print');
});
