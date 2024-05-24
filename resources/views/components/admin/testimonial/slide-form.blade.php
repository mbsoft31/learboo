@props([
    'model' => null
])
<div x-data="slideForm({open: false})" class="relative z-40" aria-labelledby="slide-over-title" role="dialog"
     aria-modal="true">
    <button @click="openSlidePanel()" type="button"
            class="flex-shrink-0 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        {{ $action }}
    </button>
    <div x-show="open" class="fixed inset-0 bg-indigo-950/25"></div>
    <div x-show="open" class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div @click.outside="closeSlidePanel()"
                 class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <div x-show="open" x-cloak
                     x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="translate-x-full"
                     class="pointer-events-auto w-screen max-w-md">
                    <form class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl"
                          action="{{ ($model) ? route('admin.testimonials.update', $model->id) :route('admin.testimonials') }}"
                          method="POST">
                        @csrf
                        @method($model ? 'PATCH' : 'POST')
                        <div class="h-0 flex-1 overflow-y-auto">

                            <div class="bg-indigo-700 px-4 py-6 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-base font-semibold leading-6 text-white" id="slide-over-title">
                                        {{ $model ? 'Update testimonial' : 'New Testimonial' }}
                                    </h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button @click="closeSlidePanel()" type="button"
                                                class="relative rounded-md bg-indigo-700 text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                                            <span class="absolute -inset-2.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                 stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <p class="text-sm text-indigo-300">
                                        {{ $model ? 'Update the testimonial details' : 'Fill in the form below to create a new testimonial' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-1 flex-col justify-between">
                                <div class="divide-y divide-gray-200 px-4 sm:px-6">
                                    <div class="space-y-6 pb-5 pt-6">
                                        <div>
                                            <label for="name"
                                                   class="block text-sm text-start font-medium leading-6 text-gray-900">
                                                name
                                            </label>
                                            <div class="mt-2">
                                                <input
                                                    value="{{ $model ? $model->name : '' }}"
                                                    type="text"
                                                    name="name"
                                                    id="name"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                >
                                            </div>
                                        </div>
                                        <div>
                                            <label for="email"
                                                   class="block text-sm text-start font-medium leading-6 text-gray-900">
                                                email
                                            </label>
                                            <div class="mt-2">
                                                <input
                                                    value="{{ $model ? $model->email : '' }}"
                                                    type="email"
                                                    name="email"
                                                    id="email"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                >
                                            </div>
                                        </div>
                                        <div>
                                            <label for="position"
                                                   class="block text-sm text-start font-medium leading-6 text-gray-900">
                                                position
                                            </label>
                                            <div class="mt-2">
                                                <input
                                                    value="{{ $model ? $model->position : '' }}"
                                                    type="text"
                                                    name="position"
                                                    id="position"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                >
                                            </div>
                                        </div>
                                        <div>
                                            <label for="company"
                                                   class="block text-sm text-start font-medium leading-6 text-gray-900">
                                                company
                                            </label>
                                            <div class="mt-2">
                                                <input value="{{ $model ? $model->company : '' }}"
                                                       type="text" name="company" id="company"
                                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="testimonial"
                                                   class="block text-sm text-start font-medium leading-6 text-gray-900">Message</label>
                                            <div class="mt-2">
                                                <textarea id="testimonial" name="testimonial" rows="4"
                                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $model ? $model->testimonial : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-sm text-start font-medium leading-6 text-gray-900">Team
                                                Members</h3>
                                            <div class="mt-2">
                                                <div class="flex space-x-2">
                                                    <a href="#" class="relative rounded-full hover:opacity-75">
                                                        <img class="inline-block h-8 w-8 rounded-full"
                                                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                             alt="Tom Cook">
                                                    </a>
                                                    <a href="#" class="relative rounded-full hover:opacity-75">
                                                        <img class="inline-block h-8 w-8 rounded-full"
                                                             src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                             alt="Whitney Francis">
                                                    </a>
                                                    <a href="#" class="relative rounded-full hover:opacity-75">
                                                        <img class="inline-block h-8 w-8 rounded-full"
                                                             src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                             alt="Leonard Krasner">
                                                    </a>
                                                    <a href="#" class="relative rounded-full hover:opacity-75">
                                                        <img class="inline-block h-8 w-8 rounded-full"
                                                             src="https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                             alt="Floyd Miles">
                                                    </a>
                                                    <a href="#" class="relative rounded-full hover:opacity-75">
                                                        <img class="inline-block h-8 w-8 rounded-full"
                                                             src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                             alt="Emily Selman">
                                                    </a>

                                                    <button type="button"
                                                            class="relative inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full border-2 border-dashed border-gray-200 bg-white text-gray-400 hover:border-gray-300 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                        <span class="absolute -inset-2"></span>
                                                        <span class="sr-only">Add team member</span>
                                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                             aria-hidden="true">
                                                            <path
                                                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="flex flex-shrink-0 justify-end px-4 py-4">
                            <button @click="closeSlidePanel()" type="button"
                                    class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="ml-4 inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('slideForm', (initialProps) => ({
            open: false,
            init() {
                this.open = initialProps.open;
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && this.open) {
                        this.open = false;
                    }
                });
                document.addEventListener('openSlidePanel', () => {
                    this.openSlidePanel();
                    console.log('open slide');
                });
                document.addEventListener('closeSlidePanel', () => this.closeSlidePanel());
                document.addEventListener('toggleSlidePanel', () => this.toggleSlidePanel());
            },
            toggleSlidePanel() {
                this.open = !this.open;
            },
            closeSlidePanel() {
                this.open = false;
            },
            openSlidePanel() {
                this.open = true;
            },
        }));
    });
</script>
