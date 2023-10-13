function confirmDelete(itemId) {
     Swal.fire({
          html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Xác nhận xóa?</h4><p class="text-muted mx-4 mb-0">Bạn có chắc muốn xóa đi không?</p></div></div>',
          showCancelButton: true,
          confirmButtonClass: "btn btn-primary w-xs mx-2 mb-1",
          confirmButtonText: "Đồng ý",
          cancelButtonClass: "btn btn-danger w-xs mb-1",
          cancelButtonText: "Hủy",
          reverseButtons: true,
          buttonsStyling: false,
          showCloseButton: true,
     }).then((result) => {
          if (result.isConfirmed) {
               $('#deleteForm' + itemId).submit();
          }
     });
}