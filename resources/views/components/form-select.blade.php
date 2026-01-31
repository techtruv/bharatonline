<!-- Modern Form Select Component with Icons -->
<!-- Usage: @include('components.form-select', ['label' => 'Category', 'name' => 'category', 'icon' => 'uil-list', 'options' => $categories]) -->

@props([
    'label' => null,
    'name' => '',
    'icon' => null,
    'options' => [],
    'value' => null,
    'required' => false,
    'disabled' => false,
    'error' => null,
    'hint' => null,
    'placeholder' => 'Select an option',
    'class' => '',
    'attributes' => ''
])

<div class="form-group mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            @if ($icon)
                <i class="{{$icon}}"></i>
            @endif
            {{ $label }}
            @if ($required)
                <span class="required">*</span>
            @endif
        </label>
    @endif

    <select 
        id="{{ $name }}"
        name="{{ $name }}"
        class="form-select {{ $error ? 'is-invalid' : '' }} {{ $class }}"
        @if ($required) required @endif
        @if ($disabled) disabled @endif
        {!! $attributes !!}
    >
        <option value="">{{ $placeholder }}</option>
        @forelse ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @if ($optionValue == ($value ?? old($name))) selected @endif>
                {{ $optionLabel }}
            </option>
        @empty
            <option value="" disabled>No options available</option>
        @endforelse
    </select>

    @if ($error)
        <div class="invalid-feedback d-block">
            {{ $error }}
        </div>
    @endif

    @if ($hint && !$error)
        <small class="form-text">{{ $hint }}</small>
    @endif
</div>
