@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Escolher Indicadores</h3>
        </div>
        <div class="card-body">
            @TODO
            <form action="#" method="POST">
                @csrf
                <div class="row">
                    @foreach ([] as $indicator)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="indicator{{ $indicator->id }}" name="indicators[]" value="{{ $indicator->id }}"
                                    @if(auth()->user()->indicators->contains($indicator)) checked @endif>
                                    <label for="indicator{{ $indicator->id }}" class="custom-control-label">{{ $indicator->name }}</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-primary">Salvar Indicadores</button>
            </form>
        </div>
    </div>
</div>
@endsection
