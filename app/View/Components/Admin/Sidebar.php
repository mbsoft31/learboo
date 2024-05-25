<?php

namespace App\View\Components\Admin;

use App\Models\Teacher;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;
use Illuminate\View\View;

class Sidebar extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();
        return view('components.admin.sidebar', [
            "teacher" => $teacher,
            "navigation" => $this->getNavigation(),
        ]);
    }

    private function getNavigation(): array
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();
        $links = [];
        if (collect($teacher->role)->contains('teacher')){
            $links["dashboard"] = [
                'label' => __('Dashboard'),
                'href'  => route("teacher.dashboard"),
                "active" => request()->routeIs("teacher.dashboard"),
                "icon" => "home",
            ];
            $links["courses"] = [
                'label' => __('Your courses'),
                'href'  => route("teacher.courses", $teacher),
                "active" => request()->routeIs("teacher.courses"),
                "icon" => "academic-cap",
            ];
            $links["courses-create"] = [
                'label' => __('New course'),
                'href'  => route("teacher.courses.create", $teacher),
                "active" => request()->routeIs("teacher.courses.create"),
                "icon" => "document-plus",
            ];
        } else {
            $links["dashboard"] = [
                'label' => __('Dashboard'),
                'href'  => route("dashboard"),
                "active" => request()->routeIs("dashboard"),
                "icon" => "home",
            ];
        }
        if (collect($teacher->role)->contains('admin'))
        {
            $links["dashboard"] = [
                'label' => __('Dashboard'),
                'href'  => route("admin.dashboard"),
                "active" => request()->routeIs("admin.dashboard"),
                "icon" => "home",
            ];
            $links["testimonials"] = [
                'label' => __('Testimonials'),
                'href'  => route("admin.testimonials"),
                "active" => request()->routeIs("admin.testimonials"),
                "icon" => "sparkles",
            ];
            $links["faqs"] = [
                'label' => __('Frequent questions'),
                'href'  => route("admin.faq"),
                "active" => request()->routeIs("admin.faq*"),
                "icon" => "question-mark-circle",
            ];
        }

        return $links;
    }
}
