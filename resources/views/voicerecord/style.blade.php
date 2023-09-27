<style>
    .nav-tabs .nav-item:first-child .nav-link {
        margin-left: 10px;
        /* Adjust the value to your desired space */
    }

    .modal-xxl {
        max-width: 1200px !important;
    }

    .select2-container.select2-container-disabled .select2-choice {
        background-color: #ddd;
        border-color: #a8a8a8;
    }

    .dataTables_filter {
        display: none;
    }

    .overlay {
        position: fixed;
        display: none;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent black background */
        justify-content: center;
        align-items: center;
        z-index: 9999;
        /* Set a high z-index to make sure it's on top of everything */
    }

    .region-tooltip {
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 8px;
        border-radius: 12px;
        z-index: 9999;
        display: inline-block;
        /* Display inline to fit content */
        max-width: 200px;
        /* Adjust the maximum width as needed */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .region:hover .region-tooltip {
        opacity: 1;
        transform: translateY(0);
    }
</style>
