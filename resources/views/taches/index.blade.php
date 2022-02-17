@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-xs">
       <a name="" id="" class="btn btn-primary m-2" href="{{ route('taches.create') }}" role="button">Ajouter une tache</a>
    </div>
    @if(Route::currentRouteName()=='taches.index')
    <div class="col-xs">
        <a name="" id="" class="btn btn-warning m-2" href="{{ route('taches.undone') }}" role="button">Voir les taches ouvertes</a>
    </div>
    <div class="col-xs">
        <a name="" id="" class="btn btn-success m-2" href="{{ route('taches.done') }}" role="button">Voir les taches terminées</a>
    </div>
    @elseif(Route::currentRouteName()=='taches.done')
    <div class="col-xs">
        <a name="" id="" class="btn btn-dark m-2" href="{{ route('taches.index') }}" role="button">Voir toutes les taches </a>
    </div>
    <div class="col-xs">
        <a name="" id="" class="btn btn-warning m-2" href="{{ route('taches.undone') }}" role="button">Voir les taches ouvertes</a>
    </div>
    @elseif(Route::currentRouteName()=='taches.undone')
    <div class="col-xs">
        <a name="" id="" class="btn btn-dark m-2" href="{{ route('taches.index') }}" role="button">Voir toutes les taches </a>
    </div>
    <div class="col-xs">
        <a name="" id="" class="btn btn-success m-2" href="{{ route('taches.undone') }}" role="button">Voir les taches terminées</a>
    </div>
    @endif 
  </div>
</div>

@foreach ($tache as $data)
<div class="alert alert-{{ $data->done ? 'success':'danger' }}" role="alert">
    <div class="row">
        <div class="col-sm">
            <p class="my-0">
                <strong>
                    <span class="badge badge-dark">
                        #{{$data->id}}
                    </span>
                </strong>
                <small>
                    Crée {{ $data->created_at->from() }} par 
                    {{ Auth::user()->id ==$data->user->id ? 'moi' : $data->user->name  }}
                    @if ($data->tacheAffectedTo && $data->tacheAffectedTo->id == Auth::user()->id)
                    affectée à moi
                    @elseif($data->tacheAffectedTo)
                    {{ $data->tacheAffectedTo ? ', affectée à '.$data->tacheAffectedTo->name: ''}}
                    @endif
                    {{-- display affected by someone or by user himself --}}
                    @if ($data->tacheAffectedTo && $data->tacheAffectedBy && $data->tacheAffectedBy->id == Auth::user()->id)
                    par moi-même :D 
                    @elseif ($data->tacheAffectedTo && $data->tacheAffectedBy && $data->tacheAffectedBy->id != Auth::user()->id)
                    par {{ $data->tacheAffectedBy->name }}
                    @endif
                </small>
                @if($data->done)
                <small>
                    <p>
                        Terminée
                        {{ $data->updated_at->from() }} - Terminée en 
                        {{ $data->updated_at->diffForHumans($data->created_at, 1)}}
                    </p>
                </small>
                @endif
            </p> 
            <details>
                <summary>
                    <strong>{{ $data->nom}} @if( $data->done)<span class="badge badge-success">Terminé</span>@endif</strong>
                </summary>
                <p>{{ $data->description}}</p>
            </details> 
        </div>
        <div class="col-sm form-inline justify-content-end my-1">

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                            Affecter à
                        </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($users as $user)
                        <a href="taches/{{$data->id}}/affectedto/{{$user->id}}" class="dropdown-item">{{ $user->name}}</a>
                    @endforeach
                </div>
            </div>
            @if($data->done == 0 )
            <form action="{{ route('taches.makedone',$data->id)}}" method ="post">
                @csrf 
                @method('PUT')
                <button type="submit" class="btn btn-success mx-1" style="min-width:110px">Terminé </button>
            </form>
            @else
            <form action="{{ route('taches.makeundone',$data->id)}}" method ="post">
                @csrf  
                @method('PUT')
                <button type="submit" class="btn btn-warning mx-1" style="min-width:110px">Non terminé</button>
            </form>
            @endif

            <a name="" id="" class="btn btn-info mx-1" href="{{ route('taches.edit',$data->id) }}" role="button">Editer</a>
            
            <form action="{{ route('taches.destroy',$data->id) }}" method ="post">
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-1">Effacer </button>
            </form>
            
        </div>
    </div>
</div>

@endforeach 
{{ $tache->links() }}
@endsection


