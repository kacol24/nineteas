@props(['name', 'type' => 'text', 'class' => 'form-control', 'required', 'autofocus'])

<label for="{{ $name }}">
    {{ $slot }}
</label>
<input id="{{ $name }}" name="{{ $name }}" {{ $attributes }} value="{{ old($name) }}"
       {{ $attributes->class(['is-invalid' => $errors->has($name)])->merge(['type' => $type, 'class' => $class]) }}
       @isset($required) required @endisset
       @isset($autofocus) autofocus @endisset
       aria-describedby="validation{{ Str::title($name) }}Feedback">
@error($name)
<div id="validation{{ Str::title($name) }}Feedback" class="invalid-feedback">
    {{ $message }}
</div>
@enderror
