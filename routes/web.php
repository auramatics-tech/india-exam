<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\QuestionsController;
use App\Http\Controllers\Admin\DiscussionsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\PrivacyController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SubcategoriesController;
use App\Http\Controllers\Frontend\QuestionsAnswerController;
use App\Http\Controllers\Frontend\DiscussionController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\TypingtestController;



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
//Admin
Route::get('/admin', [LoginController::class, 'index'])->name('admin.home');
Route::post('/admin', [LoginController::class, 'authenticate'])->name('admin.login');

Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    //Dashboard
    // Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //Categoriesshow_subcategories
    Route::get('/categories', [CategoriesController::class, 'index'])->name('admin.Categories');
    Route::get('/create', [CategoriesController::class, 'create'])->name('admin.create');
    Route::post('/store', [CategoriesController::class, 'store'])->name('admin.store');
    Route::get('/category-delete/{id}', [CategoriesController::class, 'delete'])->name('admin.delete');
    Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('admin.edit');
    Route::get('/save-for-nav', [CategoriesController::class, 'save_for_nav'])->name('admin.save_for_nav');
    Route::get('/question/{id}', [CategoriesController::class, 'topic_question_get'])->name('admin.questioncat');
    Route::get('/questioncreate/{id}', [CategoriesController::class, 'create_question'])->name('admin.questioncreate');
    Route::post('/question_categories', [CategoriesController::class, 'question_categories'])->name('admin.question_categories');
    Route::post('/cat-active-update', [CategoriesController::class, 'cat_active_update'])->name('admin.cat_active_update');
    Route::post('/cat-drag-drop', [CategoriesController::class, 'cat_drag_drop'])->name('admin.cat_drag_drop');
    //Subcategory
    Route::post('/get-sub-cat', [CategoriesController::class, 'get_sub_cat'])->name('admin.get_sub_cat');
    Route::post('/get-topics', [CategoriesController::class, 'get_topics'])->name('admin.get_topics');
    Route::post('/get-subcat', [CategoriesController::class, 'get_subcategories'])->name('admin.get_subcategories');
    Route::post('/get-subcat1', [CategoriesController::class, 'get_subcategories1'])->name('admin.get_subcategories1');
    Route::post('/get-subcat2', [CategoriesController::class, 'get_subcategories2'])->name('admin.get_subcategories2');
    Route::get('/show-subcategories/{id}', [CategoriesController::class, 'show_subcategories'])->name('admin.show_subcategories');
    Route::get('/show-topics/{id}', [CategoriesController::class, 'show_topics'])->name('admin.show_topics');

    //Questions
    Route::get('/questions', [QuestionsController::class, 'index'])->name('admin.questions');
    Route::get('/create-questions', [QuestionsController::class, 'create'])->name('admin.create_questions');
    Route::post('/questions-store', [QuestionsController::class, 'store'])->name('admin.questions_store');
    Route::get('/questions-delete/{id}', [QuestionsController::class, 'delete'])->name('admin.questions_delete');
    Route::get('/questions-edit/{id}', [QuestionsController::class, 'edit'])->name('admin.questions_edit');
    Route::post('/active-update', [QuestionsController::class, 'active_update'])->name('admin.active_update');
    Route::get('/upload-images', [QuestionsController::class, 'upload_images'])->name('admin.upload_images');
    // Discussion
    Route::get('/discussion', [DiscussionsController::class, 'index'])->name('admin.discussion');
    Route::get('/discussion/{id}', [DiscussionsController::class, 'approved'])->name('admin.approved');
    Route::get('/discussion-delete/{id}', [DiscussionsController::class, 'delete'])->name('admin.discussion-delete');
    //Ckeditor
    Route::post('/ck-image', [CategoriesController::class, 'ckeditor_image'])->name('admin.ck_image');

    //settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/store-settings', [SettingsController::class, 'store_settings'])->name('admin.store_settings');
    //admin.terms
    Route::get('/privacy', [PrivacyController::class, 'index'])->name('admin.privacy');
    Route::get('/terms', [PrivacyController::class, 'terms'])->name('admin.terms');
    Route::post('/privacy-store', [PrivacyController::class, 'store_privacy'])->name('admin.store_privacy');
    Route::post('/terms-store', [PrivacyController::class, 'store_terms'])->name('admin.store_terms');


    Route::get('/categories/{type}/{id?}/{q?}', [CategoriesController::class, 'categories'])->name("category_data");

    // admin edit profile

    Route::get('/profile', [AdminController::class, 'index'])->name('admin.profile');
    Route::post('change-password', [AdminController::class, 'change_password'])->name('admin.change_password');
});
//Frontend
Auth::routes([
    'login' => false, // login Routes...
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sitemap', [SubcategoriesController::class, 'sitemap'])->name('sitemap');
Route::get('/topics/{id}', [SubcategoriesController::class, 'index'])->name('topics');
Route::get('/topic/{cat}', [SubcategoriesController::class, 'topics_with_cat'])->name('topics_cat');
Route::get('/sub_categories/{cat_id}', [SubcategoriesController::class, 'sub_categories'])->name('sub_categories');
Route::get('/questions/{id}', [QuestionsAnswerController::class, 'index'])->name('questions');
Route::get('/discussions/{question_id}', [DiscussionController::class, 'index'])->name('discussions');
Route::post('/check-ans', [QuestionsAnswerController::class, 'check_ans'])->name('check_ans');
Route::post('/discussions_form_save', [DiscussionController::class, 'form_save'])->name('discussions_form_save');
//typing
Route::get('/typing-test', [TypingtestController::class, 'typing_test'])->name('home.typing_test');
Route::get('/test-box', [TypingtestController::class, 'test_box'])->name('test_box');


// search
Route::get('/search', [SubcategoriesController::class, 'search'])->name('search');
Route::get('/Terms_and_condition', [SubcategoriesController::class, 'Terms_and_condition'])->name('Terms_and_condition');
Route::get('/Privacy_Policy', [SubcategoriesController::class, 'Privacy_Policy'])->name('Privacy_Policy');
Route::get('/searchindex', [SearchController::class, 'index'])->name('searchindex');
Route::get('/{category1}/{category2?}/{category3?}/{category4?}/{category5?}', [HomeController::class, 'categories'])->name('home.data');



