<div class="form-group">
    <label for="{{ $name }}">{{ $option['label'] }}</label>
    <select class="form-control" id="{{ $name }}" name="{{ $name }}">
        @foreach( $option['values'] as $label => $value) 
            <option value="{{ $value }}" {{ get_option($name) == $value? 'selected':'' }}>{{ $label }}</option>
        @endforeach
    </select>
</div>