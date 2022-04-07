@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-5">Usuarios</h1>
                <form id="search" action="{{ route('user.index') }}" method="get">
                    <div class="row">
                        <div class="form-group col">
                            <input type="text" id="search_text" class="form-control" />
                        </div>
                        <div class="form-group col btn-search">
                            <button type="submit" class="btn btn-primary">Busacar</button>
                        </div>
                    </div>
                </form>

                @foreach ($users as $user)
                    <div class="profile-user">
                        @if ($user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" alt="" class="avatar" />
                            </div>
                        @endif
                        <div class="user-info">
                            <h2>{{ '@' . $user->nick }}</h2>
                            <h3>{{ $user->name . ' ' . $user->last_name }}</h3>
                            <span>Se Unio {{ \FormatTime::LongTimeFilter($user->created_at) }}</span>
                            <br>
                            <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="btn btn-sm btn-success mt-2">Ver Perfil</a>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <div class="clearfix">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
