<footer class="content-info">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        @php dynamic_sidebar('sidebar-footer-1') @endphp
                    </div>
                    <div class="col-md-4">
                        @php dynamic_sidebar('sidebar-footer-2') @endphp
                    </div>
                    <div class="col-md-3 text-md-right">
                        @php dynamic_sidebar('sidebar-footer-3') @endphp
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-base">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mr-auto">
                        @if (has_nav_menu('footer_navigation'))
                            {!!wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'nav', 'depth' => 1]) !!}
                        @endif
                    </div>
                    <div class="col-md-4">
                        &copy; <?= date('Y') ?> {{ get_bloginfo('name', 'display') }} | All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
</footer>
