<style>
    .tab1{
        font-family:Arial, Helvetica, sans-serif;
        margin: 15px 0;
        padding: 0 15px;
    }
    .tab1 .title{
        text-align: center;
    }
    .tab1 .title .name{
        color: orangered;
    }
    .tab1 .content-tab1{
        margin: 15px 0;
        font-size: 17px;
    }
    /* TAB 2 */
    .tab2{
        display: flex;
       justify-content: center;
       align-items: center;
        flex-wrap: wrap;
        padding: 0 20px
    }
    .tab2 .tab2-right h4{
        color: orangered;
        padding: 10px 0;
    }
    .tab2 .tab2-right p.bao-dap{
        color: orangered;
        font-size: 16px;
        font-weight: bolder;
    }
    .tab2 .tab2-right p,
    .tab2 .tab2-right ul li{
        font-size: 17px;
    }
    .tab2 .tab2-right ul li{
        padding: 10px 0;
    }
    .tab2 .tab2-right p span{
        color: orangered
    }

    /* TAB 3 */
    .tab3{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }
    .tab3 h4{
        color: orangered;
    }
    .tab3 p{
        font-size: 17px;
    }

    /* TAB 4 */
    .tab4{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .tab4-left img{
        border-radius: 5%
    }
    .tab4-right{
        margin: 0 20px;
    }
    .tab4 h4{
        color: orangered;
    }
    .tab4 p{
        font-size: 16px;
    }
    @media(max-width:767px){
        .tab4{
        flex-wrap: wrap-reverse;
    }
    }
</style>
