<style>
    .nav-tabs .nav-item:first-child .nav-link {
        margin-left: 10px;
        /* Adjust the value to your desired space */
    }

    .popup-tab-font-size {
        font-size: 18px;
    }

    /*   li.rightside {
        float: right;
        line-height: 34px;
    } */

    .card {
        background-color: white;
        border-radius: 6px;
        /* box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); */
    }

    .modal-xxl-toolbar {
        max-width: 1200px !important;
    }


    #queue_wait {
        opacity: 1;
        transition: opacity 0.5s;
    }

    .hide_text {
        opacity: 0.5 !important;
        background-color: #eef3cd;
        border-radius: 10px;
    }

    .toast-top-center {
        top: 12px;
        margin: 0 auto;
        left: 50%;
    }

    *.text-toolbar {
        color: #007bff;
        ;
        font-size: 1.2em;
        text-align: center;
        vertical-align: middle;

    }

    *.icon-gray {
        color: #6c757d;
        font-size: 1.5em;
        text-align: center;
        vertical-align: middle;
    }

    *.icon-black {
        color: #000000;
        font-size: 1.5em;
        text-align: center;
        vertical-align: middle;
    }

    *.icon-green {
        color: #28a745;
        font-size: 1.5em;
        text-align: center;
        vertical-align: middle;
    }

    *.icon-blue {
        color: #2533f5;
        font-size: 1.5em;
        text-align: center;
        vertical-align: middle;

    }

    *.icon-yellow {
        color: #ffc107;
        font-size: 1.5em;
        text-align: center;
        vertical-align: middle;

    }

    *.icon-red {
        color: rgb(193, 32, 11);
        font-size: 1.5em;
        text-align: center;
        vertical-align: middle;

    }

    .sidebar-item {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 12px;
        max-width: 160px
            /* Adjust as needed */
    }


    .custom-tooltip .tooltip.show {
        opacity: 0.7;
    }

    /* body {
            font-family: 'Sarabun', serif;
                    font-size: 20px;
        } */
    .btn-orange,
    .btn-orange:hover,
    .btn-orange:active,
    .btn-orange:visited {
        background-color: #ff8000;
        color: #ffffff;
    }

    .btn-yellow,
    .btn-yellow:hover,
    .btn-yellow:active,
    .btn-yellow:visited {
        background-color: #c7c42c;
        color: #ffffff;
    }

    body {
        font-family: 'Sarabun', 'Roboto';
        font-size: 16px !important;
    }

    .main-header.navbar {
        box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.1);
        /* Adjust shadow values as needed */
    }

    .center-content {
        text-align: center;
    }

    /* sidebar-bg */
    .main-sidebar {
        background-color: rgb(162, 223, 144) !important
    }

    .control-sidebar-light {
        background-color: rgb(252, 253, 251) !important
    }


    /* .card-container {
            display: flex;
            flex-direction: row-reverse;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }

        */
    .card-content {
        padding: 15px;
        /* Set the maximum height for the card's content */
        max-height: calc(100% - 40px);
        /* Subtract the height of the footer */
        overflow-y: auto;
        /* Enable vertical scrolling when content overflows */
    }

    .custom-bottom-right-card {
        /* position: fixed;
        bottom: 20px;
        right: 20px; */
        z-index: 1040;
    }



    /* .card {
            margin-left: 10px;
            position: fixed;
            bottom: 20px;
        } */

    .scroll-to-top {
        position: fixed;
        right: 1rem;
        bottom: 1rem;
        display: none;
        width: 2.75rem;
        height: 2.75rem;
        text-align: center;
        color: #fff;
        background: rgba(90, 92, 105, .5);
        line-height: 46px
    }

    .scroll-to-top:focus,
    .scroll-to-top:hover {
        color: #fff
    }

    .scroll-to-top:hover {
        background: #5a5c69
    }

    .scroll-to-top i {
        font-weight: 800
    }

    .digital-clock {
        /* font-family: Arial, sans-serif; */
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .digit {
        padding: 0.2em;
        background-color: rgba(253, 252, 252, 0.681);
        color: rgb(15, 14, 14);
        border-radius: 0.2em;
        font-size: 2rem;
    }

    .custom-button {
        width: 150px;
        height: 50px;
        font-size: 1.0em;
    }


    .rowbutton {
        margin: 0 auto;
        width: 300px;
        clear: both;
        text-align: center;
        font-family: 'Exo';
    }

    .digit,
    .dig {
        float: left;
        padding: 10px 30px;
        width: 90px;
        cursor: pointer;
        border: 2px solid #d3d3d3;
        /* Set the border color */
        border-radius: 4px;
    }

    .sub {
        font-size: 0.5rem;
        color: grey;
    }

    .containerbutton {
        background-color: white;
        width: 300px;
        padding: 15px;
        margin: 8px auto;
        height: 350px;
        text-align: center;

    }

    #dialpadcall {
        display: inline-block;
        background-color: #66bb6a;
        padding: 4px 30px;
        margin: 10px;
        color: white;
        border-radius: 4px;
        float: left;
        cursor: pointer;
        font-size: 1rem;
    }

    .botrow {
        margin: 0 auto;
        width: 320px;
        clear: both;
        text-align: center;
        font-family: 'Exo';
    }

    .digit:active,
    .dig:active {
        background-color: #e6e6e6;
    }

    #dialpadcall:hover {
        background-color: #81c784;
    }

    .dig {
        float: left;
        padding: 10px 30px;
        margin: 10px;
        width: 70px;
        cursor: pointer;
        font-size: 0.8rem;
    }

    .popover {
        max-width: 100%;
    }

    aside.sidebar .single {
        padding: 30px 15px;
        margin-top: 40px;
        background: #fcfcfc;
        border: 1px solid #f0f0f0;
    }

    aside.sidebar .single h3.side-title {
        margin: 0;
        margin-bottom: 10px;
        padding: 0;
        font-size: 20px;
        color: #333;
        text-transform: uppercase;
    }

    aside.sidebar .single h3.side-title:after {
        content: '';
        width: 60px;
        height: 1px;
        background: #00b0ff;
        display: block;
        margin-top: 6px;
    }

    .single.contact-info {
        background: none;
        border: none;
    }

    .single.contact-info li {
        margin-top: 10px;
    }

    .single.contact-info li .icon {
        display: block;
        float: left;
        margin-right: 10px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 1px solid #f0f0f0;
        color: #00b0ff;
        text-align: center;
        line-height: 50px;
    }

    .single.contact-info li .info {
        overflow: hidden;
    }
</style>
