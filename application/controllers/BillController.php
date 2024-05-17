<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// use Xendit\Invoice\Invoice;
class BillController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Bill_Model');
    }

    public function index() {
        // Contoh mendapatkan semua data tagihan
        $data['bills'] = $this->Bill_Model->getAllBills();
        $this->load->view('bill/index', $data);
    }

    public function view($billId) {
        // Contoh mendapatkan data tagihan berdasarkan ID
        $data['bill'] = $this->Bill_Model->getBillById($billId);
        $this->load->view('bill/view', $data);
    }

    public function createBill() {
        // Contoh membuat tagihan baru
        // $billData = array(
        //     'CustomerId' => 1,
        //     'SiteId' => 2,
        //     'Amount' => 100.00,
        //     'DueDate' => '2023-12-31',
        //     'StatusId' => 'Unpaid',
        //     'PaymentDate' => null,
        //     'Creator' => 'John Doe',
        //     'CreateDate' => date('Y-m-d H:i:s'),
        //     'Modifier' => 'John Doe',
        //     'ModifyDate' => date('Y-m-d H:i:s')
        // );

        $newBillId = $this->Bill_Model->createBill($billData);

        // Lakukan sesuatu setelah membuat tagihan, seperti redirect atau menampilkan pesan sukses
    }

    public function update($billId) {
        // Contoh mengupdate data tagihan
        $updatedData = array(
            'Amount' => 150.00,
            'DueDate' => '2024-01-15',
            'Modifier' => 'Jane Doe',
            'ModifyDate' => date('Y-m-d H:i:s')
        );

        $this->Bill_Model->updateBill($billId, $updatedData);

        // Lakukan sesuatu setelah mengupdate tagihan, seperti redirect atau menampilkan pesan sukses
    }

    public function delete($billId) {
        // Contoh menghapus data tagihan
        $this->Bill_Model->deleteBill($billId);

        // Lakukan sesuatu setelah menghapus tagihan, seperti redirect atau menampilkan pesan sukses
    }

    public function getInvoicePdf($referenceId){
        $siteId = $this->getSiteId();
        // echo $siteId;

        $select = 'b.Id, c.FirstName, c.LastName, c.Email as CsEmail, c.Whatsapp as CsPhone, 
        c.Address as CsAddress, b.InvoiceId, b.Amount, b.Periode, b.DueDate, b.CreateDate as InvDate, 
        b.Product, b.Description, b.PaymentLink, s.Name as ComName, s.Phone as ComPhone, 
        s.Email as ComEmail, s.Address as ComAddress';
        $join1   = ['Customer  AS c', 'b.CustomerId = c.Id', 'LEFT'];
        $join2   = ['Site as s', 'b.SiteId = s.Id', 'LEFT'];
        $arrJoin = array(
            'join1' => $join1,
            'join2' => $join2
        );
        $arrWhere = array(
            'SiteId' => $siteId,
            'ReferenceId' => $referenceId
        );
        $data['dataInvoice'] = $this->Bill_Model->getInvoice($select, $arrJoin, $arrWhere);
        if(!empty($data['dataInvoice'])){
            $data['iconVendor'] = $this->getIconVendorHeaderInvoice($siteId);
            $data['iconCompany'] = $this->getIconHeaderInvoice($siteId);
        }
        // return $data;
        $this->load->view('invoicepdf/index', $data);
    }

    public function getPrefixInv()
    {
        $siteId = $this->getSiteId();
        $code = 'PrefixInvoice';
        $this->load->model('Setting_Model');
        // Panggil fungsi model untuk mendapatkan pengaturan berdasarkan siteid dan code
        $setting = $this->Setting_Model->getConfigSetting($siteId, $code);
        
        return $setting["Value"];
    }

    public function IconHeaderNav()
    {
        $siteId = $this->getSiteId();
        $code = 'IconHeaderNav';
        $this->load->model('Setting_Model');
        // Panggil fungsi model untuk mendapatkan pengaturan berdasarkan siteid dan code
        $setting = $this->Setting_Model->getConfigSetting($siteId, $code);
        
        return $setting["Value"];
    }

    public function getIconVendorHeaderInvoice($siteId)
    {
        $siteId = $siteId;
        $code = 'IconHeaderVendorInvoice';
        $this->load->model('Setting_Model');
        // Panggil fungsi model untuk mendapatkan pengaturan berdasarkan siteid dan code
        $setting = $this->Setting_Model->getConfigSetting($siteId, $code);
        
        return $setting["Value"];
    }

    public function getIconHeaderInvoice($siteId)
    {
        $siteId = $siteId;
        $code = 'IconHeaderInvoice';
        $this->load->model('Setting_Model');
        // Panggil fungsi model untuk mendapatkan pengaturan berdasarkan siteid dan code
        $setting = $this->Setting_Model->getConfigSetting($siteId, $code);
        
        return $setting["Value"];
    }

    public function getSiteId()
    {
        $domain = $_SERVER['HTTP_HOST'];
        if (!$domain) {
            $domain = $_SERVER['SERVER_NAME'];
        }
        $where = array('Domain' => $domain);
        
        $site = $this->M_Site->siteId("Site",$where);
		// require_once APPPATH . 'config/config.php';
        $siteId = null;
        if(isset($site)){
            $siteId = $site + 0;
        }else{
            $siteId = $this->config->item('site_id');
        }
        return $siteId;
	}

    public function getCompanyProfile(){
        $siteId = $this->getSiteId();
        // var_dump($siteId);
        $select = "Name,Phone,Email,Address";
        $where = $siteId;
        $this->load->model('Site_Model');
        // Panggil fungsi model untuk mendapatkan pengaturan berdasarkan siteid dan code
        $setting = $this->Site_Model->getCompanyData($select, $where);
        return $setting;
    }
}
