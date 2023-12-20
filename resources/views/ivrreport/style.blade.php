<style>
    .nav-tabs .nav-item:first-child .nav-link {
        margin-left: 10px;
        /* Adjust the value to your desired space */
    }
#loadingModal {
    display: none;
}

.modal {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    pointer-events: none; /* Allow clicks to pass through */
}

.modal-content {
    text-align: center;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 20px;
    border-radius: 8px; /* Optional: Add rounded corners */
    max-width: 90px; /* Set the maximum width of the modal content */
    width: 90px; /* Ensure width is 100% for smaller screens */
    pointer-events: auto; /* Enable clicks within the modal content */
    box-shadow: 0 4px 8px rgba(50, 37, 37, 0.1); /* Optional: Add a box shadow */
    position: relative;
}

.loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
