<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Bill extends CI_Model {

    public function getDashboardData() {
        $query = $this->db->query("
        SELECT
        -- Total Revenue Bulan Ini
        (SELECT CAST(COALESCE(SUM(Amount), 0) AS UNSIGNED) FROM Bill WHERE MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE()) AND StatusId = 'BLS1') AS TRThisMonth,
        (SELECT MAX(ModifyDate) FROM Bill WHERE MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE()) ORDER BY ModifyDate DESC) AS DateUpdateTRThisMonth,

        -- Total Customer yang Sudah Bayar dan Belum
        (SELECT COUNT(*) FROM Bill WHERE StatusId = 'BLS1' AND MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE())) AS TPCustomers,
        (SELECT COUNT(*) FROM Bill WHERE StatusId = 'BLS2' AND MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE())) AS TUPCustomers,
        (SELECT  MAX(ModifyDate) FROM Bill WHERE StatusId = 'BLS1' ORDER BY ModifyDate DESC) AS DateUpdateTUPCustomers,
        (SELECT  MAX(ModifyDate) FROM Bill WHERE StatusId = 'BLS2'ORDER BY ModifyDate DESC) AS DateUpdateTUCustomers,

        -- Total Customer Aktif
        (SELECT COUNT(*) FROM Customer WHERE StatusId = 'CRS1') AS TACustomers,
        #(SELECT MAX(ModifyDate) FROM Customer WHERE StatusId = 'CRS1') AS DateUpdateTACustomers,
        
        -- Total Customer All
        (SELECT COUNT(*) FROM Customer) AS TotalCustomers,
        #(SELECT MAX(ModifyDate) FROM Customer) AS DateUpdateTACustomers,

        -- Total Revenue 3 Bulan Terakhir
        (SELECT  CAST(COALESCE(SUM(Amount), 0) AS UNSIGNED) FROM Bill WHERE StatusId = 'BLS1' AND DueDate >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) AS TRLast3Months,
        (SELECT MAX(ModifyDate) FROM Bill WHERE StatusId = 'BLS1' AND DueDate >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) AS UpdateDateTRLast3Months,

        -- Total Customer Growth (3 Bulan Terakhir)
        (SELECT COUNT(*) - (SELECT COUNT(*) FROM Customer WHERE CreateDate >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) FROM Customer) AS TCGrowth,
        (SELECT MAX(ModifyDate) FROM Customer WHERE CreateDate >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) AS UpdateDateTCGrowth,

        -- Total Profit Bersih This Month
        (SELECT  CAST(COALESCE(SUM(Amount - 350000), 0) AS UNSIGNED) FROM Bill WHERE StatusId = 'BLS1' AND MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE())) AS TNPThisMonth,
    
        -- Total Profit Kotor This Month
        (SELECT  CAST(COALESCE(SUM(Amount - 350000), 0) AS UNSIGNED) FROM Bill WHERE StatusId = 'BLS1' AND MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE())) AS TGPThisMonth;
        ");

        return $query->row();
    }
}