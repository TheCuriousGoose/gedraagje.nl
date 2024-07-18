<div class="p-3 bg-white mt-4 mb-2 rounded-3 shadow ">
    <div class="d-inline-flex w-100">
        <div class="bg-secondary rounded-3 p-2 d-flex justify-content-center align-items-center my-auto"
            style="width: 48px; height: 48px;">
            <i class="fa @yield('breadcrumb-icon', 'fa-list') fa-2xl text-white"></i>
        </div>
        <div class="mx-2 mb-0">
            <h4 class="m-0 fw-bold">
                @yield('breadcrumb-title', ucwords(Breadcrumbs::current()->title))
            </h4>
            <div>
                {{ Breadcrumbs::render(request()->route()->getName(),...array_values(request()->route()->parameters())) }}
            </div>
        </div>
        <div class="ms-auto d-inline-flex align-items-center" x-data="{ lanuageDropdownOpen: false }">
            <div class="d-inline-flex mx-2">
                <i class="fa-solid fa-globe fa-xl" @click="lanuageDropdownOpen = !lanuageDropdownOpen"></i>
                <div class="position-relative z-3" x-cloak x-show="lanuageDropdownOpen" @click.away="lanuageDropdownOpen = false">
                    <x-language-switcher  />
                </div>
            </div>
            <div class="mx-2">

                <div x-data="{ dropdownOpen: false }" class="position-relative">
                    <img src="{{ Auth::user()->getProfileImage() }}" alt="Profile image of {{ Auth::user()->name}}" class="rounded-5 cursor-pointer object-fit-cover "
                        width="42px" height="42px" @click="dropdownOpen = !dropdownOpen">
                    <div x-show="dropdownOpen" x-cloak @click.away="dropdownOpen = false"
                        class="position-absolute bg-white end-0 mt-4 pb-2 shadow rounded-3 z-3 "  style="width: 200px;">
                        <div class="d-flex align-items-center p-2 ">
                            <img src="{{ Auth::user()->getProfileImage() }}" alt="Profile image of {{ Auth::user()->name}}" width="42px" height="42px"
                                class="rounded-5 object-fit-cover ">
                            <div class="ms-2">
                                <p class="fw-bold  mb-0 lh-1">{{ Auth::user()->name }}</p>
                                    <span class="m-0">
                                        @foreach (Auth::user()->roles as $role)
                                            {{ $role->name }}
                                            @unless ($loop->last)
                                                ,
                                            @endunless
                                        @endforeach
                                    </span>
                            </div>
                        </div>
                        <hr class="my-1">
                        <div>
                            <a href="{{route('profiles.edit', Auth::user())}}" class="d-block px-2 py-1 text-decoration-none mw-100 user-dropdown-hover text-black">
                                <i class="fa fa-cog me-2"></i>
                                {{__('Edit account')}}
                            </a>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="border-0 user-dropdown-hover w-100 py-1 text-start bg-white px-2  text-danger text-decoration-none">
                                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>
                                {{__('Logout')}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
