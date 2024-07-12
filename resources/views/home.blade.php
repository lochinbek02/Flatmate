@extends('welcome')
@section('content1')
<li><a href="{{route('notifications')}}"><i class="bi bi-bell bi-lg"></i><span style="color: red;">+{{$len}}</span></a></li>

@endsection
@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            <div class="row">
                 
                       
                    
                @foreach ($response as $item)
                    <div class="col-md-3 mb-4">
                        <div class="card m-5" style="width: 300px; height: 450px;">
                            <img class="card-img-top" src="..." alt="Card image cap" style="height: 150px; object-fit: cover;">
                            <div class="card-body" style="height: 200px; overflow: hidden;">
                                <h5 class="card-title">{{$item['first_name']}}</h5>
                                <p class="card-text">{{$item['about_user']}}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">{{$item['province']}}</li>
                                <li class="list-group-item">{{$item['city']}}</li>
                                <li class="list-group-item">{{$item['neighborhood']}}</li>
                            </ul>
                            <div class="card-body">
                                <a href="{{ route('about_user', ['id' => $item['id']]) }}" class="card-link">Batafsil</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
