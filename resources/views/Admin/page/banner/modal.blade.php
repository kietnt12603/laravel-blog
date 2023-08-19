<div class="modal fade" id="bannerAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
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
                <form id="saveBanner">
                    <div id="errorMessage" class="d-none alert alert-danger" role="alert">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tên Banner</label>
                                <input type="text" name="name" id="name" class="form-control" value=""
                                    onkeyup="checkName()" onkeydown="checkName()" required>
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Đường Dẫn</label>
                                <input type="text" placeholder="Đường Dân ('/') hoặc ('https://facebook.com')"
                                    name="url" id="url" class="form-control" value=""
                                    onkeyup="checkUrl()" onkeydown="checkUrl()" required>
                                <p style="color: red; padding-top: 10px;" id="errorUrl"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="form-group">
                            <label for="">Hình Ảnh</label><br>
                            <input type="file" name="image" class="file_img" id="image">
                            <br>
                            <p style="color: red;padding-top: 10px;" id="errorImg"></p>
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

<div class="modal fade" id="bannerEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
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
                <form id="updateBanner">
                    <div id="errorMessage" class="d-none alert alert-danger" role="alert">
                    </div>
                    <input type="hidden" id="id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tên Banner</label>
                                <input type="text" placeholder="Nhập Tên" name="name" id="name_edit"
                                    class="form-control" value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Đường Dẫn</label>
                                <input type="text" placeholder="Đường Dân ('/') hoặc ('https://facebook.com')"
                                    name="url" id="url_edit" class="form-control" value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="form-group">
                            <label for="">Hình Ảnh</label><br>
                            <input type="file" name="image" class="file_img" id="image_edit">
                            <img src="" id="hinh1" width="300" height="250" alt="">
                            <br>
                            <p style="color: red;padding-top: 10px;" id="errorImg"></p>
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
