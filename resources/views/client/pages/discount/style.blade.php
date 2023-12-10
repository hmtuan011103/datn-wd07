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
    }

    .line {
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
        border-color: #007bff;
    }

    .active .line {
        background-color: #007bff;
    }

    #contentContainer {
        border: 1px solid #ddd;
        padding: 20px;
    }
    .mr-2 {
         margin-right: 0.5rem!important;
    }
    .discount-container {
        display: flex;
        flex-wrap: wrap;
        max-width: 800px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .discount-item {
        flex: 0 0 calc(33.3333% - 20px);
        margin: 10px;
        padding: 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        background-color: #ffffff;
    }

    .discount-label {
        font-weight: bold;
        margin-right: 5px;
    }

    .discount-value {
        color: #007bff;
    }

    h2 {
        width: 100%;
        text-align: center;
        margin-bottom: 20px;
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
