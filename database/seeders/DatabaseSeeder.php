<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Faq;
use App\Models\Teacher;
use App\Models\Testimonial;
use App\Models\User;
use Core\Admin\DataObjects\TestimonialData;
use Core\Frontend\DTO\FaqData;
use Core\LmsLite\DataObjects\CourseData;
use Core\LmsLite\DataObjects\TeacherData;
use Core\LmsLite\Enums\CourseStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Teacher Boo',
            'email' => 'boo@mail.com',
        ]);*/
        $this->seedTeachers();

        $this->seedTestimonials();

        $this->seedFaqs();

        $this->seedCourses();
    }

    /**
     * @return void
     */
    public function seedTeachers(): void
    {
        $techersData = TeacherData::collect([
            [
                'first_name' => 'Boutheyna',
                'last_name' => 'Fetatnia',
                'nick_name' => 'Miss.Boo',
                'email' => 'boo@mail.com',

                'role' => ['founder', 'teacher', 'admin'],
                'phone' => '0555555555',
                'imageUrl' => asset('images/teachers/boutheyna.png'),
                'description' => 'Boutheyna is the founder of LearnBoo Academy. She is a teacher and an admin. She is a very good teacher and she is very patient with her students. She is very good at explaining things in a way that is easy to understand. She is very good at helping her students to improve their English skills. She is very good at helping her students to build their confidence. She is very good at helping her students to achieve their goals. She is very good at helping her students to improve their English skills. She is very good at helping her students to build their confidence. She is very good at helping her students to achieve their goals. She is very good at helping her students to improve their English skills. She is very good at helping her students to build their confidence. She is very good at helping her students to achieve their goals. She is very good at helping her students to improve their English skills. She is very good at helping her students to build their confidence. She is very good at helping her students to achieve their goals.',
                'about' => "-LearnBoo! founder.\n– Over 5 years Experience teaching english as a foreign language with students from\n(Algeria, Morocco, Tunisia, Syria, indonesia, Malaysia, france … etc)\n– Digital creator of Educational content on Tikitok and Instagram\n– Masters in English Language culture and literature.\n– Tefl Certified teacher\n",
                'social' => [
                    'instagram' => 'https://www.instagram.com/teacher_boo__/',
                    'linkedin' => 'https://www.linkedin.com/in/boutheynafetatnia',
                ],
                'user_id' => 1,
            ],
            [
                'first_name' => 'Nidal',
                'last_name' => 'Oudainia',
                'nick_name' => 'Coach N',
                'email' => 'nidal@mail.com',

                'role' => ['admission responsible', 'teacher'],
                'phone' => '0555555555',
                'imageUrl' => asset('images/teachers/nidal_oudainia.jpg'),
                'description' => 'Nidal is a teacher and an admission responsible. He is a very good teacher and he is very patient with his students. He is very good at explaining things in a way that is easy to understand. He is very good at helping his students to improve their English skills. He is very good at helping his students to build their confidence. He is very good at helping his students to achieve their goals. He is very good at helping his students to improve their English skills. He is very good at helping his students to build their confidence. He is very good at helping his students to achieve their goals. He is very good at helping his students to improve their English skills. He is very good at helping his students to build their confidence. He is very good at helping his students to achieve their goals. He is very good at helping his students to improve their English skills. He is very good at helping his students to build their confidence. He is very good at helping his students to achieve their goals.',
                'about' => "- Over 6 years experience in teaching as a personal trainer, with renowned institutions, and with corporate clients across the country.\n- Multilingual Diplomatic Interpreter and Translator..\n- Masters in interpreting from the Institute of Translation - Algiers II..\n- United Nations linguistic section trained..\n- Embraces the learn-through-fun approach, very interactive and empathetic, and coaches the groups/individuals with remarkable enthusiasm..\n",
                'social' => [
                    'instagram' => 'https://www.instagram.com/nidalsgallery/',
                    'linkedin' => 'https://www.linkedin.com/in/nidaloudainia',
                ],
                'user_id' => 2,
            ],
            [
                'first_name' => 'Lydia',
                'last_name' => 'Azrarak',
                'nick_name' => '....',
                'email' => 'lydia@mail.com',

                'role' => ['admission responsible', 'teacher'],
                'phone' => '0555555555',
                'imageUrl' => 'https://placehold.co/400',
                'description' => 'Lydia is a teacher and an admission responsible. She is a very good teacher and she is very patient with her students. She is very good at explaining things in a way that is easy to understand. She is very good at helping her students to improve their English skills. She is very good at helping her students to build their confidence. She is very good at helping her students to achieve their goals. She is very good at helping her students to improve their English skills. She is very good at helping her students to build their confidence. She is very good at helping her students to achieve their goals. She is very good at helping her students to improve their English skills. She is very good at helping her students to build their confidence. She is very good at helping her students to achieve their goals. She is very good at helping her students to improve their English skills. She is very good at helping her students to build their confidence. She is very good at helping her students to achieve their goals.',
                'about' => "- A Nationall Teaching School graduate and a Didactics student.\n- Over 2 years experience in teaching English as a foreign language online to international francophone students (Canada, France, and Algeria) Personalized and creative Lessons, tailored to meet your unique needs.\n",
                'social' => [
                    'instagram' => 'https://www.instagram.com/lydiazrarak',
                    'linkedin' => 'https://www.linkedin.com/in/lydia-azrarak-11960521b',
                ],
                'user_id' => 3,
            ]
        ]);

        foreach ($techersData as $item) {
            $user = User::factory()->create([
                'name' => $item->nick_name,
                'email' => $item->email,
            ]);
            $teacher = Teacher::create([
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'email' => $item->email,

                'role' => $item->role,
                'nick_name' => $user->name,
                'phone' => $item->phone,
                'imageUrl' => $item->imageUrl,
                'description' => $item->description,
                'about' => $item->about,
                'social' => $item->social,

                'user_id' => $user->id,
            ]);
        }
    }

    /**
     * @return void
     */
    public function seedTestimonials(): void
    {
        $testimonials = TestimonialData::loadFromFile(resource_path('data/testimonials.php'));

        foreach ($testimonials as $testimonial) {
            Testimonial::create([
                'name' => $testimonial->name,
                'email' => $testimonial->email,
                'position' => $testimonial->position,
                'company' => $testimonial->company,
                'testimonial' => $testimonial->testimonial,
                'imageUrl' => $testimonial->imageUrl,
            ]);
        }
    }

    /**
     * @return void
     */
    public function seedFaqs(): void
    {
        $faqs = FaqData::loadFromFile(resource_path('data/faqs.php'));

        foreach ($faqs as $faq) {
            Faq::create([
                'question' => $faq->question,
                'answer' => $faq->answer,
            ]);
        }
    }

    /**
     * @return void
     */
    public function seedCourses(): void
    {
        $courses = CourseData::collect(require resource_path('data/courses.php'));

        foreach ($courses as $course) {
            $category = Category::createOrFirst([
                'name' => $course->category->name,
                'slug' => $course->category->slug,
            ]);

            Course::create([
                'title' => $course->title,
                'slug' => $course->slug,
                'description' => $course->description,
                'content' => $course->content,
                'level' => $course->level,
                'imageUrl' => $course->imageUrl,
                'date' => $course->date,
                'category_slug' => $category->slug,
                'teacher_id' => $course->teacher->id,
                'status' => $course->status,
                'meta' => $course->meta,
            ]);
        }
    }
}
