$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // alert(base_url);
    $(document).on('click','.show-section-modal',function(){
        $('#frm-curriculum-name').val('')
        let mode = $(this).data('mode');
        $('#frm-save-mode').val(mode);
        $('.mode-label').text(ucfirstLetter(mode));
        if(mode=='edit'){
            //fetch the section by id from DB
            let id = $(this).data('id');
            // alert(id);
            $('#section-id').val(id)
            let data = get_curriculum_by_id(id);
            console.log(data);
            $('#frm-curriculum-name').val(data.title);
        }
        $('#add-section-modal').modal('show');
    });
    
    $(document).on('click','#add-section-btn',function(){
        save_section();
    });

    $(document).on('click','.delete-section',function(){
        delete_section($(this).data('id'));
    });

    $(document).on('click','.delete-lesson',function(){
        delete_lesson($(this).data('id'));
    });

    $(document).on('click','.show-lesson-modal',function(){
        $('#frm-lesson').trigger("reset").data('id','');
        let mode = $(this).data('mode');
        $('#frm-save-mode').val(mode);
        $('.mode-label').text(ucfirstLetter(mode));
        if(mode=='edit'){
            let id = $(this).data('id');
            console.log(id);
            //fetch id from DB
            let data = get_curriculum_by_id(id);
            console.log(data);
            $('#frm-lesson').data('id',id);
            $('#frm-lesson [name="title"]').val(data.title);
            $('#frm-lesson [name="parent_id"]').val(data.parent_id);
            $('#frm-lesson [name="file_type"]').val(data.file_type);
            $('#frm-lesson [name="file_length"]').val(data.file_length);
        }
        
        // const name = $('#frm-curriculum-name').val()
        // add_section(name);
        $('#add-lesson-modal').modal('show');
    });

    $(document).on('click','#add-lesson-btn',function(){
        const name = $('#frm-curriculum-lesson-name').val();
        const id = $('#frm-curriculum-lesson-type').val();
        
        save_lesson();
        // $('#add-lesson-modal').modal('hide');
    });
});

function get_curriculum_by_id(id){
    var res = null;
     $.ajax({
        url: base_url+'/courses/curriculum/'+id,
        type: 'GET',
        async: false,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            if (data.id) {
                res = data;
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
        },
    });

    return res;
}

function save_section(){
    var title = $('#frm-curriculum-name').val();
    var mode = $('#frm-save-mode').val();
    var uri = mode=='edit' ? '/'+$('#section-id').val() : '';
    var formData = new FormData();
    formData.append('title',title);
    formData.append('course_id',course_id);

    //insert section in DB
    $.ajax({
        url: base_url+'/courses/curriculum'+uri,
        type: 'POST',
        async: false,
        contentType: false,
        processData: false,
        data: formData,
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            if (data.status) {
                toastr.success('Section saved successfully');
                update_section(data.curr,mode);
                get_sections();
                $('#add-section-modal').modal('hide');
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            toastr.error('Error occurred while saving section!!');
        },
    }); 
}

function delete_section(id){
    //insert section in DB
    $.ajax({
        url: base_url+'/courses/curriculum/'+id,
        type: 'DELETE',
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            if (data.status) {
                toastr.success('Section deleted successfully');
                $('#curriculum-'+id).remove();
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            toastr.error('Error occurred while deleting section!!');
        },
    }); 
}

function save_lesson(){
    var mode = $('#frm-save-mode').val();
    var uri = mode=='edit' ? '/'+$('#frm-lesson').data('id') : '';
    
    var formData = new FormData($('#frm-lesson')[0]);
    formData.append('course_id',course_id);
    
    //insert section in DB
    $.ajax({
        url: base_url+'/admin/courses/curriculum/lesson'+uri,
        type: 'POST',
        async: false,
        contentType: false,
        processData: false,
        data: formData,
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            if (data.status) {
                toastr.success('Lesson saved successfully');
                update_lesson(data.curr,mode);
                $('#add-lesson-modal').modal('hide');
                $('#frm-lesson')[0].reset();
            }
        },
        error: function (xhr, status, error) {
            toastr.error('Error occurred whiles saving lesson!!');
            console.log(xhr);
            console.log(status);
        },
    }); 
}

function delete_lesson(id){
    //insert section in DB
    $.ajax({
        url: base_url+'/admin/courses/curriculum/lesson/'+id,
        type: 'DELETE',
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            if (data.status) {
                toastr.success('Lesson deleted successfully');
                $('#curriculum-lesson-'+id).remove();
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            toastr.error('Error occurred while deleting lesson!!');
        },
    }); 
}


function update_section(data,mode){
    if(mode=='add'){
        $('#curriculum-sections-container').append('<div class="card card-info curriculum-card" id="curriculum-'+data.id+'"><div class="card-header">'
            +'<h1 class="card-title">Section '+data.title+'</h1><div class="float-right section-btn">'
                +'<button class="btn btn-default btn-xs show-section-modal" data-id="'+data.id+'" data-mode="edit"><i class="fas fa-pen"></i> Edit Section</button>'
                +'<button class="btn btn-default btn-xs delete-section" data-id="'+data.id+'" data-mode="delete"><i class="fas fa-trash"></i> Delete Section</button>'
                +'<button class="btn btn-default btn-xs sort-lessons" data-id="'+data.id+'" ><i class="fas fa-sort"></i> Sort Lessons</button>'
            +'</div></div><div class="card-body"><div class="list-group"></div></div></div>');
    }
    else{
        $('#curriculum-'+data.id+' h1.card-title').text(data.title);
    }
}

function update_lesson(data                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ,mode){
    if(mode=='add'){
        $('#curriculum-'+data.parent_id+' .list-group').append('<p id="curriculum-lesson-'+data.id+'" class="list-group-item list-group-item-info"><span>Lesson: '+data.title+'</span>'
        +'<button class="btn btn-xs delete-lesson float-right" data-id="'+data.id+'" data-mode="delete" title="Delete Lesson"><i class="fas fa-trash"></i></button> '
        +'<button class="btn btn-xs show-lesson-modal float-right" data-id="'+data.id+'" data-mode="edit"  title="Edit Lesson"><i class="fas fa-pen"></i></button> </p>');
    }else{
        $('#curriculum-lesson-'+data.id+'>span').text(data.title);
    }
}

function get_sections(){
    $.ajax({
        url: base_url+'/courses/'+course_id+'/curriculum/sections',
        type: 'GET',
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            $('#frm-lesson [name="parent_id"]').html('<option value="">Select Section</option>');
            data.forEach(section => {
                $('#frm-lesson [name="parent_id"]').append('<option value="'+section.id+'">'+section.title+'</option>');
            });
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
        },
    });    
}

function ucfirstLetter(string) 

{

    return string.charAt(0).toUpperCase() + string.slice(1);

}
