@foreach($items as $item)
        @if($item->attributes['class'] == 'navigation-header')
            <li class="navigation-header"><span>{{$item->title}}</span><i class="ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i></li>
        @elseif($item->attributes['class'] !== 'navigation-header' and empty($item->parent))
            @if($item->hasChildren())
                <li class="nav-item">
                    <a href="{{$item->url()}}">
                        <i class="{{$item->attributes['class']}}"></i>
                        <span class="menu-title" data-i18n="">{{$item->title}}</span>
                        <span class="badge badge badge-primary badge-pill float-right mr-2">{{$item->children()->count()}}</span>
                    </a>
                    <ul class="menu-content">
                @foreach($item->children() as $value)
                        <li><a class="menu-item" href="{{$value->url()}}">{{$value->title}}</a></li>
                @endforeach
                    </ul>
                </li>
            @else
                <li class="{{(URL::current() == $item->url()) ? "active" : "nav-item" }}">
                    <a href="{{$item->url()}}">
                        <i class="{{$item->attributes['class']}}"></i>
                        <span class="menu-title" data-i18n="">{{$item->title}}</span>
                    </a>
                </li>
                @endif
        @endif
@endforeach

