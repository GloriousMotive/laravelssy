<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        @if ($getMedia() && $isVideo())
            @push('styles')
                @vite(['resources/css/videojs.css'])
            @endpush

            @push('scripts')
                @vite(['resources/js/videojs.js'])
            @endpush

            <video id="my-video" class="video-js vjs-fluid w-full aspect-video object-contain">
                <source src="{{ $getMedia()->getUrl() }}" type="{{ $getMedia()->mime_type }}">
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
            </video>
        @elseif ($getMedia() && $isImage())
            @push('styles')
                @vite(['resources/css/fancyapps.css'])
            @endpush

            @push('scripts')
                @vite(['resources/js/fancyapps.js'])
            @endpush

            <div class="flex justify-center items-center">
                <a href="{{ $getMedia()->getUrl() }}" data-fancybox="single" data-caption="Single image">
                    <img src="{{ $getMedia()->getUrl() }}" class="w-full aspect-video object-contain" />
                </a>
            </div>
        @else
            <p>Dieser Medientyp wird nicht unterstützt.</p>
        @endif
    </div>
</x-dynamic-component>
