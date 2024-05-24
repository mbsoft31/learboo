<?php

namespace Core\LmsLite\Repositories;

use App\Models\Course;
use App\Models\Teacher;
use Core\LmsLite\DataObjects\CourseData;
use Core\LmsLite\DataObjects\TeacherData;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

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
    public function getTeacherCourses(Request $request, Teacher|TeacherData $teacher): array
    {
        $filters = ['teacher_id' => ['=', $teacher->id]];

        $query = $this->courseQuery();

        $models = CourseData::collect(
            $query->where('teacher_id', $teacher->id)
                ->get()
        );

        return $models->toArray();
        /*$sort = ['date' => 'desc'];
        $fields = ['*']; // ['*'] or [] for all

        if ($request->has('search')) {
            $filters['title'] = ['like', '%' . $request->search . '%'];
            $filters['description'] = ['like', '%' . $request->search . '%'];
        }

        if ($request->has('status')) {
            $filters['status'] = $request->status;
        }

        if ($request->has('sort')) {
            $sort = $request->sort;
        }

        if ($request->has('filter'))
        {
            foreach ($request->query('filter') as $field => $value){
                $filters[$field] = $value;
            }
        }

        return app(CourseRepository::class)->getCourses($filters, $sort, $fields);*/
    }

    private function courseQuery(): QueryBuilder|Course
    {
        return QueryBuilder::for(Course::class)
            ->allowedFilters(['title', 'description', 'level', 'teacher_id'])
            ->allowedSorts(['date']);
    }

}
