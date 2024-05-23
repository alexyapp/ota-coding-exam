<?php

namespace App\Console\Commands;

use App\Services\Description\DescriptionServiceInterface;
use App\Services\JobAd\JobAdServiceInterface;
use App\Services\Tag\TagServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Saloon\XmlWrangler\XmlReader;

class FetchJobListings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-job-listings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get(config('app.feed_url'));
        $reader = XmlReader::fromString($response->body());
        $jobListings = $reader->values()['workzag-jobs']['position'];
        $jobAdService = app(JobAdServiceInterface::class);

        foreach ($jobListings as $jobListing) {
            $data = [
                'title' => $jobListing['name'],
                'external_ref' => $jobListing['id'],
                'subcompany' => $jobListing['subcompany'],
                'office' => $jobListing['office'],
                'department' => $jobListing['department'],
                'category' => $jobListing['recruitingCategory'],
                'employment_type' => $jobListing['employmentType'],
                'seniority' => $jobListing['seniority'],
                'schedule' => $jobListing['schedule'],
                'years_of_experience' => $jobListing['yearsOfExperience'],
                'occupation' => $jobListing['occupation'],
                'department' => $jobListing['department'],
                'published_at' => $jobListing['createdAt'],
            ];

            $jobAd = $jobAdService->findByExternalRef($jobListing['id']);

            if ($jobAd) {
                $jobAd = $jobAdService->update($jobAd, $data);
            } else {
                $jobAd = $jobAdService->create($data);
            }

            // Branches/Offices
            $jobAdService->deleteAllBranches($jobAd);
            $jobAdService->addNewBranch($jobAd, $jobListing['office']);

            if (isset($jobListing['additionalOffices']['office'])) {
                foreach ($jobListing['additionalOffices']['office'] as $office) {
                    $jobAdService->addNewBranch($jobAd, $office);
                }
            }

            // Tags/Keywords
            $jobAdService->detachAllTags($jobAd);

            if (isset($jobListing['keywords'])) {
                $keywords = explode(',', $jobListing['keywords']);
                $keywords = array_map(function ($keyword) {
                    return trim($keyword);
                }, $keywords);

                $tagService = app(TagServiceInterface::class);
                $tags = collect();

                foreach ($keywords as $keyword) {
                    $tags->push($tagService->firstOrCreate($keyword));
                }

                $tagService->sync($jobAd, $tags->pluck('id')->toArray());
            }

            // Descriptions
            $jobAdService->deleteAllDescriptions($jobAd);

            if (isset($jobListing['jobDescriptions']['jobDescription'])) {
                $descriptionService = app(DescriptionServiceInterface::class);

                foreach ($jobListing['jobDescriptions']['jobDescription'] as $description) {
                    $descriptionService->create($jobAd, [
                        'title' => $description['name'],
                        'body' => $description['value'],
                    ]);
                }
            }
        }
    }
}
