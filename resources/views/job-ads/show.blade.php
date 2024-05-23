<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-xl font-bold mb-2">{{ $jobAd->title }}</h1>

        <div class="grid gap-8">
            @foreach ($jobAd->descriptions as $description)
                <div>
                    @if ($description->title)
                        <p class="text-lg font-bold">{{ $description->title }}</p>
                    @endif
                    {!! $description->body !!}
                </div>
            @endforeach
        </div>

        <a href="#" class="px-6 py-3 text-white rounded-md inline-block bg-violet-500 mt-8">Apply Now</a>
    </div>
</x-app-layout>
