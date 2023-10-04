var token = $('meta[name=csrf-token]').attr('content');
function formModal(route) {

    $.get(route, function (res) {
        $("#modal_form_content").empty();
        $('#modal_form_content').html(res);

        $('.changeUrlButton').on('click', () => {
            //const newUrl = 'wav/PinkPanther60.wav'; // Replace with the new URL
            const newUrl = 'wav/2023/10/01/q-4567-8888-20231001-141026-1696169425.161.wav';
            // const newUrl = 'wav/'+$('#vioc').val();
            //

            console.log('wav/' + $('#vioc').val());
            console.log(newUrl);
            initializeWaveSurfer(newUrl);
        });
        $('.vioc').on('click', function () {
            const newUrl = 'wav/' + $('#vioc').val();
            console.log('wav/' + $('#vioc').val());
            console.log(newUrl);
            initializeWaveSurfer(newUrl);
        });

        // $("#CreateModal").modal("show");
    });

}

