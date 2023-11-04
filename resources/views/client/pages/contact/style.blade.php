<style>
    .contact{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center;
        padding: 15px 0 !important;
    }
    .intro{
        color: orange;
        font-size: 18px;
        font-weight: 500;
    }
    .item-info{
       padding: 10px 0;
       font-size: 20px;
       font-weight: 600
    }
    .item-info span{
        color: rgb(108, 108, 108);
    }
    .title span{
        text-align: center;
        color: orangered;
        font-size: 22px;
        font-weight: 600
    }
    .btn-submit{
        background-color: #F15A24;
        color: white;
        padding: 5px 0;
        width: 100%;
        transition: 0.5s ease-in-out;
    }
    .error-help-block{
        color: red;
        font-size: 15px;
        margin-bottom: 0 !important;
    }
    @media(max-width:767px){
        .contact{
            justify-content: center;
        }
        .contact-right{
            margin-top: 20px;
        }
        .input-email{
            margin-bottom: 20px;
        }
    }
</style>
