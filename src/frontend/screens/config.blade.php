<div class="bg-white p-3">
<h1 class="jjsw-title">Tela de configuração</h1>
<hr>
<p>
    {{ __('Defina o funcionamento da carteira virtual na sua loja.', 'wc-sw-jj') }}
</p>
@if( $_POST )
    @php
        function wc_jjsw_update($name, $default = '') {
            if( isset($_POST[$name]) ) {
                update_option($name, $_POST[$name], false);
            } else {
                update_option($name, $default, false);
            }
        }
        wc_jjsw_update('wc-jj-wallet-enabled', 0);
        wc_jjsw_update('wc-jj-cashback', 0);
        wc_jjsw_update('wc-jj-cashback-mode');
        wc_jjsw_update('wc-jj-cashback-percent', '');
        wc_jjsw_update('wc-jj-cashback-fixed-value', '');
        wc_jjsw_update('wc-jj-cash-expire');
        wc_jjsw_update('wc-jj-cash-expire-days');
        wc_jjsw_update('wc-jj-cash-limit');
        wc_jjsw_update('wc-jj-products', []);
        wc_jjsw_update('wc-jj-products-categories', []);
    @endphp
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ __('Configurações salvas!', 'wc-sw-jj') }}</strong> {{ __('As configurações já foram aplicadas a sua loja.', 'wc-sw-jj') }}
    </div>
@endif
<form method="post">
    <div class="row">
        @foreach( $options as $name => $option )
            <div class="col-md-5">
                @if( $option['type'] == 'number' )
                    @if( get_option('wc-jj-cashback-mode', false) == 'fixed' && $name == 'wc-jj-cashback-percent' )
                        @include('forms.input', ['name' => $name, 'option' => $option, 'props' => 'step=".01" readonly="readonly"'])
                    @elseif( get_option('wc-jj-cashback-mode', false) == 'percent' && $name == 'wc-jj-cashback-fixed-value' )
                        @include('forms.input', ['name' => $name, 'option' => $option, 'props' => 'step=".01" readonly="readonly"'])
                    @else
                        @include('forms.input', ['name' => $name, 'option' => $option, 'props' => 'step=".01"'])
                    @endif
                @elseif( $option['type'] == 'checkbox' )
                    @include('forms.checkbox', ['name' => $name, 'option' => $option])
                @elseif( $option['type'] == 'select' )
                    @include('forms.select', ['name' => $name, 'option' => $option])
                @elseif( $option['type'] == 'select2' )
                    <div class="form-group">
                        <label>{{ $option['label'] }}:</label><br>
                        <select class="select2" name="{{ $name }}[]" multiple="multiple">
                            @foreach( $categories as $cat )
                                <option value="{{ $cat->ID }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    <div class="action">
        <hr>
        <button type="submit" class="btn btn-primary">
            {{ __('Salvar Configurações', 'wc-sw-jj') }}
        </button>
    </div>
</form>
</div>
