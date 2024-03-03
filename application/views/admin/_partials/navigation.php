<!-- [ navigation menu ] start -->
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="data:image/png;base64, <?= base64_encode($this->session->userdata('picture')) ?>" alt="User-Profile-Image">
                    <div class="user-details">
                        <span><?= $this->session->userdata('name');?></span>
                        <div id="more-details"><?= $this->session->userdata('role');?><i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                        <li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
                        <li class="list-group-item"><a href="auth-normal-sign-in.html"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Dashboard</label>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" onclick="addTabDashboard()" class="active" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Wallboard</span></a>
                </li>
                <!-- <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Page layouts</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="layout-vertical.html" target="_blank">Vertical</a></li>
                        <li><a href="layout-horizontal.html" target="_blank">Horizontal</a></li>
                    </ul>
                </li> -->
                <li class="nav-item pcoded-menu-caption">
                    <label>Customer</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Data Customer</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="javascript:void(0)" onclick="addTabListCustomers()">Customer</a></li>
                        <li><a href="javascript:void(0)" onclick="addTabListContact()">Contact</a></li>
                        <li><a href="javascript:void(0)" onclick="addTabListGroupContact()">Group Contact</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" onclick="addTabBillCustomer()" class="nav-link "><span class="pcoded-micon"><i class="fa fa-file-invoice-dollar"></i></span><span class="pcoded-mtext">Bill Customer</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Communicator</label>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" onclick="addTabBillReminder()" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-tower-broadcast"></i></span><span class="pcoded-mtext">Broadcast Billing</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Report</label>
                </li>
                <li class="nav-item">
                    <a href="form_elements.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Customer</span></a>
                </li>
                <li class="nav-item">
                    <a href="tbl_bootstrap.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Bootstrap table</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Chart & Maps</label>
                </li>
                <li class="nav-item">
                    <a href="chart-apex.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Chart</span></a>
                </li>
                <li class="nav-item">
                    <a href="map-google.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Maps</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Pages</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Authentication</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="auth-signup.html" target="_blank">Sign up</a></li>
                        <li><a href="auth-signin.html" target="_blank">Sign in</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="sample-page.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Sample page</span></a></li>

            </ul>
            
            <!-- <div class="card text-center">
                <div class="card-block">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="feather icon-sunset f-40"></i>
                    <h6 class="mt-3">Upgrade To Pro</h6>
                    <p>Please contact us on our email for need any support</p>
                    <a href="https://1.envato.market/PgJNQ" target="_blank" class="btn btn-primary btn-sm text-white m-0">Upgrade</a>
                </div>
            </div> -->
            
        </div>
    </div>
<!-- [ navigation menu ] end -->