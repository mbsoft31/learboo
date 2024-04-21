<?php

namespace Core\LmsLite\DataObjects;

use App\Models\Teacher;
use Spatie\LaravelData\Data;

class TeacherData extends Data
{
    public function __construct(
        public int $id,
        public string $first_name,
        public string $last_name,
        public string $email,

        public array $role,
        public ?string $nick_name,
        public ?string $phone,
        public ?string $imageUrl,
        public ?string $description,
        public ?string $about,
        public array $social,

        public int $user_id,
        public ?string $fullName = null,
    ){
        $this->fullName = "{$this->first_name} {$this->last_name} ({$this->nick_name})";
    }

    public static function fromArray(array $input): self
    {
        return new self(
            id: $input['id'] ?? 0,
            first_name: $input['first_name'],
            last_name: $input['last_name'],
            email: $input['email'],

            role: $input['role'] ?? [],
            nick_name: $input['nick_name'] ?? null,
            phone: $input['phone'] ?? null,
            imageUrl: $input['imageUrl'] ?? null,
            description: $input['description'] ?? null,
            about: $input['about'] ?? null,
            social: $input['social'] ?? [],

            user_id: $input['user_id'],
        );
    }

    public static function fromModel(Teacher $teacher): self
    {
        return new self(
            id: $teacher->id,
            first_name: $teacher->first_name,
            last_name: $teacher->last_name,
            email: $teacher->email,

            role: $teacher->role,
            nick_name: $teacher->user->name,
            phone: $teacher->phone,
            imageUrl: $teacher->imageUrl,
            description: $teacher->description,
            about: $teacher->about,
            social: $teacher->social,

            user_id: $teacher->user_id,
        );
    }
}
