<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Job Listing') }}
            </h2>
            <a href=" {{ route('admin.company_jobs.create') }} "
                class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">

                @forelse ($company_jobs as $job)
                    <div class="flex flex-row items-center justify-between item-card">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src=" {{ Storage::url($job->thumbnail) }} " alt="thumbnails"
                                class="rounded-2xl object-cover w-[120px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">
                                    {{ $job->name }}
                                </h3>
                                <p class="text-sm text-slate-500">
                                    {{ $job->category->name }}
                                </p>
                            </div>
                        </div>
                        <div class="flex-col hidden md:flex">
                            <p class="text-sm text-slate-500">Salary</p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                Rp {{ number_format($job->salary, 0, ',', '.') }}/mo
                            </h3>
                        </div>
                        <div class="flex-col hidden md:flex">
                            <p class="text-sm text-slate-500">Level</p>
                            <h3 class="text-xl font-bold text-indigo-950">{{ $job->skill_level }}</h3>
                        </div>
                        <div class="flex-col hidden md:flex">
                            <p class="text-sm text-slate-500">Candidates</p>
                            <h3 class="text-xl font-bold text-indigo-950">{{ $job->candidates->count() }}</h3>
                        </div>
                        <div class="flex-row items-center hidden md:flex gap-x-3">
                            <a href="{{ route('admin.company_jobs.show', $job) }}"
                                class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                                Manage
                            </a>
                        </div>
                    </div>
                @empty
                    <p>
                        Belum ada data pekerjaan
                    </p>
                @endforelse


            </div>
        </div>
    </div>
</x-app-layout>
