@props(['name', 'label' => '', 'value' => null, 'placeholder' => '', 'rows' => 4])

<div>
    @if($label)
        <label class="block text-sm font-semibold mb-2" style="color:#065F46;">{{ $label }}</label>
    @endif

    <textarea name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
              {{ $attributes->merge(['class' => 'w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-200']) }}>{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
