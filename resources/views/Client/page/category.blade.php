@extends('client.blocks.main')
@section('ClientContent')
    <div class="section search-result-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">Danh Mục: {{ $categoryName }}</div>
                </div>
            </div>
            <div class="row posts-entry">
                <div class="col-lg-8">
                    @foreach ($blog as $item)
                        <div class="blog-entry d-flex blog-entry-search-item">
                            <a href="{{ route('client_blog_detail', ['id' => $item->id]) }}" class="img-link me-4">
                                <img src="/images/{{ $item->images }}" alt="Image" class="" width="154"
                                    height="170">
                            </a>
                            <div>
                                <span class="date">{{ $item->created_at->format('d-m-Y') }} &bullet; <a
                                        href="{{ route('client_category', ['id' => $item->category->id]) }}">{{ $item->category->name }}</a></span>
                                <h2><a href="{{ route('client_blog_detail', ['id' => $item->id]) }}">{{ $item->name }}</a></h2>
                                <p>{{ $item->short_content }}</p>
                                <p><a href="{{ route('client_blog_detail', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-outline-primary">Đọc Ngay</a></p>
                            </div>
                        </div>
                    @endforeach

                    <div class="row text-start pt-5 border-top">
                        {{ $blog->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>

                <div class="col-lg-4 sidebar">
                    @include('client.blocks.aside')
                </div>
            </div>
        </div>
    </div>
@endsection
