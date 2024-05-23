<x-mail::message>
# {{ $jobAd->title }}

@foreach ($jobAd->descriptions as $description)
    {{ $description->body }}
@endforeach

<x-mail::button :url="route('job-ads.approve', $jobAd)">
Publish
</x-mail::button>

<x-mail::button :url="route('job-ads.mark-as-spam', $jobAd)">
Mark As Spam
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
