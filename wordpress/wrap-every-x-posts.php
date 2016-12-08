<?php
$posts = get_posts( $args );

foreach (array_chunk($posts, 2, true) as $posts) :  ?>

    <div class="row">

        <?php foreach($posts as $post) : setup_postdata($post); ?>

            <!-- etc  -->

        <?php endforeach; ?>

    </div>

<?php endforeach; ?>