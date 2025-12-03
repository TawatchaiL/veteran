<style>
    .nav-tabs .nav-item:first-child .nav-link {
        margin-left: 10px;
        /* Adjust the value to your desired space */
    }

    .modal-xxl {
        max-width: 1200px !important;
    }

    .modal-xxxl {
        max-width: 1400px !important;
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

    #waveform {
        border: 1px solid #cccaca;
        /* Add your desired border styles here */
    }

    #waveform ::part(wrapper) {
        --box-size: 20px;
        background-image:
            linear-gradient(transparent calc(var(--box-size) - 1px), rgb(219, 219, 220) var(--box-size), transparent var(--box-size)),
            linear-gradient(90deg, transparent calc(var(--box-size) - 1px), rgb(219, 219, 220) var(--box-size), transparent var(--box-size));
        background-size: 100% var(--box-size), var(--box-size) 100%;
    }

    #waveform ::part(cursor) {
        height: 220px;
        /* top: 28px; */
        border-radius: 4px;
        border: 1px solid #fff;
    }

    #waveform ::part(cursor):after {
        content: '🔶';
        font-size: 1.5em;
        position: absolute;
        left: 0;
        top: -20px;
        transform: translateX(-50%);
    }

    /* #waveform ::part(region) {
        background-color: rgba(0, 0, 100, 0.25) !important;
    }

    #waveform ::part(region-green) {
        background-color: rgba(0, 100, 0, 0.25) !important;
        font-size: 12px;
        text-shadow: 0 0 2px #fff;
    }

    #waveform ::part(marker) {
        background-color: rgba(0, 0, 100, 0.25) !important;
        border: 1px solid #fff;
        padding: 1px;
        text-indent: 10px;
        font-family: fantasy;
        text-decoration: underline;
    }

    #waveform ::part(region-handle-right) {
        border-right-width: 4px !important;
        border-right-color: #fff000 !important;
    } */

    #waveform-time-indicator {
        text-align: center;
        margin-top: 10px;
    }

    #waveform-time-indicator .time {
        /* background: #f5f5f5; */
        padding: 5px;
    }
</style>
