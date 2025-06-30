<?php
use Illuminate\Support\Facades\Blade;

add_action('after_setup_theme', function () {
    Blade::directive('query', function ($expression) {
        return <<<'PHP'
<?php 
  $__query = new WP_Query(%s); 
  if ($__query->have_posts()): 
    $__loopIndex = 0; 
    $__loopTotal = $__query->post_count;
    while ($__query->have_posts()): 
      $__query->the_post(); 
      $__loopIndex++;
      $loop = (object) [
        'index' => $__loopIndex,
        'remaining' => $__loopTotal - $__loopIndex,
        'count' => $__loopTotal,
        'first' => $__loopIndex === 1,
        'last' => $__loopIndex === $__loopTotal,
      ];
?>
PHP;
    });

    Blade::directive('endquery', function () {
        return '<?php endwhile; wp_reset_postdata(); endif; ?>';
    });
});
