<?php //Example Slider
  $gallery = get_sub_field('slider_gallery');
  $title = get_sub_field('hero_title');
  $copy = get_sub_field('hero_copy')
?>

<div class='m-slider js-slider'>
  <div class='container'>
    <!-- Swiper -->
    <div class='m-slider__slider swiper js-my-swiper'>
      <div class='m-slider__wrapper swiper-wrapper'>  
        <?php foreach($gallery as $img) : ?>
          <div class='m-slider__slide swiper-slide'>
            <img 
              class='m-slider__img' 
              src='<?php echo $img['url']; ?>'
              alt='<?php echo $img['alt']; ?>'
            />
          </div>
        <?php endforeach; ?>
      </div>

      <div class="m-slider__text-wrapper">
        <h2 class="m-slider__title"><?= esc_html($title); ?></h2>
        <p class="m-slider__copy"><?= esc_html($copy); ?></p>
      </div>
      
      <!-- <button class='swiper-button-next js-swiper-button-next'></button>
      <button class='swiper-button-prev js-swiper-button-prev'></button> -->
      <div class='swiper-pagination js-swiper-pagination'></div>
    </div>
  </div>
</div>