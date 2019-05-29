export default {
    init() {
        // JavaScript to be fired on all pages

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            if (e.target.id === "experience-tab") {
                $('.readmore').readmore({
                    collapsedHeight: 195,
                    moreLink: '<a class="btn btn-outline-secondary" href="#">Read more</a>',
                    lessLink: '<a class="btn btn-outline-secondary" href="#">Read less</a>',
                });
            }
        })

    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        var $container = $('.masonry-container');
        $container.imagesLoaded(function () {
            $container.masonry({
                columnWidth: '.masonry-item',
                itemSelector: '.masonry-item',
            });
        });
    },
};
