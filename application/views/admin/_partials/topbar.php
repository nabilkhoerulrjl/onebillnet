  <!-- Include jQuery -->
  <script src="<?= base_url()?>public/js/jquery-2.1.1.js"></script>

<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        <form role="search" class="navbar-form-custom" action="search_results.html">
            <div class="form-group">
                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
            </div>
        </form>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li>
            <span class="m-r-sm text-muted welcome-message">Welcome to OnebillNet</span>
        </li>
        <li>
            <a href="#" id="logoutBtn">
                <i class="fa fa-sign-out"></i> Log out
            </a>
        </li>
        <!-- <li>
            <a class="right-sidebar-toggle">
                <i class="fa fa-tasks"></i>
            </a>
        </li> -->
    </ul>
</nav>

<!-- Logout Modal-->
<?php $this->load->view("admin/_partials/logoutModal.php") ?>

<!-- End of Topbar -->
<script>
    $("#logoutBtn").on("click", function () {
        // Show the logout modal
        $("#logoutModal").modal("show");
    });
    function addTabSettings() {
        var agent_ts = '{{agent_ts}}';

        $.ajax({
            url: "<?= base_url()?>Menu_Controller/Settings",
            dataType: "html",
            type: "post",
            success: function(result){
                //securityCheck(result);
                $("#accordionSidebar").html(result);
                console.log(result);

        }});
    }
</script>