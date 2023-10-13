var idTableContainer,
     checkAll = document.getElementById("checkAll"),
     perPage =
          (checkAll &&
               (checkAll.onclick = function () {
                    var e = document.querySelectorAll(
                         '.form-check-all input[type="checkbox"]'
                    );
                    1 == checkAll.checked
                         ? Array.from(e).forEach(function (e) {
                              (e.checked = !0),
                                   e.closest("tr").classList.add("table-active");
                         })
                         : Array.from(e).forEach(function (e) {
                              (e.checked = !1),
                                   e.closest("tr").classList.remove("table-active");
                         });
               }),
               10),
     editlist = !1,
     options = {
          valueNames: ["id", "name", "created_at", "updated_at"],
          page: perPage,
          pagination: !0,
          plugins: [ListPagination({ left: 2, right: 2 })],
     };

// no result handle
document.getElementById("idTableContainer") &&
     (idTableContainer = new List("idTableContainer", options).on(
          "updated",
          function (e) {
               0 == e.matchingItems.length
                    ? (document.getElementsByClassName(
                         "noresult"
                    )[0].style.display = "block")
                    : (document.getElementsByClassName(
                         "noresult"
                    )[0].style.display = "none");
               var t = 1 == e.i,
                    a = e.i > e.matchingItems.length - e.page;
               document.querySelector(".pagination-prev.disabled") &&
                    document
                         .querySelector(".pagination-prev.disabled")
                         .classList.remove("disabled"),
                    document.querySelector(".pagination-next.disabled") &&
                    document
                         .querySelector(".pagination-next.disabled")
                         .classList.remove("disabled"),
                    t &&
                    document
                         .querySelector(".pagination-prev")
                         .classList.add("disabled"),
                    a &&
                    document
                         .querySelector(".pagination-next")
                         .classList.add("disabled"),
                    e.matchingItems.length <= perPage
                         ? (document.querySelector(
                              ".pagination-wrap"
                         ).style.display = "none")
                         : (document.querySelector(
                              ".pagination-wrap"
                         ).style.display = "flex"),
                    e.matchingItems.length == perPage &&
                    document
                         .querySelector(".pagination.listjs-pagination")
                         .firstElementChild.children[0].click(),
                    0 < e.matchingItems.length
                         ? (document.getElementsByClassName(
                              "noresult"
                         )[0].style.display = "none")
                         : (document.getElementsByClassName(
                              "noresult"
                         )[0].style.display = "block");
          }
     ));

// delete multiple click event trigger
function deleteMultiple() {
     ids_array = [];
     var e = document.getElementsByName("chk_child");
     if (
          (Array.from(e).forEach(function (e) {
               1 == e.checked &&
                    ((e =
                         e.parentNode.parentNode.parentNode.querySelector(
                              ".id a"
                         ).innerHTML.trim()),
                         ids_array.push(e));
          }),
               "undefined" != typeof ids_array && 0 < ids_array.length)
     ) {
          // Convert the array to a JSON string
          var idArrayJsonData = JSON.stringify(ids_array);
          var urlAjaxRequest = window.location.hostname + "/api/type_users/destroy-multiple";

          $.ajax({
               url: urlAjaxRequest,
               type: 'DELETE',
               data: { ids: idArrayJsonData },
               success: function (response) {
                    console.log('Success:', response);
               },
               error: function (error) {
                    console.error('Error:', error);
               }
          });

          // var ajaxRequest = $.ajax({
          //      url: window.location.hostname + "manage/type_users/{type_user_array}" +
          //           selectedRows[a],
          //      method: "GET"
          // });
          // var row = document.getElementById('row' + selectedRows[a]);
          // if (row) {
          //      row.remove();
          //      // style.display = 'none';
          // }
          // Swal.fire({
          //      position: "center",
          //      icon: "success",
          //      title: "Xóa phân quyền thành công!",
          //      showConfirmButton: !1,
          //      timer: 2e3,
          //      showCloseButton: !0,
          // })


          // if (!confirm("Bạn có chắc muốn xóa không?")) return !1;
          // Array.from(ids_array).forEach(function (e) {
          //      idTableContainer.remove(
          //           "id",
          //           `<a href="javascript:void(0);" class="fw-medium link-primary">${e}</a>`
          //      );
          // }),
          (document.getElementById("checkAll").checked = !1);
     } else
          Swal.fire({
               title: "Vui lòng chọn ít nhất 1",
               confirmButtonClass: "btn btn-danger",
               confirmButtonColor: '#d33',
          });
}

document.querySelectorAll(".listjs-table").forEach(function (e) {
     e.querySelector(".pagination-next").addEventListener("click", function () {
          e.querySelector(".pagination.listjs-pagination") &&
               e
                    .querySelector(".pagination.listjs-pagination")
                    .querySelector(".active") &&
               e
                    .querySelector(".pagination.listjs-pagination")
                    .querySelector(".active")
                    .nextElementSibling.children[0].click();
     });
}),
     document.querySelectorAll(".listjs-table").forEach(function (e) {
          e.querySelector(".pagination-prev").addEventListener(
               "click",
               function () {
                    e.querySelector(".pagination.listjs-pagination") &&
                         e
                              .querySelector(".pagination.listjs-pagination")
                              .querySelector(".active") &&
                         e
                              .querySelector(".pagination.listjs-pagination")
                              .querySelector(".active")
                              .previousSibling.children[0].click();
               }
          );
     });
