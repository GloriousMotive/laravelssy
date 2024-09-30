<x-filament-panels::page>
    @if ($isVideo)
        <video controls>
            <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }}">
            Ihr Browser unterstützt das Video-Tag nicht.
        </video>
    @elseif ($isImage)
        <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}">
    @else
        <p>Dieser Medientyp wird nicht unterstützt.</p>
    @endif
</x-filament-panels::page>
