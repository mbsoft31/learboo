<?php

namespace Core\LmsLite\Handlers;

use Core\LmsLite\DataObjects\TeacherData;
use Core\LmsLite\Repositories\TeacherRepository;
use Core\LmsLite\Requests\TeacherCreateRequest;

class AdminTeacherCreate
{

    public function __invoke(TeacherRepository $repository, TeacherCreateRequest $request): array
    {
        $data = TeacherData::fromArray($request->validated());

        $teacher = $repository->createTeacher($data);

        return $teacher->toArray();
    }

}
