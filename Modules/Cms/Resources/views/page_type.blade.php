<h2>{{Str::of($page_type)->ucfirst()->plural()}}</h2>

<div class="container">
    <div class="row" id="pages_content">
        @include('cms::page_type_content')
    </div>
    <div class="row mt-2">
        <div id="paginate_box">
            {{$pages->links()}}
        </div>
    </div>
</div>