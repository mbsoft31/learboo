<?php

use App\Models\Teacher;
use Core\LmsLite\DataObjects\TeacherData;
use Core\LmsLite\Enums\CourseStatus;
use Illuminate\Support\Str;

return [
    [
        'title' => 'English for communication:',
        'slug' => Str::slug('English for communication:'),
        'description' => 'Our English communication course prepares you for real world scenarios you may find when speaking and interacting in English.',
        'content' => "This course is best for you if:\n– you can understand a lot of what people say in movies but you can not reply back.\n– you are anxious that you will make mistakes when speaking.\n– you lack practice.\n– you have a basic understanding of English sentence structure.\n– You wish to have friends to practise with.\n– you could understand all of this without needing to translate it.\nOur course focuses mainly on improving your listening, speaking and reading. However, there will be plenty of opportunities for you to focus on writing too, making sure you learn all four key skills.",
        'level' => '(CEFR : B1- B2)',
        'imageUrl' => asset('images/courses/course-1.webp'),
        'date' => 'Mar 16, 2020',
        'category' => [
            'name' => '(CEFR : B1- B2)',
            'slug' => Str::slug('(CEFR : B1- B2)'),
        ],
        'teacher' => TeacherData::fromModel(Teacher::find(1))->toArray(),
        'status' => CourseStatus::PUBLISHED->value,
        'meta' => [
            'level' => 'CEFR: B1 B2 \ intermediate',
            'duration' => '1 hour 20 mins \ 1 hour 30 mins',
            'session_per_week' => 4,
            'capacity' => ' 8 to 12 students', // number of learners
            'groups' => [
                'group-1' => [
                    'Saturday' => '5:00pm - 6:20pm (GMT+1)',
                    'Sunday' => '5:00pm - 6:20pm (GMT+1)',
                    'Monday' => '5:00pm - 6:20pm (GMT+1)',
                    'Wednesday ' => '5:00pm - 6:20pm (GMT+1)',
                ],
                'group-2' => [
                    'Saturday' => '8:00pm - 9:20pm (GMT+1)',
                    'Sunday' => '8:00pm - 9:20pm (GMT+1)',
                    'Monday' => '8:00pm - 9:20pm (GMT+1)',
                    'Wednesday ' => '8:00pm - 9:20pm (GMT+1)',
                ],
            ],
            'fees' => [
                [
                    'amount' => 8000.0,
                    'currency' => 'DZD',
                    'payment_method' => 'CCP',
                    'terms' => 'full course (two months 48 hours)',
                ],
                [
                    'amount' => 60.0,
                    'currency' => 'EUR',
                    'payment_method' => 'PAYPAL',
                    'terms' => 'full course (two months 48 hours)',
                ],
            ]
        ]
    ],
    [
        'title' => 'English for beginners:',
        'slug' => Str::slug('English for beginners:'),
        'description' => 'Our English Level Course is for beginners only. We focus on building a strong foundation or refine your already existent foundation of the language. Grammar is the center and our main focus.',
        'content' => "This course is best for you if:\n- You just started learning English.\n- You know some words in English.\n- You know some grammatical rules but you cannot form a sentence.\n- You want to start learning English the Right way.",
        'level' => '(CEFR : A1)',
        'imageUrl' => asset('images/courses/course-1.webp'),
        'date' => '2024-05-16T11:15:00.00',
        'category' => [
            'name' => '(CEFR : A1)',
            'slug' => Str::slug('(CEFR : A1)'),
        ],
        'teacher' => TeacherData::fromModel(Teacher::find(1))->toArray(),
        'status' => CourseStatus::DRAFT->value,
        'meta' => [
            'level' => 'CEFR: A1 \ Beginner',
            'duration' => '1 hour 20 mins \ 1 hour 30 mins',
            'session_per_week' => 4,
            'capacity' => ' 8 to 12 students', // number of learners
            'groups' => [
                'group-1' => [
                    'Saturday' => '9:30pm - 11:00pm (GMT+1)',
                    'Sunday' => '9:30pm - 11:00pm (GMT+1)',
                    'Monday' => '9:30pm - 11:00pm (GMT+1)',
                    'Wednesday ' => '9:30pm - 11:00pm (GMT+1)',
                ],
            ],
            'fees' => [
                [
                    'amount' => 8000.0,
                    'currency' => 'DZD',
                    'payment_method' => 'CCP',
                    'terms' => 'full course (two months 48 hours)',
                ],
                [
                    'amount' => 60.0,
                    'currency' => 'EUR',
                    'payment_method' => 'PAYPAL',
                    'terms' => 'full course (two months 48 hours)',
                ],
            ]
        ]
    ],
    [
        'title' => 'How to teach English for Newbies',
        'slug' => Str::slug('How to teach English for Newbies'),
        'description' => "Our teacher Training course prepares you for real world scenarios you might face when Teaching English.",
        'content' => "<p>This course is best for you if:</p><ul><li>You have a C1 level in English and want to pursue the teacher career.</li><li>You are a University student majoring in English or similar field.</li><li>You are a Fresh graduate \ wanna-be-teacher.</li></ul><p>What to expect from this course:</p><ul><li>Learn from my teaching experience.</li> <li>How to deal with certain difficult cases.</li> <li>How to become THE Teacher that people trust and contact.</li><li>How to deal with time consuming lesson planning.</li><li>Tips on how to avoid Teacher-burnout.</li><li>How to find Teaching positions as a new graduate or even as a  student.</li><li>Time management.</li><li>How to start building your teacher Confidence.</li><li>Most useful teaching techniques or methods.</li><li>Teaching , reading , speaking , writing, listening, grammar.</li><li>Classroom management both online and onsite.</li><li>A collection of teacher friendly websites.</li></ul>",
        'level' => '(CEFR : A1)',
        'imageUrl' => asset('images/courses/course-1.webp'),
        'date' => '2024-05-16T11:15:00.00',
        'category' => [
            'name' => 'CEFR: A1 \ Beginner',
            'slug' => Str::slug('CEFR: A1 \ Beginner'),
        ],
        'teacher' => TeacherData::fromModel(Teacher::find(1))->toArray(),
        'status' => CourseStatus::PUBLISHED->value,
        'meta' => [
            'level' => 'CEFR: A1 \ Beginner',
            'duration' => '1 hour 20 mins \ 1 hour 30 mins',
            'session_per_week' => 4,
            'capacity' => ' 8 to 12 students', // number of learners
            'groups' => [
                'group-1' => [
                    'Saturday' => '9:30pm - 11:00pm (GMT+1)',
                    'Sunday' => '9:30pm - 11:00pm (GMT+1)',
                    'Monday' => '9:30pm - 11:00pm (GMT+1)',
                    'Wednesday ' => '9:30pm - 11:00pm (GMT+1)',
                ],
            ],
            'fees' => [
                [
                    'amount' => 8000.0,
                    'currency' => 'DZD',
                    'payment_method' => 'CCP',
                    'terms' => 'full course (two months 48 hours)',
                ],
                [
                    'amount' => 60.0,
                    'currency' => 'EUR',
                    'payment_method' => 'PAYPAL',
                    'terms' => 'full course (two months 48 hours)',
                ],
            ]
        ]
    ],
    [
        'title' => 'English for Individuals',
        'slug' => Str::slug('English for Individuals'),
        'description' => "Our English for Individuals course is designed to fit you and your language needs.",
        'content' => "<p>Our English for Individuals course is designed to fit you and your language needs. Whether you have a beginner, an elementary, an intermediate or an upper intermediate level we are here to help you improve.</p><p>This course is best for those who want:</p><ul><li>Their teacher`s full attention.</li><li>To focus on improving at their own pace.</li><li>To work on improving specific skill or skills.</li><li>Extra sessions to practice their speaking and pronunciation.</li></ul><p>If you are confused about what your level in English is, take this free test online <a href=\"https://www.efset.org/ef-set-50/\">https://www.efset.org/ef-set-50/</a></p>",
        'level' => 'any level \ we give you a test',
        'imageUrl' => asset('images/courses/course-1.webp'),
        'date' => '2024-05-16T11:15:00.00',
        'category' => [
            'name' => '(CEFR : A1)',
            'slug' => Str::slug('any level \ we give you a test'),
        ],
        'teacher' => TeacherData::fromModel(Teacher::find(1))->toArray(),
        'status' => CourseStatus::PUBLISHED->value,
        'meta' => [
            'level' => 'any level \ we give you a test',
            'duration' => '1 hour',
            'session_per_week' => 'as many as you need',
            'capacity' => '1 person\exceptions for friends can be made', // number of learners
            'groups' => [],
            'fees' => [
                [
                    'amount' => 8000.0,
                    'currency' => 'DZD',
                    'payment_method' => 'CCP',
                    'terms' => 'two sessions a week',
                ],
                [
                    'amount' => 80.0,
                    'currency' => 'EUR',
                    'payment_method' => 'PAYPAL',
                    'terms' => 'two sessions a week',
                ],
            ]
        ]
    ],
];
