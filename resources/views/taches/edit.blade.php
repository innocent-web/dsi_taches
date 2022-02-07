@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header bg-info">
        <h4 class="card-title">Modification de la tache <span class="badge badge-dark">#{{ $tache->id }}</span></h4>
    </div>
    <div class="card-body">
      <form action="{{ route('taches.update', $tache->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
          <label for="name">Titre</label>
          <input type="text" name="nom" class="form-control" id="name" aria-describedby="nameHelp"
            value="{{ old('nom', $tache->nom) }}">
          <small id="nameHelp" class="form-text text-muted">Entrez le titre de votre tache.</small>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" name="description" class="form-control" id="description" aria-describedby="nameHelp"
            value="{{ old('description', $tache->description) }}">
        </div>
        <div class="form-group form-check">
          <input class="form-check-input" type="checkbox" name="done" id="done" {{ $tache->done ? 'checked' : '' }}
            value=1>
          <label class="form-check-label" for="done">Done ?</label>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
      </form>
    </div>
</div>


@endsection