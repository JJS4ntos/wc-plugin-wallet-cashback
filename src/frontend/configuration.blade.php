<div class="jjsw-container">
    <h1 class="jjsw-title">Tela de configuração</h1>
    <hr>
    <p>
        {{ __('Defina o funcionamento da carteira virtual na sua loja.', 'wc-sw-jj') }}
    </p>
    @if( $_POST )
        @php
            update_option('wc-jj-wallet-enabled', $_POST['wc-jj-wallet-enabled'], false);
            update_option('wc-jj-cashback', $_POST['wc-jj-cashback'], false);
            update_option('wc-jj-cashback-mode', $_POST['wc-jj-cashback-mode'], false);
            update_option('wc-jj-cashback-percent', $_POST['wc-jj-cashback-percent'], false);
            update_option('wc-jj-cash-expire', $_POST['wc-jj-cash-expire'], false);
            update_option('wc-jj-cash-expire-days', $_POST['wc-jj-cash-expire-days'], false);
            update_option('wc-jj-cash-limit', $_POST['wc-jj-cash-limit'], false);
            update_option('wc-jj-products', $_POST['wc-jj-products'], false);
            update_option('wc-jj-products-categories', $_POST['wc-jj-products-categories'], false);
        @endphp
    @endif
    <form method="post">
        @foreach( $options as $name => $option )
            <div class="jjsw-form-group">
            @if( $option['type'] == 'number' )
                <label>{{ $option['label'] }}:</label>
                <input class="jjsw-form-input" type="number" name="{{ $name }}" value="{{ get_option($name) }}" step=".01">
            @elseif( $option['type'] == 'checkbox' )
                <label><span class="jjsw-checkbox">{{ $option['label'] }}:</span>
                    <input  type="checkbox" name="{{ $name }}" value="1"
                    {{ get_option($name)? 'checked':'' }}>
                </label>
            @elseif( $option['type'] == 'select' )
                <label>{{ $option['label'] }}:</label>
                <select class="jjsw-form-input" name="{{ $name }}">
                    @foreach( $option['values'] as $label => $value) 
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            @elseif( $option['type'] == 'select2' )
                <label>{{ $option['label'] }}:</label>
                <select class="jjsw-form-input select2" name="{{ $name }}[]" multiple="multiple">
                    @foreach( $categories as $cat )
                        <option value="{{ $cat->ID }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            @endif
            </div>
        @endforeach
        <div class="action">
            <button class="button sw-button">
                {{ __('Salvar Configurações', 'wc-sw-jj') }}
            </button>
        </div>
    </form>
</div>
