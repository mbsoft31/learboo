<form
    action="{{ $action }}"
    role="none"
    method="{{ ($method == \Core\LmsLite\Enums\HttpMethod::GET) ?? \Core\LmsLite\Enums\HttpMethod::POST }}"
>
    @csrf
    @method($method->value)
    <button type="submit"
            class="w-full text-start block {{ $colors[$color] }} px-4 py-2 text-sm"
            role="menuitem"
            tabindex="-1"
    >
        {{ $text }}
    </button>
</form>
