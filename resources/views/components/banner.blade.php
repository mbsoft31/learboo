@php
    $type = session('type', null);
    $message = session('message', null);
    $class = 'bg-green-50';
    $text = 'text-green-900';
    if ($type === 'error') {
        $class = 'bg-red-50';
        $text = 'text-red-900';
    }
    if ($type === 'warning') {
        $class = 'bg-yellow-50';
        $text = 'text-yellow-900';
    }
    if ($type === 'info') {
        $class = 'bg-blue-50';
        $text = 'text-blue-900';
    }
    if ($type === 'success') {
        $class = 'bg-green-50';
        $text = 'text-green-900';
    }
    if ($type == null || $message == null) {
        $class  = 'hidden';
    }
@endphp
<div class="rounded-md {{$class}} p-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium {{ $text }}">
                {{ $message }}
            </p>
        </div>
        <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button type="button" class="inline-flex rounded-md {{$class}} p-1.5 {{ $text }} hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                    <span class="sr-only">Dismiss</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
