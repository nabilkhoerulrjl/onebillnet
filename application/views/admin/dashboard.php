<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view("admin/_partials/head.php") ?>
    </head>
    <style>
        .no-padding {
            padding: none;
        }
    </style>
    <body>
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <!-- Sidebar -->
                    <?php $this->load->view("admin/_partials/sidebar.php") ?>
                <!-- End of Sidebar -->
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <!-- Topbar -->
                        <?php $this->load->view("admin/_partials/topbar.php") ?>
                    <!-- End of Topbar -->
                </div>
                <div class="row border-bottom">
                    
                    <div class="col-lg-12 no-padding">
                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <div class="tabs-container">
                                    <ul id="pageTab" class="nav nav-tabs pl-2" role="tablist">
                                        
                                    </ul>
                                    <div id="pageTabContent" class="tab-content">
                                        <!--
                                        <div role="tabpanel" id="tab-1" class="tab-pane active">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="widget style1 navy-bg">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <i class="fa fa-microchip fa-5x"></i>
                                                                </div>
                                                                <div class="col-8 text-right">
                                                                    <span> Temp CPU </span>
                                                                    <h2 class="font-bold">26'C</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="widget style1 lazur-bg">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <i class="fa fa-server fa-5x"></i>
                                                                </div>
                                                                <div class="col-8 text-right">
                                                                    <span> CPU Usage </span>
                                                                    <h2 class="font-bold">260%</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="widget style1 yellow-bg">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <i class="fa fa-signal fa-5x"></i>
                                                                </div>
                                                                <div class="col-8 text-right">
                                                                    <span> Total Traffic </span>
                                                                    <i class="fa fa-sort-up"></i>
                                                                    <h2 class="font-bold">12</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="widget style1 yellow-bg">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <i class="fa fa-users fa-5x"></i>
                                                                </div>
                                                                <div class="col-8 text-right">
                                                                    <span> Total Customer </span>
                                                                    <h2 class="font-bold">12</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" id="tab-2" class="tab-pane">
                                            <div class="panel-body">
                                                <strong>Donec quam felis</strong>

                                                <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                                    and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                                <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                                    sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                            </div>
                                        </div>
                                        -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	
                <?php 
                /*
                    if ($this->uri->segment('1') == 'welcome') :
                        $this->load->view("menu/mainDashboard.php");
                    endif;
                */
                ?>
                <!-- Footer -->
                    <?php $this->load->view("admin/_partials/footer.php") ?>
                <!-- End of Footer -->
            </div>

            <div id="right-sidebar">
                <div class="sidebar-container">
                    
                </div>
            </div>
        </div>
        <!-- Dashboard JS -->
            <?php $this->load->view("admin/_partials/dashboardjs.php") ?>
        <!-- End of Dashboard JS -->
        <!-- MenuTab JS -->
            <?php $this->load->view("menu/menuJs.php") ?>
        <!-- End of MenuTab JS -->
        <script>
            $(document).ready(function() {
                openTabGeneral('main_dashboard','Dashboard', 'fa-gauge-high', 'dashboard/mainDash_Controller/index', 'Get' );

                var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
                var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];
                var data1 = [
                    { label: "Data 1", data: d1, color: '#17a084'},
                    { label: "Data 2", data: d2, color: '#127e68' }
                ];
                $.plot($("#flot-chart1"), data1, {
                    xaxis: {
                        tickDecimals: 0
                    },
                    series: {
                        lines: {
                            show: true,
                            fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 1
                                }, {
                                    opacity: 1
                                }]
                            },
                        },
                        points: {
                            width: 0.1,
                            show: false
                        },
                    },
                    grid: {
                        show: false,
                        borderWidth: 0
                    },
                    legend: {
                        show: false,
                    }
                });
                var lineData = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            label: "Example dataset",
                            backgroundColor: "rgba(26,179,148,0.5)",
                            borderColor: "rgba(26,179,148,0.7)",
                            pointBackgroundColor: "rgba(26,179,148,1)",
                            pointBorderColor: "#fff",
                            data: [48, 48, 60, 39, 56, 37, 30]
                        },
                        {
                            label: "Example dataset",
                            backgroundColor: "rgba(220,220,220,0.5)",
                            borderColor: "rgba(220,220,220,1)",
                            pointBackgroundColor: "rgba(220,220,220,1)",
                            pointBorderColor: "#fff",
                            data: [65, 59, 40, 51, 36, 25, 40]
                        }
                    ]
                };
                var lineOptions = {
                    responsive: true
                };
                var ctx = document.getElementById("lineChart").getContext("2d");
                new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
            });
        </script>
    </body>
</html>
