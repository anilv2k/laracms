<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <p class="card-title">Question {{$question->currentPage()}}</p>
        </div>
        <div class="card-body">
            <p>{{$question[0]->question}}</p>
            <div class="list-group">
            @foreach ($question[0]->questions_option as $k=>$option)
                <p class="list-group-item list-group-item-info exam-options" data-option="{{$option->id}}">
				
			<?php /*	<input type="radio" id="male" name="option[]" value="{{$option->id}}"> */ ?>
				
				{{chr($k+65)}}. {{$option->option}}</p>
            @endforeach
            {{-- <p class="list-group-item list-group-item-info exam-options" data-option="b">b. Designer</p>
            <p class="list-group-item list-group-item-info exam-options" data-option="a">c. Developer</p>
            <p class="list-group-item list-group-item-info exam-options" data-option="a">d. All of Above</p> --}}
            </div>
        </div>
    </div>
</div>