$(document).ready(function() {
    function print_toast() {
        // Lấy URL hiện tại
        let url = new URL(window.location.href);
        let params = new URLSearchParams(url.search);
        let message = params.get('message');
        let status = params.get('status');
        if(message && status) {
            switch(parseInt(status)) {
                case 200:
                    toastSuccess(message);
                break;
                case 300:
                    toastInfo(message)
                break;
                default:
                    toastError(message)
                break;
            }
        }
    }
    print_toast();
})