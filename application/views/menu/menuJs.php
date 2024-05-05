<style>
  /* CSS untuk warna teks pada tab yang aktif dan tidak aktif */
.nav-tabs a.active-tab {
    color: #1abc9c !important;
}

.nav-tabs a {
    color: #495057 !important;
}
</style>

<script>
  function addTabDashboard() {
    openTabGeneral('main_dashboard','Main Dashboard', 'fa-gauge', 'dashboard/MainDash_Controller/index', 'Get' );
  }

  function addTabWinboxDashboard() {
    openTabGeneral('winbox_dashboard','Winbox Dashboard', 'fa-gauge', 'dashboard/WinboxDash_Controller/index', 'Get' );
  }

  function addTabListCustomers() {
    openTabGeneral('list_customer','List Customers', 'fa-users', 'CustomerController/index', 'Get' );
  }

  function addTabSetting() {
    openTabGeneral('setting','Setting', 'fa-cog', 'welcome', 'Get' );
  }

  function addTabCompanyProfile() {
    openTabGeneral('company_profile','Company Profile', 'fa-building', 'setting/Company_Controller/Index', 'Get' );
  }

  function addTabBillReminder() {
    openTabGeneral('bill_reminder','Bill Reminder', 'fa-message', 'broadcast/BillReminder_Controller/Index', 'Get' );
  }

  function addTabBillCustomer() {
    openTabGeneral('bill_customer','Bill Customer', 'fa-file-invoice-dollar', 'CustomerController/billCustomer', 'Get' );
  }

  function addTabListContact() {
    openTabGeneral('contact','Contact', 'fa-address-book', 'ContactController/viewContact', 'Get' );
  }

  function addTabListContactGroup() {
    openTabGeneral('Contact_and_Group','Contact & Group', 'fa-address-book', 'customer/ContactGroupController/index', 'Get' );
  }

  function addTabAddBill() {
    openTabGeneral('add_bill_customer','Add Bill Customer', 'fa-file-circle-plus', 'CustomerController/addBillCustomer', 'Get' );
  }
  
  function addTabDeliveryHistory() {
    openTabGeneral('delivery_history','Delivery History', 'fa-history', 'broadcast/DeliveryHistory_Controller/index', 'Get' );
  }

  function openTabGeneral(NameID,TittleText, Icon,UrlTarget, MethodAction, form_data){
      //showHideMenu();
      var tabName = 'Tab Name Prototipe';//$(".nav-menu-custom > li.on > a").text();
      var tabIcon = Icon;
      breadcumbsValue(tabName,TittleText);
      //var countTab = $("li[id*='tab-open']").length;
      //var maxTab = '{{maxTab}}'

      /*
      if(countTab > maxTab-1){
      max_tab_toast_show();
      return false
      
      }
  */
      if (UrlTarget.charAt(0) !== '/') UrlTarget = '<?= base_url(); ?>'+UrlTarget;

      if (typeof(form_data) == 'undefined') form_data = null;

      if (!($('#'+NameID).length)){
      $('#pageTab').append('<li><a class="nav-link text-uppercase" data-toggle="tab" href="#'+NameID+'" tabname="'+tabName+'" TittleText="'+TittleText+'"><i class="fa '+tabIcon+'"></i> '+TittleText+' &nbsp;&nbsp;<button class="close" type="button" onClick="removeTab()" style="position: relative;font-size: 17px;top: 1px;bottom: 5px;left: 0.5em;"><i class="fa fa-times fa-xs"></i></button></a></li>');
      $('#pageTabContent').append('<div class=\"tab-pane\" id=\"'+NameID+'\"></div>');
      $('#'+NameID+'').append('<div class=\"loadingTab'+NameID+'\" style=\"z-index:1011;position:absolute;padding:10px;margin:0px;width:15%;top:317px;left:43%;text-align:center;color:#555555;border:0px;background-color:#ddd; cursor: wait; font-weight: 600;display:none;\"</h3><i class="fa fa-refresh fa-spin"></i> Loading...</h3></div>');

      $.ajax({
          url: UrlTarget,
          type: MethodAction,
          dataType: "html",
          data	: form_data,
          cache: false,
          beforeSend: function() {
                  //blockUI('#pageTabContent');
                  $('div .loadingTab'+NameID+'').show();
              },
          success: function(data) {
          securityCheck(data);
          $('#'+NameID).append(data);
          //$('.blockUI').hide();
          $('div .loadingTab'+NameID+'').remove();
          },
          error: function (xhr, ajaxOptions, thrownError) {
          //alert(xhr.status);
          //alert(thrownError);
          }
      })
      $('.nav-tabs a[href="#'+NameID+'"]').tab('show');
      }
      else
      {
      $('.nav-tabs a[href="#'+NameID+'"]').tab('show');
      }
      //openTabGeneral('itemtab2','Dashboard','ManualTicket', 'Get' );
  }

  // Menambahkan CSS untuk warna teks pada tab yang aktif dan tidak aktif
$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $('a[data-toggle="tab"]').removeClass('active-tab');
    $(e.target).addClass('active-tab');
});

// Menambahkan CSS untuk warna teks pada tab yang aktif dan tidak aktif
$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $('a[data-toggle="tab"]').removeClass('active-tab');
    $(e.target).addClass('active-tab');
});

  function breadcumbsValue(tabName,TittleText){
    tabName = $.trim(tabName);
    TittleText = $.trim(TittleText);

    if(typeof(tabName) == 'undefined'){
    tabName = "<i>(undefined)</i>";
    }
    if(tabName.length == 1){
    tabName = "Menu";
    }
    if(tabName.length == 0){
    tabName = "<i>(undefined)</i>";
    }
    if( (typeof(TittleText) == 'undefined') || (TittleText.length <= 1) ){
    TittleText = "<i>(undefined)</i>";
    }

    $(".breadcrumb-item").html(tabName);
    $(".breadcrumb-item.active").html(TittleText);
    console.log(tabName +" "+TittleText);
  }

  function securityCheck( htmldata)
  {
    var tes = htmldata.substring(0, 6);
    if(tes=='logout')
    {
      window.location='{{ url() }}Login/';
      //alert('kenadeh')
    }
  }

  function removeTab(){
    $('#pageTab').on('click', ' li a .close', function() {
      var tabId = $(this).parents('li').children('a').attr('href');
      $(this).parents('li').remove('li');
      $(tabId).remove();
      $('.nav-tabs a[href="#itemtab"]').tab('show');
      $("#pageTab li:last-child a").trigger('click');

      var countTab = $("#pageTab li:last-child a").length;
      if(countTab == 0) {
        breadcumbsValue();
      }
    });
  }
</script>