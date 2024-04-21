<?php

namespace Core\Frontend\DTO;

use Core\Frontend\Requests\ContactUsRequest;

readonly class ContactUs extends BaseDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $phone,
        public ?string $course,
        public ?string $message
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'] ?? null,
            course: $data['course'] ?? null,
            message: $data['message'] ?? null,
        );
    }

    public static function fromRequest(ContactUsRequest $request): self
    {
        return new self(
            name: $request->name,
            email: $request->email,
            phone: $request->phone,
            course: $request->course,
            message: $request->message,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'course' => $this->course,
            'message' => $this->message,
        ];
    }
}
