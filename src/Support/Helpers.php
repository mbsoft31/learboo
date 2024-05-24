<?php

namespace Core\Support;

use DOMDocument;
use stdClass;

class Helpers
{
    public static function hexToRGB($hex): Color
    {
        // Remove the hash symbol if it's there
        return Color::fromHexString($hex);
    }

    public static function rgbStringToObject($rgbString): Color
    {
        return Color::fromRgbString($rgbString);
    }

    public static function parse($string): array
    {
        return self::extractColorItems($string);
    }

    public static function extractColorItems($string): array
    {
        $colorItems = array();

        // Find the starting index of the main div
        // $startPos = strpos($string, '<div class="flex-grow palettes overflow-auto h-full bg-gray-600 p-6">');
        $startPos = strlen("<div class='flex-grow palettes overflow-auto h-full bg-gray-600 p-6'>\n");
        if (!$startPos) {
            // Return empty array if the starting tag is not found
            return $colorItems;
        }

        // Find the ending index of the main div
        $endPos = strlen($string) - strlen("</div>") * 2 - 1;
        if (!$endPos) {
            // Return empty array if the ending tag is not found
            return $colorItems;
        }

        // Extract the main div content
        $mainDivContent = substr($string, $startPos, $endPos - $startPos + strlen('</div>'));

        // Use DOMDocument to parse HTML
        $dom = new DOMDocument();
        $dom->loadHTML($mainDivContent);

        // Get all div elements with class "palette-name"
        $paletteNameDivs = $dom->getElementsByTagName('div');

        foreach ($paletteNameDivs as $div) {
            // Get the color name
            $colorName = $div->textContent;

            // Initialize array for color items
            $colorItems[strtolower($colorName)] = array();

            // Find the next 11 color items
            $nextSibling = $div->nextSibling;
            $count = 0;
            while ($nextSibling && $count < 11) {
                if ($nextSibling->nodeName === 'button') {
                    // Extract color variant value
                    $span = $nextSibling->getElementsByTagName('span')[0] ?? null;
                    if ($span)
                    {
                        $colorItems[strtolower($colorName)][$span->textContent] = self::extractColors(
                            $dom->saveHTML($nextSibling)
                        );
                        $count++;
                    }
                    // Extract color item HTML
                    // $colorItems[strtolower($colorName)][] = $dom->saveHTML($nextSibling);
                    // $count++;
                }
                $nextSibling = $nextSibling->nextSibling;
            }
        }

        return $colorItems;
    }

    public static function extractColors($input): stdClass
    {
        // Regular expression pattern to match background-color and --hover-color attributes
        $pattern = '/background-color:\s*rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\);.*--hover-color:\s*(#[0-9A-Fa-f]{6})\s*;/';

        // Perform the regular expression match
        preg_match($pattern, $input, $matches);

        // Extract the matched values
        $bgColor = "rgb(" . $matches[1] . ", " . $matches[2] . ", " . $matches[3] . ")";
        $hoverColor = $matches[4];

        // Create and return an object with bgColor and hoverColor attributes
        $colors = new stdClass();
        $colors->bgColor = self::rgbStringToObject($bgColor);
        $colors->hoverColor = self::hexToRGB($hoverColor);

        return $colors;
    }

    static function getColors($items): string
    {
        return self::render($items);
    }

    static function render(array $colorsItems): string
    {
        $colors = "";
        foreach ($colorsItems as $name => $variants)
        {
            $tmp = [];
            foreach ($variants as $variant => $color)
            {
                $tmp[$variant] = $color->bgColor;
            }
            $colors .= self::renderColor($name, $tmp, spacing: "  ");
        }
        return sprintf(
            "[\n%s\n]",
            $colors
        );
    }

    static function renderColor($name, $variants, $spacing = "  "): string
    {
        $string = "\n";
        foreach ($variants as $variant => $color)
        {
            $string .= sprintf(
                "%s\n",
                self::renderVariantLine($color, $variant, $spacing. "  ")
            );
        }

        return sprintf(
            "%s'%s' => [%s%s],\n",
            $spacing,
            $name,
            $string,
            $spacing,
        );
    }

    static function renderVariantLine(Color $color, $variant, $spacing = "  "): string
    {
        return sprintf(
            "%s'%s' => new Color(%d, %d, %d),",
            $spacing,
            $variant,
            $color->R,
            $color->G,
            $color->B,
        );
    }

}
