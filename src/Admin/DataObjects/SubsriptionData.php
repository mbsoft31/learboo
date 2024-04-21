<?php

namespace Core\Admin\DataObjects;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Data;

class SubsriptionData extends Data
{
    public function __construct(
        public int $id,
        public string $email,
        public ?CarbonImmutable $subscribed_at,
        public ?CarbonImmutable $unSubscribed_at,
    ){}

    public function isSubscribed(): bool
    {
        return $this->subscribed_at !== null && $this->unSubscribed_at === null;
    }

    public function isUnSubscribed(): bool
    {
        return $this->subscribed_at !== null && $this->unSubscribed_at !== null;
    }

    public static function fromModel($model): self
    {
        return new self(
            id: $model->id,
            email: $model->email,
            subscribed_at: $model->subscribed_at ? CarbonImmutable::parse($model->subscribed_at) : null,
            unSubscribed_at: $model->unSubscribed_at ? CarbonImmutable::parse($model->unSubscribed_at) : null,
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            email: $data['email'],
            subscribed_at: $data['subscribed_at'] ? CarbonImmutable::parse($data['subscribed_at']) : null,
            unSubscribed_at: $data['unSubscribed_at'] ? CarbonImmutable::parse($data['unSubscribed_at']) : null,
        );
    }
}
