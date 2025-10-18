@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between px-2 py-1">
        {{-- Mobile Pagination --}}
        <div class="flex justify-between flex-1 gap-3 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed leading-5 rounded-lg">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Previous</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-black bg-white border border-gray-300 leading-5 rounded-lg hover:bg-gray-50 hover:text-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Previous</span>
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-black bg-white border border-gray-300 leading-5 rounded-lg hover:bg-gray-50 hover:text-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 shadow-sm">
                    <span>Next</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            @else
                <span class="relative inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed leading-5 rounded-lg">
                    <span>Next</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @endif
        </div>

        {{-- Desktop Pagination --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            {{-- Results Info --}}
            <div class="flex items-center">
                <p class="text-sm text-gray-600 leading-5 flex items-center gap-1.5 bg-gray-50 px-4 py-2 rounded-lg border border-gray-200">
                    <span class="text-gray-500">Menampilkan</span>
                    <span class="font-semibold text-gray-900">{{ $paginator->firstItem() ?? 0 }}</span>
                    <span class="text-gray-500">-</span>
                    <span class="font-semibold text-gray-900">{{ $paginator->lastItem() ?? 0 }}</span>
                    <span class="text-gray-500">dari</span>
                    <span class="font-semibold text-primary">{{ $paginator->total() }}</span>
                    <span class="text-gray-500">data</span>
                </p>
            </div>

            {{-- Pagination Links --}}
            <div class="flex items-center gap-1">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="Previous" class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-not-allowed rounded-lg leading-5 shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-black bg-white border border-gray-300 rounded-lg leading-5 hover:bg-primary hover:text-white hover:border-primary focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary active:bg-primary active:text-white transition-all ease-in-out duration-200 shadow-sm" aria-label="Previous">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true" class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-lg shadow-sm">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="relative inline-flex items-center justify-center min-w-[2.5rem] h-10 px-3 text-sm font-semibold text-white bg-primary border-2 border-primary cursor-default leading-5 rounded-lg shadow-md z-10">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="relative inline-flex items-center justify-center min-w-[2.5rem] h-10 px-3 text-sm font-medium text-black bg-white border border-gray-300 leading-5 rounded-lg hover:bg-primary hover:text-white hover:border-primary focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary active:bg-primary active:text-white transition-all ease-in-out duration-200 shadow-sm" aria-label="Go to page {{ $page }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-black bg-white border border-gray-300 rounded-lg leading-5 hover:bg-primary hover:text-white hover:border-primary focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary active:bg-primary active:text-white transition-all ease-in-out duration-200 shadow-sm" aria-label="Next">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="Next" class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-not-allowed rounded-lg leading-5 shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
