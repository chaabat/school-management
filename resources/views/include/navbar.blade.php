<nav class="bg-[#03045e] shadow shadow-gray-300 w-100 px-8 md:px-auto">
    <div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">

        <div class="text-[#fb5607] md:order-1">

            <img src="{{ asset('photos/mortier.png') }}" class="h-12" alt="">
            
        </div>

        <div class="order-2 md:order-3">
            <a href="{{ route('login') }}"
                class="px-4 py-2  bg-[#fb5607] hover:bg-indigo-600 text-gray-50 rounded-xl flex items-center gap-2">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
                <span>Login</span>
            </a>
        </div>
    </div>
</nav>