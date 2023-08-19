<div class="sidebar-box search-form-wrap mb-4">
    <form action="{{ route('client_blog_search') }}" method="POST" class="sidebar-search-form">
        <span class="bi-search"></span>
        <input type="text" class="form-control" id="s" name="search" placeholder="Nhập Keyword vào đây">
        @csrf
    </form>
</div>
<div class="sidebar-box">
    <h3 class="heading">Bài Viết Được Xem Nhiều Nhất</h3>
    <div class="post-entry-sidebar">
        <ul>
            @foreach ($blogView as $item)
                <li>
                    <a href="{{ route('client_blog_detail', ['id' => $item->id]) }}">
                        <img src="/images/{{ $item->images }}" alt="Image placeholder" class="me-4 rounded">
                        <div class="text">
                            <h4>{{ $item->name }}</h4>
                            <div class="post-meta">
                                <span class="mr-2">{{ $item->created_at->format('d/m/Y') }} </span>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- END sidebar-box -->

<div class="sidebar-box">
    <h3 class="heading">Danh Mục</h3>
    <ul class="categories">
        @foreach ($categoryAll as $item)
            <li><a href="{{ route('client_category', ['id' => $item->id]) }}">{{ $item->name }}
                    <span>({{ $item->blogsCount() }})</span></a></li>
        @endforeach
    </ul>
</div>
