<?php

namespace Core\Admin\Handlers;

use App\Models\Faq;
use Core\Admin\DataObjects\FaqData;
use Core\Admin\Requests\FaqCreateRequest;

class FaqCreate
{

    public function __invoke(FaqCreateRequest $request): array
    {
        $data = FaqData::fromArray($request->validated());

        $faq = FaqData::fromModel(Faq::create($data->toArray()));

        return $faq->toArray();
    }
}
