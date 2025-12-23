<?php
$bg          = get_field('background_image');
$title       = get_field('title');
$text        = get_field('text');
$cta         = get_field('cta');
$items       = get_field('items');

// get bg URL
$bg_url = $bg ? wp_get_attachment_image_url($bg, 'full') : '';
?>

<section class="container mx-auto relative rounded-2xl overflow-hidden shadow-lg">
    <?php if ($bg_url): ?>
        <div class="absolute inset-0">
            <img src="<?php echo esc_url($bg_url); ?>" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
    <?php endif; ?>

    <div class="relative p-8 lg:p-12 text-white grid lg:grid-cols-2 gap-10">
        
        <div class="space-y-5">
            <?php if ($title): ?>
                <h2 class="text-3xl font-bold"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($text): ?>
                <p class="text-base leading-relaxed"><?php echo esc_html($text); ?></p>
            <?php endif; ?>

            <?php if ($cta && $cta['text'] && $cta['url']): ?>
                <a href="<?php echo esc_url($cta['url']); ?>"
                   class="inline-block bg-resaltar text-black px-6 py-3 rounded-full font-semibold">
                    <?php echo esc_html($cta['text']); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if ($items): ?>
            <div class="space-y-6">
                <?php foreach ($items as $item): ?>
                    <div class="flex items-center gap-3">
                        <?php if (!empty($item['icon'])): ?>
                            <span class="w-6 h-6 text-yellow-400" aria-hidden="true">
                                <?php echo $item['icon']; ?>
                            </span>
                        <?php endif; ?>
                        
                        <p class="text-white font-medium"><?php echo esc_html($item['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
