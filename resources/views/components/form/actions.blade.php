@props(['submitLabel' => 'Simpan', 'cancelUrl' => null])

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="px-4 py-2 rounded-md text-white font-semibold" style="background:#0891B2;">{{ $submitLabel }}</button>
    @if($cancelUrl)
        <a href="{{ $cancelUrl }}" class="px-4 py-2 rounded-md border text-sm">Batal</a>
    @endif
</div>
