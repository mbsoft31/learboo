<?php

namespace Core\Support\Enums;

enum ColorVariant: string
{
    case _50 = '50';
    case _100 = '100';
    case _200 = '200';
    case _300 = '300';
    case _400 = '400';
    case _500 = '500';
    case _600 = '600';
    case _700 = '700';
    case _800 = '800';
    case _900 = '900';
    case _950 = '950';

    /**
     * @return ColorVariant[]
     */
    public static function all(): array
    {
        // Return all variants as an array
        return [
            self::_50,
            self::_100,
            self::_200,
            self::_300,
            self::_400,
            self::_500,
            self::_600,
            self::_700,
            self::_800,
            self::_900,
            self::_950,
        ];
    }

    /**
     * @param ColorVariant $variant
     * @return string
     */
    public static function getName(ColorVariant $variant): string
    {
        // Map each variant to its name
        return match ($variant) {
            self::_50 => '50',
            self::_100 => '100',
            self::_200 => '200',
            self::_300 => '300',
            self::_400 => '400',
            self::_500 => '500',
            self::_600 => '600',
            self::_700 => '700',
            self::_800 => '800',
            self::_900 => '900',
            self::_950 => '950',
        };
    }
}
