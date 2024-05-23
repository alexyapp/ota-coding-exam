<?php

namespace App\Services\JobAd;

use App\Events\FirstTimePosterHasCreatedJobAd;
use App\Models\JobAd;
use App\Models\Office;
use App\Repositories\JobAd\JobAdRepositoryInterface;
use App\Services\Category\CategoryServiceInterface;
use App\Services\Department\DepartmentServiceInterface;
use App\Services\Description\DescriptionServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class JobAdService implements JobAdServiceInterface
{
    public function __construct(private JobAdRepositoryInterface $repository) {}

    public function create(array $data): JobAd
    {
        if (isset($data['department'])) {
            $departmentService = app(DepartmentServiceInterface::class);
            $department = $departmentService->firstOrCreate($data['department']);
            $data['department_id'] = $department->getKey();
        }

        $jobAd = $this->repository->create($data);

        if (isset($data['category'])) {
            $categoryService = app(CategoryServiceInterface::class);
            $category = $categoryService->associate($jobAd, $data['category']);
        }

        if (isset($data['descriptions'])) {
            $descriptionService = app(DescriptionServiceInterface::class);
            foreach ($data['descriptions'] as $description) {
                $descriptionService->create($jobAd, $description);
            }    
        }

        if (!$jobAd->isPublished() && optional($jobAd->poster)->isFirstTimePoster()) {
            event(new FirstTimePosterHasCreatedJobAd($jobAd));
        }

        return $jobAd;
    }

    public function update(JobAd $jobAd, array $data): JobAd
    {
        if (isset($data['department'])) {
            $departmentService = app(DepartmentServiceInterface::class);
            $department = $departmentService->firstOrCreate($data['department']);
            $data['department_id'] = $department->getKey();
        }

        $jobAd = $this->repository->update($jobAd, $data);

        if (isset($data['category'])) {
            $categoryService = app(CategoryServiceInterface::class);
            $category = $categoryService->associate($jobAd, $data['category']);
        }

        return $jobAd;
    }

    public function findByExternalRef(string $externalRef): ?JobAd
    {
        return $this->repository->findByExternalRef($externalRef);
    }

    public function deleteAllBranches(JobAd $jobAd): void
    {
        $this->repository->deleteAllBranches($jobAd);
    }

    public function detachAllTags(JobAd $jobAd): void
    {
        $this->repository->detachAllTags($jobAd);
    }

    public function deleteAllDescriptions(JobAd $jobAd): void
    {
        $this->repository->deleteAllDescriptions($jobAd);
    }

    public function publish(JobAd $jobAd): JobAd
    {
        return $this->repository->publish($jobAd);
    }

    public function markAsSpam(JobAd $jobAd): JobAd
    {
        return $this->repository->markAsSpam($jobAd);
    }

    public function paginate(array $with = [], ?string $search = null): LengthAwarePaginator
    {
        return $this->repository->paginate($with, $search);
    }
    
    public function addNewBranch(JobAd $jobAd, string $branch): Office
    {
        return $this->repository->addNewBranch($jobAd, $branch);
    }
}
