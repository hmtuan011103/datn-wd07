  <div class="container">
      <div class="form-ticket">
          <div class="title-search">
              <p>TRA CỨU THÔNG TIN ĐẶT VÉ</p>
          </div>
          <form >
            <div class="form-group">
              <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Vui lòng nhập điện thoại">
              <label for="phone" class="form-label">Số điện thoại</label>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="ticketCode" name="ticketCode" placeholder="Vui lòng nhập mã hóa đơn">
              <label for="ticketCode" class="form-label">Mã hóa đơn</label>
            </div>
            <div class="button">
              <button type="submit" id="searchButton" class="btn-search">Tra cứu</button>

            </div>
          </form>
      </div>

    </div>

  @include('client.pages.search-ticket.detail-ticket')
