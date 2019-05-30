<div class="container">
    <article @php post_class() @endphp>
        <div class="row">
            <div class="col-md-4">
                @php
                $has_secondary = get_field('secondary_staff_image') ? ' has-secondary' : '';
                @endphp

                @if(has_post_thumbnail())
                    {{ the_post_thumbnail('large', ['class' => 'primary-staff-img img-fluid'.$has_secondary]) }}
                @else
                    <img src="{{ \App\asset_path('/images/Profile_avatar_placeholder_large.png') }}" class="img-fluid">
                @endif

                @if ($has_secondary)
                    <img class="secondary-staff-img img-fluid" class='img-fluid' src="{{ get_field('secondary_staff_image')['sizes']['basis-staff'] }}" alt="{{ get_field('secondary_staff_image')['alt'] }}">
                @endif

            </div>
            <div class="col-md-8">
                <header>
                    <h1 class="entry-title">{{ get_the_title() }}@if( get_field('credentials') ), <span
                                class="small">{{ the_field('credentials') }}</span>@endif
                    </h1>
                    <p>
                        {{ the_field('position') }}
                    </p>
                    <div class="contact-info">
                        <p>
                            @if( get_field('email_address'))
                                <i class="fas fa-envelope"></i> <a
                                        href="mailto:{{ the_field('email_address') }}">{{ the_field('email_address') }}</a>
                            @endif
                            @if( get_field('phone_number'))
                                | <i class="fas fa-phone"></i>
                                    <a href="tel:{{ the_field('phone_number') }}">{{ the_field('phone_number') }}</a>
                            @endif
                        </p>
                    </div>
                    @if( get_field('location'))
                        <p>
                            {{ the_field('location') }}
                        </p>
                    @endif
                </header>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @if(get_field('overview'))
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab"
                               aria-controls="home" aria-selected="true">Overview</a>
                        </li>
                    @endif
                    @if(get_field('achievement'))
                        <li class="nav-item">
                            <a class="nav-link" id="achievement-tab" data-toggle="tab" href="#achievement" role="tab"
                               aria-controls="profile" aria-selected="false">Achievement</a>
                        </li>
                    @endif
                    @if(get_field('experience'))
                        <li class="nav-item">
                            <a class="nav-link" id="experience-tab" data-toggle="tab" href="#experience" role="tab"
                               aria-controls="contact" aria-selected="false">Experience</a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    @if(get_field('overview'))
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="home-tab">
                            {{ the_field('overview') }}
                        </div>
                    @endif
                    @if(get_field('achievement'))
                        <div class="tab-pane fade" id="achievement" role="tabpanel" aria-labelledby="profile-tab">
                            {{ the_field('achievement') }}
                        </div>
                    @endif
                    @if(get_field('experience'))
                        <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="readmore">
                                {{ the_field('experience') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </article>
</div>
