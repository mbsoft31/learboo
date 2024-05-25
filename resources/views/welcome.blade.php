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
                    drag: null,

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
                    },
                    dragStart(e) {
                        this.drag = e;
                        console.log('dragstart', this.drag.x)
                    },
                    dragEnd(e) {
                        console.log('dragend', e.x - this.drag.x)
                        if (e.x - this.drag.x > 100) {this.next()}
                        if (e.x - this.drag.x < -100) {this.prev()}
                        this.drag = null;
                    },
                }"
                class="relative z-20 w-full max-w-4xl mx-auto"
                x-on:mouseenter="pause()"
                x-on:mouseleave="play()"
            >
                {{-- Teacher slide--}}
                <ul
                    role="list"
                    class="relative w-full aspect-[3/4] sm:aspect[1/1] md:aspect-[3/1] overflow-hidden rounded-2xl"
                >
                    @foreach($teachers as $key => $teacher)
                        <li
                            x-show="isCurrent({{ $key }})"
                            x-bind:key="{{ $key }}"
                            x-transition:enter="transition duration-1000 transform fadeIn"
                            x-transition:enter-start="-translate-x-full opacity-0"
                            x-transition:enter-end="translate-x-0 opacity-100"
                            x-transition:leave="transition ease-in-out duration-1000 transform"
                            x-transition:leave-start="translate-x-0 opacity-100"
                            x-transition:leave-end="translate-x-full opacity-0"
                            class="w-full h-full md:px-14"
                        >
                            <x-frontend.teacher-card
                                class="h-full cursor-pointer"
                                :teacher="$teacher"
                                x-on:dragstart="(e)=> dragStart(e);"
                                x-on:dragend="(e)=> dragEnd(e);"
                            />
                        </li>
                    @endforeach
                </ul>
                {{-- Controls --}}
                <div class="relative h-16 flex items-center justify-center">
                    @foreach($teachers as $key => $teacher)
                        <button
                            x-on:click="goTo({{ $key }})"
                            class="px-2 w-12 h-full"
                        >
                            <span :class="{'bg-gray-900': isCurrent({{ $key }}),'bg-gray-300': !isCurrent({{ $key }})}"
                            class="block w-full h-3 rounded-full"></span>
                        </button>
                    @endforeach
                </div>
                {{--Next/Prev--}}
                <div class="w-full">
                    <button x-on:click="prev()" class="absolute z-10 start-0 inset-y-0 p-4 text-3xl text-gray-900 bg-transparent hover:bg-gradient-to-bl to-transparent via-gray-600/10 from-transparent">
                        <x-icons name="left-arrow" class="w-6 h-6" />
                    </button>
                    <button x-on:click="next()" class="absolute z-10 end-0 inset-y-0 p-4 text-3xl text-gray-900 bg-transparent hover:bg-gradient-to-tr to-transparent via-gray-600/10 from-transparent">
                        <x-icons name="right-arrow" class="w-6 h-6" />
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
    <x-frontend.faqs-section :faqs="$faqs" />
    <x-frontend.newsletter-section />
</x-main-layout>
