<?php

use App\Http\Controllers\ApplicationSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanPlanController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductServiceController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\SavingDepositCotroller;
use App\Http\Controllers\SavingsUploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\ProductServiceCategory;
use Illuminate\Validation\Rules\Can;

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

include_once('admin_web.php');

// Route::get('/', function () {
//     return redirect()->route('login', 301);
// })->name('index');
// Route::get('/', function () {
//     return redirect()->route('index');
// })->name('/');
Route::get('/', function(){
    return view('front.home');
})->name('index');
Route::get('pdf-print', function (){
    return view('layouts.pdf-views.guarantors');
});
Route::view('sample-page', 'admin.pages.sample-page')->name('sample-page');
Route::view('default', 'admin.dashboard.default')->name('dashboard.index');
Route::get('images/', [MemberController::class, 'viewAvatar'])->name('member.avatar');
Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        // Route::view('/', 'admin.dashboard.default');

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::get('/member-register', [MemberController::class, 'create'])->name('member-register');
        Route::post('/register-member', [MemberController::class, 'store'])->name('store-register');
        Route::get('/guarantor-form/{user}/download', [MemberController::class, 'guarantorFormDownload'])->name('guarantor-form');
        Route::get('/member/update', [MemberController::class, 'showSelfUpdate'])->name('self-update.create');
        Route::patch('/member/update/{user}/store', [MemberController::class, 'storeSelfUpdate'])->name('self-update.store');
    });
    Route::prefix('member-savings')->group(function () {

        Route::get('/deposit/{user}/view', [UserController::class, 'usersContribution'] )->name('self-deposit.all');
        Route::get('/change-deductions/{user}/view', [UserController::class, 'updateContribution'])->name('contributions.update');
    });
    Route::prefix('member-loans')->group(function () {
        Route::get('/apply/self', [LoanPlanController::class, 'selfapplyLoan'])->name('self-loan.apply');
        Route::get('/details/{loan}/view', [LoanPlanController::class, 'selfLoanDetail'])->name('self-loan.view');
        route::get('/loans/{user}/view', [UserController::class, 'usersLoan'])->name('self-loan.all');
    });
    Route::prefix('office')->group(function () {
        Route::get('/upload-deposit', [SavingDepositCotroller::class, 'create'])->name('upload.deposit')->can('upload-deposit');
        Route::get('/deposits', [SavingDepositCotroller::class, 'index'])->name('deposit.home')->can('view-all-deposits');
        Route::get('/deposit/{deposit}/show', [SavingDepositCotroller::class, 'show'])->name('deposit.show')->can('view-deposit');
        Route::get('/Loan-plan', [LoanPlanController::class, 'index'])->name('loanplan.home')->can('view-all-loan');
        Route::get('/add-member', [MemberController::class, 'addNewMember'])->name('add.user')->can('create-member');
        Route::post('/store-member', [MemberController::class, 'storeNewMember'])->name('store.member')->can('create-member');
        //account numbers
        Route::get('/bank-details', [RevenueController::class, 'accountNumber'])->name('account-number')->can('create-account');

        //all Ctss Approval
        Route::get('/contribution/{deposit}/confirm', [SavingDepositCotroller::class, 'confirmContribution'])->name('approve.contribution')->can('approve-deposit');
        Route::post('/contribution/upload', [SavingDepositCotroller::class, 'get_contribution_data'])->name('contribution.datatable')->can('view-all-deposit');
        //all ctls upload
        Route::get('/ctls/{ctls}/process', [SavingDepositCotroller::class, 'confirmCtls'])->name('approve.ctls')->can('approve-ctls');
        Route::post('/ctls/upload', [SavingDepositCotroller::class, 'get_ctls_data'])->name('ctls.datatable')->can('view-ctls-upload');
        Route::get('/ctls', [SavingDepositCotroller::class, 'ctls'])->name('ctls.home')->can('view-ctls-upload');
        Route::get('/ctls/{ctls}/show', [SavingDepositCotroller::class, 'showCtls'])->name('ctls.show')->can('view-ctls-detail');
        //bank mandates routes
        Route::get('mandates/awaiting-batching', [RevenueController::class, 'bankMandate'])->name('bankmandate.all')->can('view-awaiting-bank-mandate');
        Route::get('mandates/{mandate}/preview', [RevenueController::class, 'showBankMandate'])->name('bankmandate.show')->can('view-bank-mandate');
        Route::post('/mandates/get_table_data',[RevenueController::class, 'get_mandate_data'])->name('bankmandate.datatable');
        //bank mandate batches
        Route::get('/batch/bankMandates', [RevenueController::class, 'bankMandateBatch'])->name('bankmandatebatch.all')->can('view-batches');
        Route::get('/batch/{batch}/details', [RevenueController::class, 'bankMandateBatchShow'])->name('bankmandatebatch.show')->can('view-bank-mandate');
        Route::post('/batch/bankMandates/process', [RevenueController::class, 'bankMandateBatchProcess'])->name('bankmandatebatch.process')->can('process-batch');
        Route::post('/mandate-batch/get_batch_data',[RevenueController::class, 'get_batch_data'])->name('batch-mandate.datatable');
        //revenues
        Route::get('/revenues', [RevenueController::class, 'revenueReport'])->name('revenues.all')->can('view-revenues');
        Route::post('/revenues/get_table_data',[RevenueController::class, 'get_revenue_data'])->name('revenues.datatable');

    });
    Route::prefix('savings')->group(function(){
        Route::post('/savings/get_table_data',[SavingController::class, 'get_saving_data'])->name('savings.datatable');
        Route::get('/savings',[SavingController::class, 'index'])->name('savings.all');
    });
    Route::prefix('settings')->group(function () {
        Route::get('/create-role', [RoleController::class, 'index'])->name('role.create')->can('create-role');
        Route::get('/edit-role/{role}/check', [RoleController::class, 'edit'])->name('role.edit')->can('edit-role');
        Route::post('assign-role', [UserController::class, 'processAssignRole'])->name('role.process')->can('assign-role');
        Route::get('assign-role/users', [UserController::class, 'assignRoleToUser'])->name('role.assign')->can('assign-role');
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permission.create')->can('create-permission');

    });
    Route::prefix('shops')->group(function () {
        //Recieve Order
        Route::get('/receive-order/index', [ProductServiceController::class, 'receiveOrder'])->name('receive-order.all')->can('create-receive-order');
        Route::get('/receive-order/show/{order}', [ProductServiceController::class, 'showReceiveOrder'])->name('receive-order.show')->can('create-receive-order');
        Route::post('/process-order', [HomeController::class, 'processReceiveOrder'])->name('receive.process')->can('create-receive-order');
        Route::post('/receive-order/get_table_data',[HomeController::class, 'get_receive_order'])->name('receive-order.datatable');
        Route::get('/recieve-order/{order}/processed', [HomeController::class, 'showReceivedOrder'])->name('receive-order.processed')->can('create-receive-order');
        //suppliers
        Route::get('/product/supplier/create', [ProductServiceController::class, 'createSupplier'])->name('supplier.create')->can('create-supplier');
        Route::get('/product/supplier', [ProductServiceController::class, 'allSupplier'])->name('supplier.all')->can('view-suppliers');
        Route::get('/product-service/category', [ProductServiceController::class, 'category'])->name('product.category')->can('create-product-category');
        Route::get('/product-service/all', [ProductServiceController::class, 'index'])->name('product.all')->can('view-all-product');
        Route::get('/product-service/create', [ProductServiceController::class, 'invent'])->name('product.create')->can('create-product');
        Route::get('/product-service/sales', [ProductServiceController::class, 'sales'])->name('product.sales')->can('create-sales');
        Route::get('/product-service/{product}/details', [ProductServiceController::class, 'show'])->name('product.show')->can('view-product-detail');
        //purchase order
        Route::view('/purchase-order/create', 'shop.create-purchase-order')->name('purchase-order.ceate')->can('create-purchase-order');
        Route::view('/purchase-order', 'shop.list-purchase-order')->name('purchase-order.all')->can('create-purchase-order');
        Route::get('/purchase-order/{order}/show', [ProductServiceController::class, 'showPurchaseOrder'])->name('purchase-order.show')->can('create-purchase-order');
        Route::patch('/purchase-order/{order}/process', [ProductServiceController::class, 'processPurchaseOrder'])->name('purchase-order.process')->can('process-purchase-order');

        //sales
        Route::post('/sales/get_table_data',[ProductServiceController::class, 'sales_table'])->name('sales.datatable');
        Route::get('/sales', [ProductServiceController::class, 'salesReport'])->name('sales.all')->can('create-sales');
        Route::get('/sales/{sale}/show', [ProductServiceController::class, 'showSales'])->name('sales.show')->can('view-sales');
        Route::post('/sales/total', [ProductServiceController::class, 'getSalesTotal'])->name('sales.total')->can('view-sales');

    });
    Route::prefix('loans')->group(function () {
        Route::get('/all', [LoanPlanController::class, 'index'])->name('all.loans')->can('view-loan');
        Route::get('/pending-loans', [LoanPlanController::class, 'PendingLoanIndex'])->name('pending.loan')->can('view-loan');
        Route::get('/show/{loan}/detail', [LoanPlanController::class, 'show'])->name('show.loan')->can('view-loan');
        Route::get('/print/loan/{loan}/form', [LoanPlanController::class, 'loanFormDownload'])->name('form.loan')->can('create-loan');
        Route::get('/upload/loan/{loan}/form', [LoanPlanController::class, 'loanFormUpload'])->name('form.upload.loan');
        Route::get('/apply', [LoanPlanController::class, 'applyLoan'])->name('loan.apply')->can('create-loan');

        Route::post('/approve-loans', [LoanPlanController::class, 'approveLoan'])->name('approve.loan')->can('approve-loan');
        Route::post('/decline-loans', [LoanPlanController::class, 'declineLoan'])->name('decline.loan')->can('decline-loan');
        Route::post('/apply', [LoanRequestController::class, 'storeLoanRequest'])->name('store.loan')->can('process-loan');
        Route::post('/apply-self', [LoanRequestController::class, 'selfstoreLoanRequest'])->name('self-store.loan');
        Route::post('/get_table_data',[LoanPlanController::class, 'get_table_data'])->name('loan.datatable');
        Route::post('/get_pending_loan',[LoanPlanController::class, 'get_pending_loan'])->name('pending.datatable');

    });
    Route::prefix('admin')->group(function () {
        Route::get('/members/update-email/{user}', [UserController::class, 'updateEmail'])->name('member-email.create')->can('update-member-email');
        Route::get('users', [UserController::class, 'index'])->name('all.users')->can('view-all-users');
        Route::get('user/list', [UserController::class, 'newUsers'])->name('users.list');
        Route::get('user/members/list', [UserController::class, 'member'])->name('members.list')->can('view-member');
        Route::get('user/awaiting', [UserController::class, 'awaitingApproval'])->name('awaiting.list')->can('view-awaiting');
        Route::get('user/denied', [UserController::class, 'deniedApproval'])->name('denied.list')->can('view-denied');
        Route::get('user/online', [UserController::class, 'onlineRegistered'])->name('online.list')->can('view-online');
        Route::get('user/{user}/contribution', [UserController::class, 'adminUsersContribution'] )->name('user-deposit-admin.all');
        Route::get('user/member', [UserController::class, 'create'])->name('membership')->can('create-member');
        Route::get('user/all', [UserController::class, 'tryQuery'])->name('users.try');
        Route::get('user/more', [UserController::class, 'olaTable'])->name('mylist');
        Route::get('user/{user}/view', [UserController::class, 'show'])->name('user.show');
        Route::get('/member/{member}/show', [MemberController::class, 'updateMember'])->name('member-update.create')->can('update-member');
        Route::patch('/member/{member}/update', [MemberController::class, 'updateMemberStore'])->name('member-update.store');
        Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('user/get_table_data',[UserController::class, 'get_table_data'])->name('user.datatable');
        Route::post('user/get_member_data',[UserController::class, 'get_member_data'])->name('member.datatable');
        Route::post('user/get_awaiting_data',[UserController::class, 'get_awaiting_data'])->name('awaiting.datatable');
        Route::post('user/get_denied_data',[UserController::class, 'get_denied_data'])->name('denied.datatable');
        Route::post('user/get_user_contribution_data/{user}',[UserController::class, 'get_user_contribution_data'])->name('userContribution.datatable');
        Route::get('user/getMemberContribution/{user}',[UserController::class, 'memberContribution'])->name('userContribution.get');
        Route::post('user/get_online_data',[UserController::class, 'get_online_data'])->name('online.datatable');
        Route::get('/approve-memberhip/{user}/treat', [UserController::class, 'approveMembership'])->name('membership.approve')->can('approve-member');
        Route::get('/deny-memberhip/{user}/treat', [UserController::class, 'declineMembership'])->name('membership.decline')->can('deny-membership');
        //Maual deposit
        Route::get('/manual-deposit/{user}', [MemberController::class, 'manualDeposit'])->name('deposit.manual')->can('manual-deposit');
    });

    Route::prefix('application')->group(function () {
        Route::get('/index', [ApplicationSettingController::class, 'index'])->name('application.index');
        Route::post('/storeSetting', [ApplicationSettingController::class, 'storeSetting'])->name('application.store');
        Route::patch('/updateSetting/{setting}', [ApplicationSettingController::class, 'update'])->name('application.update');
        Route::post('/executives/add', [ApplicationSettingController::class, 'addUserToExco'])->name('executive.store');
        Route::get('/executives',[ApplicationSettingController::class, 'executives'])->name('executive.index');
        Route::patch('update-executive/{executive}', [ApplicationSettingController::class, 'updateExecutive']);

    });
});
Route::get('/rundown', [UserController::class, 'generateFullName'])->name('rundown');
Route::view('modern-layout', 'multiple.modern-layout')->name('modern-layout');

Auth::routes();

