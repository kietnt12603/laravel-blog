@extends('client.blocks.main')
@section('ClientContent')
    <div class="site-cover site-cover-sm same-height overlay single-page"
        style="background-image: url('/images/{{ $blogDetail->images }}');">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4">{{ $blogDetail->name }}</h1>
                        <div class="post-meta align-items-center text-center">
                            <figure class="author-figure mb-0 me-3 d-inline-block"><img
                                    src="/images/{{ $blogDetail->users->avatar }}" alt="Image" class="img-fluid"></figure>
                            <span class="d-inline-block mt-1">By {{ $blogDetail->users->name }}</span>
                            <span>&nbsp;-&nbsp; {{ $blogDetail->created_at->format('d-m-Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">

            <div class="row blog-entries element-animate">

                <div class="col-12 main-content">

                    <div class="post-content-body">
                        <div>
                            {!! $blogDetail->content !!}
                        </div>
                    </div>


                    <div class="pt-5">
                        <p>Categories: <a
                                href="{{ route('client_category', ['id' => $blogDetail->category->id]) }}">{{ $blogDetail->category->name }}</a>
                        </p>
                    </div>


                    <div class="pt-5 comment-wrap">
                        <h3 class="mb-5 heading" id="commentCount">{{ $commentCount }} Comments</h3>
                        <div id="comments">
                            <ul class="comment-list">
                            </ul>
                        </div>
                        <!-- END comment-list -->

                        <div class="comment-form-wrap pt-5">
                            <h3 class="mb-5">Leave a comment</h3>
                            <form id="commentForm" method="POST" class="p-5 bg-light">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="content" id="message" cols="30" rows="" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    {{-- <input type="submit" value="Post Comment" class="btn btn-primary"> --}}
                                    <button type="submit" class="btn btn-primary">Bình luận</button>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Start posts-entry -->
    <section class="section posts-entry posts-entry-sm bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-uppercase text-black">More Blog Posts</div>
            </div>
            <div class="row">
                @foreach ($relatedBlogs as $item)
                    <div class="col-md-6 col-lg-3">
                        <div class="blog-entry">
                            <a href="{{ route('client_blog_detail', ['id' => $item->id]) }}" class="img-link">
                                <img src="/images/{{$item->images}}" alt="Image" class="img-fluid">
                            </a>
                            <span class="date">Apr. 14th, 2022</span>
                            <h2><a href="{{ route('client_blog_detail', ['id' => $item->id]) }}">{{$item->name}}</p>
                            <p><button class="btn btn-sm btn-primary"><a href="{{ route('client_blog_detail', ['id' => $item->id]) }}" class="read-more text-light" style="text-decoration: none !important">Đọc Ngay</a></button></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Gửi bình luận
                $('#commentForm').on('submit', function(e) {
                    e.preventDefault();

                    var content = $('#message').val();

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('comment.store', $blogDetail->id) }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            content: content
                        },
                        success: function(response) {
                            refreshComments(); // Cập nhật danh sách bình luận
                            $('#commentCount').text(response.commentCount + ' comments');
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công!',
                                text: 'Bình luận đã được thêm thành công.',
                            });
                            $('#message').val('');
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Đã xảy ra lỗi khi thêm bình luận.',
                            });
                        }
                    });
                });

                // Hiển thị form khi nhấp vào nút "Reply"
                $(document).on('click', '.reply', function() {
                    var commentId = $(this).closest('.comment').data('comment-id');
                    var replyForm = $('.reply-form[data-comment-id="' + commentId + '"]');
                    replyForm.toggle(); // Toggle hiển thị/ẩn form trả lời
                });

                // Gửi phản hồi
                $(document).on('click', '.submit-reply', function() {
                    var replyForm = $(this).closest('.reply-form');
                    var commentId = replyForm.data('comment-id');
                    var replyMessage = replyForm.find('.reply-message').val();

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('comment.reply', $blogDetail->id) }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            content: replyMessage,
                            parent_id: commentId
                        },
                        success: function(response) {
                            refreshComments();
                            replyForm.hide(); // Ẩn form trả lời sau khi gửi thành công
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công!',
                                text: 'Phản hồi đã được thêm thành công.',
                            });
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Đã xảy ra lỗi khi thêm phản hồi.',
                            });
                        }
                    });
                });

                function refreshComments() {
                    $.ajax({
                        url: '/refresh-comments/{{ $blogDetail->id }}', // Đường dẫn đến endpoint xử lý việc tải lại danh sách bình luận
                        type: 'GET',
                        success: function(response) {
                            $('#comments ul').html(response); // Cập nhật danh sách bình luận
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Đã xảy ra lỗi khi tải lại danh sách bình luận.',
                            });
                        },
                        complete: function() {
                            setTimeout(refreshComments, 50000); // Tự động gọi lại sau 50 giây
                        }
                    });
                }

                refreshComments(); // Bắt đầu Polling ngay khi trang được tải
            });
        </script>
    </section>
    <!-- End posts-entry -->
@endsection
