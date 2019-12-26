@foreach($categories as $category)
    @if(isset($displayId) && $category['id'] == $displayId)
        <li class="">{{$category['name']}}</li>
    @else
        <li><a href="/galerie/{{$category['id']}}">{{$category['name']}}</a></li>
    @endif
    @include('frontend.children', ['categories' => $category['children']])
@endforeach
