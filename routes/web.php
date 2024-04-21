<?php

use App\Http\Controllers\ProfileController;
use App\Models\Course;
use Core\Admin\Handlers\ContactCreate;
use Core\Admin\Handlers\FaqCreate;
use Core\Admin\Handlers\TestimonialCreate;
use Core\Admin\Handlers\TestimonialDelete;
use Core\Admin\Handlers\TestimonialsList;
use Core\Admin\Handlers\TestimonialUpdate;
use Core\Frontend\Handlers\AboutPageHandler;
use Core\Frontend\Handlers\ContactUsCreate;
use Core\Frontend\Handlers\ContactUsShow;
use Core\Frontend\Handlers\HomePageHandler;
use Core\LmsLite\DataObjects\CourseData;
use Core\LmsLite\Handlers\AdminListTeacherCourses;
use Core\LmsLite\Handlers\AdminListTeachers;
use Core\LmsLite\Handlers\AdminTeacherCreate;
use Core\LmsLite\View\Cells\TableCell;
use Core\LmsLite\View\CourseTableTest;
use Illuminate\Support\Facades\Route;

/*
 * Public routes
 */
// Home page
Route::get('/', [HomePageHandler::class, '__invoke'])
    ->name("home");

// About page
Route::get('/why_us', [AboutPageHandler::class, '__invoke'])
    ->name("why_us");

// Contact page
Route::get('/contact', [ContactUsShow::class, '__invoke'])
    ->name("contact");
// Contact form submission
Route::post('/contact', [ContactCreate::class, '__invoke'])
    ->name("contact.store");
// Frequently asked questions
Route::get('/faq', fn() => view('faq'))
    ->name("faq");

/*
 * Admin Dashboard
 * */
Route::middleware(['auth'/*, 'admin'*/])
    ->prefix('/admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('dashboard'))
            ->name('dashboard');

        Route::get('/courses', [AdminListTeacherCourses::class, 'getAllCourses'])
            ->name('courses');

        // List teachers
        Route::get('/teachers', [AdminListTeachers::class, '__invoke'])
            ->name('teachers');
        // create teacher
        Route::get('/teachers/create', [AdminTeacherCreate::class, '__invoke'])
            ->name('teachers.create');


        // List courses of a teacher
        Route::get('/teachers/{teacher}/courses', [AdminListTeacherCourses::class, '__invoke'])
            ->name('teachers.courses');

        // Frequently asked questions Crud
        Route::get('/faq', fn() => view('admin.faq.index'))
            ->name('faq');
        /*Route::get('/faq/create', fn() => view('admin.faq.create'))
            ->name('faq.create');*/
        Route::post('/faq', [FaqCreate::class, '__invoke'])
            ->name('faq.store');


        // testimonials Crud
        Route::get('/testimonials', [TestimonialsList::class, '__invoke'])
            ->name('testimonials');
        /*Route::get('/testimonials/create', fn() => view('admin.testimonials.create'))
            ->name('testimonials.create');*/
        Route::post('/testimonials', [TestimonialCreate::class, '__invoke'])
            ->name('testimonials.store');
        /*Route::get('/testimonials/{testimonial}/edit', [TestimonialCreate::class, 'edit'])
            ->name('testimonials.edit');*/
        Route::patch('/testimonials/{testimonial}', [TestimonialUpdate::class, '__invoke'])
            ->name('testimonials.update');
        Route::delete('/testimonials/{testimonial}', [TestimonialDelete::class, '__invoke'])
            ->name('testimonials.destroy');

        // Contact messages Crud
        Route::get('/contact', fn() => view('admin.contact.index'))
            ->name('contact');
        Route::get('/contact/{contact}', [ContactUsShow::class, '__invoke'])
            ->name('contact.show');
        Route::delete('/contact/{contact}', [ContactUsCreate::class, '__invoke'])
            ->name('contact.destroy');

    });

/*
 * Teacher Dashboard
 * */
Route::middleware(['auth'/*, 'teacher'*/])
    ->prefix('/teacher')
    ->as('teacher.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('dashboard'))
            ->name('dashboard');
    });

/*
 * Authenticated routes
 */
Route::middleware('auth')
    ->group(function () {
        Route::get('/dashboard', fn() => view('dashboard'))->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__.'/auth.php';

