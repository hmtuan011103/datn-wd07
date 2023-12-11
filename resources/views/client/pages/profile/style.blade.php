<style>
    .row {
        display: flex;
    }
    .col-md-4 {
        flex: 4;
    }
    .col-md-8 {
        flex: 8;
    }
    .list-group-item:hover {
        background-color: #fef9f8;
    }
    .btn-primary{
        background-color: rgb(239, 82, 34);
        border: 1px solid rgb(239, 82, 34);
    }
    input[type="password"] {
        padding-left: 30px;
        border: 1px solid #e0dfdf;
        border-radius: 20px;
        outline: none;
        transition: border-color 0.3s ease;
        width: 100%;
    }
    input[type="password"]:focus
    {
        outline: 2px solid rgba(170, 46, 8, .1) !important;
        border-color: #F9821D;
        box-shadow: none;
    }
    .text-danger{
        padding-left: 10px;
        font-size: 14px;
        font-weight: normal;
        display: block;
        padding-bottom: 10px;
    }
    .step-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-bottom: 20px;
        position: relative;
    }

    .step {
        position: relative;
        z-index: 1;
        text-align: center;
        flex: 1;
    }

    .step-circle {
        width: 10px;
        height: 10px;
        border: 2px solid #ddd;
        background-color: white;
        border-radius: 50%;
        position: relative;
        z-index: 2;
        margin: 0 auto;
        transition: background-color 0.3s ease;
        /* Thêm transition */
    }

    /* Thêm phần tooltip */
    .step-tooltip {
        width: 200px;
        position: absolute;
        bottom: 120%;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
        pointer-events: none;
        background-color: #F9821D;
        color: white;
        padding: 5px;
        border-radius: 5px;
    }

    .step:hover .step-circle {
        background-color: #F9821D;
    }

    .step:hover .step-tooltip {
        opacity: 1;
        transform: translateX(-50%) translateY(-5px);
    }

    .line {
        position: absolute;
        width: calc(100% - 20px);
        height: 2px;
        background-color: #ffc107;
        top: 50%;
        left: 20px;
        z-index: 0;
        margin-top: -13px;
    }

    .grey-line {
        position: absolute;
        width: calc(100% - 20px);
        height: 2px;
        background-color: #ddd;
        top: 50%;
        left: 20px;
        z-index: 0;
        margin-top: -13px;
    }

    .active .step-circle {
        background-color: #007bff;
    }

    .active .line {
        background-color: #007bff;
    }

    .initial .step-circle {
        background-color: red;
    }

    .initial .line {
        background-color: red;
    }

    .yellow .line {
        background-color: yellow !important;
    }

    #contentContainer {
        border: 1px solid #ddd;
        padding: 20px;
    }
    .mr-2 {
         margin-right: 0.5rem!important;
    }
    .border_main {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
    }
    img, video {
        max-width: 100%;
        height: auto;
    }
    .rounded-circle {
        width: 80%;
        margin: 0px 30px;
    }
    .profile_pading{
        padding: 70px 0px;
    }
    .pading_left{
        padding-left: 50px;
    }
    .highlighted-text {
        color: #F9821D; /* Màu chữ trắng */
        text-decoration: none; /* Loại bỏ gạch chân */
        transition: background-color 0.3s ease, color 0.3s ease; /* Hiệu ứng chuyển động */
        display: inline-block; /* Cho phép đặt kích thước và padding */
    }
</style>
