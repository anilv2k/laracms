$(document).ready(function(){
    $('#pages_content').on('click','.exam-options',function(){
        $('.exam-options').removeClass('active');
        $(this).addClass('active');
    });

    $(document).on('click','#submit-answer',function (e) {
        e.stopImmediatePropagation();
        if($('.exam-options.active').data('option') != undefined){  
           
	var answer=$('.exam-options.active').data('option');

    //save answer - ajax call
			

    var formData = new FormData();
    formData.append('user_id',1);
    formData.append('answer',answer);

    //insert answers in DB
    $.ajax({
        url: '{{ url("exam/submitanswer") }}',
        type: 'POST',
        async: false,
        contentType: false,
        processData: false,
        data: formData,
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            if (data.status) {
               
			   // sucess
               
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            
        },
    }); 
			
			

            //on success trigger next button click event

            $('#paginate_box a.page-link[rel="next"]').trigger("click");
			
        }else{
            alert("Choose an answer before submit!!");
        }
    })
});