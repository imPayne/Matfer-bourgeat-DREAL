<!-- resources/views/components/layout.blade.php -->

<div>
    <h1>Liste des Buildings</h1>
    <div class="container">
    <x-layout>
        @foreach($zones as $zone)
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    zone:{{$zone['id']}}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">storage id: {{$zone['id']}}</li>
                    <li class="list-group-item">number: {{$zone['number']}}</li>
                    <li class="list-group-item">level: {{$zone['level']}}</li>
                    <li class="list-group-item">storage: {{$zone['storage']}}</li>
                    <li class="list-group-item">zone_id: {{$zone['zone_id']}}</li></li>
                </ul>
            </div>
        @endforeach
    </x-layout>
    </div>
        <span>
            {{$zones->links()}}
            {{$storages->links()}}
        </span>

        <style>
            .w-5{
                display: none;
            }
        </style>
</div>