@props([
    'name',
    'variant'
])

@php
    $color = \Core\Support\Colors::getHexTextColor($name, $variant);
    $bgColor = \Core\Support\Colors::getHexColor($name, $variant);
    $style = 'color: ' . $color . '; background-color: ' . $bgColor . ';'
@endphp

<button
    style="{{$style}};"
    {{ $attributes->merge(['class' => "color group"]) }}
>
    <span class="md:group-hover:inline-block md:hidden">
        {{$variant->value}}
    </span>
</button>

<style>
    .transform {
        --tw-translate-x: 0;
        --tw-translate-y: 0;
        --tw-rotate: 0;
        --tw-skew-x: 0;
        --tw-skew-y: 0;
        --tw-scale-x: 1;
        --tw-scale-y: 1;
        transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
    }

    @keyframes spin {
        to {
            transform: rotate(1turn)
        }
    }

    @keyframes ping {
        75%,to {
            opacity: 0;
            transform: scale(2)
        }
    }

    @keyframes pulse {
        50% {
            opacity: .5
        }
    }

    @keyframes bounce {
        0%,to {
            animation-timing-function: cubic-bezier(.8,0,1,1);
            transform: translateY(-25%)
        }

        50% {
            animation-timing-function: cubic-bezier(0,0,.2,1);
            transform: none
        }
    }

    .fade-enter-active,.fade-leave-active {
        transition: opacity .5s
    }

    .fade-enter,.fade-leave-to {
        opacity: 0
    }

    .transition {
        transition-duration: .15s;
        transition-property: background-color,border-color,color,fill,stroke,opacity,box-shadow,transform,filter,backdrop-filter,-webkit-backdrop-filter;
        transition-timing-function: cubic-bezier(.4,0,.2,1)
    }

    .color {
        height: 2.5rem;
        outline: 0 !important;
        transition: all .3s ease 0s
    }

    .color span {
        font-weight: 700
    }

    .color:active {
        transform: scale(.7)
    }

    .color--first {

    }

    @media (min-width: 768px) {
        .color--first {

        }
    }

    .color--last {

    }

    @media (min-width: 768px) {
        .color--last {

        }
    }
</style>
