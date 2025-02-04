@extends('../layouts.master')

@section('content')

    <body class="font-poppins text-[#0E0140] pb-[100px] overflow-x-hidden">
        <div id="page-background" class="absolute h-[863px] w-full top-0 -z-10 overflow-hidden">
            <img src="{{ asset('assets/backgrounds/Group 2009.png') }}" class="object-fill w-full h-full" alt="background">
        </div>
        <nav class="container max-w-[1130px] mx-auto flex items-center justify-between pt-10">
            <a href="index.html" class="flex shrink-0">
                <img src="{{ asset('assets/logos/Logo.svg') }}" alt="Logo">
            </a>
            <ul class="flex items-center gap-10">
                <li>
                    <a href="index.html"
                        class="transition-all duration-300 hover:font-semibold hover:text-[#FF6B2C] font-medium text-white">Home</a>
                </li>
                <li>
                    <a href="index.html"
                        class="transition-all duration-300 hover:font-semibold hover:text-[#FF6B2C] font-medium text-white">Features</a>
                </li>
                <li>
                    <a href="index.html"
                        class="transition-all duration-300 hover:font-semibold hover:text-[#FF6B2C] font-medium text-white">Benefits</a>
                </li>
                <li>
                    <a href="index.html"
                        class="transition-all duration-300 hover:font-semibold hover:text-[#FF6B2C] font-medium text-white">Stories</a>
                </li>
                <li>
                    <a href="index.html"
                        class="transition-all duration-300 hover:font-semibold hover:text-[#FF6B2C] font-medium text-white">About</a>
                </li>
            </ul>
            <div class="flex items-center gap-3">
                <a href="signin.html" class="rounded-full border border-white p-[14px_24px] font-semibold text-white">Sign
                    In</a>
                <a href="signup.html"
                    class="rounded-full p-[14px_24px] bg-[#FF6B2C] font-semibold text-white hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Sign
                    up</a>
            </div>
        </nav>
        <header class="container max-w-[1130px] mx-auto flex items-center justify-between gap-[50px] mt-[70px]">
            <div class="flex flex-col items-center w-full gap-4">
                <h1 class="font-black text-[36px] leading-[70px] text-white text-center">{{ ucfirst($category->name) }}</h1>
            </div>
        </header>

        <section id="Result" class="container max-w-[1130px] mx-auto flex flex-col gap-[30px] mt-[70px] w-fit">
            <div class="categories-container grid grid-cols-3 gap-[30px]">

                @forelse ($category->jobs as $job)
                    <div
                        class="card w-[300px] flex flex-col shrink-0 rounded-[20px] border border-[#E8E4F8] p-5 gap-5 bg-white shadow-[0_8px_30px_0_#0E01400D] hover:ring-2 hover:ring-[#FF6B2C] transition-all duration-300">
                        <div class="flex items-center gap-3 company-info">
                            <div class="w-[70px] flex shrink-0 overflow-hidden">
                                <img src="{{ Storage::url($job->company->logo) }}" class="object-contain w-full h-full"
                                    alt="logo">
                            </div>
                            <div class="flex flex-col">
                                <p class="font-semibold">{{ $job->company->name }}</p>
                                <p class="text-sm leading-[21px]">Posted at {{ $job->created_at }}</p>
                            </div>
                        </div>
                        <hr class="border-[#E8E4F8]">
                        <p class="job-title font-bold text-lg leading-[27px] h-[54px] flex shrink-0 line-clamp-2">
                            {{ $job->name }}</p>
                        <div class="job-info flex flex-col gap-[14px]">
                            <div class="flex items-center gap-[6px]">
                                <div class="flex w-6 h-6 shrink-0">
                                    <img src="{{ asset('assets/icons/note-favorite-orange.svg') }}" alt="icon">
                                </div>
                                <p class="font-medium">{{ $job->type }}</p>
                            </div>
                            <div class="flex items-center gap-[6px]">
                                <div class="flex w-6 h-6 shrink-0">
                                    <img src="{{ asset('assets/icons/moneys-cyan.svg') }}" alt="icon">
                                </div>
                                <p class="font-medium">Guaranteed</p>
                            </div>
                            <div class="flex items-center gap-[6px]">
                                <div class="flex w-6 h-6 shrink-0">
                                    <img src="{{ asset('assets/icons/location-purple.svg') }}" alt="icon">
                                </div>
                                <p class="font-medium">{{ $job->location }}</p>
                            </div>
                        </div>
                        <hr class="border-[#E8E4F8]">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col gap-[2px]">
                                <p class="font-bold text-lg leading-[27px]">Rp
                                    {{ number_format($job->salary, 0, ',', '.') }}</p>
                                <p class="text-sm leading-[21px]">/month</p>
                            </div>
                            <a href="{{ route('front.details', $job->slug) }}"
                                class="rounded-full p-[14px_24px] bg-[#FF6B2C] font-semibold text-white hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Details</a>
                        </div>
                    </div>
                @empty
                    <p class="text-lg text-white">Belum ada data pekerjaan terkait</p>
                @endforelse


            </div>
        </section>
    </body>
@endsection

@push('after-scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- JavaScript -->
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    {{-- make carousel --}}
    <script>
        $('.main-carousel').flickity({
            // options
            cellAlign: 'left',
            contain: true,
            prevNextButtons: false,
            pageDots: false
        });
    </script>
@endpush
