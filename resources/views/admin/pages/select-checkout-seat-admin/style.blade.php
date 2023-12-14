<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style>
    .error {
        color: #ff4d4f;
        font-size: 14px;
    }
    .justify-content-between {
        margin-bottom: 10px;
    }
    .border-bottom-4 {
        border-bottom: 4px solid #E5E5E5;
    }
    .place-turning-returning {
        margin-top: 20px;
        border-top: 1px solid #ccc;
        padding-top: 20px;
    }
    .border-bottom-1-seats {
        padding-top: 20px;
        border-top: 1px solid #CCD;
        margin-top: 30px;
    }
    .border-top-1 {
        border-top: 1px solid #ccc;
    }
    .border-right-2 {
        border-right: 2px solid #ccc;
    }
    .form-check-input:checked {
        border-color: #ff4d4f;
    }
    .form-check-input:checked[type=checkbox] {
        background-color: #ff4d4f;
    }
    .form-check-input:focus[type=checkbox] {
        box-shadow: none;
    }
    .w-70 {
        width: 70%;
    }
    .w-30 {
        width: 30%;
    }
    .w-20px {
        width: 20px !important;
    }
    #countdown_client_interface {
        margin: 0 auto;
        border-radius: 10px;
        width: 30%;
        padding: 10px;
        text-align: center;
        border: 1px solid #ccc;
    }
    .seat-active {
        color: #A7ABF4;
    }
    .ta-center {
        text-align: center;
    }
    .height-seat-choosing {
        height: 33px;
    }
    .seat-selecting {
        color: #F05E22;
    }
    .h-32 {
        height: 32px;
    }
    .fw-bold {
        font-weight: 700!important;
    }
    .text-uppercase {
        text-transform: uppercase!important;
    }
    .cursor {
        cursor: pointer;
    }
    .cursor-not-allowed {
        cursor: not-allowed;
    }
    .seat-disabled{
        color: #A2ACBB;
    }
    .seat-choosing{
        color: #FFFFFF;
    }
    .fs-10 {
        font-size: 10px !important;
    }
    .w-32 {
        width: 32px;
    }
    .bg-white{
        background-color: #ffffff;
        box-shadow: 0 3px 3px rgba(56,65,74,.1);
    }
    .code-seat {
        left: 8px;
        top: 6px;
    }
    /*Tabs Jquery*/

    .container-tabs{
        width: 500px;
        margin: 0 auto;
        background: #ffffff;
        z-index: 999;
        border-radius: 10px;
        box-shadow: 0 3px 3px rgba(56,65,74,.1);
        border: 1px solid #ccc;
        right: -10px;
        top: 25px;
        display: none;
    }
    .container-tabs ul.tabs{
        margin: 0px;
        padding: 0px;
        list-style: none;
    }
    .container-tabs ul.tabs li{
        background: none;
        color: #222;
        display: inline-block;
        padding: 10px 15px;
        cursor: pointer;
    }

    .container-tabs ul.tabs li.current{
        color: #222;
        border-bottom: 2px solid #E03909;
    }

    .container-tabs .tab-content{
        display: none;
        padding: 15px;
        border-top: 1px solid #ccc;
    }

    .container-tabs .tab-content.current{
        display: inherit;
        border-radius: 0 0 10px 10px;
    }
    .hover__see--detail--car:hover>.container-tabs {
        display: block;
    }
    /*Tabs Jquery*/
</style>
