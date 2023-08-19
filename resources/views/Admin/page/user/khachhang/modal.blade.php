<div class="modal fade" id="customerAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class=" modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thêm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="saveCustomer">
                    <div id="errorMessage" class="d-none alert alert-danger" role="alert">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tên</label>
                                <input type="text" name="name" id="name" class="form-control" value=""
                                    onkeyup="checkName()" onkeydown="checkName()" required>
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value=""
                                    onkeyup="checkEmail()" onkeydown="checkEmail()" required>
                                <p style="color: red; padding-top: 10px;" id="errorEmail"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Mật Khẩu</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    value=""onkeyup="checkPassword()" required>
                                <p style="color: red; padding-top: 10px;" id="errorPassword"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Hình Ảnh</label><br>
                                <input type="file" name="image" class="file_img" id="image" required>
                                <br>
                                <p style="color: red;padding-top: 10px;" id="errorImg"></p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Thêm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
            @csrf
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="customerEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class=" modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Sửa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateCustomer">
                    <div id="errorMessage" class="d-none alert alert-danger" role="alert">
                    </div>
                    <input type="hidden" id="id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tên</label>
                                <input type="text" name="name" id="name_edit" class="form-control"
                                    value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email_edit" class="form-control"
                                    value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Hình Ảnh</label><br>
                                <input type="file" name="image" class="file_img" id="image_edit">
                                <img src="" id="hinh1" width="350" height="250" alt="">
                                <br>
                                <p style="color: red;padding-top: 10px;" id="errorImg"></p>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Sửa</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
            @csrf
            </form>
        </div>
    </div>
</div>
