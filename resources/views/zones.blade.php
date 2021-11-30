@extends('layout')

@section('content')

<h1>Liste des zones</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($zones as $zone)
            <div class="col">
                <div class="card mb-1" style="width: 18rem;">
                    <div class="card-header">
                        zone:{{$zone['id']}}
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">storage id: {{$zone['id']}}</li>
                            <li class="list-group-item">number: {{$zone['number']}}</li>
                            <li class="list-group-item">level: {{$zone['level']}}</li>
                            <li class="list-group-item">storage: {{$zone['storage']}}</li>
                            <li class="list-group-item">zone_id: {{$zone['zone_id']}}</li></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="justify-content-center">
        {{$zones->links()}}
    </div>

@endsection
