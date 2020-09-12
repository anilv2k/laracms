@foreach ($pages as $page)
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title"><a href="{{url($page->slug)}}">{{$page->title}}</a></h1>
        </div>
        <div class="card-body">
            {{$page->description}}
        </div>
    </div>
</div>
@endforeach