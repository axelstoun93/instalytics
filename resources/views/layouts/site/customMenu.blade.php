@foreach($items as $item)

    <li {{(URL::current() == $item->url()) ? "class=active" : '' }}>
        <a href="{{$item->url()}}">
            {{$item->title}}
        </a>
    </li>

@endforeach