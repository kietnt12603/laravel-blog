@extends('client.blocks.main')
@section('ClientContent')
    @php
        use Illuminate\Support\Str;
    @endphp
    <div class="hero overlay inner-page bg-primary py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">Bài Viết</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section search-result-wrap">
        <div class="container">

            <div class="row posts-entry">
                <div class="col-lg-8">
                    @foreach ($blogAll as $item)
                        <div class="blog-entry d-flex blog-entry-search-item">
                            <a href="{{ route('client_blog_detail', ['id' => $item->id]) }}" class="img-link me-4">
                                <img src="/images/{{ $item->images }}" alt="Image" class="" width="154" height="170">
                            </a>
                            <div>
                                <span class="date">{{ $item->created_at->format('d-m-Y') }} &bullet; <a
                                        href="{{ route('client_category', ['id' => $item->category->id]) }}">{{ $item->category->name }}</a></span>
                                <h2><a href="{{ route('client_blog_detail', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                </h2>
                                <p>{{ Str::limit($item->short_content, 300) }}</p>
                                <p><a href="{{ route('client_blog_detail', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-outline-primary">Đọc Ngay</a></p>
                            </div>
                        </div>
                    @endforeach

                    {{ $blogAll->links('vendor.pagination.bootstrap-4') }}


                </div>

                <div class="col-lg-4 sidebar">
                    @include('client.blocks.aside')
                </div>
            </div>
        </div>
    </div>
@endsection
