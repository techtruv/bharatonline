<!-- Modern Form Checkbox/Radio Component with Icons -->
<!-- Usage: @include('components.form-checkbox', ['label' => 'Remember me', 'name' => 'remember', 'type' => 'checkbox', 'icon' => 'uil-check']) -->

@props([
    'label' => null,
    'name' => '',
    'type' => 'checkbox',
    'icon' => null,
    'value' => '1',
    'checked' => false,
    'disabled' => false,
    'class' => '',
    'attributes' => ''
])

<div class="form-check">
    <input 
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        class="form-check-input {{ $class }}"
        @if ($checked || old($name) == $value) checked @endif
        @if ($disabled) disabled @endif
        {!! $attributes !!}
    >
    
    @if ($label)
        <label class="form-check-label" for="{{ $name }}">
            @if ($icon)
                <i class="{{$icon}}"></i>
            @endif
            {{ $label }}
        </label>
    @endif
</div>
