<?php

namespace Core\Frontend\DTO;

use Illuminate\Support\Str;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class FaqData extends Data
{

    public function __construct(
        public string $question,
        public string $answer,
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            question: $data['question'],
            answer: $data['answer'],
        );
    }

    public function toArray(): array
    {
        return [
            'question' => $this->question,
            'answer' => $this->answer,
        ];
    }

    /**
     * @param string $file
     * @return array|DataCollection
     */
    public static function loadFromFile(string $file): array|DataCollection
    {
        $data = require $file;
        return self::collect($data);
    }

    public static function toPhpArrayString(array $data): string
    {
        return Str::of(json_encode($data, JSON_PRETTY_PRINT))
            ->replace('{', '[')
            ->replace('}', ']')
            ->replace(': ', ' => ')
            ->__toString();
    }

    public static function saveToFile(string $file, string $content): false|int
    {
        return file_put_contents($file, $content);
    }

}
