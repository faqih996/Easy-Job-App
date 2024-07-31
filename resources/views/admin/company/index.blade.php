<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('My Company') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">

                {{-- This is no need to call function $company because already use 'compact' in controller  --}}
                <div class="flex flex-row items-center justify-between item-card">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src=" {{ Storage::url($company->logo) }} " alt=""
                            class="rounded-2xl object-cover w-[90px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{-- get company name --}}
                                {{ $company->name }}
                            </h3>
                            <p class="text-sm text-slate-500">
                                {{-- count company job from the company use relation in th model --}}
                                {{ $company->jobs->count() }} jobs posted
                            </p>
                        </div>
                    </div>
                    <div class="flex-row items-center hidden md:flex gap-x-3">
                        <a href=" {{ route('admin.company.edit', $company) }} "
                            class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Edit Company
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-indigo-950">About</h3>
                    <p>
                        {{ $company->about }}
                    </p>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
