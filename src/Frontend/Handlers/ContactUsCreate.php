<?php

namespace Core\Frontend\Handlers;

use Core\Frontend\DTO\ContactUs;
use Core\Frontend\Requests\ContactUsRequest;
use Illuminate\Http\RedirectResponse;

class ContactUsCreate
{

    public function __invoke(ContactUsRequest $request): RedirectResponse
    {
        $contactUs = ContactUs::fromRequest($request);

        // Send email to the admin
        // Mail::to(config('mail.from.address'))->send(new ContactUsMail($contactUs));

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully.');
    }

}
