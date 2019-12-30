<div class="form-group">
    <label for="{{ $name }}">{{ $option['label'] }}</label>
    <input type="{{ $option['type'] }}" class="form-control" id="{{ $name }}" name="{{ $name }}" aria-describedby="{{ $name }}Help"
     placeholder="{{ $option['placeholder'] }}" value="{{ get_option($name) }}" {{ $props }}>
    <small id="{{ $name }}Help" class="form-text text-muted">{{ $option['textHelp'] }}</small>
</div>