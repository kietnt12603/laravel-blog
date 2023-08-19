<div class="modal fade" id="categoryAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
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
                <form id="saveCategory">
                    <div id="errorMessage" class="d-none alert alert-danger" role="alert">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tên Danh Mục</label>
                                <input type="text" name="name" id="name" class="form-control" value=""
                                    onkeyup="checkName()" onkeydown="checkName()" required>
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
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
                    <div class="form-group text-center">
                        <Label>Hiển Thị Menu</Label>
                        <br>
                        <input type="radio" name="menu_active" id="" value="1" checked> Kích Hoạt
                        <input type="radio" name="menu_active" id="" value="0"> Không
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

<div class="modal fade" id="categoryEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
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
                <form id="updateCategory">
                    <div id="errorMessage" class="d-none alert alert-danger" role="alert">
                    </div>
                    <input type="hidden" id="id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tên Danh Mục</label>
                                <input type="text" name="name" id="name_edit" class="form-control" value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group ">
                                <Label>Hiển Thị Menu</Label>
                                <br>
                                <input type="radio" name="menu_active1" id="kh" value="1" checked> Kích
                                Hoạt
                                <input type="radio" name="menu_active1" id="kkh" value="0"> Không
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group text-center">
                                <label for="">Hình Ảnh</label><br>
                                <input type="file" name="image" class="file_img" id="image_edit">
                                <img src="" id="hinh1" width="100" height="100" alt="">
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
