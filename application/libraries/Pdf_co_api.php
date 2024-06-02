<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pdf_co_api {

    protected $CI;

    public function __construct() {
        $this->CI = &get_instance();
    }

    public function HtmltoPdfTemplate($dataPdfInv) {
    
        // Get submitted form data
        $getConnApi = $this->getConApiKey(); // The authentication key (API Key). Get your own by registering at https://app.pdf.co
        $apiKey = $getConnApi[0]->Token;
        // Prepare URL for HTML to PDF API call
        $url = "https://api.pdf.co/v1/pdf/convert/from/html";

        // Prepare requests params
        $parameters = array();
        $parameters["name"] = "Invoice-".$dataPdfInv['customer_name']."-".$dataPdfInv['periode_bill'].".pdf";
        $parameters["templateId"] = 2452;
        // Data to fill the template
        // var_dump(json_encode($dataPdfInv));
        $dataPdfInv = array_values($dataPdfInv);
        $parameters["templateData"] = json_encode($dataPdfInv);

        // Create Json payload
        $data = json_encode($parameters);

        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // Execute request
        $result = curl_exec($curl);
        $json = json_decode($result);
        if (curl_errno($curl) == 0)
        {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200)
            {
                $json = json_decode($result, true);
                
                if (!isset($json["error"]) || $json["error"] == false)
                {
                    $resultFileUrl = $json["url"];
                    // var_dump('$resultFileUrl',$resultFileUrl);

                }
                else
                {
                    // Display service reported error
                    echo "<p>Error: " . $json["message"] . "</p>"; 
                }
            }
            else
            {
                // Display request error
                echo "<p>Status code: " . $status_code . "</p>"; 
                echo "<p>" . $result . "</p>";
            }
        }
        else
        {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }

        // Cleanup
        curl_close($curl);
        // Return URL file PDF
        return $json;
    }

    public function getConApiKey() {
        $siteId = $this->getSiteId();
        $CI =& get_instance(); // Mendapatkan instance CI

        // Memuat model yang diperlukan
        $CI->load->model('ConnectionModel');

        $select = 'conn.Name, conn.Token';
        $arrWhere = array(
            'SiteId' => $siteId,
            'StatusId' => 'CNS1',
            'Name'  => 'PDF.co',
        );
        $dataConn = $CI->ConnectionModel->getConnActive($select, $arrWhere);

        return $dataConn;
    }
    
    public function getSiteId()
    {
		$siteId  ="0";
		// Load the session library
        $this->CI =& get_instance();
        // Memuat library session
        $this->CI->load->library('session');
        if ($this->CI->session->has_userdata('siteid')) {
            // Retrieve its value
            $siteId = $this->CI->session->userdata("siteid");
        }
        return $siteId;
	}
}