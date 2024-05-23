<?php

namespace App\Services\JobAd;

use App\Models\JobAd;
use App\Models\Office;
use Illuminate\Pagination\LengthAwarePaginator;

interface JobAdServiceInterface
{
    public function create(array $data): JobAd;
    
    public function update(JobAd $jobAd, array $data): JobAd;

    public function publish(JobAd $jobAd): JobAd;

    public function markAsSpam(JobAd $jobAd): JobAd;

    public function paginate(array $with = [], ?string $search = null): LengthAwarePaginator;

    public function addNewBranch(JobAd $jobAd, string $branch): Office;

    public function findByExternalRef(string $externalRef): ?JobAd;

    public function deleteAllBranches(JobAd $jobAd): void;

    public function detachAllTags(JobAd $jobAd): void;

    public function deleteAllDescriptions(JobAd $jobAd): void;
}