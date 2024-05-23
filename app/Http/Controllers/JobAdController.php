<?php

namespace App\Http\Controllers;

use App\Enums\EmploymentTypes;
use App\Enums\Schedules;
use App\Enums\Seniorities;
use App\Enums\YearsOfExperience;
use App\Http\Requests\CreateJobAdRequest;
use App\Models\JobAd;
use App\Services\JobAd\JobAdServiceInterface;
use Illuminate\Http\Request;

class JobAdController extends Controller
{
    public function index(Request $request, JobAdServiceInterface $jobAdService)
    {
        $jobAds = $jobAdService->paginate(with: ['descriptions', 'tags'], search: $request->input('query'));
        return view('dashboard', compact('jobAds'));
    }

    public function show(JobAd $jobAd)
    {
        return view('job-ads.show', compact('jobAd'));
    }

    public function create()
    {
        return view('job-ads.create', [
            'employment_types' => EmploymentTypes::values(),
            'schedules' => Schedules::values(),
            'seniorities' => Seniorities::values(),
            'years_of_experience' => YearsOfExperience::values(),
        ]);
    }

    public function store(CreateJobAdRequest $request, JobAdServiceInterface $jobAdService)
    {
        $jobAd = $jobAdService->create(
            array_merge(
                $request->only([
                    'title',
                    'employment_type',
                    'schedule',
                    'seniority',
                    'years_of_experience',
                    'subcompany',
                    'occupation',
                    'department'
                ]),
                [
                    'descriptions' => array_map(function ($description) {
                        return [
                            'title' => null,
                            'body' => $description
                        ];
                    }, $request->get('descriptions'))
                ]
            )
        );

        
        return redirect()->back()->with('success', 'Job Ad posted successfully!');
    }

    public function markAsSpam(JobAd $jobAd, JobAdServiceInterface $jobAdService)
    {
        $jobAdService->markAsSpam($jobAd);

        return redirect()->route('dashboard')->with('success', 'Successfully marked Job Ad as spam!');
    }

    public function approve(JobAd $jobAd, JobAdServiceInterface $jobAdService)
    {
        $jobAdService->publish($jobAd);

        return redirect()->route('dashboard')->with('success', 'Successfully published Job Ad!');
    }
}
