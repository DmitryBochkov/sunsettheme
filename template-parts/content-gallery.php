<?php
/*
  @package sunsettheme

  - Gallery post format

*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header text-center">

    <?php if ( sunset_get_attachment() ): ?>
      <?php
        $featured_image = sunset_get_attachment();
        $attachments = sunset_get_attachment(7);
        // var_dump($attachments);
      ?>
      <div class="post-gallery-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">

          <?php
          $i = 0;
          foreach ($attachments as $attachment):
            $active = $i == 0 ? ' active' : '';
          ?>
            <div class="item <?php echo $active; ?> background-image" style="background-image: url(<?php echo wp_get_attachment_url( $attachment->ID ); ?>); "></div>
          <?php $i++; endforeach; ?>


        </div><!-- .carousel-inner -->
      </div><!-- .carousel -->
      <?php endif; ?>

    <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

    <div class="entry-meta">
      <?php echo sunset_posted_meta(); ?>
    </div>

  </header>

  <div class="entry-content">


    <div class="entry-excerpt">
      <?php the_excerpt(); ?>
    </div>

    <div class="button-container text-center">
      <a href="<?php the_permalink(); ?>" class="btn btn-sunset"><?php _e( 'Read More' ); ?></a>
    </div> <!-- .button-container -->

  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php echo sunset_posted_footer(); ?>
  </footer>

</article>
