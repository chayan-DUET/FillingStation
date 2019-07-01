@include('admin.layouts.header')
<?php if (is_Admin()) : ?>
    @include('admin.layouts.admin_sidebar')
<?php else: ?>
    @include('admin.layouts.institute_sidebar')
<?php endif; ?>
<div id="page-wrapper">
    <!-- Main Content -->
    <div class="container-fluid">
        <?php
        if (has_flash_message()):
            echo view_flash_message();
        endif;
        ?>
        <div class="alert" id="ajaxMessage" style="display:none;"></div>
        <div class="text-center btn-warning" id="loading_image">Loading... <img src="{{ asset('img/ajax-loader.gif') }}" alt="Loading...."></div>
        @yield('content')
    </div><!-- End Main Content -->
</div>
@include('admin.layouts.footer')