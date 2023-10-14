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

// Function to confirm delete action then use ajax to send request to server
// can use for delete and softdelete
async function confirmDeleteApi(url, data = {}, methodType = 'DELETE') {
     const result = await Swal.fire({
          html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Xác nhận xóa?</h4><p class="text-muted mx-4 mb-0">Bạn có chắc muốn xóa đi không?</p></div></div>',
          showCancelButton: true,
          confirmButtonClass: "btn btn-primary w-xs mx-2 mb-1",
          confirmButtonText: "Đồng ý",
          cancelButtonClass: "btn btn-danger w-xs mb-1",
          cancelButtonText: "Hủy",
          reverseButtons: true,
          buttonsStyling: false,
          showCloseButton: true,
     });
     if (result.isConfirmed) {
          const statusRequest = await deleteRecordApi(url, data, methodType);
          return statusRequest;
     }

     return false;
}

// Function to handle the delete action
async function deleteRecordApi(url, data, methodType = 'DELETE') {
     Swal.fire({
          toast: true,
          position: 'top-end',
          text: 'Đang thực hiện...',
          icon: 'info',
          showCancelButton: false,
          showConfirmButton: false,
          didOpen: () => {
               Swal.showLoading();
          },
     });
     const csrfToken = $('meta[name="csrf-token"]').attr('content');

     try {
          // 'Content-Type': 'application/json',
          const response = await fetch(url, {
               method: methodType,
               headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
               },
               body: JSON.stringify(data)
          });

          if (response.status === 200) {
               Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Xóa thành công!",
                    showConfirmButton: !1,
                    timer: 2e3,
                    showCloseButton: !0,
               });

               return true;
          } else {
               Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Xóa thất bại!",
                    text: response.statusText,
                    showConfirmButton: !1,
                    timer: 2e3,
                    showCloseButton: !0,
               });

               return false;
          }
     } finally {
          Swal.hideLoading();
     }
};
