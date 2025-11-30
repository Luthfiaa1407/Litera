@props(['name', 'label' => '', 'type' => 'text', 'value' => null, 'placeholder' => '', 'required' => false])

<div>
    @if($label)
        <label class="block text-sm font-semibold mb-2" style="color:#065F46;">{{ $label }}</label>
    @endif

    <input type="{{ $type }}"
           name="{{ $name }}"
           value="{{ old($name, $value) }}"
           placeholder="{{ $placeholder }}"
           @if($required) required @endif
           {{ $attributes->merge(['class' => 'w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-200']) }}>

    @error($name)
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
