<div class="modal fade" id="webconfigEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
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
                <form id="updateWebconfig">
                    <div id="errorMessage" class="d-none alert alert-danger" role="alert">
                    </div>
                    <input type="hidden" id="id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tên</label>
                                <input type="text" placeholder="Nhập Tên" name="name" id="name"
                                    class="form-control" value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Giới Thiệu</label>
                                <textarea name="about" id="about" class="form-control" cols="30" rows="1"></textarea>
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Facebook</label>
                                <input type="text" placeholder="" name="facebook" id="facebook" class="form-control"
                                    value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Instagram</label>
                                <input type="text" placeholder="" name="instagram" id="instagram"
                                    class="form-control" value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Twitter</label>
                                <input type="text" placeholder="" name="twitter" id="twitter" class="form-control"
                                    value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Linkedin</label>
                                <input type="text" placeholder="" name="linkedin" id="linkedin" class="form-control"
                                    value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Pinterest</label>
                                <input type="text" placeholder="" name="pinterest" id="pinterest"
                                    class="form-control" value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Dribbble</label>
                                <input type="text" placeholder="" name="dribbble" id="dribbble"
                                    class="form-control" value="">
                                <p style="color: red; padding-top: 10px;" id="errorName"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="form-group">
                            <label for="">Hình Ảnh</label><br>
                            <input type="file" name="image" class="file_img" id="image">
                            <img src="" id="hinh1" width="200" height="150" alt="">
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
