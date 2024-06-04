<?php

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\EdulinksController;
use App\Http\Controllers\EnrollsController;
use App\Http\Controllers\GendersController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostsLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelativesCotroller;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StagesController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TypesController;
use App\Models\Enroll;
use App\Models\Status;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboards',[DashboardsController::class,'index'])->name('dashboard.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('announcements',AnnouncementsController::class);
    Route::resource('attendances',AttendancesController::class);
    Route::resource('categories',CategoriesController::class);
    Route::resource('contacts',ContactsController::class);
    Route::resource('cities',CitiesController::class);
    Route::resource('comments',CommentsController::class);
    Route::resource('countries',CountriesController::class);
    Route::resource('days',DaysController::class);
    Route::resource('edulinks',EdulinksController::class);
    Route::resource('enrolls',EnrollsController::class);
    Route::resource('genders',GendersController::class);
    Route::resource('leaves',LeavesController::class);

    Route::resource('posts',PostsController::class);
    Route::post('posts/{post}/like',[PostsLikeController::class,'like'])->name('posts.like');
    Route::post('posts/{post}/unlike',[PostsLikeController::class,'unlike'])->name('posts.unlike');

    Route::resource('relatives',RelativesCotroller::class);
    Route::resource('roles',RolesController::class);

    Route::resource('stages',StagesController::class);
    Route::get('stagesstatus',[StagesController::class,'typestatus']);

    Route::resource('statuses',StatusesController::class);
    Route::resource('students',StudentsController::class);
    Route::post('compose/mailbox',[StudentsController::class,'mailbox'])->name('students.mailbox');

    Route::resource('tags',TagsController::class);

    Route::resource('types',TypesController::class);
    Route::get('typesstatus',[TypesController::class,'typestatus']);

});

require __DIR__.'/auth.php';
