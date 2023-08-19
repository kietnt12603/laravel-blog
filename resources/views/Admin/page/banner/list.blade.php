@extends('admin.blocks.main')

@section('content')
    <div class="card-body table-responsive p-0">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Hình</th>
                    <th>Tên Banner</th>
                    <th>Đường Dẫn</th>
                    <th>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bannerAddModal">
                            Thêm Danh Mục
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody id="table">
                @php
                    $i = 1;
                @endphp
                @foreach ($banner as $item)
                    <tr>
                        <td><img src="/images/{{ $item->images }}" alt="" height="80px"></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->url }}</td>
                        <td> <button type="button" value="{{ $item->id }}"
                                class="editBannerBtn btn btn-success">Edit</button>
                            <button type="button" value="{{ $item->id }}"
                                class="deleteBannerBtn btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $banner->links('vendor.pagination.bootstrap-4') }}
    </div>

    @include('admin.page.banner.modal')
@endsection
