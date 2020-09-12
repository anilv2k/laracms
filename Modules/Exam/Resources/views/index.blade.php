<h2>Exams</h2>

<div class="">
    <div class="row" id="pages_content">
        @include('exam::exam_content')
    </div>
    <div class="row mt-2">
        <div class="col-md-6" id="paginate_box">
            {{$question->links()}}
        </div>
        <div class="col-md-6 float-right">
            <button class="btn btn-primary float-right" id="submit-answer">Submit Answer</button>
        </div>
    </div>
</div>