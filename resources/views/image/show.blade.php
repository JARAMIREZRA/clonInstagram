@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('includes.message')

                <div class="card pub_image pub_image_show">
                    <div class="card-header">
                        <div class="container-avatar">
                            @if ($image->user->image)
                                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" alt=""
                                    class="avatar" />
                            @endif
                        </div>
                        <div class="data-user">
                            {{ $image->user->nick }}
                            |
                            <span class="nickname">{{ $image->user->name . ' ' . $image->user->last_name }} </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <section>
                            <div class="image-container image-show">
                                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="" />
                            </div>
                            <div class="likes">
                                @php
                                    $user_like = false;
                                @endphp
                                @foreach ($image->likes as $like)
                                    @if ($like->user->id == Auth::user()->id)
                                        @php
                                            $user_like = true;
                                        @endphp
                                    @endif
                                @endforeach

                                @if ($user_like)
                                    <a href="#" class="like btn-dislike" data-id="{{ $image->id }}" style="color: red">
                                        <i class="fas fa-heart fa-2x"></i>
                                    </a>
                                @else
                                    <a href="#" class="like btn-like" data-id="{{ $image->id }}">
                                        <i class="far fa-heart fa-2x"></i>
                                    </a>
                                @endif
                                <span class="num_likes">({{ count($image->likes) }})</span>
                            </div>

                            @if (Auth::user() && Auth::user()->id == $image->user->id)
                                <div class="actions">
                                    <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-sm btn-warning">Actualizar</a>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">Eliminar</button>

                                    <div class="modal" id="myModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Eliminar imagen</h4>
                                                </div>

                                                <div class="modal-body">
                                                    Esta apunto de eliminar la imagen, y esta accion no es reversible.
                                                    ¿Estas seguro?
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="{{ route('image.delete', ['id' => $image->id]) }}"
                                                        class="btn btn-success">Borrar</a>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="description">
                                <p class="nickname">{{ '@' . $image->user->nick }}</p>
                                <span>{{ \FormatTime::LongTimeFilter($image->created_at) }}</span>
                                <p>{{ $image->description }}</p>
                            </div>

                            <div class="clearfix"></div>

                            <div class="comments">
                                <h2>Comentarios ({{ count($image->comments) }})</h2>
                                <form action="{{ route('comment.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{ $image->id }}" />
                                    <p>
                                        <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content"
                                            required></textarea>
                                        @if ($errors->has('content'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                        @endif
                                    </p>

                                    <button type="submit" class="btn btn-outline-success">Crear</button>
                                </form>
                                <hr>
                                @foreach ($image->comments as $comment)
                                    <div class="comments">
                                        <div class="description">
                                            <p class="nickname">{{ '@' . $comment->user->nick }}</p>
                                            <span>{{ \FormatTime::LongTimeFilter($comment->created_at) }}</span>
                                            <p>{{ $comment->content }}</p>
                                            @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                                <a href="{{ route('comment.delete', ['id' => $comment->id]) }}"
                                                    class="btn-delete">
                                                    <i class="far fa-trash-alt fa-2x"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
