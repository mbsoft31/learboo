<?php

namespace Core\Support;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Color implements Arrayable, Jsonable
{
    public function __construct(
        public int $R = 0,
        public int $G = 0,
        public int $B = 0,
    ){}

    public static function fromHexString(string $hexString): self
    {
        // Remove the '#' symbol if present
        $hexString = ltrim($hexString, '#');

        // Parse hexadecimal string to RGB values
        $R = hexdec(substr($hexString, 0, 2));
        $G = hexdec(substr($hexString, 2, 2));
        $B = hexdec(substr($hexString, 4, 2));

        return new self($R, $G, $B);
    }

    public static function fromRgbString(string $rgbString): self
    {
        // Extract RGB values from the string
        preg_match('/rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)/', $rgbString, $matches);

        // Assign RGB values
        $R = isset($matches[1]) ? (int)$matches[1] : 0;
        $G = isset($matches[2]) ? (int)$matches[2] : 0;
        $B = isset($matches[3]) ? (int)$matches[3] : 0;

        return new self($R, $G, $B);
    }

    public function toHexString(): string
    {
        // Convert RGB values to hexadecimal string
        $hexR = dechex($this->R);
        $hexG = dechex($this->G);
        $hexB = dechex($this->B);

        // Ensure that each hexadecimal string has two characters
        $hexR = str_pad($hexR, 2, '0', STR_PAD_LEFT);
        $hexG = str_pad($hexG, 2, '0', STR_PAD_LEFT);
        $hexB = str_pad($hexB, 2, '0', STR_PAD_LEFT);

        // Combine the hexadecimal values
        return '#' . $hexR . $hexG . $hexB;
    }

    public function toRgbString(): string
    {
        // Format RGB values into a string
        return "rgb({$this->R}, {$this->G}, {$this->B})";
    }

    public function toArray(): array
    {
        return [
            'R' => $this->R,
            'G' => $this->G,
            'B' => $this->B,
        ];
    }

    public function toJson($options = 0): false|string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }
}
