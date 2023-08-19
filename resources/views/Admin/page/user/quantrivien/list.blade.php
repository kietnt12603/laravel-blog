@extends('admin.blocks.main')

@section('content')
    <div class="card-body table-responsive p-0">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Quyền Hạn</th>
                    <th>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userAddModal">
                            Thêm Nhân Viên
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody id="table">
                @php
                    $i = 1;
                @endphp
                @foreach ($users as $item)
                    <tr>
                        <td><img src="/images/{{ $item->avatar }}" alt="" height="80px"></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{$item->role->name}}</td>
                        <td>
                            <button type="button" value="{{ $item->id }}"
                                class="editUserBtn btn btn-success">Edit</button>
                            <button type="button" value="{{ $item->id }}"
                                class="deleteUserBtn btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $users->links('vendor.pagination.bootstrap-4') }}
    </div>

    @include('admin.page.user.quantrivien.modal')
@endsection
