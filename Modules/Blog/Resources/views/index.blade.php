@extends('blog::layouts.master')

@section('content')
    <h1>Hello World</h1>

	<?php $params=array('users' => 10,'Name'=>'Anil Kumar'); ?>
	{{ Widget::run('Modules\Blog\Widgets\recentNews',$params) }} 
	
	 <br/>
	<?php echo $user = auth()->user()->name; ?>
    <p>
        This view is loaded from module: {!! config('blog.name') !!}
    </p>
@endsection
