<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (Session::has('success'))
        <div class="container mx-auto pt-8 pb-0">
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif

    <div class="container mx-auto">
        <form action="{{ route('dashboard') }}" class="py-8 flex items-center gap-2">
            <input type="text" placeholder="Search" class="w-full rounded-md" name="query">
            <button type="submit" class="px-4 py-2 text-white rounded-md inline-block text-sm bg-violet-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </form>
    </div>

    <div class="container mx-auto grid xl:grid-cols-2 gap-8 py-8">
        @foreach ($jobAds as $jobAd)
            <div class="bg-white rounded-md p-8 flex flex-col">
                <h1 class="text-lg font-bold mb-1">{{ $jobAd->title }}</h1>
                <p class="text-sm mb-2">{{ $jobAd->published_at->format('Y/m/d') }}</p>

                <p class="text-sm mb-2"><span class="font-bold">Years Of Experience:</span> {{ $jobAd->years_of_experience }}, <span class="font-bold">Employment Type:</span> {{ $jobAd->employment_type }}, <span class="font-bold">Schedule:</span> {{ $jobAd->schedule }}, <span class="font-bold">Seniority:</span> {{ $jobAd->seniority }}</p>

                @if ($jobAd->offices->count())
                    <p class="text-sm mb-2"><span class="font-bold">Location:</span> {{ $jobAd->offices->pluck('name')->implode(', ') }}</p>
                @endif

                @if ($jobAd->descriptions->first())
                    <p class="mb-2 flex-1">{{ Str::limit(strip_tags(trim($jobAd->descriptions->first()->body)), 300) }}</p>
                @endif

                @if ($jobAd->tags->count())
                    <div class="flex gap-2 mb-6">
                        @foreach ($jobAd->tags as $tag)
                            <span class="bg-black text-xs text-white rounded-md p-1 px-2">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif

                <div>
                    <a href="{{ route('job-ads.show', $jobAd) }}" class="px-4 py-2 text-white rounded-md inline-block text-sm bg-violet-500">Learn More</a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
