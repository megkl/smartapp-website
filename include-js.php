
        <script src="assets/js/jquery.min.js"></script> 
        <script src="assets/js/bootstrap.js"></script>  
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <script src="assets/js/sweetalert.min.js" ></script>
        <script src="assets/js/jquery.redirect.js"></script> 
        <script src="assets/js/jquery.blockUI.min.js" ></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/smooth-scroll.min.js"></script>
        <script src="assets/js/progressbar.js"></script> 
        <script src="assets/js/webquiz.js?ts=<?= time() ?>"></script>

        <script type="text/javascript">
            var ios_app = localStorage.getItem("ios_app");
            var android_app = localStorage.getItem("android_app");
            $("#ios_url").attr("href", ios_app);
            $("#android_url").attr("href", android_app);
            function copyText() {
                var str = document.getElementById("url-text");
                str.removeAttribute("style");
                str.focus();
                str.select();
                document.execCommand('copy');
                str.setAttribute("style", "display:none");
                ;

            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                //Disable full page
                $("body").on("contextmenu", function (e) {
                    return false;
                });
            });
            $(document).keydown(function (e) {
                if (e.keyCode == 123) {
                    return false;
                }
                if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                    return false;
                }
                if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                    return false;
                }
                if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                    return false;
                }
                if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                    return false;
                }
            });
            $(document).ready(function () {
                //Disable cut copy paste
                $('body').bind('selectstart', function (e) {
                    e.preventDefault();
                });
            });
        </script>
