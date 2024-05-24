<?php

return [
    "main" => [
        'home' => [
            "label" => trans("navigation.home"),
            "route" => route("home"),
            "icon" => "home",
        ],
        'courses' => [
            "label" => trans("navigation.courses"),
            "route" => "courses",
            "icon" => "book",
        ],
        'read-boo' => [
            "label" => trans("navigation.read-boo"),
            "route" => "read-boo",
            "icon" => "book-open",
        ],
        'why_us' => [
            "label" => trans("navigation.why_us"),
            "route" => "why_us",
            "icon" => "users",
        ],
        'contact_us' => [
            "label" => trans("navigation.contact_us"),
            "route" => "contact_us",
            "icon" => "phone",
        ],
    ]
];
