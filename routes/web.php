<?php

use Illuminate\Support\Facades\Route;


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
    return view('welcome');
});


// Login
Route::get('/', 'App\Http\Controllers\ConnectController@getLogin');
Route::post('/', 'App\Http\Controllers\ConnectController@postLogin'); 

// logout
Route::get('/logout', 'App\Http\Controllers\ConnectController@getLogout');

// registrar usuario
Route::get('/register', 'App\Http\Controllers\ConnectController@getRegister')->name('register'); //ruta para llamar el login
Route::post('/register', 'App\Http\Controllers\ConnectController@postRegister')->name('register');

// home
Route::get('/home', 'App\Http\Controllers\ConnectController@getHome');

// 
// USUARIOS
// 

// agregar nuevo usuario
Route::get('/user/adduser', 'App\Http\Controllers\UserController@getAddUser')->middleware('auth');
Route::post('/user/adduser', 'App\Http\Controllers\UserController@postAddUser')->middleware('auth');

// lista de usuarios
Route::get('/user/listuser', 'App\Http\Controllers\UserController@getListUser')->middleware('auth');

// editar usuario
Route::get('/user/{id}/edit', 'App\Http\Controllers\UserController@getEditUser')->middleware('auth');
Route::post('/user/{id}/edit', 'App\Http\Controllers\UserController@postEditUser')->middleware('auth');

// eliminar usuario
Route::get('/user/{id}/delete', 'App\Http\Controllers\UserController@getDeleteUser')->middleware('auth');


// 
// PRODUCTOS
// 

// agregar nuevo producto
Route::get('/product/addproduct', 'App\Http\Controllers\ProductController@getAddProduct')->middleware('auth');
Route::post('/product/addproduct', 'App\Http\Controllers\ProductController@postAddProduct')->middleware('auth');

// productos en stock
Route::get('/product/productsinstock', 'App\Http\Controllers\ProductController@getProductsInStock')->middleware('auth');

// editar producto
Route::get('/product/{id}/edit', 'App\Http\Controllers\ProductController@getEditProduct')->middleware('auth');
Route::post('/product/{id}/edit', 'App\Http\Controllers\ProductController@postEditProduct')->middleware('auth');

// eliminar producto
Route::get('/product/{id}/delete', 'App\Http\Controllers\ProductController@getDeleteProduct')->middleware('auth');

// productos en sotck minimo
Route::get('/product/productsinminstock', 'App\Http\Controllers\ProductController@getProductsInMinStock')->middleware('auth');

// generar codigo de barras
Route::get('/product/generatebarcode', 'App\Http\Controllers\ProductController@getGenerateBarCode')->middleware('auth');
Route::post('/product/generatebarcode', 'App\Http\Controllers\ProductController@postGenerateBarCode')->middleware('auth');

// lista de codigos de barras
Route::get('/product/listbarcode', 'App\Http\Controllers\ProductController@getListBarCode')->middleware('auth');

// detalle de codigo de barras
Route::get('/product/{id}/detailbarcode', 'App\Http\Controllers\ProductController@getDetailBarCode')->middleware('auth');

// generar ticket de codigo de barras
Route::get('/product/{id}/ticketbarcode', 'App\Http\Controllers\ProductController@getGenerateTicketBarCode')->middleware('auth');

// 
// VENTAS
// 

// seleccionar el tipo de venta
Route::get('/sale/selectnewsale', 'App\Http\Controllers\SaleController@getSelectNewSale')->middleware('auth');

// venta - consumidor final
Route::post('/sale/newsalecf', 'App\Http\Controllers\SaleController@postNewSaleCF')->middleware('auth');

// agregar productos a la venta - consumidor final
Route::get('/sale/{id}/addnewsalecf', 'App\Http\Controllers\SaleController@getAddSaleProductCF')->middleware('auth');

// agregar nuevo producto a la venta - consumidor final
Route::post('/sale/{id}/addnewsaleproductcf', 'App\Http\Controllers\SaleController@postAddNewSaleProductCF')->middleware('auth');

// eliminar producto de la venta - consumidor final
Route::get('/sale/{id}/deletesaleproductcf', 'App\Http\Controllers\SaleController@getDeleteSaleProductCF')->middleware('auth');

// buscar producto para la venta - consumidor final
Route::post('/sale/{id}/searchproductcf', 'App\Http\Controllers\SaleController@postSearchProductDetailCF')->middleware('auth');

// confirmar venta - consumidor final
Route::post('/sale/addnewsaleconfirmcf', 'App\Http\Controllers\SaleController@postAddNewSaleConfirmCF')->middleware('auth');

// cancelar venta - consumidor final
Route::get('/sale/{id}/cancelnewsalecf', 'App\Http\Controllers\SaleController@getCancelNewSaleCF')->middleware('auth');

// historial de ventas
Route::get('/sale/listsales', 'App\Http\Controllers\SaleController@getListSales')->middleware('auth');

// filtrar ventas por fecha
Route::get('/sale/filterdate', 'App\Http\Controllers\SaleController@getFilterDateSale')->middleware('auth');
Route::post('/sale/filterdate', 'App\Http\Controllers\SaleController@postFilterDateSale')->middleware('auth');

// detalle de venta
Route::get('/sale/{id}/saledetail', 'App\Http\Controllers\SaleController@getSaleDetail')->middleware('auth');

// generar pdf ventas
Route::get('/sale/{id}/getpdf', 'App\Http\Controllers\SaleController@getPDF')->middleware('auth');

