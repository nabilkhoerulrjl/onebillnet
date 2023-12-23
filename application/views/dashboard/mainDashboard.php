<div class="wrapper wrapper-content">
    <div class="row m-2 pt-2">
        <!-- Dashboard JS -->
            <?php $this->load->view("widgets/paidBills.php") ?>
        <!-- End of Dashboard JS -->
        <!-- Dashboard JS -->
            <?php $this->load->view("widgets/unpaidBills.php") ?>
        <!-- End of Dashboard JS --> 
        <!-- Dashboard JS -->
            <?php $this->load->view("widgets/activeCustomer.php") ?>
        <!-- End of Dashboard JS -->
        <!-- Dashboard JS -->
            <?php $this->load->view("widgets/totalCustomer.php") ?>
        <!-- End of Dashboard JS -->
    </div>
    <div class="row m-1">
        <div class="col-lg-6">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="ibox-tools d-flex justify-content-end">
                        <span class="label label-primary" style="cursor:context-menu">Updated <?= date($summaryData->DateUpdateTRThisMonth); ?></span>
                    </div>
                    <div class="text-value">
                        <h2 class="text-white">Rp <?= $summaryData->TNPThisMonth ?></h2>
                    </div>
                    <div>Total Net Profit</div>
                    <small class="text-white">Total Net Profit from Remaining Gross Profit in This Month</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <div class="ibox-tools d-flex justify-content-end">
                        <span class="label label-secondary" style="cursor:context-menu">Updated <?= date($summaryData->DateUpdateTRThisMonth); ?></span>
                    </div>
                    <div class="text-value">
                        <h2 class="text-white">Rp <?= $summaryData->TGPThisMonth ?></h2>
                    </div>
                    <div>Total Gross Profit</div>
                    <small class="text-white">Total Net Profit from income Paid Bills in This Month</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="ibox-tools d-flex justify-content-end">
                        <span class="label label-primary" style="cursor:context-menu">Updated <?= date($summaryData->DateUpdateTRThisMonth); ?></span>
                    </div>
                    <div class="text-value">
                        <h2 class="text-white">Rp <?= $summaryData->TRThisMonth ?></h2>
                    </div>
                    <div>Total Net Profit Last Three Month</div>
                    <small class="text-white">Total Net Profit from Remaining Gross Profit in Last Three Month</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card text-white bg-purple">
                <div class="card-body">
                    <div class="ibox-tools d-flex justify-content-end">
                        <span class="label label-primary" style="cursor:context-menu">Updated <?= date($summaryData->UpdateDateTRLast3Months); ?></span>
                    </div>
                    <div class="text-value">
                        <h2 class="text-white">Rp <?= $summaryData->TRLast3Months ?></h2>
                    </div>
                    <div>Total Gross Profit Last Three Month</div>
                    <small class="text-white">Total Net Profit from income Paid Bills in Last Three Month.</small>
                </div>
            </div>
        </div>
    </div>
</div>