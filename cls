warning: LF will be replaced by CRLF in app/Http/Controllers/CustomerController.php.
The file will have its original line endings in your working directory.
warning: LF will be replaced by CRLF in app/Http/Controllers/CustomerTransactionController.php.
The file will have its original line endings in your working directory.
warning: LF will be replaced by CRLF in app/Http/Controllers/InstituteController.php.
The file will have its original line endings in your working directory.
warning: LF will be replaced by CRLF in app/Http/Controllers/LedgerController.php.
The file will have its original line endings in your working directory.
warning: LF will be replaced by CRLF in app/Http/Controllers/LoadingController.php.
The file will have its original line endings in your working directory.
warning: LF will be replaced by CRLF in app/Http/Controllers/RawbrickController.php.
The file will have its original line endings in your working directory.
warning: LF will be replaced by CRLF in app/Http/Controllers/SaleController.php.
The file will have its original line endings in your working directory.
warning: LF will be replaced by CRLF in app/Models/Customer.php.
The file will have its original line endings in your working directory.
warning: LF will be replaced by CRLF in app/Models/CustomerTransaction.php.
The file will have its original line endings in your working directory.
warning: LF will be replaced by CRLF in app/Models/RawBrickItem.php.
The file will have its original line endings in your working directory.
warning: LF will be replaced by CRLF in app/Models/Stock.php.
The file will have its original line endings in your working directory.
warning: LF will be replaced by CRLF in app/Models/Transaction.php.
The file will have its original line endings in your working directory.
[1mdiff --git a/app/Http/Controllers/CustomerController.php b/app/Http/Controllers/CustomerController.php[m
[1mindex 51786f3..61a159b 100644[m
[1m--- a/app/Http/Controllers/CustomerController.php[m
[1m+++ b/app/Http/Controllers/CustomerController.php[m
[36m@@ -7,6 +7,7 @@[m [muse Exception;[m
 use Auth;[m
 use App\Models\Institute;[m
 use App\Models\Customer;[m
[32m+[m[32muse App\Models\CustomerTransaction;[m
 use Validator;[m
 use Illuminate\Http\Request;[m
 [m
[36m@@ -74,6 +75,12 @@[m [mclass CustomerController extends HomeController {[m
         return view('institute.customers.edit', compact('data'));[m
     }[m
 [m
[32m+[m[32m    public function ledger($id) {[m
[32m+[m[32m        $data = Customer::where('_key', $id)->first();[m
[32m+[m[32m        $dataset = CustomerTransaction::where('customer_id', $data->id)->get();[m
[32m+[m[32m        return view('institute.customers.ledger', compact('dataset', 'data'));[m
[32m+[m[32m    }[m
[32m+[m
     public function update(Request $r, $id) {[m
         $input = $r->all();[m
         $rules = array([m
[36m@@ -179,6 +186,13 @@[m [mclass CustomerController extends HomeController {[m
         return json_encode($resp);[m
     }[m
 [m
[32m+[m[32m    public function get_customer_balance() {[m
[32m+[m[32m        $_cid = $_POST['id'];[m
[32m+[m[32m        $customer = Customer::find($_cid);[m
[32m+[m[32m        $balance = $customer->sumBalance($_cid);[m
[32m+[m[32m        return $balance;[m
[32m+[m[32m    }[m
[32m+[m
     public function get_particular(Request $r) {[m
         $dataset = Particular::where('subhead_id', $r->head)->get();[m
         $str = ["<option value=''>Select sub head</option>"];[m
[1mdiff --git a/app/Http/Controllers/CustomerTransactionController.php b/app/Http/Controllers/CustomerTransactionController.php[m
[1mindex 6ba2a3a..dc1dd6e 100644[m
[1m--- a/app/Http/Controllers/CustomerTransactionController.php[m
[1m+++ b/app/Http/Controllers/CustomerTransactionController.php[m
[36m@@ -6,45 +6,46 @@[m [muse Exception;[m
 use Auth;[m
 use DB;[m
 use App\Models\Institute;[m
[32m+[m[32muse App\Models\CustomerTransaction;[m
 use App\Models\Transaction;[m
[32m+[m[32muse App\Models\Customer;[m
 use App\Models\Head;[m
[31m-use App\Models\SubHead;[m
 use App\User;[m
 use Session;[m
 use Validator;[m
 use Illuminate\Http\Request;[m
 [m
[31m-class TransactionController extends HomeController {[m
[32m+[m[32mclass CustomerTransactionController extends HomeController {[m
 [m
     public function index() {[m
[31m-        $model = new Transaction();[m
[31m-        $insList = Institute::where('type','institute')->get(); [m
[31m-        $query = is_Admin() ? $model->orderBy('date','DESC') : $model->where('institute_id', institute_id())->orderBy('date','DESC');[m
[32m+[m[32m        $model = new CustomerTransaction();[m
[32m+[m[32m        $insList = Institute::where('type', 'institute')->get();[m
[32m+[m[32m        $query = is_Admin() ? $model->orderBy('date', 'DESC') : $model->where('institute_id', institute_id())->orderBy('date', 'DESC');[m
         $dataset = $query->paginate($this->getSettings()->pagesize);[m
[31m-        $heads = Head::where('institute_id', institute_id())->get();[m
[31m-        return view('institute.transactions.index', compact('dataset', 'heads', 'insList'));[m
[32m+[m[32m        $customers = Customer::where('institute_id', institute_id())->get();[m
[32m+[m[32m        return view('institute.customer_transactions.index', compact('dataset', 'customers', 'insList'));[m
     }[m
 [m
[31m-    public function create($tp) {[m
[31m-        $model = new Head();[m
[31m-        $insList = Institute::where('type','institute')->get();       [m
[31m-        $heads = $model->where('institute_id', institute_id())->get();[m
[31m-        return view('institute.transactions.create', compact('tp', 'heads', 'insList'));[m
[32m+[m[32m    public function create() {[m
[32m+[m[32m        $model = new Customer();[m
[32m+[m[32m        $insList = Institute::where('type', 'institute')->get();[m
[32m+[m[32m        $customers = $model->where('institute_id', institute_id())->get();[m
[32m+[m[32m        return view('institute.customer_transactions.create', compact('customers', 'insList'));[m
     }[m
 [m
     public function store(Request $r) {[m
[32m+[m[32m        //pr($_POST);[m
         $input = $r->all();[m
         $rules = array([m
             'date' => 'required',[m
[31m-            'head' => 'required',[m
[32m+[m[32m            'customer_id' => 'required',[m
             'amount' => 'required',[m
         );[m
         if (is_Admin()) {[m
             $rules['institute_id'] = 'required';[m
         }[m
         $messages = array([m
[31m-            'head.required' => 'Please select a head',[m
[31m-            'subhead.required' => 'Please select a subhead',[m
[32m+[m[32m            'customer_id.required' => 'Please select a Customer',[m
             'amount.required' => 'You must provide a amount',[m
         );[m
 [m
[36m@@ -53,41 +54,50 @@[m [mclass TransactionController extends HomeController {[m
             return redirect()->back()->withErrors($valid)->withInput();[m
         }[m
 [m
[31m-        if ($r->type == 'd') {[m
[31m-            $type = strtoupper($r->type);[m
[31m-            $voucher_type = RECEIVE_VOUCHER;[m
[31m-            $debit = $r->amount;[m
[31m-            $credit = NULL;[m
[31m-        } else {[m
[31m-            $type = strtoupper($r->type);[m
[31m-            $voucher_type = PAYMENT_VOUCHER;[m
[31m-            $debit = NULL;[m
[31m-            $credit = $r->amount;[m
[31m-        }[m
[31m-[m
[31m-        $model = new Transaction();[m
[32m+[m[32m        $model = new CustomerTransaction();[m
         $model->institute_id = !empty($r->institute_id) ? $r->institute_id : institute_id();[m
[31m-        $model->type = $type;[m
[31m-        $model->voucher_type = $voucher_type;[m
[32m+[m[32m        $model->type = 'D';[m
[32m+[m[32m        $model->voucher_type = RECEIVE_VOUCHER;[m
         $model->date = date_ymd($r->date);[m
[31m-        $model->head_id = $r->head;[m
[31m-        $model->subhead_id = $r->subhead;[m
[32m+[m[32m        