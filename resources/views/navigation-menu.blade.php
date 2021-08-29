<nav x-data="{ open: false }"
    class="bg-white sm:relative absolute left-0 right-0 top-0 bottom-0 w-full md:w-[380px] border-l border-[#E9EAEB]">
    <!-- Primary Navigation Menu -->
    <div class="bg-[#FBBC41] w-full flex justify-center">
        <img src="https://nytrogin.com/wp-content/uploads/2021/02/logo-nytrogin.svg" alt="" srcset="">
    </div>

    <div class="flex w-full justify-between px-4 py-4">
        <div class="text-white bg-[#72559D] h-10 w-10 grid place-content-center place-items-center rounded-full">
            <span class="material-icons">
                menu_open
            </span>
        </div>
        <div class="text-gray-400 h-10 w-10 grid place-content-center place-items-center relative">
            <span
                class="animate-ping absolute inline-flex h-3 w-3 top-1 right-1 rounded-full bg-purple-400 opacity-75 notif-ping hidden"></span>
            <span
                class="absolute inline-flex rounded-full h-3 w-3 top-1 right-1 bg-purple-500 notif-ping hidden"></span>
            <span class="material-icons relative cursor-pointer" id="notification_button">
                notifications
            </span>
            <div class="w-[250px] bg-white border-2 shadow-xl absolute top-10  hidden p-5" id="notifications">
            </div>
        </div>

    </div>
    <div class="flex flex-col w-full gap-1 p-4 justify-center items-center text-center">
        <div
            class="rounded-full h-[120px] shadow-xl w-[120px] border-2 border-[#71579A] grid place-items-center place-content-center text-4xl font-black text-[#71579A]">
            <div
                class="rounded-full h-[75px] w-[75px] bg-[#F6F8FC] shadow grid place-items-center place-content-center text-3xl font-black text-[#71579A]">
                @php
                    $words = explode(' ', auth()->user()->name);
                @endphp
                {{ Str::substr($words[0], 0, 1) . '.' . Str::substr($words[1], 0, 1) }}
            </div>
        </div>

        <div class="text-2xl font-bold text-[#71579A] mt-5">{{ auth()->user()->name }} </div>
        <span class="text-gray-400 text-xl capitalize font-normal mb-6">{{ __(auth()->user()->role->name) }}</span>
    </div>
    <div class="">
        <div class="flex flex-col">
            <!-- Navigation Links -->

            <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                <span class="material-icons ml-6">
                    dashboard
                </span>
                {{ __('لوحة القيادة') }}
            </x-jet-nav-link>
            <x-jet-nav-link href="{{ route('dashboard') }}">
                <span class="material-icons ml-6">
                    people
                </span>
                {{ __('الفريق') }}
            </x-jet-nav-link>
            <x-jet-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                <span class="material-icons ml-6">
                    settings
                </span>
                {{ __('اعدادات حسابي') }}
            </x-jet-nav-link>
            <x-jet-nav-link href="{{ route('dashboard') }}">
                <span class="material-icons ml-6">
                    location_city
                </span>
                {{ __('الجهات') }}
            </x-jet-nav-link>
            {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-jet-responsive-nav-link>
            </form> --}}

        </div>
        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                    :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                        :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}"
                            :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @section('footerScripts2')
        <script>
            let isShown = false;
            $('#notification_button').focusout(function(e) {
                $('#notifications').fadeOut();
            });
            $('#notification_button').click(function(e) {
                isShown = !isShown;
                $('#notifications').html('');

                if (isShown)
                    $('#notifications').fadeIn();
                else
                    $('#notifications').fadeOut();
            });

            function get_notifications() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('notifications') }}",
                    success: function(notifications) {
                        if (Object.values(notifications).length > 0) {
                            $('.notif-ping').fadeIn();
                        }
                        console.log(Object.values(notifications));
                        $('#notifications').html('');
                        Object.values(notifications).forEach(notification => {
                            let notiHtml =
                                `<a href="${notification.link}"><p class=" text-black">${notification.body}</p><br><span></span></a>`;
                            $('#notifications').append(notiHtml);
                        });
                    }
                });
            }
        </script>
    @endsection
</nav>
