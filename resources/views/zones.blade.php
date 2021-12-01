@extends('layout')

@section('content')

<h1>Liste des zones</h1>
<h2 class="text-center">Liste des zones</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($zones as $zone)
            <div class="col">
                <div class="card mb-1" style="width: 18rem;">
                    <div class="card-header" style="background-color: #5cb85c;">
                        zone:{{$zone['id']}}
                    </div>
                    @foreach($zone->storages->slice(0,5) as $storage)
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">storage id: {{$storage['id']}}</li>
                            <li class="list-group-item">number: {{$storage['number']}}</li>
                            <li class="list-group-item">level: {{$storage['level']}}</li>
                            <li class="list-group-item">storage: {{$storage['storage']}}</li>
                            <li class="list-group-item">zone_id: {{$storage['zone_id']}}</li></li>
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="justify-content-center">
        {{$zones->links()}}
    </div>

@endsection
