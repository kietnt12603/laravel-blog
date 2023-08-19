@extends('admin.blocks.main')

@section('content')
    <div class="card-body table-responsive p-0">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Hình</th>
                    <th>Tên Danh Mục</th>
                    <th>Slung</th>
                    <th>Hiển Thi Menu</th>
                    <th>Tác Giả</th>
                    <th>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryAddModal">
                            Thêm Danh Mục
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody id="table">
                @php
                    $i = 1;
                @endphp
                @foreach ($category as $item)
                    <tr>
                        <td><img src="/images/{{ $item->images }}" alt="" height="80px"></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            @if ($item->menu_active == 1)
                                Hiển Thị
                            @else
                                Không Hiển Thị
                            @endif
                        </td>
                        <td>{{ $item->users->name }}</td>
                        <td>
                            <button type="button" value="{{ $item->id }}"
                                class="editCategoryBtn btn btn-success">Edit</button>
                            <button type="button" value="{{ $item->id }}"
                                class="deleteCategoryBtn btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $category->links('vendor.pagination.bootstrap-4') }}
    </div>

    @include('admin.page.category.modal')
@endsection
