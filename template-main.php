<?php
/*
Template Name: Главная страница
*/
get_header(); 
?>


<?php 
$hero_video = carbon_get_the_post_meta('crb_hero_video');
$advantages = carbon_get_the_post_meta('crb_advantages');
?>


<section class="hero ">
    <video autoplay muted loop playsinline class="hero__video">
        <source src="<?php echo wp_get_attachment_url($hero_video); ?>" type="video/mp4">
    </video>
    <div class="hero__content">
        <h1><?php echo carbon_get_the_post_meta('crb_hero_title'); ?></h1>

    </div>
</section>


<section class="advantages">
    <div class="container">
        <h1><?php echo carbon_get_the_post_meta('crb_advantages_title'); ?></h1>
        <div class="advantages__grid">
            <?php foreach ( $advantages as $index => $item ) : ?>
                <article class="adv-card" style="transition-delay: <?php echo $index * 100; ?>ms">
                    <img src="<?php echo $item['icon']; ?>" alt="" class="adv-card__icon">
                    <h3><?php echo $item['title']; ?></h3>
                    <p><?php echo $item['desc']; ?></p>
                    <a href="<?php echo $item['link']; ?>">Подробнее</a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer();  ?>