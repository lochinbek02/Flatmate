@foreach ($not as $i )
<div class="">
    <a href="{{ route('about_user', ['id' => $i['sending_user']]) }}"><p>{{$i['message'].' '.$i['name']}}</p></a>
    
</div>

@endforeach
