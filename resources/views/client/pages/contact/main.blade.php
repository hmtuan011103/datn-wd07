@include('client.pages.contact.style')
<div class="contact container mt-3 mb-5">
    <div class="contact-left col-md-5 col-10">
        <img src="{{ asset('client/assets/images/contact.png')}}" width="100%" alt="">
    </div>
    <div class="contact-right col-md-6 col-10">
        <div class="title">
            <img src="https://futabus.vn/images/icons/mail_send.svg" alt="">
            <span>  Gửi thông tin liên hệ đến chúng tôi</span>
        </div>
        <form action="{{route('create_contact')}}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="form-group col-md-12">
                    <input type="text" name="name" class="form-control" placeholder="Họ và tên">
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <input type="email" name="email" class="form-control input-email" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="phone_number" class="form-control" placeholder="Số điện thoại">
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-12">
                    <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề">
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-12">
                    <textarea class="form-control" name="note" rows="3" placeholder="Nhập ghi chú"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-submit">Gửi</button>
        </form>
    </div>
</div>

