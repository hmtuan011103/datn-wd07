<style>
    .container_one {
        margin: 40px 10%;
    }
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
    .border_main {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
</style>
