<?php

namespace Core\LmsLite\Handlers;

use App\Models\Teacher;
use Core\LmsLite\DataObjects\TeacherData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminListTeachers
{

    public function __invoke(Request $request): array
    {
        // features: filter, sort, pagination, search. implement each feature in a pipe like methods
        // filter: filter by status, sort: sort by name, pagination: 10 items per page, search: search by name

        // filter
        /** @var Builder $teachers */
        $teachers = Teacher::query();

        // search
        if ($request->has('search')) {
            $teachers->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status')) {
            $teachers->where('status', $request->status);
        }

        // sort
        $teachers->orderBy('name');

        // pagination
        $teachers = $teachers->paginate(10);

        return [
            'teachers' => TeacherData::collect($teachers),
        ];
    }

}
