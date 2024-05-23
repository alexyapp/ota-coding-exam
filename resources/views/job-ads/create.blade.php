<x-app-layout>
    <div class="container mx-auto py-8">
        @if (Session::has('success'))
            <p>{{ Session::get('success') }}</p>
        @endif

        <h1 class="text-xl font-bold mb-2">Post Job Ad</h1>

        <form action="{{ route('job-ads.store') }}" class="grid gap-4" method="POST">
            @csrf
            <div>
                <input type="text" name="title" class="rounded-md w-full" placeholder="Title">
            </div>
            <textarea name="descriptions[]" cols="30" rows="10" class="rounded-md" placeholder="Description 1"></textarea>
            <textarea name="descriptions[]" cols="30" rows="10" class="rounded-md" placeholder="Description 2"></textarea>
            <textarea name="descriptions[]" cols="30" rows="10" class="rounded-md" placeholder="Description 3"></textarea>

            <div>
                <label for="employment_type">Employment Type</label>
                <select name="employment_type" id="employment_type" class="block w-full rounded-md">
                    @foreach ($employment_types as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="schedule">Schedule</label>
                <select name="schedule" id="schedule" class="block w-full rounded-md">
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule }}">{{ $schedule }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="seniority">Seniority</label>
                <select name="seniority" id="seniority" class="block w-full rounded-md">
                    @foreach ($seniorities as $seniority)
                        <option value="{{ $seniority }}">{{ $seniority }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="years_of_experience">Years Of Experience</label>
                <select name="years_of_experience" id="years_of_experience" class="block w-full rounded-md">
                    @foreach ($years_of_experience as $experience)
                        <option value="{{ $experience }}">{{ $experience }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <input type="text" name="subcompany" placeholder="Subcompany" class="w-full rounded-md">
            </div>

            <div>
                <input type="text" name="occupation" placeholder="Occupation" class="w-full rounded-md">
            </div>

            <div>
                <input type="text" name="department" placeholder="Department" class="w-full rounded-md">
            </div>

            <button type="submit" class="px-6 py-3 text-white rounded-md inline-block bg-violet-500">Submit</button>
        </form>
    </div>
</x-app-layout>
