=var token = $('meta[name=csrf-token]').attr('content');
function formModal(route) {

    $.get(route, function (res) {
        $("#modal_form_content").empty();
        $('#modal_form_content').html(res);


        $("#CreateModal").modal("show");
    });

}

