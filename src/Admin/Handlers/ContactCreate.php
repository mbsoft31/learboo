<?php

namespace Core\Admin\Handlers;

use App\Models\Contact;
use Core\Admin\DataObjects\ContactData;
use Core\Admin\Requests\ContactCreateRequest;
use Illuminate\Http\RedirectResponse;

class ContactCreate
{
    public function __invoke(ContactCreateRequest $request): RedirectResponse
    {
        $data = ContactData::fromRequest($request);

        // Do something with the data
        $contact = ContactData::fromModel(Contact::create($data->toArray()));
        // Mail::to(config('mail.from.address'))->send(new ContactUsMail($contactUs));

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully.');
    }
}
