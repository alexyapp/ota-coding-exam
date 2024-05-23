<?php

namespace App\Repositories\JobAd;

use App\Enums\EmploymentTypes;
use App\Enums\Schedules;
use App\Enums\Seniorities;
use App\Enums\YearsOfExperience;
use App\Models\JobAd;
use App\Models\Office;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class JobAdRepository implements JobAdRepositoryInterface
{
    public function create(array $data): JobAd
    {
        $jobAd = new JobAd;
        $jobAd->external_ref = $data['external_ref'] ?? null;
        $jobAd->title = $data['title'];
        $jobAd->employment_type = EmploymentTypes::from($data['employment_type']);
        $jobAd->seniority = Seniorities::from($data['seniority']);
        $jobAd->years_of_experience = YearsOfExperience::from($data['years_of_experience']);
        $jobAd->schedule = Schedules::from($data['schedule']);
        $jobAd->department_id = $data['department_id'];
        $jobAd->subcompany = $data['subcompany'];
        $jobAd->occupation = $data['occupation'];

        $user = auth()->user();

        if ($user) {
            $jobAd->user_id = $user->getKey();

            if (!$user->isFirstTimePoster()) {
                $jobAd->published_at = Carbon::now();
            }
        } else if (isset($data['published_at'])) {
            $jobAd->published_at = Carbon::parse($data['published_at']);
            $jobAd->marked_as_spam_at = null;
        }

        $jobAd->save();

        return $jobAd;
    }

    public function update(JobAd $jobAd, array $data): JobAd
    {
        $jobAd->external_ref = $data['external_ref'] ?? null;
        $jobAd->title = $data['title'];
        $jobAd->employment_type = EmploymentTypes::from($data['employment_type']);
        $jobAd->seniority = Seniorities::from($data['seniority']);
        $jobAd->years_of_experience = YearsOfExperience::from($data['years_of_experience']);
        $jobAd->schedule = Schedules::from($data['schedule']);
        $jobAd->department_id = $data['department_id'];
        $jobAd->subcompany = $data['subcompany'];
        $jobAd->occupation = $data['occupation'];

        if (isset($data['published_at'])) {
            $jobAd->published_at = Carbon::parse($data['published_at']);
            $jobAd->marked_as_spam_at = null;
        }

        $jobAd->save();

        return $jobAd;
    }

    public function publish(JobAd $jobAd): JobAd
    {
        $jobAd->update(['published_at' => now()]);

        return $jobAd;
    }

    public function markAsSpam(JobAd $jobAd): JobAd
    {
        $jobAd->update(['marked_as_spam_at' => now()]);

        return $jobAd;
    }

    public function paginate(array $with = [], ?string $search = null): LengthAwarePaginator
    {
        if ($search) {
            return JobAd::search($search)
                ->query(function ($query) use ($with) {
                    $query->with($with)
                        ->published();
                })
                ->paginate();
        } else {
            return JobAd::query()
                ->with($with)
                ->published()
                ->paginate();
        }
    }

    public function addNewBranch(JobAd $jobAd, string $branch): Office
    {
        return $jobAd->offices()->create(['name' => $branch]);
    }

    public function findByExternalRef(string $externalRef): ?JobAd
    {
        return JobAd::where('external_ref', $externalRef)->first();
    }

    public function deleteAllBranches(JobAd $jobAd): void
    {
        $jobAd->offices()->delete();
    }

    public function detachAllTags(JobAd $jobAd): void
    {
        $jobAd->tags()->detach();
    }

    public function deleteAllDescriptions(JobAd $jobAd): void
    {
        $jobAd->descriptions()->delete();
    }
}