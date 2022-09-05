<{{ $tag }} {{ $attributes }}>
    <div {{ $wireLoadingAttribute }}>
        @if ($icon)
            <x-dynamic-component
                :component="WireUi::component('icon')"
                :name="$icon"
                class="{{ $iconSize }} shrink-0"
            />
        @else
            {{ $label ?? $slot }}
        @endif
    </div>

    @if ($spinner)
        <x-phosphor.icons::regular.circle-notch
            class="animate-spin {{ $iconSize }} shrink-0"
            {{ $spinner }}
        />
    @endif
</{{ $tag }}>
