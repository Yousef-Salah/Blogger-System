@extends('layouts.dashboard')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <div class="user-profile__avatar shadow-effect text-center">
        <img class="img-responsive center-block" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="...">
        {{ $user->name }}
        <p class="text-muted">Project Manager</p>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
          User Menu
        </div>
        <div class="panel-body">
          <ul>
            <li><a href="#"><i class="fa fa-user"></i> My Profile</a></li>
            <li><a href="{{ route('user.information.edit') }}"><i class="fa fa-edit"></i> Edit Profile</a></li>
            <li><a href="#"><i class="fa fa-envelope-o"></i> Messages</a></li>
            <li><a href="#"><i class="fa fa-sign-out"></i> Sign Out</a></li>
          </ul>
        </div>
      </div>

    </div>
    <div class="col-sm-9">
      <div class="row">
        <div class="col-sm-6">

          <!-- User name -->
          <h3 class="user-profile__title">{{ $user->name }}</h3>

          <!-- User description -->
          <p class="user-profile__desc">
            {{ $user->info }}
          </p>
          <!-- User URL -->
          <div class="user-profile__url">
            <a href="https://bootdey.com/">https://bootdey.com/</a>
          </div>
          <!-- User social links -->
          <div class="social">
            <ul class="list-inline">
              <li>
                <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              </li>
              <li>
                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              </li>
              <li>
                <a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">

          <!-- Profile info -->
          <ul class="user-profile__info">
            <li>
              <i class="fa fa-calendar-o"></i> Member for {{ now()->diffForHumans($user->created_at) }}
            </li>
            <li>
              <i class="fa fa-clock-o"></i> Last Post Date: {{ $user->lastPostDate }} 
            </li>
            <li>
              <i class="fa fa-eye"></i> 50 profile views
            </li>
          </ul>
        </div>
        <div class="col-sm-12">
          <div class="user-profile__tabs">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#user-profile__portfolio" aria-controls="user-profile__portfolio" role="tab" data-toggle="tab" aria-expanded="true">My Posts</a>
              </li>
              <li role="presentation" class="">
                <a href="#user-profile__shopping-cart" aria-controls="user-profile__shopping-cart" role="tab" data-toggle="tab" aria-expanded="false">Last Activities</a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="user-profile__portfolio">
                <div class="row">

                  @foreach($blogs as $blog)
                    <x-dashboard.user-information.post-card
                          :imgsrc="$blog->image" 
                          :title="$blog->title" 
                          :summary="$blog->summary"
                          :total_likes="$blog->total_likes"
                          :total_dislikes="$blog->total_dislikes"
                          :total_comments="$blog->total_comments"
                          :blog_id="$blog->id"   />

                  @endforeach

                </div> <!-- / .row -->
              </div> <!-- / .tab-pane -->
              <div role="tabpanel" class="tab-pane fade" id="user-profile__shopping-cart">
                <div class="table-responsive">
                  <table class="table table-bordered shopping-cart__table">
                    <thead>
                      <tr>
                        <th>Preview</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="js-shop__item">
                        <td>
                          <img class="img-responsive shopping-cart-item__img" src="https://via.placeholder.com/50x50/" alt="...">
                        </td>
                        <td>
                          <div class="shopping-cart-item__title">
                            Product Title
                          </div>
                          <div class="shopping-cart-item__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id ipsum varius, tincidunt odio nec, placerat enim.
                          </div>
                        </td>
                        <td>$<span class="js-shop-item__price">59.99</span></td>
                        <td>
                          <input type="number" class="js-shop-item__quantity form-control" min="1" max="100" step="1" value="1">
                        </td>
                      </tr>
                      <tr class="js-shop__item">
                        <td>
                          <img class="img-responsive shopping-cart-item__img" src="https://via.placeholder.com/50x50/" alt="...">
                        </td>
                        <td>
                          <div class="shopping-cart-item__title">
                            Product Title
                          </div>
                          <div class="shopping-cart-item__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id ipsum varius, tincidunt odio nec, placerat enim.
                          </div>
                        </td>
                        <td>$<span class="js-shop-item__price">59.99</span></td>
                        <td>
                          <input type="number" class="js-shop-item__quantity form-control" min="1" max="100" step="1" value="1">
                        </td>
                      </tr>
                      <tr class="js-shop__item">
                        <td>
                          <img class="img-responsive shopping-cart-item__img" src="https://via.placeholder.com/50x50/" alt="...">
                        </td>
                        <td>
                          <div class="shopping-cart-item__title">
                            Product Title
                          </div>
                          <div class="shopping-cart-item__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id ipsum varius, tincidunt odio nec, placerat enim.
                          </div>
                        </td>
                        <td>$<span class="js-shop-item__price">59.99</span></td>
                        <td>
                          <input type="number" class="js-shop-item__quantity form-control" min="1" max="100" step="1" value="1">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div> <!-- / .table-responsive -->
                <ul class="shopping-cart__checkout">
                  <li><strong>Total Price</strong>: $<span class="js-shop__total-price"></span></li>
                  <li><strong>Shipping</strong>: Free</li>
                  <li>
                    <a href="#" class="btn btn-secondary">Proceed to checkout</a>
                  </li>
                </ul>
              </div> <!-- / .tab-pane -->
            </div> <!-- / .tab-content -->
          </div>
        </div>
      </div> <!-- / .row -->
    </div>
  </div> <!-- / .row -->
