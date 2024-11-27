<?php get_header(); ?>

<main id="primary" class="site-main">
  <section class="author-info">
    <div class="author-avatar">
      <?php echo get_avatar(get_the_author_meta('ID'), 150); ?>
    </div>
    <div class="author-details">
      <h1><?php echo get_the_author(); ?></h1>
      <p><?php echo get_the_author_meta('description'); ?></p>
    </div>
  </section>

  <section class="author-posts">
    <h2>مقالات الكاتب</h2>
    <?php if ( have_posts() ) : ?>
      <ul>
        <?php while ( have_posts() ) : the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else : ?>
      <p>لا توجد مقالات لهذا الكاتب.</p>
    <?php endif; ?>
  </section>
</main>

<?php get_footer(); ?>
