<?php

namespace Core\Support;

use Core\Support\Enums\Color as ColorEnum;
use Core\Support\Enums\ColorVariant as ColorVariantEnum;
use JetBrains\PhpStorm\Pure;

class Colors
{
    public static function Color(ColorEnum $name, ColorVariantEnum $variant = ColorVariantEnum::_500): Color
    {
        return self::config('colors')[$name->value][$variant->value];
    }

    public static function TextColor(ColorEnum $name, ColorVariantEnum $variant = ColorVariantEnum::_500): Color
    {
        return self::config('hover')[$name->value][$variant->value];
    }

    public static function getHexColor(ColorEnum $name, ColorVariantEnum $variant = ColorVariantEnum::_500): string
    {
        return self::Color($name, $variant)->toHexString();
    }

    public static function getHexTextColor($name, $variant = '500'): string
    {
        return self::TextColor($name, $variant)->toHexString();
    }

    /**
     * @param 'colors'|'hover' $key
     * @return array
     */
    public static function config(string $key): array
    {
        return (require base_path('src/Support/colors-config.php'))[$key];
    }

    /**
     * @return ColorEnum[]
     */
    #[Pure] public static function getColors(): array
    {
        return ColorEnum::all();
    }

    /**
     * @return ColorVariantEnum[]
     */
    #[Pure] public static function getVariants(): array
    {
        return ColorVariantEnum::all();
    }

}
