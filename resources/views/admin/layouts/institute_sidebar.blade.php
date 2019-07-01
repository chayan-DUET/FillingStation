<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> {{ trans('words.institute_sidebar') }}</a>
        </li>
        <?php if (has_user_access('setting')) : ?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#setting"><i class="fa fa-fw fa-wrench"></i> {{ trans('words.settings') }} <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="setting" class="collapse">
                    <?php if (has_user_access('generel_setting')) : ?>
                        <li><a href="{{ url('/general-setting') }}">{{ trans('words.general_setting') }}</a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>

        <?php if (has_user_access('manage_account')) : ?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#manage-accounts"><i class="fa fa-book"></i> {{ trans('words.accounts') }} <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="manage-accounts" class="collapse">
                    <li><a href="{{ url('/daily_report') }}">{{ trans('words.daily_report') }}</a></li> 
                    <li><a href="{{ url('/ledger/dailysheet') }}">{{ trans('words.daily_sheet') }}</a></li>
                    <li><a href="{{ url('/financial-statement') }}">{{ trans('words.financial_statement') }}</a></li>
                    <li><a href="{{ url('/head') }}">{{ trans('words.account_head') }}</a></li>
                    <li><a href="{{ url('/subhead') }}">{{ trans('words.subhead') }}</a></li>
                    <li><a href="{{ url('/particulars') }}">{{ trans('words.particular') }}</a></li>
                    <li><a href="{{ url('/ledger') }}">{{ trans('words.ledger') }}</a></li>
                    <li><a href="{{ url('/transactions') }}">{{ trans('words.all_transactions') }}</a></li>
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
        <?php endif; ?>
        <?php if (has_user_access('manage_user')) : ?>
            <li>
                <a href="{{ url('/user') }}"><i class="fa fa-fw fa-bar-chart-o"></i> {{ trans('words.user_list') }}</a>
            </li>
        <?php endif; ?>
    </ul>
</div>
</nav>