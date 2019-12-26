@if(isset($category->parent))
    @include('frontend.breadcrumb', ['category' => $category->parent])
@endif
@if(isset($displayId) && $displayId == $category->id)
    <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
@else
    <li class="breadcrumb-item"><a href="/galerie/{{$category->id}}">{{$category->name}}</a>
    </li>
@endif
