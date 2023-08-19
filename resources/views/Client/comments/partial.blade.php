{{-- @foreach ($blogDetail->comments as $comment)
    <li class="comment">
        <div class="vcard">
            <img src="/images/{{ $comment->user->avatar }}" alt="Image placeholder">
        </div>
        <div class="comment-body">
            <h3>{{ $comment->user->name }}</h3>
            <div class="meta">{{ $comment->created_at->format('d-m-Y H:i:s') }}</div>
            <p>{{ $comment->content }}</p>
            <p><a href="#" class="reply rounded">Reply</a></p>
            <form class="reply-form" data-comment-id="{{ $comment->id }}" style="display: none;">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea class="reply-message" rows="2" placeholder="Nhập phản hồi của bạn"></textarea>
                <button type="button" class="submit-reply">Gửi</button>
            </form>
            <ul class="comment-list">
                @foreach ($comment->replies as $reply)
                    <li class="comment">
                        <div class="vcard">
                            <img src="/images/{{ $reply->user->avatar }}" alt="Image placeholder">
                        </div>
                        <div class="comment-body">
                            <h3>{{ $reply->user->name }}</h3>
                            <div class="meta">{{ $reply->created_at->format('d-m-Y H:i:s') }}</div>
                            <p>{{ $reply->content }}</p>
                            <!-- Không cần nút Reply cho các bình luận cấp 2 -->
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </li>
@endforeach --}}
@foreach ($topLevelComments as $comment)
    <li class="comment" data-comment-id="{{ $comment->id }}">
        <!-- ... Hiển thị thông tin bình luận ... -->
        <div class="vcard">
            <img src="/images/{{ $comment->user->avatar }}" alt="Image placeholder">
        </div>
        <div class="comment-body">
            <h3>{{ $comment->user->name }}</h3>
            <div class="meta">{{ $comment->created_at->format('d-m-Y H:i:s') }}</div>
            <p>{{ $comment->content }}</p>
            {{-- <p><a href="#" class="reply rounded">Reply</a></p> --}}
            <p><button type="button" class="reply rounded">Reply</button></p>
            <!-- Form trả lời bình luận (ban đầu ẩn đi) -->
            {{-- <form class="reply-form" data-comment-id="{{ $comment->id }}" style="display: none;">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea class="reply-message" rows="2" placeholder="Nhập phản hồi của bạn"></textarea>
                <button type="button" class="submit-reply">Gửi</button>
            </form> --}}
            <form class="reply-form p-5 bg-light" data-comment-id="{{ $comment->id }}" style="display: none;">
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="content" id="message-reply" cols="30" rows="" class="reply-message form-control"></textarea>
                </div>
                <div class="form-group">
                    {{-- <input type="submit" value="Post Comment" class="btn btn-primary"> --}}
                    {{-- <button type="button" class="submit-reply">Gửi</button> --}}
                    <button type="button" class="submit-reply btn btn-primary">Bình luận</button>
                </div>
                @csrf
            </form>
            <ul class="comment-list">
                @foreach ($comment->replies as $reply)
                    <li class="comment">
                        <div class="vcard">
                            <img src="/images/{{ $reply->user->avatar }}" alt="Image placeholder">
                        </div>
                        <div class="comment-body">
                            <h3>{{ $reply->user->name }}</h3>
                            <div class="meta">
                                {{ $reply->created_at->format('d-m-Y H:i:s') }}</div>
                            <p>{{ $reply->content }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
    </li>
@endforeach
{{-- @foreach ($blogDetail->comments as $comment)
    <li data-comment-id="{{ $comment->id }}" class="comment">
        <!-- ... Hiển thị thông tin bình luận ... -->
        <div class="vcard">
            <img src="/images/{{ $comment->user->avatar }}" alt="Image placeholder">
        </div>
        <div class="comment-body">
            <h3>{{ $comment->user->name }}</h3>
            <div class="meta">{{ $comment->created_at->format('d-m-Y H:i:s') }}</div>
            <p>{{ $comment->content }}</p>
            <p><button type="button" class="reply rounded">Reply</button></p>

            <form class="reply-form" data-comment-id="{{ $comment->id }}" style="display: none;">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea class="reply-message" rows="2" placeholder="Nhập phản hồi của bạn"></textarea>
                <button type="button" class="submit-reply">Gửi</button>
            </form>
            <ul class="reply-list">
                @foreach ($comment->replies as $reply)
                    <li class="comment">
                        <div class="vcard">
                            <img src="/images/{{ $reply->user->avatar }}" alt="Image placeholder">
                        </div>
                        <div class="comment-body">
                            <h3>{{ $reply->user->name }}</h3>
                            <div class="meta">
                                {{ $reply->created_at->format('d-m-Y H:i:s') }}</div>
                            <p>{{ $reply->content }}</p>
                            <!-- Không cần nút Reply cho các bình luận cấp 2 -->
                        </div>
                    </li>
                @endforeach
            </ul>
    </li>
@endforeach --}}
