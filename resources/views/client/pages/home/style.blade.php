<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<link rel="stylesheet" href="{{ asset('client/assets/css/responsive/home.css') }}">

<style>
    /* the slides */
    .slick-slide {
        cursor: pointer;
        margin: 0 8px;
    }

    /* the parent */
    .slick-list {
        margin: 0 -8px;
    }

    .slick-dots {
        display: flex;
        justify-content: center;
        margin: 0;
        padding: 1rem 0;
        list-style-type: none;
    }

    .slick-dots li {
        margin: 0 0.25rem;
    }

    .slick-dots button {
        display: block;
        width: 1rem;
        height: 1rem;
        padding: 0;
        border: none;
        border-radius: 100%;
        background-color: rgb(151, 150, 150);
        text-indent: -9999px;
    }

    .slick-dots li.slick-active button {
        background-color: #EF5222;
    }

    .slick-arrow-right, .slick-arrow-left {
        position: absolute;
        top: 35%;
        width: fit-content;
        z-index: 999;
        cursor: pointer;
    }
    .slick-arrow-left {
        left: -65px;
    }
    .slick-arrow-right {
        right: -50px;
    }

</style>
