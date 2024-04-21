<?php

namespace Core\Admin\Handlers;

use App\Models\Subscription;
use Carbon\CarbonImmutable;
use Core\Admin\DataObjects\SubsriptionData;
use Core\Admin\Requests\SubscriptionCreateRequest;

class SubscriptionCreate
{

    public function __invoke(SubscriptionCreateRequest $request)
    {
        $data = SubsriptionData::fromArray($request->validated());

        if ($data->subscribed_at === null) {
            $data->subscribed_at = CarbonImmutable::create(now())->toImmutable();
        }

        $subscription = SubsriptionData::fromModel(Subscription::create($data->toArray()));

        return $subscription->toArray();
    }
}
