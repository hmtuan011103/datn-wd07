<link href="{{ asset("admin/assets/libs/sweetalert2/sweetalert2.min.css") }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="dist/css/font-awesome/css/font-awesome.min.css">

{{-- click date --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    /* .submit-data-trip{
        margin-top: -0.8vw;
    } */
    .filter-container {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        border-top: 1px solid #ccc;
    }
    .filter-group-inline {
        display: inline-block;
        vertical-align: top;
    }
    label {
        display: block;
        font-weight: bold;
        margin: 5px 0;
    }
    input[type="date"],
    select,
    input[type="text"] {
        width: 14.2vw;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 0.5vw;
    }
</style>

