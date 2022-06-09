 @props([
  'title',
  'summary',
  'imgsrc',
  'total_likes',
  'total_dislikes',
  'total_comments',
  'blog_id'
])

<div class="col-sm-6 col-md-6 col-lg-4">
  <div class="portfolio__item">
    <div class="portfolio-item__img">
      <a href="{{ route('blogs.show', $blog_id) }}">
        <img src="{{ asset( $imgsrc ?? 'images/default_image.png') }}" class="img-responsive" alt="...">
        <div class="portfolio-item__mask">
          <div class="portfolio-item-mask__content">
            <div class="portfolio-item-mask__title">
              {{ $title }}
            </div>
            <div class="portfolio-item-mask__summary">
              {{ $summary }}
            </div>

            <!--  -->
            <div class="row">

              <div class="thumbnails-icons">
                <div class="cel-1">
                  <i class="fa-regular fa-thumbs-up fa-xl col-md-3">
                  </i><span>{{ $total_likes }}</span>
                </div>
              
                <div class="cel-2">
                  <i class="fa-regular fa-thumbs-down fa-xl col-md-3">
                  </i><span>{{ $total_dislikes }}</span>
                </div>
                
                <div class="cel-3">
                <i class="fa-regular fa-comment fa-xl col-md-3">
                </i> <span>{{ $total_comments }} </span>
                </div>
              </div>

            </div>

            <!--  -->

          </div> <!-- / .portfolio-item-mask__content -->
        </div> <!-- / .portfolio-item__mask -->
      </a>
    </div> <!-- / .portfolio-item__img -->
  </div> <!-- / .portfolio__item -->
</div>

