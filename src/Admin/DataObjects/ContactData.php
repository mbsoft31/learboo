<?php

namespace Core\Admin\DataObjects;

use App\Models\Contact;
use Core\Admin\Requests\ContactCreateRequest;
use Spatie\LaravelData\Data;

class ContactData extends Data
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

    public static function fromRequest(ContactCreateRequest $request): self
    {
        return new self(
            name: $request->name,
            email: $request->email,
            phone: $request->phone,
            course: $request->course,
            message: $request->message,
        );
    }

    public static function fromModel(Contact $contact): ContactData
    {
        return new self(
            name: $contact->name,
            email: $contact->email,
            phone: $contact->phone,
            course: $contact->course,
            message: $contact->message,
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
