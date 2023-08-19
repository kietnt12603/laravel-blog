<script>
    $(document).on('click', '.editWebconfigBtn', function() {

        var webconfig_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "/webconfig/edit/" + webconfig_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $('#id').val(res.data.id);
                    $('#name').val(res.data.name);
                    $('#facebook').val(res.data.facebook);
                    $('#instagram').val(res.data.instagram);
                    $('#twitter').val(res.data.twitter);
                    $('#linkedin').val(res.data.linkedin);
                    $('#pinterest').val(res.data.pinterest);
                    $('#dribbble').val(res.data.dribbble);
                    $('#about').val(res.data.about);
                    let img = res.data.logo;
                    let img1 = "{{ asset('/images') }}/" + img;
                    $('#hinh1').attr("src", img1);
                    $('#webconfigEditModal').modal('show');
                }
            }
        });
    });

    $(document).on('submit', '#updateWebconfig', function(e) {
        e.preventDefault();

        var banner_id = $('#id').val();
        const formData = new FormData();
        if (image.files.length > 0) {
            formData.append('image', $('#image')[0].files[0]);
        }
        formData.append('name', $('#name').val());
        formData.append('about', $('#about').val());
        formData.append('facebook', $('#facebook').val());
        formData.append('instagram', $('#instagram').val());
        formData.append('twitter', $('#twitter').val());
        formData.append('linkedin', $('#linkedin').val());
        formData.append('pinterest', $('#pinterest').val());
        formData.append('dribbble', $('#dribbble').val());
        formData.append('_token', $('input[name="_token"]').val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/webconfig/edit/" + banner_id,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    $('#errorMessageUpdate').removeClass('d-none');
                    $('#errorMessageUpdate').text(res.message);
                } else if (res.status == 200) {
                    $('#errorMessageUpdate').addClass('d-none');
                    $('#webconfigEditModal').modal('hide');
                    Swal.fire(
                        "Good job!",
                        res.message,
                        "success"
                    );
                    $('#updateWebconfig')[0].reset();
                    $('#keywords').val("");
                    $('#myTable').load(location.href + " #myTable");
                    // $('#pagination').load(location.href + " #pagination");
                } else if (res.status == 500) {
                    alert(res.message);
                }
            },
            error: function(error) {
                console.log('Lỗi trong quá trình gửi yêu cầu AJAX:', error);
            }
        });
    });
</script>
