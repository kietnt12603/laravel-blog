@extends('client.layouts.app')
@section('ClientMain')
    <nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <div class="row g-0 align-items-center">
                        <div class="col-3">
                            <a href="{{ route('client_home') }}" class="logo m-0 float-start"><img
                                    src="/images/{{ $web_configuration->logo }}" width="100" height="50"
                                    alt=""><span class="text-primary"></span></a>
                        </div>
                        <div class="col-9 text-end  ">
                            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                                <li class="active"><a href="{{ route('client_home') }}">Trang Chủ</a></li>
                                <li><a href="{{ route('client_blog') }}">Bài Viết</a></li>
                                <li class="has-children">
                                    <a href="#">Danh Mục</a>
                                    <ul class="dropdown">
                                        @foreach ($categories as $item)
                                            <li><a
                                                    href="{{ route('client_category', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @foreach ($categoriesMenu as $item)
                                    <li><a
                                            href="{{ route('client_category', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                                @php
                                    $info = Auth::guard('customers');
                                @endphp
                                @if ($info->check())
                                    <li class="has-children">
                                        <img class="img-circle elevation-2"
                                            style="border-radius: 50%; box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23) !important;"
                                            width="50" height="50" src="/images/{{ $info->user()->avatar }}"
                                            alt="">
                                        <a href="#">{{ $info->user()->name }}</a>
                                        <ul class="dropdown">
                                            {{-- <li>
                                                <a href="">Đổi Mật Khâu</a>
                                            </li> --}}
                                            <li>
                                                <a href="{{ route('client_logout') }}">Đăng Xuất</a>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{ route('client_login') }}">Đăng Nhập</a></li>
                                    <li><a href="{{ route('client_register') }}">Đăng Ký</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @yield('ClientContent')
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="widget">
                        <h3 class="mb-4">About</h3>
                        <p>{{ $web_configuration->about }}</p>
                    </div>
                    <!-- /.widget -->
                    <div class="widget">
                        <h3>Social</h3>
                        <ul class="list-unstyled social">
                            <li><a href="{{ $web_configuration->instagram }}"><span class="icon-instagram"></span></a></li>
                            <li><a href="{{ $web_configuration->twitter }}"><span class="icon-twitter"></span></a></li>
                            <li><a href="{{ $web_configuration->facebook }}"><span class="icon-facebook"></span></a></li>
                            <li><a href="{{ $web_configuration->linkedin }}"><span class="icon-linkedin"></span></a></li>
                            <li><a href="{{ $web_configuration->pinterest }}"><span class="icon-pinterest"></span></a></li>
                            <li><a href="{{ $web_configuration->dribbble }}"><span class="icon-dribbble"></span></a></li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4 ps-lg-5">
                    <div class="widget">
                        <h3 class="mb-4">Company</h3>
                        <ul class="list-unstyled float-start links">
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Vision</a></li>
                            <li><a href="#">Mission</a></li>
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Privacy</a></li>
                        </ul>
                        <ul class="list-unstyled float-start links">
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Creative</a></li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="widget">
                        <h3 class="mb-4">Recent Post Entry</h3>
                        <div class="post-entry-footer">
                            <ul>
                                @foreach ($blogView as $item)
                                    <li>
                                        <a href="{{ route('client_blog_detail', ['id' => $item->id]) }}">
                                            <img src="/images/{{ $item->images }}" alt="Image placeholder"
                                                class="me-4 rounded">
                                            <div class="text">
                                                <h4>{{ $item->name }}</h4>
                                                <div class="post-meta">
                                                    <span class="mr-2">{{ $item->created_at->format('d-m-y H:i:s') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->

            <div class="row mt-5">
                <div class="col-12 text-center">
                    <p>Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> Nguyễn Tuấn Kiệt
                    </p>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </footer>
