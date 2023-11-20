<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Bill extends CI_Model {

    public function getDashboardData() {
        $query = $this->db->query("
            SELECT
                -- Total Revenue Bulan Ini
                (SELECT SUM(Amount) FROM Bill WHERE MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE())) AS TotalRevenueThisMonth,
                (SELECT MAX(ModifyDate) FROM Bill WHERE MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE()) ORDER BY ModifyDate DESC) AS DateUpdateTRThisMonth,

                -- Total Customer yang Sudah Bayar dan Belum
                (SELECT COUNT(*) FROM Bill WHERE StatusId = 'BLS1' AND MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE())) AS TotalPaidCustomers,
                (SELECT COUNT(*) FROM Bill WHERE StatusId = 'BLS2' AND MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE())) AS TotalUnpaidCustomers,
                (SELECT  MAX(ModifyDate) FROM Bill WHERE StatusId = 'BLS1' ORDER BY ModifyDate DESC) AS DateUpdateTUPCustomers,
                (SELECT  MAX(ModifyDate) FROM Bill WHERE StatusId = 'BLS2'ORDER BY ModifyDate DESC) AS DateUpdateTUCustomers,

                -- Total Customer Aktif
                (SELECT COUNT(*) FROM Customer WHERE StatusId = 'CRS1') AS TotalActiveCustomers,
                #(SELECT MAX(ModifyDate) FROM Customer WHERE StatusId = 'CRS1') AS DateUpdateTACustomers,
                
                -- Total Customer All
                (SELECT COUNT(*) FROM Customer) AS TotalCustomers,
                #(SELECT MAX(ModifyDate) FROM Customer) AS DateUpdateTACustomers,

                -- Total Revenue 3 Bulan Terakhir
                (SELECT SUM(Amount) FROM Bill WHERE StatusId = 'BLS1' AND DueDate >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) AS TotalRevenueLast3Months,
                (SELECT MAX(ModifyDate) FROM Bill WHERE StatusId = 'BLS1' AND DueDate >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) AS UpdateDateTRLast3Months,

                -- Total Customer Growth (3 Bulan Terakhir)
                (SELECT COUNT(*) - (SELECT COUNT(*) FROM Customer WHERE CreateDate >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) FROM Customer) AS TotalCustomerGrowth,
                (SELECT MAX(ModifyDate) FROM Customer WHERE CreateDate >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) AS UpdateDateTCGrowth,

                -- Total Profit Bersih This Month
                (SELECT SUM(Amount - 350000) FROM Bill WHERE StatusId = 'BLS1' AND MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE())) AS TotalNetProfitThisMonth,
            
                -- Total Profit Kotor This Month
                (SELECT SUM(Amount - 350000) FROM Bill WHERE StatusId = 'BLS1' AND MONTH(DueDate) = MONTH(CURRENT_DATE()) AND YEAR(DueDate) = YEAR(CURRENT_DATE())) AS TotalGrossProfitThisMonth;
        ");

        return $query->row();
    }
}