@extends('layouts.app')
@section('content')
@php
    $message = Session::get('message');
    $editing = isset($image);
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">
                    @lang($editing ? __("Editar mi Imagen") : __("subir nueva imagen"))
                </div>
                <div class="card-body">
                    <form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-7">
                                @if ($editing)
                                    @if ($image->user->image)
                                        <img class="avatar" src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="" />
                                    @endif
                                @endif
                                
                                <input type="file" class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }}" name="image_path" id="image_path" {{ $editing ? '' : 'required' }}/>
                                @if ($errors->has('image_path'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image_path') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">Descripcion</label>
                            <div class="col-md-7">
                                <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" cols="10" rows="5" required>{{ $editing ? $image->description : '' }}</textarea>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                                @if ($editing)
                                    <input type="hidden" name="image_id" value="{{ $image->id }}" />
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    @if ($editing)
                                        {{ __('Actualizar') }}
                                    @else
                                        {{ __('Crear') }} 
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection