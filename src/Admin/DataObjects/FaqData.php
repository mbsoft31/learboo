<?php

namespace Core\Admin\DataObjects;

use App\Models\Faq;
use Spatie\LaravelData\Data;

class FaqData extends Data
{
    public function __construct(
        public int $id,
        public string $question,
        public string $answer,
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? 0,
            question: $data['question'],
            answer: $data['answer'],
        );
    }

    public static function fromModel(Faq $faq): self
    {
        return new self(
            id: $faq->id,
            question: $faq->question,
            answer: $faq->answer,
        );
    }
}
