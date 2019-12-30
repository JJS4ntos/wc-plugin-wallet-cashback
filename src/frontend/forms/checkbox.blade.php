<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="{{ $name }}" name="{{ $name }}" value="1" {{ get_option($name)? 'checked':'' }}>
        <label class="custom-control-label" for="{{ $name }}">{{ $option['label'] }}</label>
    </div>
</div>