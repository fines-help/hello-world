<?php
$args = array(
  'post_type' => 'seminar',
  'post_status' => 'publish',
  'seminar_cat' => 'training',
);
$the_query = new WP_Query($args);
?>
<?php if ($the_query->have_posts()) : ?>
  <p class="home-seminar-more" style="text-align: right; margin-bottom: 20px;"><a href="<?php echo esc_url(home_url('/contents/seminar_cat/training/')); ?>" class="btn btn-a">もっとみる<svg viewBox="0 0 22.002 21.998" class="arrow-right">
        <use xlink:href="#ico-arrow-right"></use>
      </svg></a></p>

  <ul class="seminar-archive
      grid
			gap-4
			grid-cols-1
			w-full
			sm:grid-cols-1
			md:grid-cols-3
			lg:grid-cols-3
			xl:grid-cols-3
			m-auto
  ">
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
      <li style="border: 1px solid #DDDDDD; padding: 0.8rem 0;">
        <a href="<?php the_permalink(); ?>" style="flex-direction:column">
          <?php if (has_post_thumbnail()) : ?>
            <div class="seminar-archive-image" style="width: 100%;"><?php the_post_thumbnail('thumbnailseminer'); ?></div>
          <?php else : ?>
            <div class="seminar-archive-image w-full" style="width: 100%;"><img src="<?php echo get_theme_file_uri('/assets/img/common/ph_noimage_02.png'); ?>" alt=""></div>
          <?php endif; ?>
          <div style="padding: 10px; width: 100%;">
            <p class="seminar-date">開催 : <span class="date">
            <?php
            $date = get_field('date');
            dateonly( $date ) ;
            ?></span>
            <?php
            weekformat($date);
            ?></p>
            <p class="seminar-cat"><span><?php
            $terms = get_the_terms( $post->ID, 'seminar_cat' );
            foreach( $terms as $term ) {
              echo $term->name;
            }
            ?></span></p>
            <h3 class="seminar-title"><?php the_title(); ?></h3>
          </div>
        </a>
      </li>
      <!-- / .seminar-archive -->
    <?php endwhile; ?>
  </ul>
  <?php wp_reset_postdata(); ?>
<?php else : ?>

  <div class="entry-none">
    <p>coming soon　乞うご期待！</p>
  </div>

<?php endif; ?>