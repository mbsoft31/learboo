<x-main-layout>
    <div class="hero min-h-[80svh]" style="background-image: url({{asset('/images/hero-bg.jpg')}});">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="mx-auto min-w-7xl flex items-center justify-center">
                <div class="max-w-md">
                    <h1 class="mb-5 text-5xl font-bold">Learn English the natural way.</h1>
                    <p class="mb-5">The most efficient road towards learning a language is that road filled with fun. That is
                        why, Your journey of learning English with us; MUST be and WILL be a joyful one.</p>
                    <button class="btn btn-outline">learn more</button>
                    <!-- Open the modal using ID.showModal() method -->
                    <button class="btn glass">Start learning</button>
                </div>
            </div>
        </div>
    </div>
    <div class="min-h-[80svh] py-24 sm:py-32 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:max-w-4xl">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Our courses</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">We offer a variety of courses that are designed to help you learn English in a fun and interactive way.</p>
                <div class="mt-16 space-y-20 lg:mt-20 lg:space-y-20">
                    @php
                        $dataArray = [
                            [
                                'title' => 'English Reading \ Speaking:',
                                'description' => 'Our English Level Course is for beginners only. We focus on building a strong foundation or refine your already existent foundation of the language. Grammar is the center and our main focus.',
                                'level' => 'comunicative',
                                'imageUrl' => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3603&q=80',
                                'date' => 'Mar 16, 2020',
                                'category' => 'comunicative',
                                'teacher' => [
                                    'name' => 'Teacher. Boutheyna (Miss.Boo)',
                                    'role' => 'Founder',
                                    'imageUrl' => 'https://learnboo.academy/_next/image?url=%2Fimages%2Fport-1.png&w=3840&q=75',
                                ],
                            ],
                            [
                                'title' => 'Level Course',
                                'description' => 'Our English Level Course is for beginners only. We focus on building a strong foundation or refine your already existent foundation of the language. Grammar is the center and our main focus.',
                                'level' => 'A1',
                                'imageUrl' => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3603&q=80',
                                'date' => 'Mar 16, 2020',
                                'category' => 'A1',
                                'teacher' => [
                                    'name' => 'Teacher. Boutheyna (Miss.Boo)',
                                    'role' => 'Founder',
                                    'imageUrl' => 'https://learnboo.academy/_next/image?url=%2Fimages%2Fport-1.png&w=3840&q=75',
                                ],
                            ],
                        ];
                    @endphp
                    @foreach($dataArray as $course)
                        <x-frontend.course-card :course="\Core\Frontend\DTO\Course::fromArray($course)" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <x-frontend.video-section />
    <div class="bg-white py-24 md:py-32">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-x-8 gap-y-20 px-6 lg:px-8 xl:grid-cols-5">
            <div class="max-w-2xl xl:col-span-2">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Teachers</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">We’re a dynamic group of individuals who are passionate about what we do and dedicated to delivering the best results for our clients.</p>
            </div>
            <ul role="list" class="-mt-12 space-y-12 divide-y divide-gray-200 xl:col-span-3">
                @foreach([1,] as $item)
                    <li class="">
                        <x-frontend.teacher-card />
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <section class="bg-gray-900 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                @foreach([1,2] as $item)
                    <x-frontend.testimonial-card />
                @endforeach
            </div>
        </div>
    </section>
    <x-frontend.newsletter-section />
</x-main-layout>
