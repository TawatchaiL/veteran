<style>
    .nav-tabs .nav-item:first-child .nav-link {
        margin-left: 10px;
        /* Adjust the value to your desired space */
    }

    .card {
        background-color: white;
        border-radius: 6px;
        /* box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); */
    }

    .modal-xxl-toolbar {
        max-width: 1200px !important;
    }

    *.text-toolbar {
        color: #007bff;;
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
        background-color: #333;
        color: white;
        border-radius: 0.2em;
    }

    .custom-button {
        width: 175px;
        height: 60px;
        font-size: 1.2em;
    }
</style>
