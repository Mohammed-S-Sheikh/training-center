@if ($paginator->hasPages())
<div class="dataTables_info" style="float:right;">عرض نتائج من {{ $paginator->firstItem() }} إلى {{ $paginator->lastItem() }} إجمالي {{ $paginator->total() }} عنصر</div>

<div class="dataTables_paginate paging_simple_numbers" style="float:left;">
    @if ($paginator->onFirstPage())
        <span class="page-link" aria-hidden="true">السابق</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="paginate_button previous disabled">السابق</a>
    @endif

    <span>
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        {{-- @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif --}}

        {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="paginate_button current" aria-controls="example" data-dt-idx="1" tabindex="0">{{ $page }}</a>
                    @else
                        <a class="paginate_button " aria-controls="example" data-dt-idx="2" tabindex="0" href="{{ $url }}">{{ $page }}</a>
                        {{-- <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li> --}}
                    @endif
                @endforeach
            @endif
        @endforeach
    </span>

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="paginate_button next">التالي</a>
    @else
        <span class="page-link" aria-hidden="true">التالي</span>
    @endif
</div>
@endif