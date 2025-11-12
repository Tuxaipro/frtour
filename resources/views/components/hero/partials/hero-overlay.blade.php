@props(['hero'])

@if($hero->background_video)
    {{-- Only show overlay for video backgrounds, not for images --}}
    <div class="absolute inset-0" style="{{ $hero->overlay_style }}"></div>
@elseif(!$hero->background_image)
    {{-- Show pattern overlay only when there's no background image --}}
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%233B82F6\" fill-opacity=\"0.05\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>
@endif

