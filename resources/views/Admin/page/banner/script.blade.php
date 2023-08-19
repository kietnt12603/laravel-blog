<script>
    function checkName() {
        var name = document.getElementById('name').value;
        var errorName = document.getElementById('errorName');

        if (name.trim() === '') {
            errorName.innerHTML = "Tên không được để trống";
        } else {
            errorName.innerHTML = "";
            return filter;
        }
    }

    function checkUrl() {
        var url = document.getElementById('url').value;
        var errorUrl = document.getElementById('errorUrl');

        if (url.trim() === '') {
            errorUrl.innerHTML = "Url không được để trống";
        } else {
            errorUrl.innerHTML = "";
            return filter;
        }
    }
    $(document).on('submit', '#saveBanner', function(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append('image', $('#image')[0].files[0]);
        formData.append('name', $('#name').val());
        formData.append('url', $('#url').val());
        formData.append('_token', $('input[name="_token"]').val());
        // var form = this;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/banner/add",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $('#bannerAddModal').modal('hide');
                    $('#saveBanner')[0].reset();
                    $('#keywords').val("");
                    Swal.fire(
                        "Good job!",
                        res.message,
                        "success"
                    );
                    console.log('Thêm thành công');
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
        // reader.readAsText(file);
    });

    $(document).on('click', '.editBannerBtn', function() {

        var banner_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "/banner/edit/" + banner_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $('#id').val(res.data.id);
                    $('#name_edit').val(res.data.name);
                    let img = res.data.images;
                    let img1 = "{{ asset('/images') }}/" + img;
                    $('#hinh1').attr("src", img1);
                    $('#url_edit').val(res.data.url);
                    $('#bannerEditModal').modal('show');
                }
            }
        });
    });

    $(document).on('submit', '#updateBanner', function(e) {
        e.preventDefault();

        var banner_id = $('#id').val();
        const formData = new FormData();
        if (image_edit.files.length > 0) {
            formData.append('image', $('#image_edit')[0].files[0]);
        }
        formData.append('name', $('#name_edit').val());
        formData.append('url', $('#url_edit').val());
        formData.append('_token', $('input[name="_token"]').val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/banner/edit/" + banner_id,
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
                    $('#bannerEditModal').modal('hide');
                    Swal.fire(
                        "Good job!",
                        res.message,
                        "success"
                    );
                    $('#updateBanner')[0].reset();
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

    $(document).on('click', '.deleteBannerBtn', function() {
        var banner_id = $(this).val();

        Swal.fire({
            title: 'Bạn Có Chắc Muốn Xóa Danh Mục Này Không?',
            text: "Bạn Không Thể Khôi Phục Lại Khi Đã Bị Xóa",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hủy',
            confirmButtonText: 'Có, Tôi Muốn Xóa!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/banner/delete/" + banner_id,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {
                            Swal.fire(
                                'Deleted!',
                                res.message,
                                'success'
                            );
                            $('#myTable').load(location.href + " #myTable");
                            // $('#pagination').load(location.href + " #pagination");
                        } else if (res.status == 500) {
                            Swal.fire(
                                "Good job!",
                                res.message,
                                "error"
                            );
                            console.log('xóa thất bại');
                        }
                    },
                    error: function(error) {
                        Swal.fire(
                            "Error!",
                            "Danh Mục Đang Có Bài Viết",
                            "error"
                        );
                        console.log('Lỗi trong quá trình gửi yêu cầu DELETE:', error);
                    }
                });
            }
        });
    });
</script>
