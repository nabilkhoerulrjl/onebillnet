<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view("admin/_partials/head.php") ?>
    </head>
    <body>
        <?php $this->load->view("admin/_partials/preLoader.php") ?>
        <!-- [ navigation menu ] start -->
        <!-- theme-horizontal menu-light -->
        <nav class="pcoded-navbar  ">
            <?php $this->load->view("admin/_partials/navigation.php") ?>
        </nav>
	    <!-- [ navigation menu ] end -->
        <!-- [ Header ] start -->
	    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
            <?php $this->load->view("admin/_partials/header.php") ?>
        </header>
	    <!-- [ Header ] end -->
        <!-- [ Main Content ] start -->
        <div class="pcoded-main-container" style="overflow:hidden;">
            <div class="pcoded-content p-0">
                <!-- [ breadcrumb ] start -->
                <!-- <div class="page-header"> <?php $this->load->view("admin/_partials/breadcrumb.php") ?> -->
                <!-- [ breadcrumb ] End -->
                </div> 
                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                <div class="card-body p-0 pt-4 pl-0 pr-0 pb-0 bg-white">
                    <ul class="nav nav-tabs ml-2" id="pageTab" role="tablist">
                        <!-- <li class="nav-item">
                            <a class="nav-link text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                        </li> -->
                    </ul>
                </div>
                <div class="card-body p-1">
                    <div class="tab-content" id="pageTabContent">
                        <!-- <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <p class="mb-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.
                                Reprehenderit
                                butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher
                                voluptate nisi qui.
                            </p>
                        </div>
                        <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <p class="mb-0">Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four
                                loko
                                farm-to-table
                                craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. accusamus tattooed echo park.</p>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <p class="mb-0">Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed
                                craft beer,
                                iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Lnyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                        </div> -->
                    </div>
                </div>
                <!-- </div> -->
                <!-- [ Main Content ] end -->
            </div>
            <!-- [ footer ] start -->
            <!-- <div class="page-header">
                <?php //$this->load->view("admin/_partials/footer.php") ?>
            </div> -->
            <!-- [ footer ] End -->
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
