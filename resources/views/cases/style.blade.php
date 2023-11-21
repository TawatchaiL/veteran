<style>
    .disabled-select {
        background-color: #d5d5d5;
        opacity: 0.5;
        border-radius: 3px;
        cursor: not-allowed;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
    }

    select[readonly].select2-hidden-accessible+.select2-container {
        pointer-events: none;
        touch-action: none;
    }

    select[readonly].select2-hidden-accessible+.select2-container .select2-selection {
        background: #eee;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible+.select2-container .select2-selection__arrow,
    select[readonly].select2-hidden-accessible+.select2-container .select2-selection__clear {
        display: none;
    }

    .modal-xxl {
        max-width: 1500px !important;
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
        margin-top: 30px;
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
