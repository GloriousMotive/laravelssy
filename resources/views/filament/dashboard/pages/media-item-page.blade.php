<x-filament-panels::page>
    @if ($isVideo)
        <video controls>
            <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }}">
            Ihr Browser unterstützt das Video-Tag nicht.
        </video>
    @elseif ($isImage)
        @push('styles')
            @vite(['resources/css/fancyapps.css'])
        @endpush

        @push('scripts')
            @vite(['resources/js/fancyapps.js'])
        @endpush

        <a href="{{ $media->getUrl() }}" data-fancybox="single" data-caption="Single image">
            <img src="{{ $media->getUrl() }}" />
        </a>
    @else
        <p>Dieser Medientyp wird nicht unterstützt.</p>
    @endif
</x-filament-panels::page>
