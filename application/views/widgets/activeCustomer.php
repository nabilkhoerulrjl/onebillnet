<style>
    .display-flex {
        display: flex;
    }
</style>
<div class="col-lg-3">
    <div class="widget style1 navy-bg">
        <div class="row display-flex">
            <div class="col-4">
                <i class="fa fa-user fa-5x"></i>
            </div>
            <div class="col-8 text-right">
                <span> Active Customers </span>
                <h2 class="font-bold"><?= $summaryData->TACustomers ?></h2>
            </div>
        </div>
    </div>
</div>