</div>

<!-- Blog Starts -->




<!-- Blog Ends -->


@endsection

@push('style')
<style>
  body{margin-top:20px;
background:#eee;
}

/**
 * User Profile
 */
.user-profile__avatar,
.user-avatar {
  padding: 10px;
  margin-bottom: 30px;
  border: 1px solid #eee;
  border-radius: 3px;
}
.user-profile__avatar > img,
.user-avatar > img {
  margin-bottom: 10px;
  border-radius: 2px;
}
.user-profile__title {
  font-weight: 700;
}
.user-profile__desc {
  color: #777777;
}
.user-profile__url {
  margin-bottom: 20px;
}
.user-profile__info {
  margin: 20px 0;
  padding-left: 0;
  list-style: none;
}
.user-profile__info > li {
  padding: 5px 0;
}
.user-profile__info > li .fa {
  margin-right: 10px;
}
.user-profile__tabs {
  margin-top: 40px;
}




/**
 * Portfolio
 */
/* Portfolio navigation */
.portfolio__nav {
  list-style: none;
  padding-left: 0;
  margin-bottom: 40px;
  margin-top: -20px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
.portfolio__nav > li {
  display: inline-block;
}
.portfolio__nav > li > a {
  display: block;
  padding: 20px 10px;
  margin-bottom: -1px;
  border-bottom: 2px solid transparent;
  color: #757575;
  -webkit-transition: all .05s linear;
       -o-transition: all .05s linear;
          transition: all .05s linear;
}
.portfolio__nav > li > a:hover,
.portfolio__nav > li > a:focus {
  color: #333333;
  text-decoration: none;
}
.portfolio__nav > li.active > a {
  color: #ed3e49;
  border-bottom-color: #ed3e49;
}
@media (max-width: 767px) {
  .portfolio__nav {
    border-bottom: 0;
  }
  .portfolio__nav > li {
    display: block;
  }
  .portfolio__nav > li > a {
    padding: 10px 15px;
    margin-bottom: 10px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  }
  .portfolio__nav > li.active > a {
    font-weight: 600;
  }
}
/* Portfolio thumbnails */
.isotope-item {
  padding-left: 10px;
  padding-right: 10px;
}
/* Firefox bug fix */
@media (min-width: 1200px) {
  .col-lg-4.isotope-item {
    width: 33%;
  }
}
.portfolio__item {
  margin-bottom: 20px;
}
.portfolio-item__img {
  position: relative;
  overflow: hidden;
  cursor: pointer;
}
.portfolio-item__img:hover .portfolio-item__mask {
  background: rgba(255, 255, 255, 0.9);
}
.portfolio-item__img:hover .portfolio-item-mask__content {
  top: 0;
}
.portfolio-item__mask {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0);
  -webkit-transition: background .3s;
       -o-transition: background .3s;
          transition: background .3s;
}
@media (max-width: 767px) {
  .portfolio-item__mask {
    visibility: hidden;
  }
}
.portfolio-item-mask__content {
  position: absolute;
  display: block;
  top: -100%;
  left: 0;
  width: 100%;
  height: 100%;
  padding: 40px 20px;
  overflow: hidden;
  color: #333333;
  text-decoration: none;
  -webkit-transition: top .3s;
       -o-transition: top .3s;
          transition: top .3s;
}
.portfolio-item-mask__title {
  margin-bottom: 20px;
  font-weight: 600;
  text-transform: uppercase;
}
.portfolio-item-mask__summary {
  font-size: 12px;
}
.portfolio-item__recent > [class*="col-"] {
  padding-left: 10px;
  padding-right: 10px;
}

.tab-pane {
    padding-top: 20px;
}

.panel-body > ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.panel-body > ul > li {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.panel-body > ul > li > a {
    display: block;
    padding: 8px 0;
    font-weight: 600;
    font-size: 11px;
    color: #777777;
    text-transform: uppercase;
    text-decoration: none;
}

/* user-information post card  */
.thumbnails-icons {
  margin-top: 20px;
}

.thumbnails-icons div {
  width: 30%;
  text-align: top left;
  height: 30px;
  display: inline-block;
}

.thumbnails-icons div span {
  display: inline-block;
  padding-left: 15px; 
}

.portfolio-item__img a img {
  height: 170px;
}

</style>
@endpush