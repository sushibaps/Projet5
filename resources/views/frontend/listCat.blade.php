@foreach($categories as $category)
    <div class="d-flex ml-3 align-items-start
@if($category['level'] == 0)
        mt-3 pb-3
@endif">
        <div class="categories p-3 d-flex justify-content-around align-items-center text-decoration-none text-dark m-2">
            <input type="checkbox" name="category{{$category['id']}}" class="mr-2">
            <label for="{{$category['id']}}">{{$category['name']}}</label>
        </div>
        <div class="d-flex flex-column mt-3">
            @include('frontend.listCat', ['categories' => $category['children']])
        </div>
    </div>
@endforeach
