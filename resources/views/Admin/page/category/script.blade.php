<script>
    // function checkName() {
    //     var name = document.getElementById('name').value;
    //     var errorName = document.getElementById('errorName');

    //     if (name == '' || name == null) {
    //         errorName.innerHTML = "Tên không được để trống";
    //     } else {
    //         errorName.innerHTML = "";
    //         return filter;
    //     }
    // }

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

    function checkMota() {
        var filter = document.getElementById('short_content').value;
        var errorFilter = document.getElementById('errorShortContent');

        if (filter == '' || filter == null) {
            errorFilter.innerHTML = "Mô Tả không được để trống";
        } else {
            errorFilter.innerHTML = "";
            return filter;
        }
    }
    $(document).on('submit', '#saveCategory', function(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append('image', $('#image')[0].files[0]);
        formData.append('name', $('#name').val());
        formData.append('menu_active', $('input[name="menu_active"]:checked').val());
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
            url: "/category/add",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $('#categoryAddModal').modal('hide');
                    $('#saveCategory')[0].reset();
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

    $(document).on('click', '.editCategoryBtn', function() {

        var category_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "/category/edit/" + category_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $('#id').val(res.data.id);
                    $('#name_edit').val(res.data.name);
                    let img = res.data.images;
                    let img1 = "{{ asset('/images') }}/" + img;
                    $('#hinh1').attr("src", img1);
                    let menu_active = res.data.menu_active;
                    if (menu_active == 1) {
                        $('#kh').prop('checked', true);
                    } else {
                        $('#kkh').prop('checked', true);
                    }
                    $('#categoryEditModal').modal('show');
                }
            }
        });

    });

    $(document).on('submit', '#updateCategory', function(e) {
        e.preventDefault();

        var category_id = $('#id').val();
        const formData = new FormData();
        if (image_edit.files.length > 0) {
            formData.append('image', $('#image_edit')[0].files[0]);
        }
        formData.append('name', $('#name_edit').val());
        formData.append('menu_active1', $('input[name="menu_active1"]:checked').val());
        formData.append('_token', $('input[name="_token"]').val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/category/edit/" + category_id,
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
                    $('#categoryEditModal').modal('hide');
                    Swal.fire(
                        "Good job!",
                        res.message,
                        "success"
                    );
                    $('#updateCategory')[0].reset();
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

    $(document).on('click', '.deleteCategoryBtn', function() {
        var category_id = $(this).val();

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
                    url: "/category/delete/" + category_id,
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
