<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function dailyReportIndex(Request $request)
    {
        return view('Report.daily');
    }
    public function dailyReport(Request $request)
    {
        $date=date('Y-m-d');
        $userId=$request->session()->get('loggedUser');

        $data=DB::select(
                    "SELECT 
                    customer_details_id,
                    customer_details_name,
                    customer_details_address,
                    customer_details_phn,
                    customer_type_name,
                    COUNT(product_purchase_customer_id) AS times,
                    purchasedTotal,
                    givenTotal,
                    Due
                FROM
                    amar_customer_details
                        LEFT JOIN
                    amar_customer_type ON amar_customer_type.customer_type_id = amar_customer_details.customer_details_type
                        LEFT JOIN
                    amar_product_purchase ON amar_product_purchase.product_purchase_customer_id = amar_customer_details.customer_details_id
                        LEFT JOIN
                    amar_product_details ON amar_product_details.product_details_id = amar_product_purchase.product_purchase_product_id
                        LEFT JOIN
                    (SELECT 
                        product_purchase_customer_id AS purchaseCustomer,
                            (SUM(product_purchase_quantity * product_details_purchase_amount) - SUM(product_purchase_quantity * product_purchase_amount)) AS Due,
                            SUM(product_purchase_quantity * product_details_purchase_amount) AS purchasedTotal,
                            SUM(product_purchase_quantity * product_purchase_amount) AS givenTotal
                    FROM
                        amar_product_purchase
                    LEFT JOIN amar_product_details ON amar_product_details.product_details_id = amar_product_purchase.product_purchase_product_id
                    WHERE
                        product_purchase_user_id = $userId
                            AND product_purchase_date = '$date'
                    GROUP BY product_purchase_customer_id) AS historyAmount ON historyAmount.purchaseCustomer = amar_customer_details.customer_details_id
                WHERE
                    customer_details_is_deleted = 0
                        AND product_purchase_user_id = $userId
                        AND product_purchase_date = '$date'
                        AND product_purchase_is_deleted = 0
                GROUP BY customer_details_id"
        );

        return response()->json(array('data'=>$data));
    }
    public function monthlyReportIndex(Request $request)
    {
        return view('Report.monthly');
    }
    public function monthlyReport(Request $request)
    {
        $date=$request->date;
        $userId=$request->session()->get('loggedUser');

        $data=DB::select(
                    "SELECT 
                    customer_details_id,
                    customer_details_name,
                    customer_details_address,
                    customer_details_phn,
                    customer_type_name,
                    COUNT(product_purchase_customer_id) AS times,
                    purchasedTotal,
                    givenTotal,
                    Due
                FROM
                    amar_customer_details
                        LEFT JOIN
                    amar_customer_type ON amar_customer_type.customer_type_id = amar_customer_details.customer_details_type
                        LEFT JOIN
                    amar_product_purchase ON amar_product_purchase.product_purchase_customer_id = amar_customer_details.customer_details_id
                        LEFT JOIN
                    amar_product_details ON amar_product_details.product_details_id = amar_product_purchase.product_purchase_product_id
                        LEFT JOIN
                    (SELECT 
                        product_purchase_customer_id AS purchaseCustomer,
                            (SUM(product_purchase_quantity * product_details_purchase_amount) - SUM(product_purchase_quantity * product_purchase_amount)) AS Due,
                            SUM(product_purchase_quantity * product_details_purchase_amount) AS purchasedTotal,
                            SUM(product_purchase_quantity * product_purchase_amount) AS givenTotal
                    FROM
                        amar_product_purchase
                    LEFT JOIN amar_product_details ON amar_product_details.product_details_id = amar_product_purchase.product_purchase_product_id
                    WHERE
                        product_purchase_user_id = $userId
                            AND product_purchase_date <= '$date'
                    GROUP BY product_purchase_customer_id) AS historyAmount ON historyAmount.purchaseCustomer = amar_customer_details.customer_details_id
                WHERE
                    customer_details_is_deleted = 0
                        AND product_purchase_user_id = $userId
                        AND product_purchase_date <= '$date'
                        AND product_purchase_is_deleted = 0
                GROUP BY customer_details_id"
        );
        $file=fopen("H://report.txt","w+");
        fwrite($file,print_r($data,true).PHP_EOL);
        fclose($file);

        return response()->json(array('data'=>$data));
    }
}
