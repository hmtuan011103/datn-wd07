    <!-- Sweet Alert css-->
    <link href="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/hummingbird-treeview.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/hummingbird-treeview.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        /* .rolemodal {
            display: none;
        } */

        /* CSS cho modal */
        .rolemodal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 30%;
            top: 20%;
            width: 50%;
            height: 50%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.342);
        }

        .rolemodal {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f2f1f1;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            max-width: 500px;
        }

        .rolemodal h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .rolemodal p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .rolemodal span {
            display: block;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .rolemodal span span {
            font-weight: bold;
        }

        .rolemodal button.close {
            background-color: #ccc;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .rolemodal button.close:hover {
            background-color: #999;
        }
    </style>
