@extends('admin.blocks.main')

@section('content')
    <div class="card-body table-responsive p-0">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Tên</th>
                    <th style="width: 40%;">Giới Thiệu</th>
                    <th>
                        Hành Động
                    </th>
                </tr>
            </thead>
            <tbody id="table">
                <tr>
                    <td><img src="/images/{{ $web_config->logo }}" alt="" height="80px"></td>
                    <td>{{ $web_config->name }}</td>
                    <td>{{ $web_config->about }}</td>
                    <td>
                        <button type="button" value="{{ $web_config->id }}"
                            class="editWebconfigBtn btn btn-success">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    @include('admin.page.WebConfigModal')
@endsection
