<x-app-layout title="Testimonials">
    {{--Banner--}}
    <x-banner></x-banner>
    {{--End Banner--}}

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Create a new course') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Fill the form and save to create a new draft course") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('teacher.courses.store', $teacher->id) }}" class="mt-6 space-y-6">
                            @csrf

                            <input type="hidden" id="teacher_id" name="teacher_id" value="{{ $teacher->id }}">

                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <div x-data="{name: null, slug: null}">
                                <x-input-label for="categorySlug" :value="__('Category')" />
                                <x-text-input id="categorySlug" name="categorySlug" type="hidden" x-bind:value="slug" required />
                                <x-dropdown align="left" class="mt-1 block w-full">
                                    <x-slot name="trigger">
                                        <x-text-input id="categoryName" name="categoryName" type="text" x-bind:value="name" x-on:change.live="slug = null" class="mt-1 block w-full" required autocomplete="false" />
                                    </x-slot>
                                    <x-slot name="content">
                                        @foreach($categories as $category)
                                            <x-dropdown-link x-on:click="slug = '{{$category->slug}}';name = '{{$category->name}}'">
                                                {{ $category->name }}
                                            </x-dropdown-link>
                                        @endforeach
                                    </x-slot>
                                </x-dropdown>
                                <x-input-error class="mt-2" :messages="$errors->get('categorySlug')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-area id="description" rows="4" name="description"  class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div>
                                @foreach($errors->all() as $key => $value)
                                    <div>
                                        <x-input-error class="mt-2" :messages="$value" />
                                    </div>
                                @endforeach
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>

                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
