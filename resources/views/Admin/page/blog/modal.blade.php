<div class="modal fade" id="blogAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
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
                <form id="saveBlog">
                    <div id="errorMessage" class="d-none alert alert-danger" role="alert">
                    </div>
                    <div class="form-group">
                        <label for="">Tên Blog</label>
                        <input type="text" name="name" id="name" onkeyup="checkName();"
                            onkeydown="checkName();" onblur="checkName();" class="form-control" value="" required>
                        <p style="color: red; padding-top: 10px;" id="errorName"></p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Hình Ảnh</label><br>
                                <input type="file" name="image" class="file_img" id="image" required>
                                <br>
                                <p style="color: red;padding-top: 10px;" id="errorImg"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Loại</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($category as $item1)
                                        <option value="{{ $item1->id }}">{{ $item1->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Mô Tả Ngắn</label>
                        <textarea name="short_content" required onkeyup="checkMota()" class="form-control" id="short_content" cols="10"
                            rows="5"></textarea>
                        <p style="color: red; padding-top: 10px;" id="errorShortContent"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Mô Tả chi tiết</label>
                        <textarea name="content" id="editor1" onkeyup="checkMotaChiTiet()" required cols="25" rows="10"
                            onkeydown="checkMotaChiTiet();" class="form-control" style="resize:none;"></textarea>
                        <p style="color: red;padding-top: 10px;" id="errorContent"></p>
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

<div class="modal fade" id="blogEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
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
                <form id="updateBlog">
                    <div id="errorMessage" class="d-none alert alert-danger" role="alert">
                    </div>
                    <input type="hidden" id="id">
                    <div class="form-group">
                        <label for="">Tên Blog</label>
                        <input type="text" name="name" id="name_edit" class="form-control" value="">
                        <p style="color: red; padding-top: 10px;" id="errorName"></p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Hình Ảnh</label><br>
                                <input type="file" name="image" class="file_img" id="image_edit"><img
                                    src="" width="100" id="hinh1" />
                                <br>
                                <p style="color: red;padding-top: 10px;" id="errorImg"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Loại</label>
                                <select name="category_id" id="category_id_edit" class="form-control">
                                    @foreach ($category as $item1)
                                        <option value="{{ $item1->id }}">{{ $item1->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->role->name != 'author')
                        <div class="form-group">
                            <label for="">Duyệt</label>
                            <select name="active" id="active_edit" class="form-control">
                                <option value="0" checked>Không</option>
                                <option value="1">Duyệt</option>
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="">Mô Tả Ngắn</label>
                        {{-- <input type="text" name="short_content" id="short_content" class="form-control" value=""> --}}
                        <textarea name="short_content" class="form-control" id="short_content_edit" cols="10" rows="5"></textarea>
                        <p style="color: red; padding-top: 10px;" id="errorName"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Mô Tả chi tiết</label>
                        <textarea name="content" id="editor2" cols="25" rows="10" onkeyup="checkmotact();"
                            class="form-control" style="resize:none;"></textarea>
                        <p style="color: red;padding-top: 10px;" id="errorMoTaCT"></p>
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
