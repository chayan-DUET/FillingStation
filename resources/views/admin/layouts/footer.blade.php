            <?php 
                use App\Models\GeneralSetting;
                
                $setting = GeneralSetting::get_setting();
                $copyright = !empty($setting) ? $setting->copyright : '';
             ?>       
        <footer id="footerPanel">
            <div id="footerBottom">
                <div class="container-fluid">
                    <div class="text-center">
                        <p>{{ $copyright }}</p>
                        <p>PLT = {{ (microtime(true) - LARAVEL_START) }}</p>
                    </div>
                </div>
            </div>
            <div class="text-center alert" id="notificationMessage" style="border-radius:0px;margin:0;"></div>
        </footer>
</div>
        <!-- jQuery -->
        <!--<script src="{{ asset('js/jquery.js') }}"></script>-->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <!-- Bootstrap DatePicker JavaScript -->
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <div id="mask"></div>
    </body>
</html>