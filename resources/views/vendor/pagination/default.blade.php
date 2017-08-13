@if ($paginator->hasPages())
    <div class="page">
        <div class="page_box">
            <ul>
                @if ($paginator->onFirstPage())
                    <li>上一页</li>
                @else
                    <li><a href="{{ $paginator->previousPageUrl() }}">上一页</a></li>
                @endif
                @foreach ($elements as $k=>$element)
                    {{-- "Three Dots" Separator --}}
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active">{{ $page }}</li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}">下一页</a></li>
                @else
                    <li class="disabled">下一页</li>
                @endif
            </ul>
            <div class="page_right">
                共<span>{{$paginator->lastPage()}}页</span> &nbsp;&nbsp;&nbsp;到第&nbsp;
                <input type="text" class="text_input">&nbsp; 页
                <input type="button" value="确定" class="btn_input">
            </div>
        </div>
    </div>
@endif
