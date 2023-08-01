<section class="reviews" id="reviews">
  <h1 class="heading" style="margin-bottom: 2rem;">Customer<span>Reviews</span></h1>
  <div class="swiper review-slider">
    <div class="swiper-wrapper">
      <div class="swiper-slide">

        <img src="images/review/face1.jpg" alt="">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur, odio repellat incidunt quod sit quos?</p>
        <h3>Aarav Singh</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>

          <i class="fas fa-star"></i>


        </div>
      </div>

      <div class="swiper-slide">
        <img src="images/review/face2.jpg" alt="">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur, odio repellat incidunt quod sit quos?</p>
        <h3>Priya Patel </h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="far fa-star"></i>

        </div>
      </div>
      <div class="swiper-slide">
        <img src="images/review/face3.jpg" alt="">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur, odio repellat incidunt quod sit quos?</p>
        <h3>Rohit Sharma</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>

        </div>
      </div>
      <div class="swiper-slide">
        <img src="images/review/face4.jpg" alt="">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur, odio repellat incidunt quod sit quos?</p>
        <h3>Arjun Patel</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="far fa-star"></i>
          <i class="far fa-star"></i>

        </div>
      </div>
      <div class="swiper-slide">
        <img src="images/review/face5.jpg" alt="">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur, odio repellat incidunt quod sit quos?</p>
        <h3>Saurabh Gupta</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="far fa-star"></i>
        </div>
      </div>


      <div class="swiper-slide">
        <img src="images/review/face6.jpg" alt="">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur, odio repellat incidunt quod sit quos?</p>
        <h3>Anjali Desai</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="far fa-star"></i>
        </div>
      </div>

    </div>
    <!-- Add navigation buttons and pagination -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>
</section>
<script>
  var swiper = new Swiper('.review-slider', {

    loop: true,
    autoplay: true,
    autoplaySpeed: 500,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },



    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 50,
      },
    },
  });
</script>