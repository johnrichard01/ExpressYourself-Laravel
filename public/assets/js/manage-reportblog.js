$(document).ready(function(){
    $('.deleteBTN').click(function (event){
        event.preventDefault();
        let user_id=$(this).val();
        $('#user_id').val(user_id);
        $('#modalDelete').modal('show');
    })
})

$('.statusSelect').change(function() {
    let report_id=$(this).data('report-id');
    $('#report_id').val(report_id);
    $('#statusForm'+report_id).submit();
});