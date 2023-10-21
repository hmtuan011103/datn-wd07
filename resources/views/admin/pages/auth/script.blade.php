<!--sweetalert-->
<script src={{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Auth\Login', '#form-login') !!}

<script>
    if ($("#admin-account") && $("#staff-account")) {
        $("#admin-account").click(function() {
            $("#email").val("admin@admin.admin");
            $("#password-input").val("admin@admin");
        });

        $("#staff-account").click(function() {
            $("#email").val("test@test.test");
            $("#password-input").val("test@test");
        });
    }
</script>
