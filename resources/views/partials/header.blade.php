<header class="banner">
  <div class="container">
    <nav class="navbar navbar-expand-md navbar-light">
      <a class="navbar-brand" href="{{ home_url('/') }}"><img height="51" src="{{ App\asset_path('images/inici-group-logo.svg') }}" /></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-navigation" aria-controls="primary-navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>      <?php
      wp_nav_menu( [
      'menu'            => 'primary_navigation',
      'theme_location'  => 'primary_navigation',
      'container'       => 'div',
      'container_id'    => 'primary-navigation',
      'container_class' => 'collapse navbar-collapse',
      'menu_id'         => false,
      'menu_class'      => 'navbar-nav ml-auto',
      'depth'           => 2,
      'fallback_cb'     => 'bs4navwalker::fallback',
      'walker'          => new bs4navwalker()
      ] );
      ?>
    </nav>
  </div>
</header>


