<!-- Modern Form Input Component with Icons -->
<!-- Usage: @include('components.form-input', ['label' => 'Email', 'name' => 'email', 'icon' => 'uil-envelope', 'type' => 'email']) -->

@props([
    'label' => null,
    'name' => '',
    'type' => 'text',
    'icon' => null,
    'placeholder' => null,
    'value' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => null,
    'hint' => null,
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

    <div @if ($icon) class="input-group-icon" @endif>
        <input 
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            class="form-control {{ $error ? 'is-invalid' : '' }} {{ $class }}"
            placeholder="{{ $placeholder ?? $label }}"
            value="{{ $value ?? old($name) }}"
            @if ($required) required @endif
            @if ($disabled) disabled @endif
            @if ($readonly) readonly @endif
            {!! $attributes !!}
        >
        @if ($icon)
            <i class="{{ $icon }}"></i>
        @endif
    </div>

    @if ($error)
        <div class="invalid-feedback d-block">
            {{ $error }}
        </div>
    @endif

    @if ($hint && !$error)
        <small class="form-text">{{ $hint }}</small>
    @endif
</div>
