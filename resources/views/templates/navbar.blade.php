@php
$user = Auth::user();

function currentClass($routes)
{
    $routes = is_array($routes) ? $routes : [$routes];
    $class = '';
    $current = Request::server('REQUEST_URI');
    foreach ($routes as $route) {
        $contain = strpos($route, '/*');
        if (!$contain) {
            if ($current == $route) {
                return 'active';
            }
        } else {
            $route = str_replace('/*', '', $route);
            if (strpos($current, $route) !== false) {
                return 'active';
            }
        }
    }
    return '';
}

$is_super_admin = $user ? $user->hasRole(['super-admin']) : false;
$is_admin = $user ? $user->hasRole(['admin']) : false;
$is_admin_or_super_admin = $user ? $user->hasRole(['admin', 'super-admin']) : false;
$polo = $user && $user->polo;

function getMenuClass($permission, $array_current = [])
{
    $class = 'dropdown-item ' . currentClass($array_current);
    $permission_value = is_bool($permission) ? $permission : hasPermissionTo($permission);
    if (!$permission_value) {
        $class .= ' disabled ';
    }
    return $class;
}

@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light py-0">
    <a class="navbar-brand py-0" href="/admin">
        <img src="{{ asset('logo.png') }}" class="logo-svg" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ currentClass(['/admin']) }}">
                <a class="nav-link pr-3" href="/admin">
                    <i class="el-icon-data-line mr-2"></i>
                    Painel
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ currentClass(['/admin/pixels/*','admin/links-encurtados/*']) }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="el-icon-s-order mr-2"></i>
                    Gerenciamento de Links
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="{{ getMenuClass('viewlist-pixels', ['/admin/pixels/*']) }}" href="/admin/pixels" data-label="Pixels de rastreamento">
                        Pixels
                    </a>
                    <a class="{{ getMenuClass('viewlist-short-urls', ['/admin/links-encurtados/*']) }}" href="/admin/links-encurtados">
                        Links Encurtados
                    </a>
                </div>
            </li>
        </ul>   
        <ul class="navbar-nav">
            <li class="nav-item dropdown hover-color ml-0">
                <a class="nav-link dropdown-toggle py-0 d-flex flex-row align-items-center" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="d-flex flex-column mr-2">
                        <b>{{ @$user->name ?? 'Nome do usuário' }}</b>
                        <small class="f-12">{{ @$user->email ?? 'Email do usuário'  }}</small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/admin/usuarios/{{ @$user->code }}/edit">
                        <div class="d-flex justify-content-between">
                            <span>Conta</span>
                            <span class="badge badge-default ml-5 pt-1 px-2">ID.: {{ @$user->code ?? 'xxxxxx'}}</span>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/login">Sair</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
