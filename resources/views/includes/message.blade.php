@php
    $message = Session::get('message');
@endphp

@if ($message)
    @if ($message == 'success')
        <div class="alert alert-success">
            Actualizado Correctamente
        </div>
    @endif
    @if ($message == 'update')
        <div class="alert alert-success">
            Creado Correctamente
        </div>
    @endif
    @if ($message == 'error')
        <div class="alert alert-danger">
            Error al ingresar los datos
        </div>
    @endif
@endif