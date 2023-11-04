<!--sweetalert-->
<script src={{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\User\StoreUserRequest', '#form-create-user') !!}
{!! JsValidator::formRequest('App\Http\Requests\User\UpdateUserRequest', '#form-edit-user') !!}
{!! JsValidator::formRequest(
    'App\Http\Requests\User\UserProfileChangePasswordRequest',
    '#form-user-profile-change-password',
) !!}

<!-- listjs init -->
<script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/pages/src/user/listjs.js') }}"></script>

<script src={{ asset('admin/assets/js/pages/src/main.js') }}></script>

<!-- multi.js -->
<script src={{ asset('admin/assets/libs/multi.js/multi.min.js') }}></script>
<script src={{ asset('admin/assets/js/pages/src/user/multijs.js') }}></script>

<script>
    var isValid = true;

    $('#form-user-profile-change-password').submit(function(event) {
        if (!isValid) {
            event.preventDefault();
        }

        var currentPassword = $('#validationCustomPasswordcur').val();
        var newPassword = $('#validationCustomPassword').val();
        if (currentPassword === newPassword) {
            $('#validationCustomPassword-error').text(
                'Mật khẩu mới phải khác mật khẩu hiện tại.');
        }
    });

    //     $('#validationCustomPassword').on('input', function() {
    $('#validationCustomPasswordRe').on('input', function() {
        // Get the values of the current password, new password, and password confirmation inputs
        var currentPassword = $('#validationCustomPasswordcur').val();
        var newPassword = $('#validationCustomPassword').val();

        // Compare the current password and new password
        if (currentPassword === newPassword) {
            // If they are the same, show an error message or perform desired action
            $('#validationCustomPassword-error').text(
                'Mật khẩu mới phải khác mật khẩu hiện tại.');
            isValid = false;
        } else {
            // If they are different, clear the error message or perform desired action
            $('#validationCustomPassword-error').text('');
            isValid = true;
        }
    });
</script>
