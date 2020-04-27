<!-- jquery
        ============================================ -->
    <script src="admin/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src="admin/js/bootstrap.min.js"></script>
    <!-- wow JS
        ============================================ -->
    <script src="admin/js/wow.min.js"></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src="admin/js/jquery.meanmenu.js"></script>
    <!-- sticky JS
        ============================================ -->
    <script src="admin/js/jquery.sticky.js"></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src="admin/js/jquery.scrollUp.min.js"></script>
    <!-- include a js alertify-->
    <script src="admin/js/alertifyjs/alertify.min.js"></script> 
    <!-- include a js sweetalert-->
    <script src="admin/js/sweetalert/sweetalert.min.js"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
    <script src="admin/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="admin/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
        ============================================ -->
    <script src="admin/js/metisMenu/metisMenu.min.js"></script>
    <script src="admin/js/metisMenu/metisMenu-active.js"></script>
    <!-- notification JS
        ============================================ -->
    <script src="js/notifications/Lobibox.js"></script>

    <script src="js/alljs.js"></script>

    
    <script>
        (function($) {
            "use strict";

            /*----------------------------
             jQuery MeanMenu
            ------------------------------ */
            jQuery('nav#dropdown').meanmenu();
            /*----------------------------
             jQuery myTab
            ------------------------------ */
            $('#myTab a').on('click', function(e) {
                e.preventDefault()
                $(this).tab('show')
            });
            $('#myTab3 a').on('click', function(e) {
                e.preventDefault()
                $(this).tab('show')
            });
            $('#myTab4 a').on('click', function(e) {
                e.preventDefault()
                $(this).tab('show')
            });
            $('#myTabedu1 a').on('click', function(e) {
                e.preventDefault()
                $(this).tab('show')
            });
            

            $('#single-product-tab a').on('click', function(e) {
                e.preventDefault()
                $(this).tab('show')
            });

            $('[data-toggle="tooltip"]').tooltip();

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
            // Collapse ibox function
            $('#sidebar ul li').on('click', function() {
                var button = $(this).find('i.fa.indicator-mn');
                button.toggleClass('fa-plus').toggleClass('fa-minus');

            });
            /*-----------------------------
                Menu Stick
            ---------------------------------*/
            $(".sicker-menu").sticky({
                topSpacing: 0
            });

            $('#sidebarCollapse').on('click', function() {
                $("body").toggleClass("mini-navbar");
                // SmoothlyMenu();
            });
            $(document).on('click', '.header-right-menu .dropdown-menu', function(e) {
                e.stopPropagation();
            });
            /*----------------------------
             wow js active
            ------------------------------ */
            new WOW().init();
            /*--------------------------
             scrollUp
            ---------------------------- */
            $.scrollUp({
                scrollText: '<i class="fa fa-angle-up"></i>',
                easingType: 'linear',
                scrollSpeed: 900,
                animation: 'fade'
            });

        })(jQuery);
    </script>