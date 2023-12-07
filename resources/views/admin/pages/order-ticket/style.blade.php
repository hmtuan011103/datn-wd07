<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style>
    #showtripstart{
        cursor: pointer;
        border-bottom: 3px solid red;
        color: red;
    }
    #showtripend{
        cursor: pointer;
        border-bottom: 1px solid rgba(246, 0, 0, 0.823)
    }
    .type-seat.active {
        background-color: rgb(219, 92, 34) !important;
        color: #ffffff !important;
        border: #110101 !important;
    }

    .floor.active {
        background-color: rgb(219, 92, 34) !important;
        color: #ffffff !important;
        border: #110101 !important;
    }

    .rowseat.active {
        background-color: rgb(219, 92, 34) !important;
        color: #ffffff !important;
        border: #110101 !important;
    }
    .border-dotted-search {
        border-bottom: 1px solid blue !important;
        flex: 1 1 0%;
    }
    .show-time-run {
        transform: translateY(15px);
    }
    .ta-center {
        text-align: center;
    }
    .bg-white{
        background-color: #ffffff;
        box-shadow: 0 3px 3px rgba(56,65,74,.1);
    }
    .circle-menu-style {
        background-color: #ccc;
        width: 6px;
        height: 6px;
    }
    .w-30{
        width: 30%;
    }
    .w-70{
        width: 70%;
    }
</style>