// venta - cuenta corriente
Route::get('/sale/newsaleca', 'App\Http\Controllers\SaleController@getNewSaleCA')->middleware('auth');
Route::post('/sale/newsaleca', 'App\Http\Controllers\SaleController@postNewSaleCA')->middleware('auth');

// detalles de nueva venta - Cuenta corriente
Route::get('/sale/{id}/addsaleproductsca', 'App\Http\Controllers\SaleController@getAddSaleProductsCA')->middleware('auth');

// agregar producto a la venta - Cuenta corriente
Route::post('/sale/{id}/addnewsaleproductca', 'App\Http\Controllers\SaleController@postAddNewSaleProductCA')->middleware('auth');

// quitar producto de la venta - Cuenta corriente
Route::get('/sale/{id}/deletesaleproductca', 'App\Http\Controllers\SaleController@getDeleteSaleProductCA')->middleware('auth');

// guardar venta - Cuenta corriente
Route::post('/sale/addnewsaleconfirmca', 'App\Http\Controllers\SaleController@postAddNewSaleConfirmCA')->middleware('auth');

// cancelar venta - Cuenta corriente
Route::get('/sale/{id}/cancelnewsaleca', 'App\Http\Controllers\SaleController@getCancelNewSaleCA')->middleware('auth');

// imprimir
Route::get('/sale/print', 'App\Http\Controllers\SaleController@getPrint')->middleware('auth');

// generar ticket
Route::get('/sale/{id}/getticket', 'App\Http\Controllers\SaleController@getTicket')->middleware('auth');


// 
// PRESUPUESTOS
// 

// nuevo presupuesto
Route::get('/budget/newbudget', 'App\Http\Controllers\BudgetController@getNewBudget')->middleware('auth');
Route::post('/budget/newbudget', 'App\Http\Controllers\BudgetController@postNewBudget')->middleware('auth');

// generar presupuesto
Route::get('/budget/{id}/addbudgetproducts', 'App\Http\Controllers\BudgetController@getAddBudgetProducts')->middleware('auth');

// agregar productos al presupuesto
Route::post('/budget/{id}/addnewbudgetproduct', 'App\Http\Controllers\BudgetController@postAddNewBudgetProduct')->middleware('auth');

// eliminar producto del presupuesto
Route::get('/budget/{id}/deletebudgetproduct', 'App\Http\Controllers\BudgetController@getDeleteBudgetProduct')->middleware('auth');

// confirmar presupuesto
Route::post('/budget/addnewbudgetconfirm', 'App\Http\Controllers\BudgetController@postAddNewBudgetConfirm')->middleware('auth');

// cancelar presupuesto
Route::get('/budget/{id}/cancelnewbudget', 'App\Http\Controllers\BudgetController@getCanceNewBudget')->middleware('auth');

// lista de presupuestos
Route::get('/budget/listbudget', 'App\Http\Controllers\BudgetController@getListBudget')->middleware('auth');

// detalle de presupuestos
Route::get('/budget/{id}/budgetdetail', 'App\Http\Controllers\BudgetController@getBudgetDetail')->middleware('auth');

// generar PDF
Route::get('/budget/{id}/getpdf', 'App\Http\Controllers\BudgetController@getPDF')->middleware('auth');

// imprimir ticket
Route::get('/budget/{id}/getticketbudget', 'App\Http\Controllers\BudgetController@getTicketBudget')->middleware('auth');



// 
// CLIENTES
// 

// agregar nuevo cliente en ventas
Route::post('/client/addnewclientsale', 'App\Http\Controllers\ClientController@postAddNewClientSale')->middleware('auth');

// agregar nuevo cliente
Route::get('/client/addnewclient', 'App\Http\Controllers\ClientController@getAddNewClient')->middleware('auth');
Route::post('/client/addnewclient', 'App\Http\Controllers\ClientController@postAddNewClient')->middleware('auth');

// lista de cliente
Route::get('/client/listclient', 'App\Http\Controllers\ClientController@getListClient')->middleware('auth');

// editar cliente
Route::get('/client/{id}/edit', 'App\Http\Controllers\ClientController@getEditClient')->middleware('auth');
Route::post('/client/{id}/edit', 'App\Http\Controllers\ClientController@postEditClient')->middleware('auth');

// eliminar cliente
Route::get('/client/{id}/delete', 'App\Http\Controllers\ClientController@getDeleteClient')->middleware('auth');


// 
// CUENTA CORRIENTE
// 

// lista de cuentas corrientes
Route::get('/currentaccount/listcurrentaccount', 'App\Http\Controllers\CurrentAccountController@getListCA')->middleware('auth');

// cobrar cuenta corriente
Route::post('/currentaccount/{id}/payca', 'App\Http\Controllers\CurrentAccountController@postPayCA')->middleware('auth');

// agregar intereses a cuenta corriente
Route::post('/currentaccount/{id}/addinterests', 'App\Http\Controllers\CurrentAccountController@postAddInterestsCA')->middleware('auth');

// detalle de cuenta corriente
Route::get('/currentaccount/{id}/cadetail', 'App\Http\Controllers\CurrentAccountController@getDetailCA')->middleware('auth');

// detalle de cada venta guardada en la cuenta corriente
Route::get('/currentaccount/{id}/detailsale', 'App\Http\Controllers\CurrentAccountController@getDetailSaleCA')->middleware('auth');

// generar PDF con detalles de la cuenta corriente
Route::get('/currentaccount/{id}/getpdf', 'App\Http\Controllers\CurrentAccountController@getPFDetailCA')->middleware('auth');

// imprimir ticket con detalles de la cuenta corriente
Route::get('/currentaccount/{id}/getticketca', 'App\Http\Controllers\CurrentAccountController@getTicketCA')->middleware('auth');
