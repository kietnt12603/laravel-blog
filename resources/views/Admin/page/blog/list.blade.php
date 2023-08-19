@extends('admin.blocks.main')

@section('content')
    <div class="card-body table-responsive p-0">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Tên Loại</th>
                    <th>Hình</th>
                    <th>Trạng Thái</th>
                    <th>Lượt Xem</th>
                    <th>Danh Mục</th>
                    <th>Tác Giả</th>
                    <th>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#blogAddModal">
                            Thêm Danh Mục
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody id="table">
                @php
                    $i = 1;
                @endphp
                @foreach ($blogall as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td><img src="/images/{{ $item->images }}" alt="" height="80px"></td>
                        <td>
                            @if ($item->active == 1)
                                Đã Duyệt
                            @else
                                Chưa Duyệt
                            @endif
                        </td>
                        <td>{{ $item->view }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->users->name }}</td>
                        <td>
                            @if (Auth::user()->role->name === 'author')
                                @if ($item->active == 0)
                                    <button type="button" value="{{ $item->id }}"
                                        class="editBlogBtn btn btn-success">Edit</button>
                                    <button type="button" value="{{ $item->id }}"
                                        class="deleteBlogBtn btn btn-danger">Delete</button>
                                @else
                                    <button disabled class="btn btn-default">Bài Viết Đã Duyệt</button>
                                @endif
                            @else
                                <button type="button" value="{{ $item->id }}"
                                    class="editBlogBtn btn btn-success">Edit</button>
                                <button type="button" value="{{ $item->id }}"
                                    class="deleteBlogBtn btn btn-danger">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $blogall->links('vendor.pagination.bootstrap-4') }}
    </div>

    @include('admin.page.blog.modal')
@endsection
