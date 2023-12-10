 <!-- Sweet Alert css-->
 <link rel="stylesheet" href={{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.css') }}>

 <!-- multi.js css -->
 <link rel="stylesheet" type="text/css" href={{ asset('admin/assets/libs/multi.js/multi.min.css') }} />
<style>
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
        /* padding: 5px; */
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 0.5vw;
    }
</style>
