<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> {{ trans('words.admin_sidebar') }}</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#setting"><i class="fa fa-fw fa-wrench"></i> {{ trans('words.settings') }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="setting" class="collapse">
                <?php if (has_user_access('generel_setting')) : ?>
                    <li><a href="{{ url('/general-setting') }}">{{ trans('words.general_setting') }}</a></li>
                <li>
                <a href="{{ url('/company') }}">{{ trans('words.company_settings') }}</a>
                </li>
                <li>
                <a href="{{ url('/category') }}">{{ trans('words.product_category') }}</a>
                </li>
                 <li>
                    <a href="{{ url('/product') }}">{{ trans('words.product_setting') }}</a>
                </li>
                <li>
                <a href="{{ url('/deep') }}">{{ trans('words.deep_sittings') }}</a>
                </li>
                <li>
                <a href="{{ url('/deepcaliber') }}">{{ trans('words.deep_caliber_settings') }}</a>
                </li>
                <li>
                <a href="{{ url('/tanklory') }}">{{ trans('words.tanklory_settings') }}</a>
                </li>
                <li>
                <a href="{{ url('/chamber') }}">{{ trans('words.chamber_settings') }}</a>
                </li>
                <li>
                <a href="{{ url('/chambercaliber') }}">{{ trans('words.chamber_caliber_settings') }}</a>
                </li>
                <li>
                <a href="{{ url('/station') }}">{{ trans('words.station_settings') }}</a>
                </li>
                <li>
                <a href="{{ url('/nogel') }}">{{ trans('words.nogel_settings') }}</a>
                </li>
               
                <?php endif; ?>
            </ul>

        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#person"><i class="fa fa-fw fa-users"></i> {{ trans('words.person') }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="person" class="collapse">
                <?php if (has_user_access('generel_setting')) : ?>
                    <li>
                        <a href="{{ url('/employee') }}">{{ trans('words.employee') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/supplier') }}">{{ trans('words.supplier') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/customer') }}">{{ trans('words.customer') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/customer_type') }}">{{ trans('words.customer_type') }}</a>
                    </li>
                <?php endif; ?>
            </ul>

        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#bank_settings"><i class="fa fa-fw fa-bank"></i> {{ trans('words.bank_info') }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="bank_settings" class="collapse">
                <?php if (has_user_access('generel_setting')) : ?>
                    <li>
                        <a href="{{ url('/bank') }}">{{ trans('words.bank_setting') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/bankbranch') }}">{{ trans('words.bank_branch_setting') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/account') }}">{{ trans('words.account_setting') }}</a>
                    </li>
                <?php endif; ?>
            </ul>

        </li> 
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#purchase"><i class="fa fa-fw fa-shopping-cart"></i> {{ trans('words.purchase_info') }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="purchase" class="collapse">
                <?php if (has_user_access('generel_setting')) : ?>
                    <li>
                        <a href="{{ url('/purchaseorder') }}">{{ trans('words.purchase_index') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/purchaseorderitem') }}">{{ trans('words.item_list') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/purchasechallan') }}">{{ trans('words.purchase_challan') }}</a>
                    </li>
                    
                <?php endif; ?>
            </ul>

        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#tanklorydeep"><i class="fa fa-fw fa-car"></i> {{ trans('words.tanklorydeepinfo') }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="tanklorydeep" class="collapse">
                <?php if (has_user_access('generel_setting')) : ?>
                    <li>
                        <a href="{{ url('/tankloryproduct') }}">{{ trans('words.tanklory') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/tankloryitem') }}">{{ trans('words.tankloryitem') }}</a>
                    </li>
                <?php endif; ?>
            </ul>

        </li>

        <li>
            <a href="{{ url('/institute') }}"><i class="fa fa-fw fa-bar-chart-o"></i> {{ trans('words.institute_list') }}</a>
        </li>
        

        <?php if (has_user_access('manage_account')) : ?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#manage-accounts"><i class="fa fa-book"></i> {{ trans('words.accounts') }} <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="manage-accounts" class="collapse">
                    <li><a href="{{ url('/dailyreport') }}">{{ trans('words.daily_report') }}</a></li>
                    <li><a href="{{ url('/ledger/dailysheet') }}">{{ trans('words.daily_sheet') }}</a></li>
                    <li><a href="{{ url('/financial-statement') }}">{{ trans('words.financial_statement') }}</a></li>
                    <li><a href="{{ url('/head') }}">{{ trans('words.account_head') }}</a></li>
                    <li><a href="{{ url('/subhead') }}">{{ trans('words.subhead') }}</a></li>
                    <li><a href="{{ url('/particulars') }}">{{ trans('words.particular') }}</a></li>
                    <li><a href="{{ url('/ledger') }}">{{ trans('words.ledger') }}</a></li>
                    <li><a href="{{ url('/transactions') }}">{{ trans('words.all_transactions') }}</a></li>
                </ul>
            </li>
        <?php endif; ?>

        <?php if (has_user_access('manage_user')) : ?>
            <li>
                <a href="{{ url('/user') }}"><i class="fa fa-fw fa-bar-chart-o"></i> {{ trans('words.user_list') }}</a>
            </li>
        <?php endif; ?>
    </ul>
</div>
</nav>