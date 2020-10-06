@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create a new Jogo</h2>
        </div>
    </div>
</div>

<form action="{{ route('jogos.update', $jogo->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Título:</strong>
                <input type="text" name="titulo" class="form-control" value="{{$jogo->titulo}}">
                </div>
         </div>
     </div>

     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Descrição:</strong>
                <textarea  name="letra" class="form-control">{{$jogo->letra}}</textarea>
                </div>
         </div>
     </div>

     <div class="row">
        <div class="col text-center">
                
                <button type="submit" class="btn col btn-primary">UPDATE</button>
                
         </div>
     </div>

     

</form>


@endsection