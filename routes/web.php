<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductReportController;
use App\Http\Controllers\Stocked\StockedProductController;
use App\Http\Controllers\Stocked\StockedProductReportController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Trademark\TrademarkController;
use App\Http\Controllers\Tag\TagController;
use App\Http\Controllers\Unit\UnitController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Invoice\InvoiceDetailController;
use App\Http\Controllers\Invoice\InvoiceAttachmentController;
use App\Http\Controllers\Invoice\InvoiceReportController;
use App\Http\Controllers\Installment\InstallmentController;
use App\Http\Controllers\Installment\InstallmentAttachmentController;
use App\Http\Controllers\Installment\InstallmentReportController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CustomerAttachmentController;
use App\Http\Controllers\Customer\CustomerReportController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeAttachmentController;
use App\Http\Controllers\Employee\EmployeeReportController;

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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();
Auth::routes(['register' => false]);






// Route::get('/section/{id}', 'InvoicesController@getproducts');

// Route::get('download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');

// Route::get('View_file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');



Route::middleware(['auth:web'])
    ->group(function (){

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [UserController::class, 'show'])-> name('profile');
        Route::get('/settings', [SettingController::class, 'index'])-> name('settings');
        Route::post('/settings', [SettingController::class, 'update'])-> name('settings.update');
        Route::get('markAsReadAll',[DashboardController::class, 'markAsReadAll'])->name('markAsReadAll');
        Route::get('unreadNotificationsCount', [DashboardController::class, 'unreadNotificationsCount'])->name('unreadNotificationsCount');
        Route::get('unreadNotifications', [DashboardController::class, 'unreadNotifications'])->name('unreadNotifications');


        // Route::get('/home', 'HomeController@index')->name('home');
        // Route::get('MarkAsRead_all','InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');
        // Route::get('unreadNotifications_count', 'InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');
        // Route::get('unreadNotifications', 'InvoicesController@unreadNotifications')->name('unreadNotifications');
        // Route::get('/{page}', 'AdminController@index');

        Route::prefix('ecommerce')->group(function () {

            Route::any('/', [EcommerceController::class, 'index'])->name('ecommerce');
            Route::get('/show/{id}', [EcommerceController::class, 'show'])-> name('ecommerce.show');

        });

        Route::prefix('users')->group(function () {

            // Route::resource('/', ActivityController::class);
            Route::get('/', [UserController::class, 'index'])->name('users');
            Route::get('/trash', [UserController::class, 'trash'])->withTrashed()->name('users.trash');
            Route::get('/create', [UserController::class, 'create'])-> name('users.create');
            Route::post('/store', [UserController::class, 'store'])-> name('users.store');
            Route::get('/show/{id}', [UserController::class, 'show'])-> name('users.show');
            Route::get('/edit/{id}', [UserController::class, 'edit'])-> name('users.edit');
            Route::patch('/update', [UserController::class, 'update'])-> name('users.update');
            Route::delete('/delete', [UserController::class, 'destroy'])-> name('users.delete');
            Route::get('/softDelete/{id}', [UserController::class, 'softDelete'])-> name('users.softDelete');
            Route::get('/restore/{id}', [UserController::class, 'restore'])-> name('users.restore');
            Route::get('/active/{id}', [UserController::class, 'active'])-> name('users.active');
            Route::get('/deactive/{id}', [UserController::class, 'deactive'] )-> name('users.deactive');

        });

        Route::prefix('roles')->group(function () {

            // Route::resource('/', RoleController::class);
            Route::get('/', [RoleController::class, 'index'])->name('roles');
            Route::get('/create', [RoleController::class, 'create'])-> name('roles.create');
            Route::post('/store', [RoleController::class, 'store'])-> name('roles.store');
            Route::get('/show/{id}', [RoleController::class, 'show'])-> name('roles.show');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])-> name('roles.edit');
            Route::patch('/update', [RoleController::class, 'update'])-> name('roles.update');
            Route::delete('/delete', [RoleController::class, 'destroy'])-> name('roles.delete');
            Route::get('/active/{id}', [RoleController::class, 'active'])-> name('roles.active');
            Route::get('/deactive/{id}', [RoleController::class, 'deactive'] )-> name('roles.deactive');

        });

        Route::prefix('products')->group(function () {

            // Route::resource('/', ProductController::class);
            Route::get('/', [ProductController::class, 'index'])->name('products');
            Route::get('/trash', [ProductController::class, 'trash'])->withTrashed()->name('products.trash');
            Route::get('/create', [ProductController::class, 'create'])-> name('products.create');
            Route::post('/store', [ProductController::class, 'store'])-> name('products.store');
            Route::get('/show/{id}', [ProductController::class, 'show'])-> name('products.show');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])-> name('products.edit');
            Route::patch('/update', [ProductController::class, 'update'])-> name('products.update');
            Route::delete('/delete', [ProductController::class, 'destroy'])-> name('products.delete');
            Route::get('/softDelete/{id}', [ProductController::class, 'softDelete'])-> name('products.softDelete');
            Route::get('/restore/{id}', [ProductController::class, 'restore'])-> name('products.restore');
            Route::get('/active/{id}', [ProductController::class, 'active'])-> name('products.active');
            Route::get('/deactive/{id}', [ProductController::class, 'deactive'] )-> name('products.deactive');
            Route::get('/print/{id}', [ProductController::class, 'print'] )-> name('products.print');
            Route::get('/export/{id}', [ProductController::class, 'export'] )-> name('products.export');

        });

        Route::prefix('product_reports')->group(function () {

            Route::get('/', [ProductReportController::class, 'index'] )-> name('product_reports');
            Route::post('search', [ProductReportController::class, 'search'])-> name('product_reports.search');
            Route::get('print', [ProductReportController::class, 'print'] )-> name('product_reports.print');

        });

        Route::prefix('stocked_products')->group(function () {

            // Route::resource('/', StockedProductController::class);
            Route::get('/', [StockedProductController::class, 'index'])->name('stocked_products');
            Route::get('/trash', [StockedProductController::class, 'trash'])->withTrashed()->name('stocked_products.trash');
            Route::get('/create', [StockedProductController::class, 'create'])-> name('stocked_products.create');
            Route::post('/store', [StockedProductController::class, 'store'])-> name('stocked_products.store');
            Route::get('/show/{id}', [StockedProductController::class, 'show'])-> name('stocked_products.show');
            Route::get('/edit/{id}', [StockedProductController::class, 'edit'])-> name('stocked_products.edit');
            Route::patch('/update', [StockedProductController::class, 'update'])-> name('stocked_products.update');
            Route::delete('/delete', [StockedProductController::class, 'destroy'])-> name('stocked_products.delete');
            Route::get('/softDelete/{id}', [StockedProductController::class, 'softDelete'])-> name('stocked_products.softDelete');
            Route::get('/restore/{id}', [StockedProductController::class, 'restore'])-> name('stocked_products.restore');
            Route::get('/active/{id}', [StockedProductController::class, 'active'])-> name('stocked_products.active');
            Route::get('/deactive/{id}', [StockedProductController::class, 'deactive'] )-> name('stocked_products.deactive');
            Route::get('/export/{id}', [StockedProductController::class, 'export'] )-> name('stocked_products.export');

        });

        Route::prefix('stocked_products_reports')->group(function () {

            Route::get('/', [StockedProductReportController::class, 'index'] )-> name('stocked_products_reports');
            Route::post('search', [StockedProductReportController::class, 'search'])-> name('stocked_products_reports.search');
            Route::get('print', [StockedProductReportController::class, 'print'] )-> name('stocked_products_reports.print');

        });

        Route::prefix('sections')->group(function () {

            // Route::resource('/', SectionController::class);
            Route::get('/', [SectionController::class, 'index'])->name('sections');
            Route::get('/trash', [SectionController::class, 'trash'])->withTrashed()->name('sections.trash');
            // Route::get('/create', [SectionController::class, 'create'])-> name('sections.create');
            Route::post('/store', [SectionController::class, 'store'])-> name('sections.store');
            Route::get('/show/{id}', [SectionController::class, 'show'])-> name('sections.show');
            // Route::get('/edit/{id}', [SectionController::class, 'edit'])-> name('sections.edit');
            Route::patch('/update', [SectionController::class, 'update'])-> name('sections.update');
            Route::delete('/delete', [SectionController::class, 'destroy'])-> name('sections.delete');
            Route::get('/softDelete/{id}', [SectionController::class, 'softDelete'])-> name('sections.softDelete');
            Route::get('/restore/{id}', [SectionController::class, 'restore'])-> name('sections.restore');
            Route::get('/active/{id}', [SectionController::class, 'active'])-> name('sections.active');
            Route::get('/deactive/{id}', [SectionController::class, 'deactive'] )-> name('sections.deactive');

            Route::get('/section/{id}',  [SectionController::class, 'getProducts'] );
        });

        Route::prefix('trademarks')->group(function () {

            // Route::resource('/', TrademarkController::class);
            Route::get('/', [TrademarkController::class, 'index'])->name('trademarks');
            Route::get('/trash', [TrademarkController::class, 'trash'])->withTrashed()->name('trademarks.trash');
            Route::get('/create', [TrademarkController::class, 'create'])-> name('trademarks.create');
            Route::post('/store', [TrademarkController::class, 'store'])-> name('trademarks.store');
            Route::get('/show/{id}', [TrademarkController::class, 'show'])-> name('trademarks.show');
            Route::get('/edit/{id}', [TrademarkController::class, 'edit'])-> name('trademarks.edit');
            Route::patch('/update', [TrademarkController::class, 'update'])-> name('trademarks.update');
            Route::delete('/delete', [TrademarkController::class, 'destroy'])-> name('trademarks.delete');
            Route::get('/softDelete/{id}', [TrademarkController::class, 'softDelete'])-> name('trademarks.softDelete');
            Route::get('/restore/{id}', [TrademarkController::class, 'restore'])-> name('trademarks.restore');
            Route::get('/active/{id}', [TrademarkController::class, 'active'])-> name('trademarks.active');
            Route::get('/deactive/{id}', [TrademarkController::class, 'deactive'] )-> name('trademarks.deactive');

        });

        Route::prefix('units')->group(function () {

            // Route::resource('/', UnitController::class);
            Route::get('/', [UnitController::class, 'index'])->name('units');
            Route::get('/trash', [UnitController::class, 'trash'])->withTrashed()->name('units.trash');
            Route::get('/create', [UnitController::class, 'create'])-> name('units.create');
            Route::post('/store', [UnitController::class, 'store'])-> name('units.store');
            Route::get('/show/{id}', [UnitController::class, 'show'])-> name('units.show');
            Route::get('/edit/{id}', [UnitController::class, 'edit'])-> name('units.edit');
            Route::patch('/update', [UnitController::class, 'update'])-> name('units.update');
            Route::delete('/delete', [UnitController::class, 'destroy'])-> name('units.delete');
            Route::get('/softDelete/{id}', [UnitController::class, 'softDelete'])-> name('units.softDelete');
            Route::get('/restore/{id}', [UnitController::class, 'restore'])-> name('units.restore');
            Route::get('/active/{id}', [UnitController::class, 'active'])-> name('units.active');
            Route::get('/deactive/{id}', [UnitController::class, 'deactive'] )-> name('units.deactive');

        });

        Route::prefix('tags')->group(function () {

            // Route::resource('/', TagController::class);
            Route::get('/', [TagController::class, 'index'])->name('tags');
            Route::get('/trash', [TagController::class, 'trash'])->withTrashed()->name('tags.trash');
            Route::get('/create', [TagController::class, 'create'])-> name('tags.create');
            Route::post('/store', [TagController::class, 'store'])-> name('tags.store');
            Route::get('/show/{id}', [TagController::class, 'show'])-> name('tags.show');
            Route::get('/edit/{id}', [TagController::class, 'edit'])-> name('tags.edit');
            Route::patch('/update', [TagController::class, 'update'])-> name('tags.update');
            Route::delete('/delete', [TagController::class, 'destroy'])-> name('tags.delete');
            Route::get('/softDelete/{id}', [TagController::class, 'softDelete'])-> name('tags.softDelete');
            Route::get('/restore/{id}', [TagController::class, 'restore'])-> name('tags.restore');
            Route::get('/active/{id}', [TagController::class, 'active'])-> name('tags.active');
            Route::get('/deactive/{id}', [TagController::class, 'deactive'] )-> name('tags.deactive');

        });


        Route::prefix('invoices')->group(function () {

            // Route::resource('/', InvoiceController::class);
            Route::get('/', [InvoiceController::class, 'index'])->name('invoices');
            Route::get('/paid', [InvoiceController::class, 'paid'])->name('invoices.paid');
            Route::get('/unpaid', [InvoiceController::class, 'unpaid'])->name('invoices.unpaid');
            Route::get('/partial', [InvoiceController::class, 'partial'])->name('invoices.partial');
            Route::get('/trash', [InvoiceController::class, 'trash'])->withTrashed()->name('invoices.trash');
            Route::get('/create', [InvoiceController::class, 'create'])-> name('invoices.create');
            Route::post('/store', [InvoiceController::class, 'store'])-> name('invoices.store');
            Route::get('/show/{id}', [InvoiceController::class, 'show'])-> name('invoices.show');
            Route::get('/edit/{id}', [InvoiceController::class, 'edit'])-> name('invoices.edit');
            Route::patch('/update', [InvoiceController::class, 'update'])-> name('invoices.update');
            Route::delete('/delete', [InvoiceController::class, 'destroy'])-> name('invoices.delete');
            Route::get('/softDelete/{id}', [InvoiceController::class, 'softDelete'])-> name('invoices.softDelete');
            Route::get('/restore/{id}', [InvoiceController::class, 'restore'])-> name('invoices.restore');
            Route::get('/active/{id}', [InvoiceController::class, 'active'])-> name('invoices.active');
            Route::get('/deactive/{id}', [InvoiceController::class, 'deactive'] )-> name('invoices.deactive');
            Route::get('/export/{id}', [InvoiceController::class, 'export'] )-> name('invoices.export');
            Route::get('/pdf/{id}', [InvoiceController::class, 'pdf'] )-> name('invoices.pdf');
            Route::get('/send_to_email/{id}', [InvoiceController::class, 'send_to_email'] )-> name('invoices.send_to_email');

        });

        Route::prefix('invoice_details')->group(function () {

            Route::get('/', [InvoiceDetailController::class, 'index'])->name('invoice_details');
            Route::get('/trash', [InvoiceDetailController::class, 'trash'])->withTrashed()->name('invoice_details.trash');
            Route::get('/show/{id}', [InvoiceDetailController::class, 'show'])-> name('invoice_details.show');
            Route::get('/edit/{id}', [InvoiceDetailController::class, 'edit'])-> name('invoice_details.edit');
            Route::patch('/update', [InvoiceDetailController::class, 'update'])-> name('invoice_details.update');
            Route::delete('/delete', [InvoiceDetailController::class, 'destroy'])-> name('invoice_details.delete');
            Route::get('/softDelete/{id}', [InvoiceDetailController::class, 'softDelete'])-> name('invoice_details.softDelete');
            Route::get('/restore/{id}', [InvoiceDetailController::class, 'restore'])-> name('invoice_details.restore');
            Route::get('/active/{id}', [InvoiceDetailController::class, 'active'])-> name('invoice_details.active');
            Route::get('/deactive/{id}', [InvoiceDetailController::class, 'deactive'] )-> name('invoice_details.deactive');
            Route::get('/print/{id}', [InvoiceDetailController::class, 'print'] )-> name('invoice_details.print');
            Route::get('/export/{id}', [InvoiceDetailController::class, 'export'] )-> name('invoice_details.export');

        });

        Route::prefix('invoice_attachments')->group(function () {

            Route::post('/download', [InvoiceAttachmentController::class, 'download'])-> name('invoice_attachments.download');
            Route::post('/store', [InvoiceAttachmentController::class, 'store'])-> name('invoice_attachments.store');
            Route::delete('/delete', [InvoiceAttachmentController::class, 'destroy'])-> name('invoice_attachments.delete');
            Route::get('/active/{id}', [InvoiceAttachmentController::class, 'active'])-> name('invoice_attachments.active');
            Route::get('/deactive/{id}', [InvoiceAttachmentController::class, 'deactive'] )-> name('invoice_attachments.deactive');

        });

        Route::prefix('invoice_reports')->group(function () {

            Route::get('/', [InvoiceReportController::class, 'index'] )-> name('invoice_reports');
            Route::post('search', [InvoiceReportController::class, 'search'])-> name('invoice_reports.search');
            Route::get('print', [InvoiceReportController::class, 'print'] )-> name('invoice_reports.print');

        });

        Route::prefix('installments')->group(function () {

            // Route::resource('/', InstallmentController::class);
            Route::get('/', [InstallmentController::class, 'index'])->name('installments');
            Route::get('/trash', [InstallmentController::class, 'trash'])->withTrashed()->name('installments.trash');
            Route::any('/create', [InstallmentController::class, 'create'])-> name('installments.create');
            Route::post('/store', [InstallmentController::class, 'store'])-> name('installments.store');
            Route::get('/show/{id}', [InstallmentController::class, 'show'])-> name('installments.show');
            Route::get('/edit/{id}', [InstallmentController::class, 'edit'])-> name('installments.edit');
            Route::patch('/update', [InstallmentController::class, 'update'])-> name('installments.update');
            Route::delete('/delete', [InstallmentController::class, 'destroy'])-> name('installments.delete');
            Route::get('/softDelete/{id}', [InstallmentController::class, 'softDelete'])-> name('installments.softDelete');
            Route::get('/restore/{id}', [InstallmentController::class, 'restore'])-> name('installments.restore');
            Route::get('/active/{id}', [InstallmentController::class, 'active'])-> name('installments.active');
            Route::get('/deactive/{id}', [InstallmentController::class, 'deactive'] )-> name('installments.deactive');
            Route::get('/export/{id}', [InstallmentController::class, 'export'] )-> name('installments.export');

        });

        Route::prefix('installment_attachments')->group(function () {

            Route::post('/download', [InstallmentAttachmentController::class, 'download'])-> name('installment_attachments.download');
            Route::post('/store', [InstallmentAttachmentController::class, 'store'])-> name('installment_attachments.store');
            Route::delete('/delete', [InstallmentAttachmentController::class, 'destroy'])-> name('installment_attachments.delete');
            Route::get('/active/{id}', [InstallmentAttachmentController::class, 'active'])-> name('installment_attachments.active');
            Route::get('/deactive/{id}', [InstallmentAttachmentController::class, 'deactive'] )-> name('installment_attachments.deactive');

        });

        Route::prefix('installment_reports')->group(function () {

            Route::get('/', [InstallmentReportController::class, 'index'] )-> name('installment_reports');
            Route::post('search', [InstallmentReportController::class, 'search'])-> name('installment_reports.search');
            Route::get('print', [InstallmentReportController::class, 'print'] )-> name('installment_reports.print');

        });

        Route::prefix('customers')->group(function () {

            // Route::resource('/', CustomerController::class);
            Route::get('/', [CustomerController::class, 'index'])->name('customers');
            Route::get('/trash', [CustomerController::class, 'trash'])->withTrashed()->name('customers.trash');
            Route::get('/create', [CustomerController::class, 'create'])-> name('customers.create');
            Route::post('/store', [CustomerController::class, 'store'])-> name('customers.store');
            Route::get('/show/{id}', [CustomerController::class, 'show'])-> name('customers.show');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])-> name('customers.edit');
            Route::patch('/update', [CustomerController::class, 'update'])-> name('customers.update');
            Route::delete('/delete', [CustomerController::class, 'destroy'])-> name('customers.delete');
            Route::get('/softDelete/{id}', [CustomerController::class, 'softDelete'])-> name('customers.softDelete');
            Route::get('/restore/{id}', [CustomerController::class, 'restore'])-> name('customers.restore');
            Route::get('/active/{id}', [CustomerController::class, 'active'])-> name('customers.active');
            Route::get('/deactive/{id}', [CustomerController::class, 'deactive'] )-> name('customers.deactive');
            Route::get('/print/{id}', [CustomerController::class, 'print'] )-> name('customers.print');
            Route::get('/export/{id}', [CustomerController::class, 'export'] )-> name('customers.export');

        });

        Route::prefix('customer_attachments')->group(function () {

            Route::post('/download', [CustomerAttachmentController::class, 'download'])-> name('customer_attachments.download');
            Route::post('/store', [CustomerAttachmentController::class, 'store'])-> name('customer_attachments.store');
            Route::delete('/delete', [CustomerAttachmentController::class, 'destroy'])-> name('customer_attachments.delete');
            Route::get('/active/{id}', [CustomerAttachmentController::class, 'active'])-> name('customer_attachments.active');
            Route::get('/deactive/{id}', [CustomerAttachmentController::class, 'deactive'] )-> name('customer_attachments.deactive');

        });

        Route::prefix('customer_reports')->group(function () {

            Route::get('/', [CustomerReportController::class, 'index'] )-> name('customer_reports');
            Route::post('search', [CustomerReportController::class, 'search'])-> name('customer_reports.search');
            Route::get('print', [CustomerReportController::class, 'print'] )-> name('customer_reports.print');

        });

        Route::prefix('employees')->group(function () {

            // Route::resource('/', EmployeeController::class);
            Route::get('/', [EmployeeController::class, 'index'])->name('employees');
            Route::get('/trash', [EmployeeController::class, 'trash'])->withTrashed()->name('employees.trash');
            Route::get('/create', [EmployeeController::class, 'create'])-> name('employees.create');
            Route::post('/store', [EmployeeController::class, 'store'])-> name('employees.store');
            Route::get('/show/{id}', [EmployeeController::class, 'show'])-> name('employees.show');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])-> name('employees.edit');
            Route::patch('/update', [EmployeeController::class, 'update'])-> name('employees.update');
            Route::delete('/delete', [EmployeeController::class, 'destroy'])-> name('employees.delete');
            Route::get('/softDelete/{id}', [EmployeeController::class, 'softDelete'])-> name('employees.softDelete');
            Route::get('/restore/{id}', [EmployeeController::class, 'restore'])-> name('employees.restore');
            Route::get('/active/{id}', [EmployeeController::class, 'active'])-> name('employees.active');
            Route::get('/deactive/{id}', [EmployeeController::class, 'deactive'] )-> name('employees.deactive');

        });

        Route::prefix('employee_attachments')->group(function () {

            Route::post('/download', [EmployeeAttachmentController::class, 'download'])-> name('employee_attachments.download');
            Route::post('/store', [EmployeeAttachmentController::class, 'store'])-> name('employee_attachments.store');
            Route::delete('/delete', [EmployeeAttachmentController::class, 'destroy'])-> name('employee_attachments.delete');
            Route::get('/active/{id}', [EmployeeAttachmentController::class, 'active'])-> name('employee_attachments.active');
            Route::get('/deactive/{id}', [EmployeeAttachmentController::class, 'deactive'] )-> name('employee_attachments.deactive');

        });

        Route::prefix('employee_reports')->group(function () {

            Route::get('/', [EmployeeReportController::class, 'index'] )-> name('employee_reports');
            Route::post('search', [EmployeeReportController::class, 'search'])-> name('employee_reports.search');
            Route::get('print', [EmployeeReportController::class, 'print'] )-> name('employee_reports.print');

        });



    });
