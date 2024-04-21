<x-main-layout>
    <section class="hero min-h-[80svh]" style="background-image: url({{asset('/images/hero-bg.webp')}});">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-white">
            <div class="mx-auto min-w-7xl flex items-center justify-center">
                <div class="max-w-md">
                    <h1 class="mb-5 text-5xl font-bold">Learn English the natural way.</h1>
                    <p class="mb-5">The most efficient road towards learning a language is that road filled with fun. That is
                        why, Your journey of learning English with us; MUST be and WILL be a joyful one.</p>
                    <a href="#video" class="btn btn-outline">learn more</a>
                    <!-- Open the modal using ID.showModal() method -->
                    <a href="#courses" class="btn glass">Explore our courses</a>
                </div>
            </div>
        </div>
    </section>
    <section id="courses" class="min-h-[80svh] py-24 sm:py-32 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:max-w-4xl">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    {{ "Choose your Course" }}
                </h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                    We offer a variety of courses that are designed to help you learn English in a fun and interactive way.
                </p>
            </div>
            <div class="mx-auto max-w-2xl lg:max-w-4xl mt-16 space-y-20 lg:mt-20 lg:space-y-20">
                @foreach($courses as $course)
                    <x-frontend.course-card :course="$course" />
                @endforeach
            </div>
        </div>
    </section>
    <x-frontend.video-section />
    <section class="bg-white py-24 md:py-32">
        <div class="mx-auto max-w-7xl flex flex-col items-center justify-center gap-y-16 px-6 lg:px-8">
            <div class="mx-auto max-w-2xl">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Your Teachers and mentors</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">We're a passionate team of teachers dedicated to unlocking YOUR full potential in English</p>
            </div>
            <div
                x-data="{
                    slide: 0,
                    total: {{ count($teachers) }},
                    interval: null,
                    isPaused: false,

                    init() {
                        this.total = {{ count($teachers) }};
                        this.start();
                    },

                    $watch: {
                        slide() {
                            console.log('slide changed', this.slide)
                        },
                    },

                    isCurrent(index) {
                        return this.slide === index;
                    },

                    start() {
                        this.interval = setInterval(() => {
                            if (!this.isPaused) {
                                this.next();
                            }
                        }, 2000);
                    },

                    stop() {
                        clearInterval(this.interval);
                    },

                    next() {
                        this.slide = (this.slide + 1) % this.total;
                    },

                    prev() {
                        this.slide = (this.slide - 1 + this.total) % this.total;
                    },

                    goTo(index) {
                        if (index >= 0 && index < this.total) {
                            this.slide = index;
                        }
                    },

                    pause() {
                        this.isPaused = true;
                        this.stop();
                    },
                    play() {
                        this.isPaused = false;
                        this.start();
                    }
                }"
                class="relative z-20 w-full max-w-4xl mx-auto"
                x-on:mouseenter="pause();console.log('mouseenter')" x-on:mouseleave="play();console.log('mouseleave')"
            >
                {{-- Teacher slide--}}
                <ul
                    role="list"
                    class="relative w-full aspect-[3/4] sm:aspect[1/1] md:aspect-[3/1] overflow-hidden rounded-2xl"
                >
                    @foreach($teachers as $teacher )
                        <li
                            x-show="isCurrent({{ $loop->index }})"
                            x-bind:key="{{ $loop->index }}"
                            x-transition:enter="transition duration-1000 transform fadeIn"
                            x-transition:enter-start="-translate-x-full opacity-0"
                            x-transition:enter-end="translate-x-0 opacity-100"
                            x-transition:leave="transition ease-in-out duration-1000 transform"
                            x-transition:leave-start="translate-x-0 opacity-100"
                            x-transition:leave-end="translate-x-full opacity-0"
                            class="absolute inset-0 h-full"
                        >
                            <x-frontend.teacher-card
                                class="h-full"
                                :teacher="$teacher"
                            />
                        </li>
                    @endforeach
                </ul>
                {{-- Controls --}}
                <div class="absolute inset-x-0 -bottom-20 flex justify-center space-x-2">
                    @for($i = 0; $i < count($teachers); $i++)
                        <button
                            x-on:click="goTo({{ $i }})"
                            :class="{
                                'bg-gray-900': isCurrent({{ $i }}),
                                'bg-gray-300': !isCurrent({{ $i }})
                            }"
                            class="w-3 h-3 rounded-full"
                        ></button>
                    @endfor
                </div>
                {{--Next/Prev--}}
                <div class="absolute inset-0 flex items-center justify-between w-full">
                    <button x-on:click="prev()" class="absolute z-10 start-0 inset-y-0 p-4 text-3xl text-gray-900 bg-transparent hover:bg-gradient-to-bl to-transparent via-gray-600/10 from-transparent">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button x-on:click="next()" class="absolute z-10 end-0 inset-y-0 p-4 text-3xl text-gray-900 bg-transparent hover:bg-gradient-to-tr to-transparent via-gray-600/10 from-transparent">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-gray-900 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                @foreach($testimonials as $testimonial)
                    <x-frontend.testimonial-card :testimonial="$testimonial" />
                @endforeach
            </div>
        </div>
    </section>
    <section class="bg-white py-24 md:py-32">
        <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8 lg:py-40">
            <div class="mx-auto max-w-4xl divide-y divide-gray-900/10">
                <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">Frequently asked questions</h2>
                <dl x-data="{
                        open: false,
                        active: 0,
                        toggle(index) {
                            if (this.active === index){
                                this.open = !this.open;
                            } else {
                                this.open = true;
                                this.active = index;
                            }
                        },
                        isOpen(index) {
                            return this.active === index;
                        },
                    }"
                    class="mt-10 space-y-6 divide-y divide-gray-900/10">
                    @foreach($faqs as $faq)
                        <div class="pt-6">
                            <dt>
                                <!-- Expand/collapse question button -->
                                <button @click="toggle({{ $loop->index }})"
                                        type="button" class="flex w-full items-start justify-between text-left text-gray-900" aria-controls="faq-0" aria-expanded="false">
                                    <span class="text-base font-semibold leading-7">{{ $faq->question }}</span>
                                    <span class="ml-6 flex h-7 items-center">
                                    <!--
                                      Icon when question is collapsed.

                                      Item expanded: "hidden", Item collapsed: ""
                                    -->
                                    <svg x-show="!isOpen({{ $loop->index }})" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                        <!--
                                          Icon when question is expanded.

                                          Item expanded: "", Item collapsed: "hidden"
                                        -->
                                    <svg x-show="isOpen({{ $loop->index }})" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                    </svg>
                                </span>
                                </button>
                            </dt>
                            <dd x-show="isOpen({{ $loop->index }})" class="mt-2 pr-12" id="faq-{{ $loop->index }}">
                                <p class="text-base leading-7 text-gray-600">{!! $faq->answer !!}</p>
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </section>
    <x-frontend.newsletter-section />
</x-main-layout>
