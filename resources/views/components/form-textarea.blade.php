<!-- Modern Form Textarea Component with Icons -->
<!-- Usage: @include('components.form-textarea', ['label' => 'Notes', 'name' => 'notes', 'icon' => 'uil-file-text', 'rows' => 4]) -->

@props([
    'label' => null,
    'name' => '',
    'icon' => null,
    'value' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => null,
    'hint' => null,
    'placeholder' => null,
    'rows' => 4,
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

    <textarea 
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        class="form-control {{ $error ? 'is-invalid' : '' }} {{ $class }}"
        placeholder="{{ $placeholder ?? $label }}"
        @if ($required) required @endif
        @if ($disabled) disabled @endif
        @if ($readonly) readonly @endif
        {!! $attributes !!}
    >{{ $value ?? old($name) }}</textarea>

    @if ($error)
        <div class="invalid-feedback d-block">
            {{ $error }}
        </div>
    @endif

    @if ($hint && !$error)
        <small class="form-text">{{ $hint }}</small>
    @endif
</div>
