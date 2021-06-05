<div class="sidebar" data-color="orange" data-background-color="white"
     data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="https://www.w2o.com.br/" class="simple-text logo-normal" target="_blank">
            {{ __('Teste W2O') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'classes' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('classes.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Aulas') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'subjects' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('subjects.index') }}">
                    <i class="material-icons">group</i>
                    <p>{{ __('Matérias') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
