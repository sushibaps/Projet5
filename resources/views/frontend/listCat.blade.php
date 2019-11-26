@foreach($categories as $category)
    <div class="d-flex flex-column bg-light ml-3">
        <div class="border p-2 rounded-lg mt-2 ml-2">
            <input type="checkbox" name="category{{$category['id']}}">
            <label for="{{$category['id']}}">{{$category['name']}}</label>
        </div>
        @include('frontend.listCat', ['categories' => $category['children']])
    </div>
@endforeach
