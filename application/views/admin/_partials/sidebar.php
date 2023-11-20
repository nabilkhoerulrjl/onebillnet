<div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element">
                <img alt="image" class="rounded-circle" src="data:image/jpeg;base64,<?php echo base64_encode($this->session->userdata("picture")); ?>" width="60"/>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="block m-t-xs font-bold"><?php echo $this->session->userdata("name"); ?></span>
                    <span class="text-muted text-xs block"><?php echo $this->session->userdata("role"); ?> <b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                    <!-- <li><a class="dropdown-item" href="contacts.html">Contacts</a></li> -->
                    <!-- <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li> -->
                    <!-- <li class="dropdown-divider"></li> -->
                    <!-- <li><a class="dropdown-item" href="login.html">Logout</a></li> -->
                </ul>
            </div>
            <div class="logo-element">
            <img alt="image" class="rounded-circle" src="data:image/jpeg;base64,<?php echo base64_encode($this->session->userdata("picture")); ?>" width="40"/>
            </div>
        </li>
        <li class="active">
            <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li onclick="addTabDashboard()" class="active"><a href="javascript:void(0)">Summary</a></li>
                <!-- <li onclick="addTabWinboxDashboard()" class=""><a href="javascript:void(0)">Winbox Dashboard</a></li> -->
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-clipboard"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li onclick="addTabReportBill()"><a href="javascript:void(0)">Customer Status Report</a></li>
                <li onclick="addTabReportBill()"><a href="javascript:void(0)">Billing Report</a></li>
                <li onclick="addTabReportPayment()"><a href="javascript:void(0)">Financial Report</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Broadcast Customer</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li onclick="addTabBillReminder()"><a href="javascript:void(0)">Bill Reminder</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Customer</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li onclick="addTabListCustomers()"><a href="javascript:void(0)">List Customers</a></li>
                <li onclick="addTabListCustomers()"><a href="javascript:void(0)">Add Customer</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Setting </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li>
                    <a href="#">Setup Registrations <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li onclick="addTabCompanyProfile()">
                            <a href="javascript:void(0)">Company Profile</a>
                        </li>
                        <!-- <li onclick="addTabRouterBoard()">
                            <a href="javascript:void(0)">Router Board</a>
                        </li> -->
                        <li onclick="addTabConfigChannel()">
                            <a href="javascript:void(0)">Channel</a>
                        </li>
                        <!-- <li onclick="addTabConfigUserTeam()">
                            <a href="javascript:void(0)">User & Team</a>
                        </li> -->
                    </ul>
                </li>
                <li>
                    <a href="#">Parameter <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li onclick="addTabCompanyProfile()">
                            <a href="javascript:void(0)">Configuration</a>
                        </li>
                        <!-- <li onclick="addTabGraphInternal()">
                            <a href="javascript:void(0)">Graphical Interface</a>
                        </li> -->
                        <li onclick="addTabTemplateRespone()">
                            <a href="javascript:void(0)">Template Broadcast</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>