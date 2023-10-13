if (typeof multi === 'function') {
     var idMultiSelect = document.getElementById('validationUserRoleSelect');

     if (idMultiSelect) {
          multi(idMultiSelect, {
               enable_search: 1,
               search_placeholder: "Tìm kiếm vai trò...",
               non_selected_header: "Danh sách vai trò",
               selected_header: "Vai trò đã chọn"
          });
     }
}