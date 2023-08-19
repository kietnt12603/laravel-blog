<script>
    function checkName() {
        var name = document.getElementById('name').value;
        var errorName = document.getElementById('errorName');

        if (name == '' || name == null) {
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

    // function checkMotaChiTiet() {
    //     var editorContent = CKEDITOR.instances.editor1.getData();
    //     // var filter = document.getElementById('editor1').value;
    //     var errorFilter = document.getElementById('errorContent');
    //     if (editorContent.trim() === '') {
    //         errorFilter.innerHTML = "Mô Tả Chi Tiết không được để trống";
    //     } else {
    //         errorFilter.innerHTML = "";
    //         return filter;
    //     }
    // }

    // function checkMotaChiTiet() {
    //     console.log("Function checkMotaChiTiet is running.");
    //     var editorContent = CKEDITOR.instances.editor1.getData();
    //     console.log("Editor content:", editorContent);
    //     var errorFilter = document.getElementById('errorContent');

    //     if (editorContent.trim() === '') {
    //         errorFilter.innerHTML = "Mô Tả Chi Tiết không được để trống";
    //     } else {
    //         errorFilter.innerHTML = "";
    //     }
    // }

    // function checkImage() {
    //     img = document.getElementById('image');
    //     errorImg = document.getElementById('errorImg');
    //     if (img.value == '') {
    //         errorImg.innerHTML = "Bạn Chưa Chọn Hình";
    //     } else {
    //         errorImg.innerHTML = "";
    //         return img;
    //     }
    // }
    $(document).on('submit', '#saveBlog', function(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append('image', $('#image')[0].files[0]);
        formData.append('name', $('#name').val());
        formData.append('short_content', $('#short_content').val());
        formData.append('content', $('#editor1').val());
        formData.append('category_id', $('#category_id').val());
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
            url: "/blog/add",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $('#blogAddModal').modal('hide');
                    $('#saveBlog')[0].reset();
                    CKEDITOR.instances.editor1.setData('');
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
                } else if (res.status == 422) {
                    Swal.fire(
                        "Error!",
                        "Vui Lòng Nhập Đầy Đủ Thông Tin",
                        "error"
                    );
                }
            },
            error: function(error) {
                if (error.code == 422) {
                    Swal.fire(
                        "Error!",
                        "V",
                        "error"
                    );

                }
                console.log('Lỗi trong quá trình gửi yêu cầu AJAX:', error);
            }
        });

    });

    $(document).on('click', '.editBlogBtn', function() {

        var blog_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "/blog/edit/" + blog_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $('#id').val(res.data.id);
                    $('#name_edit').val(res.data.name);
                    let img = res.data.images;
                    let img1 = "{{ asset('/images') }}/" + img;
                    $('#hinh1').attr("src", img1);
                    $('#category_id_edit').val(res.data.category_id);
                    $('#active_edit').val(res.data.active);
                    $('#short_content_edit').val(res.data.short_content);
                    CKEDITOR.instances.editor2.setData(res.data.content);
                    $('#editor2').val(res.data.content);
                    $('#blogEditModal').modal('show');
                }
            }
        });

    });

    $(document).on('submit', '#updateBlog', function(e) {
        e.preventDefault();

        var blog_id = $('#id').val();
        const formData = new FormData();
        if (image_edit.files.length > 0) {
            formData.append('image', $('#image_edit')[0].files[0]);
        }
        formData.append('name', $('#name_edit').val());
        formData.append('short_content', $('#short_content_edit').val());
        formData.append('content', $('#editor2').val());
        formData.append('category_id', $('#category_id_edit').val());
        formData.append('active', $('#active_edit').val());
        formData.append('_token', $('input[name="_token"]').val());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/blog/edit/" + blog_id,
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
                    $('#blogEditModal').modal('hide');
                    Swal.fire(
                        "Good job!",
                        res.message,
                        "success"
                    );
                    $('#updateBlog')[0].reset();
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

    $(document).on('click', '.deleteBlogBtn', function() {
        var blog_id = $(this).val();

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
                    url: "/blog/delete/" + blog_id,
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
