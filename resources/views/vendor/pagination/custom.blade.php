@if ($paginator->hasPages())
    <ul class="pagination pagination-sm mb-0">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link border-0 bg-transparent">
                    <i class="fas fa-chevron-left"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link border-0 bg-transparent" href="{{ $paginator->previousPageUrl() }}" aria-label="Anterior">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link border-0 bg-transparent">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link border-0" style="background-color: #6f42c1;">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link border-0 bg-transparent" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link border-0 bg-transparent" href="{{ $paginator->nextPageUrl() }}" aria-label="Siguiente">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link border-0 bg-transparent">
                    <i class="fas fa-chevron-right"></i>
                </span>
            </li>
        @endif
    </ul>

    <style>
        .pagination {
            margin-bottom: 0;
        }
        
        .pagination .page-item .page-link {
            padding: 0.25rem 0.6rem;
            font-size: 0.875rem;
            color: #6f42c1;
            border-radius: 3px;
            margin: 0 1px;
        }
        
        .pagination .page-item.active .page-link {
            background-color: #6f42c1;
            color: white;
        }
        
        .pagination .page-item .page-link:hover:not(.active) {
            color: #5a36a0;
            background-color: rgba(111, 66, 193, 0.1);
        }
        
        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
        }
    </style>
@endif
