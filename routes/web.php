<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxResponeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CExpertise\CExpertiseController;
use App\Http\Controllers\CSupply\CSupplyController;
use App\Http\Controllers\Quote\QuoteController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\SupplyBuying\SupplyBuyingController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\ProductWarehouse\ProductWarehouseController;
use App\Http\Controllers\ReportController;

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

//Auth route
Route::get('permission-error', [AdminController::class, 'permissionError']);
Route::any('login', [AuthController::class, 'login']);
Route::any('logout', [AuthController::class, 'logout']);
Route::get('get-password-remembered', [AdminController::class, 'getPasswordRemembered']);

//dev route
Route::any('dev/{method}',[DevController::class, 'index']);
Route::middleware(['check_login'])->group(function () {

	//Admin route
	Route::get('/',[HomeController::class, 'index']);
	Route::get('view/{table}', [AdminController::class, 'view']);
	Route::any('insert/{table}', [AdminController::class, 'insert']);
	Route::any('update/{table}/{id}', [AdminController::class, 'update']);
	Route::get('search-table/{table}', [AdminController::class, 'searchTable']);
	Route::any('clone/{table}/{id}', [AdminController::class, 'clone']);
	Route::delete('remove', [AdminController::class, 'remove']);
	Route::delete('multiple-remove', [AdminController::class, 'multipleRemove']);
	Route::post('do-config-data/{table}', [AdminController::class, 'doConfigData']);
	Route::get('get-data-json-customer', [AdminController::class, 'getDataJsonCustomer']);
	Route::get('get-data-json-linking', [AdminController::class, 'getDataJsonLinking']);
	Route::any('config-device-price/{step}', [AdminController::class, 'configDevicePrice']);
	Route::get('get-list-option-ajax/{table}', [AdminController::class, 'getListOptionAjax']);
	Route::get('option-ajax-child/{table}/{field}', [AdminController::class, 'optionChildData']);
	Route::post('file-upload', [AdminController::class, 'fileUpload']);
	Route::any('file-download', [AdminController::class, 'fileDownload']);
	Route::get('list-worker-by-device/{step}', [AdminController::class, 'listWorkerByDevice']);
	Route::get('get-device-by-type', [QuoteController::class, 'getDeviceByType']);
	Route::get('warehouse-management', [AdminController::class, 'warehouseManagement']);
	Route::get('supply-origin-management', [AdminController::class, 'supplyOriginManagement']);
	Route::get('get-all-supply-product', [AdminController::class, 'getAllSupplyProduct']);
	Route::post('upload-chunnked-file', [AdminController::class, 'uploadChunnkedFile']);
	Route::any('change-password', [AuthController::class, 'changePassword']);
	Route::any('account-detail', [AuthController::class, 'accountDetail']);
	Route::get('history-detail/{id}', [AdminController::class, 'historyDetail']);
	Route::get('history-table/{table}', [AdminController::class, 'historyTable']);
	Route::get('export/{table}', [AdminController::class, 'exportTable']);
	Route::post('import-excel/{table}', [AdminController::class, 'importExcel']);
	Route::get('add-linking-data', [AdminController::class, 'addLinkingData']);
	Route::any('ajax-respone/{method}', [AjaxResponeController::class, 'index']);
	Route::any('notify-process/{id}', [NotifyController::class, 'notifyProcess']);
	Route::any('report/{method}', [ReportController::class, 'index']);
	Route::get('export-data-debt/{table}', [AdminController::class, 'exportDataDebt']);

	//quotes routes
	Route::get('search-pattern', [QuoteController::class, 'searchPattern']);
	Route::get('create-quote-by-products', [QuoteController::class, 'createByProduct']);
	Route::any('create-quote', [QuoteController::class, 'createQuote']);
	Route::get('get-view-customer-data', [QuoteController::class, 'getViewCustomerData']);
	Route::get('get-view-product-quantity', [QuoteController::class, 'getViewProductQuantity']);
	Route::get('add-supply-quote', [QuoteController::class, 'addSupplyQuote']);
	Route::get('add-fill-finish-quote', [QuoteController::class, 'addFillFinishQuote']);
	Route::get('compute-paper-size', [QuoteController::class, 'computePaperSize']);
	Route::get('get-view-product-structure', [QuoteController::class, 'getViewProductStructure']);
	Route::any('profit-config-quote', [QuoteController::class, 'profitConfigQuote']);
	Route::get('get-view-product-structure-data', [QuoteController::class, 'getViewProductStructureData']);
	Route::any('quote-file-export/{id}', [QuoteController::class, 'QuoteFileExport']);
	Route::any('send-quote/{id}', [QuoteController::class, 'sendQuote']);
	Route::any('apply-quote/{id}', [QuoteController::class, 'applyQuote']);
	Route::get('get-after-print-view', [QuoteController::class, 'getAfterPrintView']);
	Route::get('suggest-product-submited-by-size', [QuoteController::class, 'suggestProductSubmitedBySize']);
	Route::get('get-view-made-by-product', [QuoteController::class, 'getViewMadeByProduct']);
	Route::post('process-data-represent/{customer}', [CustomerController::class, 'processDataRepresent']);

	//orders routes
	Route::post('apply-order/{stage}/{type}/{id}', [OrderController::class, 'applyOrder']);
	Route::post('receive-command/{table}/{id}', [OrderController::class, 'receiveCommand']);
	Route::any('supply-handle', [OrderController::class, 'supplyHandle']);
	Route::any('supply-handmade', [OrderController::class, 'supplyHandMade']);
	Route::post('take-in-supply/{id}', [OrderController::class, 'takeInSupply']);
	Route::post('apply-to-worker-handle/{table}/{id}', [OrderController::class, 'applyToWorkerHandle']);
	Route::any('apply-supply-to-worker', [OrderController::class, 'applySupplyToWorker']);
	Route::get('select-supply-warehouse/{table}', [OrderController::class, 'selectSupplyWarehouse']);
	Route::get('add-select-supply-handle', [OrderController::class, 'addSelectSupplyHandle']);
	Route::get('list-supply-process', [ProductController::class, 'listSupplyProcess']);
	Route::get('print-data/{table}/{id}', [OrderController::class, 'printData']);
	Route::any('join-print-command', [ProductController::class, 'joinPrintCommand']);
	Route::any('list-print-joined', [ProductController::class, 'listPrintJoined']);
	Route::get('profit-config-data', [OrderController::class, 'profitConfigData']);
	Route::any('order-delivery/{id}', [OrderController::class, 'orderDelivery']);
	Route::any('order-debt', [OrderController::class, 'orderDebt']);

	//supply warehouse
	Route::get('add-supply-buying', [SupplyBuyingController::class, 'addSupplyBuying']);
	Route::post('confirm-supply-bought/{status}/{id}', [SupplyBuyingController::class, 'confirmSupplyBought']);
	Route::post('confirm-warehouse-imported/{id}', [SupplyBuyingController::class, 'confirmWarehouseImported']);
	Route::get('list-supply-buying/{id}', [SupplyBuyingController::class, 'listSupplyBuying']);
	Route::get('get-quantitative-inpaper', [SupplyBuyingController::class, 'getQuantitativeInPaper']);
	Route::get('inventory-aggregate', [SupplyBuyingController::class, 'inventoryAggregate']);
	Route::get('inventory-detail', [SupplyBuyingController::class, 'inventoryDetail']);
	Route::get('inventory-export', [SupplyBuyingController::class, 'inventoryExport']);
	Route::get('field-search-supply-history', [SupplyBuyingController::class, 'fieldSearchHistory']);
	Route::get('get-view-buying-supply-type', [SupplyBuyingController::class, 'getViewBuyingSupplyType']);
	Route::get('qty-by-supply-type', [CSupplyController::class, 'qtyBySupplyType']);
	Route::post('take-out-supply/{id}', [CSupplyController::class, 'takeOutSupply']);
	Route::post('re-import-emulsion/{id}', [CSupplyController::class, 'reImportEmulsion']);
	Route::get('list-product-warehouse/{id}', [ProductController::class, 'listProductWaehouse']);
	Route::any('supply-debt', [SupplyBuyingController::class, 'supplyDebt']);

	//KCS route
	Route::post('after-print-kcs/{id}',[ProductController::class, 'afterPrintKcs']);
	Route::any('kcs-take-in-req/{id}', [ProductController::class, 'KCSTakeInRequirement']);
	Route::any('product-require-rework/{id}', [ProductController::class, 'productRequireRework']);

	//product warehouse route
	Route::any('confirm-product-warehouse/{id}', [CExpertiseController::class, 'confirmProductWarehouse']);
	Route::get('product-warehouse-history/{product_id}', [CExpertiseController::class, 'productWarehouseHistory']);
	Route::get('product-warehouse-inventory', [ProductWarehouseController::class, 'inventory']);
	Route::get('product-inventory-detail', [ProductWarehouseController::class, 'inventoryDetail']);
	Route::get('product-warehouses-export-inventory', [ProductWarehouseController::class, 'inventoryExport']);
});
$modules_path = dirname(__DIR__) . '/app/Modules/';
if (is_dir($modules_path)) {
	$modules = scandir($modules_path);
	foreach ($modules as $module) {
		if (is_dir($modules_path) . '/' . $module) {
			$routes_path = $modules_path . $module . '/Routes/web.php';
			if (file_exists($routes_path)) {
				require $routes_path;
			}
		}
	}
}
