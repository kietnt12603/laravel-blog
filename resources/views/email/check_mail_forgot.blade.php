<div style="width: 600px; margin: 0 auto">
    <h2>Xin Chào {{ $customer->name }}</h2>
    <p>Email này để giúp bạn lấy lại mật khẩu đã bị mất</p>
    <p>Vui lòng click vào link bên dưới để đặt lại mật khẩu</p>
    <p>
        <a href="{{ route('client_forgotpassword', ['customer' => $customer->id, 'token' => $customer->token]) }}"
            style="display: inline-block; background: green; color: #fff; padding: 7px 25px; font-weight: bold">Đặt Lại
            Mật Khẩu</a>
    </p>
    <h3>
        TINTUC24H.COM
    </h3>
</div>
