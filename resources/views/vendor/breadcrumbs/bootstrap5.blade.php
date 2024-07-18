@unless ($breadcrumbs->isEmpty())
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb flex-wrap rounded text-md mb-0">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb->url }}"
                           class="text-muted hover-text-decoration-underline focus-text-primary focus-text-decoration-underline">
                           {{ ucwords($breadcrumb->title) }}
                        </a>
                    </li>
                @elseif(!$loop->last)
                    <li class="breadcrumb-item text-muted">
                        {{ ucwords($breadcrumb->title) }}
                    </li>
                @else
                    <li class="breadcrumb-item active fw-bold" aria-current="page">
                        {{ ucwords($breadcrumb->title) }}
                    </li>
                @endif

                @unless ($loop->last)
                    <li class="px-2 text-muted">
                        /
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endunless
