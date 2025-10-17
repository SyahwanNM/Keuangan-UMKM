@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm style="color: var(--color-text_secondary, #6B7280);"']) }}>
    {{ $value ?? $slot }}
</label>
