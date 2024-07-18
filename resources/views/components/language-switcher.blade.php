<div class="position-absolute bg-white shadow mt-5 end-0 rounded-3 p-2" >
    @foreach($available_locales as $locale_name => $available_locale)
        @if($available_locale === $current_locale)
            <span class="d-block px-2 py-1 bg-primary rounded-1 text-white">{{ $locale_name }}</span>
        @else
            <a class="user-dropdown-hover d-block px-2 py-1" href="{{ route('language-switch', $available_locale) }}">
                <span>{{ $locale_name }}</span>
            </a>
        @endif
    @endforeach
</div>
