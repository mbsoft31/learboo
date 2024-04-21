<?php

namespace Core\LmsLite\Repositories;

use App\Models\Course;
use App\Models\Teacher;
use Core\LmsLite\DataObjects\TeacherData;
use Illuminate\Http\Request;

class TeacherRepository
{

    /**
     * Create a new teacher
     *
     * @param TeacherData $data
     * @return TeacherData
     */
    public function createTeacher(TeacherData $data): TeacherData
    {
        return TeacherData::fromModel(Teacher::create([
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'email' => $data->email,

            'role' => $data->role,
            'nick_name' => $data->nick_name,
            'phone' => $data->phone,
            'imageUrl' => $data->imageUrl,
            'description' => $data->description,
            'about' => $data->about,
            'social' => $data->social,

            'user_id' => $data->user_id,
        ]));
    }

    /**
     * Get teacher's courses
     *
     * @param Teacher|TeacherData $teacher
     * @param Request $request
     * @return array
     */
    public function getTeacherCourses(Teacher|TeacherData $teacher, Request $request): array
    {
        $filters = ['teacher_id' => $teacher->id];
        $sort = ['date' => 'asc'];
        $fields = ['*']; // specify the fields you want to select, or leave it empty to select all fields

        if ($request->has('search')) {
            $filters['title'] = ['like', '%' . $request->search . '%'];
            $filters['description'] = ['like', '%' . $request->search . '%'];
        }

        if ($request->has('status')) {
            $filters['status'] = $request->status;
        }

        return app(CourseRepository::class)->getCourses($filters, $sort, $fields);
    }
}
