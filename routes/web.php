<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

Route::get("/",[PageController::class,"showIndex"]);
Route::get("/signup",[PageController::class,"showSignUp"]);
Route::get("/login",[PageController::class,"showLogin"])->name("login");
Route::get("/admin-register",[PageController::class,"showAdminRegister"]);
Route::get("/admin-login",[PageController::class,"showAdminLogin"]);
Route::get("/user",[PageController::class,"showUserDashboard"])->middleware("auth");
Route::get("/admin",[PageController::class,"showAdminDashboard"])->middleware("admin");
Route::get("/admin-edit-details",[PageController::class,"showAdminEditDashboard"])->middleware("admin");

Route::get("/cars/list",[PageController::class,"showAllCars"])->middleware("auth");
Route::get("/cars/list/filter",[PageController::class, "showFilteredCars"])->middleware("auth");
Route::get("/my-wishlist",[PageController::class,"showWishlistedCars"])->middleware("auth");
Route::get("/my-orders",[PageController::class, "showUserOrders"])->middleware("auth");
Route::get("/my-past-orders",[PageController::class, "showUserPastOrders"])->middleware("auth");
Route::get("/rent-vehicle",[PageController::class, "showRentPage"])->middleware("auth");
Route::post("/confirm-rent",[AuthController::class, "userRentVehicle"])->middleware("auth");
Route::get("/invoice/{rental}", [AuthController::class, "showUserInvoice"])->middleware("auth");

Route::post("/remove-user-wishlist",[AuthController::class,"removeCarWishlist"])->middleware("auth");
Route::post("/return-vehicle",[AuthController::class, "returnUserCar"])->middleware("auth");

Route::post("/add-user-wishlist",[AuthController::class,"addCarWishlist"])->middleware("auth");
Route::get("/edit-profile-form",[PageController::class,"editUserDetails"])->middleware("auth");
Route::post("/update-user-details",[AuthController::class, "updateUserDetails"])->middleware("auth");
Route::post("/delete-user-account",[AuthController::class,"deleteUser"])->middleware("auth");

//temp
Route::get("/compare",[PageController::class,"showCompare"]);

Route::get('/reviews', [PageController::class, 'showAllReviews']);
Route::get('/comparisons',[PageController::class, "showAllComparisons"]);
Route::get('/electric-cars',[PageController::class,"showElectricCars"]);

Route::get("/comparisons/{slug}",[ComparisonController::class, "show"]);
Route::get('/reviews/{slug}', [ReviewController::class, 'show']);
Route::get('/communities',[PageController::class,"showCommunities"])->middleware("auth");
Route::get("/communities/filter",[PageController::class,"showCommunitiesFilter"])->middleware("auth");
Route::get('/communities/{slug}', [CommunityController::class, 'show'])->middleware("auth");
Route::post("/community-post", [CommunityController::class,"storePost"])->middleware("auth");
Route::post("/community-reply", [CommunityController::class,"storeReply"])->middleware("auth");

Route::get("/user-profile/{id}",[ProfileController::class,"show"])->middleware(["auth","completedRentalOnly"]);

Route::get("/custom-comparison",[PageController::class,"showCustomComparison"]);
Route::get("/filter-reviews",[PageController::class,"showFilteredReviews"]);

Route::post("/admin-login-validate",[AdminController::class,"login"])->name("admin.validate");
Route::post("/admin-logout",[AdminController::class,"logout"])->name("admin.logout");

Route::post("/admin-edit-review",[AdminController::class,"editReview"])->middleware("admin");
Route::post("/admin-edit-highlight",[AdminController::class,"editHighlight"])->middleware("admin");

Route::post("/admin-delete-details",[AdminController::class,"deleteDetails"])->middleware("admin");

// The ->name() method assigns a unique name to the route.
// This lets us reference the route easily in Blade templates, redirects, or URL generation
// without hardcoding the actual path (e.g., route('login') instead of '/login').
Route::post("/register",[AuthController::class,"register"])->name("register");
Route::post("/register-admin",[AdminController::class,"registerAdmin"])->name("registerAdmin");
Route::post("/login",[AuthController::class,"login"])->name("login_account");
Route::post("/logout",[AuthController::class,"logout"])->name("logout");


Route::post('/admin/review', [AdminController::class, 'storeReview'])->middleware("admin")->name('admin.storeReview');

Route::post("/admin/car-highlights",[AdminController::class,"storeHighlight"])->middleware("admin")->name("admin.storeHighlight");

Route::post("/admin/car-comparison",[AdminController::class,"storeComparison"])->middleware("admin")->name("admin.storeComparison");

Route::get("/all-admin-orders",[PageController::class,"showAllAdminOrders"])->middleware("admin");

Route::get("/all-admin-past-orders",[PageController::class,"showAllAdminPastOrders"])->middleware("admin");

Route::get("/admin-all-communities",[PageController::class,"showAdminCommunities"])->middleware("admin");
Route::get("/admin-all-communities/{slug}",[CommunityController::class, "showAdminCarCommunity"])->middleware("admin");

Route::post("/delete-admin-post",[CommunityController::class,"deleteAdminPost"])->middleware("admin");

Route::post("/delete-admin-reply",[CommunityController::class,"deleteAdminReply"])->middleware("admin");

Route::post("/approve-vehicle",[AdminController::class, "markApproved"])->middleware("admin");

Route::post("/active-vehicle",[AdminController::class, "markActive"])->middleware("admin");

Route::post("/completed-vehicle",[AdminController::class, "markCompleted"])->middleware("admin");

Route::get("/all-admin-users", [PageController::class, "showAllAdminUsers"])->middleware("admin");

Route::post("/remove-user", [AdminController::class, "removeAdminUser"])->middleware("admin");

Route::get("/user-rental-history/{id}",[PageController::class,"showRentalHistory"])->middleware("admin");


// Show forgot password form
Route::get('/forgot-password', [PageController::class, "showForgotPassword"])->middleware('guest');


// Handle email submission
Route::post('/forgot-password', [PageController::class, "handleForgotPassword"])->middleware('guest')->name('password.email');


// Show reset password form
Route::get('/reset-password/{token}', [PageController::class, "showResetPassword"])->middleware('guest')->name('password.reset');


// Handle new password
Route::post('/reset-password', [PageController::class, "handleNewPassword"])->middleware('guest')->name('password.update');