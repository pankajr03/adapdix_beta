<?php

/**
 * Template Name: The Blog
 */
?>

<?php get_header('public-blog'); ?>
<div class="container container-blog">
    <article class="page type-page status-publish hentry">

        <!-- Main hero unit for a primary marketing message or call to action -->
        <div class="hero-unit blog-container">
            <div class="row-fluid">
                <div class="col-md-8">
                    <h1 class="areaheadertext">LATEST BLOG POSTS</h1>
                    <?php
                    $args = array('numberposts' => 2, 'category' => -51);
                    $lastposts = get_posts($args);
                    foreach ($lastposts as $post) : setup_postdata($post);
                        ?>
                        <div class="blog_page_top_post clearfix">

                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                            <div class="authorname"><p>Written By: <a
                                        href="<?php the_author(); ?>"><?php the_author(); ?></a></p></div>

                            <div style="margin-top: 10px;"></div>
                            <div class="innerpostexcerpt"><?php the_content(); ?></div>
                            <br>

                            <div id="social">
                                <br>

                                <div style="float: left; margin-left: 10px;"><a href="https://twitter.com/share"
                                                                                class="twitter-share-button"
                                                                                data-count="horizontal">Tweet</a>
                                    <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                                </div>

                                <div class="fb-like" data-send="true" data-layout="button_count" data-width="150"
                                     data-show-faces="false"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <br>

                    <div class="columns blog_page_top_post" style="float: left; width: 300px;">
                        <?php
                        $args = array('numberposts' => 1, 'offset' => 2, 'exclude' => 51);
                        $lastposts = get_posts($args);
                        foreach ($lastposts as $post) : setup_postdata($post);
                            ?>

                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="authorname"><p>Written By: <a
                                        href="<?php the_author(); ?>"><?php the_author(); ?></a></p></div>

                            <div style="margin-top: 10px;"></div>


                            <div class="innerpostexcerpt"><?php the_excerpt(); ?></div>

                            <br>

                            <div id="social">

                                <div style="float: left; margin-left: 10px;"><a href="https://twitter.com/share"
                                                                                class="twitter-share-button"
                                                                                data-count="horizontal">Tweet</a>
                                    <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                                </div>

                                <div class="fb-like" data-send="true" data-layout="button_count" data-width="150"
                                     data-show-faces="false"></div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                    <div class="columns blog_page_top_post" style="float: right; width: 300px; display: inline;">
                        <?php
                        $args = array('numberposts' => 1, 'offset' => 3, 'exclude' => 51);
                        $lastposts = get_posts($args);
                        foreach ($lastposts as $post) : setup_postdata($post);
                            ?>

                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="authorname"><p>Written By: <a
                                        href="<?php the_author(); ?>"><?php the_author(); ?></a></p></div>
                            <div style="margin-top: 10px;"></div>
                            <div class="innerpostexcerpt"><?php the_excerpt(); ?></div>
                            <br>
                            <div id="social">
                                <div style="float: left; margin-left: 10px;"><a href="https://twitter.com/share"
                                                                                class="twitter-share-button"
                                                                                data-count="horizontal">Tweet</a>
                                    <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                                </div>
                                <div class="fb-like" data-send="true" data-layout="button_count" data-width="150"
                                     data-show-faces="false"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <span class="clearfix"></span>

                    <div class="columns blog_page_top_post" style="float: left; width: 300px;">
                        <?php
                        $args = array('numberposts' => 1, 'offset' => 4, 'exclude' => 51);
                        $lastposts = get_posts($args);
                        foreach ($lastposts as $post) : setup_postdata($post);
                            ?>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="authorname"><p>Written By: <a
                                        href="<?php the_author(); ?>"><?php the_author(); ?></a></p></div>
                            <div style="margin-top: 10px;"></div>
                            <div class="innerpostexcerpt"><?php the_excerpt(); ?></div>
                            <br>
                            <div id="social">
                                <div style="float: left; margin-left: 10px;"><a href="https://twitter.com/share"
                                                                                class="twitter-share-button"
                                                                                data-count="horizontal">Tweet</a>
                                    <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                                </div>
                                <div class="fb-like" data-send="true" data-layout="button_count" data-width="150"
                                     data-show-faces="false"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="columns blog_page_top_post" style="float: right; width: 300px; display: inline;">
                        <?php
                        $args = array('numberposts' => 1, 'offset' => 5, 'exclude' => 51);
                        $lastposts = get_posts($args);
                        foreach ($lastposts as $post) : setup_postdata($post);
                            ?>

                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="authorname"><p>Written By: <a
                                        href="<?php the_author(); ?>"><?php the_author(); ?></a></p></div>
                            <div style="margin-top: 10px;"></div>
                            <div class="innerpostexcerpt"><?php the_excerpt(); ?></div>
                            <br>
                            <div id="social">
                                <div style="float: left; margin-left: 10px;"><a href="https://twitter.com/share"
                                                                                class="twitter-share-button"
                                                                                data-count="horizontal">Tweet</a>
                                    <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                                </div>
                                <div class="fb-like" data-send="true" data-layout="button_count" data-width="150"
                                     data-show-faces="false"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="secondary" class="widget-area">
                        <?php if (is_active_sidebar('primary-widget-area')) : ?>
                            <?php dynamic_sidebar('primary-widget-area'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>

<div id="footer">
    <?php get_footer('public-blog'); ?>
</div>