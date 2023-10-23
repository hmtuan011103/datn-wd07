var idTableContainer,
     checkAll = document.getElementById("checkAll"),
     perPage =
          (checkAll &&
               (checkAll.onclick = function () {
                    var e = document.querySelectorAll(
                         '.form-check-all input[type="checkbox"][name="chk_child"]'
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
     editlist = !1;

var options = {
     valueNames: ["id", "name", "user_type", "email", "created_at", "updated_at"],
     page: perPage,
     pagination: !0,
     plugins: [ListPagination({ left: 2, right: 2 })],
};

// no result handle when search-route2
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
          var dataParams = { ids: ids_array };
          var urlAjaxRequest = "/api/users/destroy-multiple";

          (async () => {
               let statusRequest = await confirmDeleteApi(urlAjaxRequest, dataParams);

               if (statusRequest) {
                    // Reload the page after a 1.5-second delay
                    setTimeout(() => {
                         location.reload();
                    }, 1000);
               }
          })();

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
});
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
