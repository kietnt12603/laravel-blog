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

    function checkEmail() {
        var email = document.getElementById('email').value;
        var errorEmail = document.getElementById('errorEmail');
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex cho định dạng email

        if (email.trim() === '') {
            errorEmail.innerHTML = "Email không được để trống";
        } else if (!emailRegex.test(email)) {
            errorEmail.innerHTML = "Email không đúng định dạng";
        } else {
            errorEmail.innerHTML = "";
            return filter;
        }
    }

    function checkPassword() {
        var password = document.getElementById('password').value;
        var errorPassword = document.getElementById('errorPassword');


        if (password.trim() === '') {
            errorPassword.innerHTML = "Mật khẩu không được để trống";
        } else {
            errorPassword.innerHTML = "";
            return filter;
        }
    }
    $(document).on('submit', '#saveCustomer', function(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append('image', $('#image')[0].files[0]);
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('password', $('#password').val());
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
            url: "/customer/add",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $('#customerAddModal').modal('hide');
                    $('#saveCustomer')[0].reset();
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
                $('#customerAddModal').modal('hide');
                Swal.fire(
                    "Error!",
                    "Email Đã Tồn Tại Trong Hệ Thống",
                    "error"
                );
                // console.log('Lỗi trong quá trình gửi yêu cầu DELETE:', error);
            }
        });
        // reader.readAsText(file);
    });

    $(document).on('click', '.editCustomerBtn', function() {

        var customer_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "/customer/edit/" + customer_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $('#id').val(res.data.id);
                    $('#name_edit').val(res.data.name);
                    $('#email_edit').val(res.data.email);
                    let img = res.data.avatar;
                    let img1 = "{{ asset('/images') }}/" + img;
                    $('#hinh1').attr("src", img1);
                    $('#customerEditModal').modal('show');
                }
            }
        });

    });

    $(document).on('submit', '#updateCustomer', function(e) {
        e.preventDefault();

        var customer_id = $('#id').val();
        const formData = new FormData();
        if (image_edit.files.length > 0) {
            formData.append('image', $('#image_edit')[0].files[0]);
        }
        formData.append('name', $('#name_edit').val());
        formData.append('email', $('#email_edit').val());
        formData.append('_token', $('input[name="_token"]').val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/customer/edit/" + customer_id,
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
                    $('#customerEditModal').modal('hide');
                    Swal.fire(
                        "Good job!",
                        res.message,
                        "success"
                    );
                    $('#updateCustomer')[0].reset();
                    $('#keywords').val("");
                    $('#myTable').load(location.href + " #myTable");
                    // $('#pagination').load(location.href + " #pagination");
                } else if (res.status == 500) {
                    alert(res.message);
                }
            },
            error: function(error) {
                $('#customerEditModal').modal('hide');
                Swal.fire(
                    "Error!",
                    "Email Đã Tồn Tại Trong Hệ Thống",
                    "error"
                );
                // console.log('Lỗi trong quá trình gửi yêu cầu DELETE:', error);
            }
        });
    });

    $(document).on('click', '.deleteCustomerBtn', function() {
        var customer_id = $(this).val();

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
                    url: "/customer/delete/" + customer_id,
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
