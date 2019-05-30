<div class="container">
    <div class="row">
        <div class="col">
            <header class="text-center pb-4">
                <h2 class="entry-title">{!!  get_the_title() !!}</h2>
                <h5 class="text-muted">{!! the_field('location') !!}</h5>
                {!!  single_taxonomy_terms_link( get_the_ID(), 'client') !!}
                {!!  single_taxonomy_terms_link( get_the_ID(), 'industry') !!}
            </header>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <article @php post_class() @endphp>

                <div class="entry-content">
                    {!! the_field('project_description') !!}
                </div>
            </article>
        </div>
        <div class="col-md-6">
            @php( $images = get_field('gallery') )
            @if( is_array($images) && count($images) > 1 )
                <div class="row masonry-container" data-featherlight-gallery data-featherlight-filter="a.project-image">
                    @foreach( $images as $image)
                        <div class="col-md-6 masonry-item">
                            <a class="project-image" href="#" data-featherlight="{{ $image['url'] }}">
                                <img class='img-fluid' src="{{ $image['sizes']['basis-project'] }}"
                                     alt="{{ $image['alt'] }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                @if($images)
                    <div class="row" data-featherlight-gallery data-featherlight-filter="a.project-image">
                        <div class="col">
                            <a class="project-image" href="#" data-featherlight="{{ $images[0]['url'] }}">
                                <img class='img-fluid' src="{{ $images[0]['url'] }}" alt="{{  $images[0]['alt'] }}"></a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
    <hr>
    <div class="row pb-2">
        <div class="col">
            <h3 class="text-center">Project Details</h3>
        </div>
    </div>
    <div class="row p-2">
        @php( $details = get_field('project_details') )
        <div class="col-md-4">
            <div>
                @if ( is_array($details['project_size']) && count($details['project_size']) > 0 && !empty(array_filter($details['project_size'][0])))
                    <h4>Project Size:</h4>
                    <ul>
                        @foreach ($details['project_size'] as $item)
                            <li>{{ $item['item'] }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div>
                @if ($details['services'])
                    <h4>Services</h4>
                    <ul>
                        @foreach ($details['services'] as $service)
                            <li>{!! get_term($service, 'service')->name !!}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            @if ($details['completion_date'] || $details['cost'] || $details['sustainability'] || $details['construction_type'])
                <h4>Additional Details</h4>
                <div>{!! $details['completion_date'] ? '<strong class="text-primary">Completion Date:</strong> ' . $details['completion_date'] : ''!!}</div>
                <div>{!! $details['cost'] ? '<strong class="text-primary">Cost:</strong> ' . $details['cost'] : '' !!}</div>
                <div>{!! $details['sustainability'] ? '<strong class="text-primary">Sustainability:</strong> ' . $details['sustainability'] : '' !!}</div>
                <div>{!! $details['construction_type'] ? '<strong class="text-primary">Construction Type:</strong> ' . $details['construction_type'] : '' !!}</div>
            @endif
        </div>
    </div>
</div>