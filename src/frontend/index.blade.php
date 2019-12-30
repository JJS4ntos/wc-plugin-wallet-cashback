<div class="container-fluid">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#config">{{ __('Configurações', 'wc-sw-jj') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#statistic">{{ __('Estatísticas', 'wc-sw-jj') }}</a>
		</li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active show" id="config">
            @include('screens.config')
        </div>
        <div class="tab-pane fade" id="statistic">
            <p>Em desenvolvimento</p>
        </div>
    </div>
</div>
