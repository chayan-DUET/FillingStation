<?php

 //User Status
define("USER_STATUS_ACTIVE", 1);
define("USER_STATUS_INACTIVE", 0);
define("USER_STATUS_BLOCKED", 2);
 //User Role
define("ROLE_SUPERADMIN", 1);
define("ROLE_ADMIN", 2);
define("ROLE_CUSTOMER", 3);

// Voucher Type
define("PAYMENT_VOUCHER", "Payment Voucher");
define("RECEIVE_VOUCHER", "Receive Voucher");
define("PURCHASE_VOUCHER", "Purchase Voucher");
define("SALES_VOUCHER", "Sales Voucher");


// Supplier Type
define("COAL", "Coal");
define("SOIL", "Soil");

//Transaction Type
define("TRANSACTION_ADVANCE", "advance");
define("TRANSACTION_PRE_DUE", "previous due");
define("TRANSACTION_DUE_PAID", "due paid");
define("TRANSACTION_INVOICE", "invoice");
define("TRANSACTION_REGULAR", "regular");
//transaction method
define("TRANSACTION_CASH", "Cash");
define("TRANSACTION_BANK", "Bank");
define("TRANSACTION_NO", "No");

//payment methode
define("PAYMENT_NO", "No Payment");
define("PAYMENT_BANK", "Bank Payment");
define("PAYMENT_CASH", "Cash Payment");

//Account type 
define("ACCOUNT_LC","LC");
define("ACCOUNT_CURRENT","CURRENT");
define("ACCOUNT_SAVINGS","SAVINGS");
 //Fixed Head ID
define("HEAD_CASH_IN_HAND", 1);
define("HEAD_CREDITORS", 2);
define("HEAD_DEBTORS", 3);
define("HEAD_PURCHASE", 25);
define("HEAD_SALES", 5);
define("HEAD_CASH_AT_BANK", 6);

 // SUB Head ID
define("HEAD_SUB_CASH", 1);
define("HEAD_SUB_BANK", 2);
define("HEAD_SUB_PURCHASE", 3);
define("HEAD_SUB_RETURN", 4);
define("HEAD_SUB_SALES", 5);
define("HEAD_SUB_AP", 9);
define("HEAD_SUB_AR", 10);
define("HEAD_SUB_TRANSPORT", 11);
define("HEAD_SUB_LABOR", 12);
define("HEAD_SUB_DEBTORS", 15);
define("HEAD_SUB_CREDITORS", 16);

// Invoice Prefix
define("INV_PRODUCTION", 'PRO');
define("INV_LOADING", 'ROUND');
define("INV_UNLOADING", 'ROUND');
define("INV_SALES", 'SALES');






