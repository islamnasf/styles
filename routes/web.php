<?php


use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\GallaryController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });
Route::middleware('guest')->group(function () {
Route::get('/', [AuthenticatedSessionController::class, 'create'])
                ;
            });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//Category
route::group(['prefix' => 'dashboard/category/'], function () {
    Route::get('show', [ControllersCategoryController::class, 'index'])->name('getCategory');
    Route::post('store', [ControllersCategoryController::class, 'store'])->name('storeCategory');
    Route::post('delete/{service}', [ControllersCategoryController::class, 'delete'])->name('deleteCategory');
    Route::post('update/{service}', [ControllersCategoryController::class, 'update'])->name('updateCategory');
    // Route::get('active/{service}', [ServiceController::class, 'toggle'])->name('activeCategory');
});
//sub category
route::group(['prefix' => 'dashboard/sub/category/'], function () {
    Route::get('show', [SubCategoryController::class, 'index'])->name('getSubCategory');
    Route::get('show/cat_id', [SubCategoryController::class, 'showSubcategories'])->name('showSubcategories');

    Route::post('store', [SubCategoryController::class, 'store'])->name('storeSubCategory');
    Route::post('delete/{service}', [SubCategoryController::class, 'delete'])->name('deleteSubCategory');
    Route::post('update/{service}', [SubCategoryController::class, 'update'])->name('updateSubCategory');
    // Route::get('active/{service}', [SubCategoryController::class, 'toggle'])->name('activeCategory');
});
//gallery
route::group(['prefix' => 'dashboard/gallery/'], function () {
    Route::get('show', [GallaryController::class, 'index'])->name('getGallery');
    Route::post('store', [GallaryController::class, 'store'])->name('storeGallery');
    Route::post('update/{service}', [GallaryController::class, 'update'])->name('updateGallery');
    Route::post('delete/{gallery}', [GallaryController::class, 'delete'])->name('deleteGallery');
});
//
Route::get('/pdfdownload/{fileName}', [GallaryController::class, 'download'])->name('pdfDownload');
//////////////









require __DIR__.'/auth.php';
