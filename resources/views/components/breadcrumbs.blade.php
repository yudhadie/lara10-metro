@unless ($breadcrumbs->isEmpty())
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                    @if ($loop->first)
                    @else
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                    @endif
                    {{-- <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li> --}}
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted text-hover-primary" href="{{ $breadcrumb->url }}">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>

            @else
                @if ($loop->first)
                @else
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                @endif
                <li class="breadcrumb-item text-muted">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ul>
@endunless
