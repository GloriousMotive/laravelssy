<x-filament-panels::page>
    <x-filament::section>
        @if ($isVideo)
            @push('styles')
                @vite(['resources/css/videojs.css'])
            @endpush

            @push('scripts')
                @vite(['resources/js/videojs.js'])
            @endpush

            <video id="my-video" class="video-js vjs-fluid">
                <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }}">
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
            </video>
        @elseif ($isImage)
            @push('styles')
                @vite(['resources/css/fancyapps.css'])
            @endpush

            @push('scripts')
                @vite(['resources/js/fancyapps.js'])
            @endpush

            <div class="flex justify-center items-center">
                <a href="{{ $media->getUrl() }}" data-fancybox="single" data-caption="Single image">
                    <img src="{{ $media->getUrl() }}" class="max-w-full h-auto" />
                </a>
            </div>
        @else
            <p>Dieser Medientyp wird nicht unterstützt.</p>
        @endif
    </x-filament::section>
</x-filament-panels::page>
