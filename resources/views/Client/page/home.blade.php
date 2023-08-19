@extends('client.blocks.main')
@section('ClientContent')
    <!-- Start retroy layout blog posts -->
    <section class="section bg-light">
        <div class="container">
            <div class="row align-items-stretch retro-layout">
                <div class="col-md-4">
                    <a href="{{ route('client_blog_detail', ['id' => $blog1->id]) }}" class="h-entry mb-30 v-height gradient">

                        <div class="featured-img" style="background-image: url('/images/{{ $blog1->images }}');"></div>

                        <div class="text">
                            <span class="date">{{ $blog1->created_at->format('d-m-Y H:i:s') }}</span>
                            <h2>{{ $blog1->name }}</h2>
                        </div>
                    </a>
                    <a href="{{ route('client_blog_detail', ['id' => $blog2->id]) }}" class="h-entry v-height gradient">

                        <div class="featured-img" style="background-image: url('/images/{{ $blog2->images }}');"></div>

                        <div class="text">
                            <span class="date">{{ $blog2->created_at->format('d-m-Y H:i:s') }}</span>
                            <h2>{{ $blog2->name }}</h2>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('client_blog_detail', ['id' => $blog3->id]) }}" class="h-entry img-5 h-100 gradient">

                        <div class="featured-img" style="background-image: url('/images/{{ $blog3->images }}');"></div>

                        <div class="text">
                            <span class="date">{{ $blog3->created_at->format('d-m-Y H:i:s') }}</span>
                            <h2>{{ $blog3->name }}</h2>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('client_blog_detail', ['id' => $blog4->id]) }}"
                        class="h-entry mb-30 v-height gradient">

                        <div class="featured-img" style="background-image: url('/images/{{ $blog4->images }}');"></div>

                        <div class="text">
                            <span class="date">{{ $blog4->created_at->format('d-m-Y H:i:s') }}</span>
                            <h2>{{ $blog4->name }}</h2>
                        </div>
                    </a>
                    <a href="{{ route('client_blog_detail', ['id' => $blog5->id]) }}" class="h-entry v-height gradient">

                        <div class="featured-img" style="background-image: url('/images/{{ $blog5->images }}');"></div>

                        <div class="text">
                            <span class="date">{{ $blog5->created_at->format('d-m-Y H:i:s') }}</span>
                            <h2>{{ $blog5->name }}</h2>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </section>
    <!-- End retroy layout blog posts -->

    <section>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banners as $index => $item)
                    @if ($loop->first)
                        <div class="carousel-item active">
                        @else
                            <div class="carousel-item">
                    @endif
                    <a href="{{ $item->url }}" target="_blank">
                        <img src="/images/{{ $item->images }}" class="d-block w-100" alt="">
                    </a>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
    </section>
    @foreach ($categories as $item)
        @php
            $latestBlogs = $item
                ->blogs()
                ->where('active', 1)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        @endphp

        @if ($latestBlogs->count() > 0)
            <section class="section">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h2 class="posts-entry-title">{{ $item->name }}</h2>
                        </div>
                        <div class="col-sm-6 text-sm-end"><a href="category.html" class="read-more">View All</a></div>
                    </div>
                    <div class="row">
                        @foreach ($latestBlogs as $blog)
                            <div class="col-lg-4 mb-4">
                                <div class="post-entry-alt">
                                    <a href="{{ route('client_blog_detail', ['id' => $blog->id]) }}" class="img-link"><img
                                            src="/images/{{ $blog->images }}" alt="Image" class="" width="416" height="250"></a>
                                    <div class="excerpt">


                                        <h2><a
                                                href="{{ route('client_blog_detail', ['id' => $blog->id]) }}">{{ $blog->name }}</a>
                                        </h2>
                                        <div class="post-meta align-items-center text-left clearfix">
                                            <figure class="author-figure mb-0 me-3 float-start"><img
                                                    src="/images/{{ $blog->users->avatar }}" alt="Image"
                                                    class="img-fluid">
                                            </figure>
                                            <span class="d-inline-block mt-1">By <a
                                                    href="#">{{ $blog->users->name }}</a></span>
                                            <span>&nbsp;-&nbsp; {{ $blog->created_at->format('d-m-Y H:i:s') }}</span>
                                        </div>

                                        <p>{{ $blog->short_content }}</p>
                                        <p><a href="{{ route('client_blog_detail', ['id' => $blog->id]) }}"
                                                class="read-more">Đọc</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach
@endsection
