<?php

namespace Core\Support\Enums;

enum Color: string
{
    case RED = 'red';
    case ORANGE = 'orange';
    case AMBER = 'amber';
    case YELLOW = 'yellow';
    case LIME = 'lime';
    case GREEN = 'green';
    case EMERALD = 'emerald';
    case TEAL = 'teal';
    case CYAN = 'cyan';
    case SKY = 'sky';
    case BLUE = 'blue';
    case INDIGO = 'indigo';
    case VIOLET = 'violet';
    case PURPLE = 'purple';
    case FUCHSIA = 'fuchsia';
    case PINK = 'pink';
    case ROSE = 'rose';
    case STONE = 'stone';
    case NEUTRAL = 'neutral';
    case ZINC = 'zinc';
    case GRAY = 'gray';
    case SLATE = 'slate';

    public static function all(): array
    {
        return [
            self::RED,
            self::ORANGE,
            self::AMBER,
            self::YELLOW,
            self::LIME,
            self::GREEN,
            self::EMERALD,
            self::TEAL,
            self::CYAN,
            self::SKY,
            self::BLUE,
            self::INDIGO,
            self::VIOLET,
            self::PURPLE,
            self::FUCHSIA,
            self::PINK,
            self::ROSE,
            self::STONE,
            self::NEUTRAL,
            self::ZINC,
            self::GRAY,
            self::SLATE,
        ];
    }

    public static function getName(Color $color): string
    {
        return match ($color) {
            self::RED => 'Red',
            self::ORANGE => 'Orange',
            self::AMBER => 'Amber',
            self::YELLOW => 'Yellow',
            self::LIME => 'Lime',
            self::GREEN => 'Green',
            self::EMERALD => 'Emerald',
            self::TEAL => 'Teal',
            self::CYAN => 'Cyan',
            self::SKY => 'Sky',
            self::BLUE => 'Blue',
            self::INDIGO => 'Indigo',
            self::VIOLET => 'Violet',
            self::PURPLE => 'Purple',
            self::FUCHSIA => 'Fuchsia',
            self::PINK => 'Pink',
            self::ROSE => 'Rose',
            self::STONE => 'Stone',
            self::NEUTRAL => 'Neutral',
            self::ZINC => 'Zinc',
            self::GRAY => 'Gray',
            self::SLATE => 'Slate',
        };
    }
}
