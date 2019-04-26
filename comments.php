<?php

	/**
	 * Partial: Comments component, including comment form
	 *
	 * @category 	Additional WordPress template files
	 * @package  	scenic
	 * @author  	Andi North <andi@mangopear.co.uk>
	 * @copyright  	2017 Mangopear creative
	 * @license   	GNU General Public License <http://opensource.org/licenses/gpl-license.php>
	 * @link 		https://mangopear.co.uk/
	 * @version  	3.0.0
	 * @since   	3.0.0
	 */
	

	/**
	 * Security protections, including password protection
	 */
	
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) :
		die('You can\'t access this file directly. You naughty little thing, you!');


		if (! empty($post->$post_password)) :
			if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) :
				echo '<p>This post is password protected. Enter the password to view comments.</p>';
				return;
			endif;
		endif;
	endif;
	
?>


	<section class="o-panel  o-panel--comments">
		<div class="o-container">
			<header class="c-comments__header">
				<h2 class="c-comments__header__title">
					<?php comments_number('No reviews', '1 review', '% reviews'); ?>


					<?php if (get_post_meta(get_the_ID(), 'scenic_review_rating', 1) AND get_post_meta(get_the_ID(), 'scenic_review_rating', 1) != 'nan') : ?>
						<span class="c-comments__header__ratings">
							<?php scenic_output_rating_stars(get_the_ID()); ?>
							<span class="c-comments__header__ratings__total">(<?php echo get_post_meta(get_the_ID(), 'scenic_review_rating', 1); ?>)</span>
						</span>
					<?php endif; ?>
				</h2>


				<?php if ($post->comment_status == 'open') : ?>
					<?php if (get_option('comment_registration') && ! $user_ID) : ?>
						<a href="<?php echo wp_login_url(get_permalink()); ?>" class="o-button  o-button--secondary  c-comments__header__action">
							<svg class="o-button__icon  o-button__icon--left" height="24" width="24" role="presentation"><use xlink:href="<?php echo MANGOPEAR_SPRITE; ?>#add"/></svg>
							<span class="o-button__text">Add a Review</span>
						</a>
					<?php else : ?>
						<button class="o-button  o-button--secondary  c-comments__header__action  js-comments__action--reveal-form">
							<svg class="o-button__icon  o-button__icon--left" height="24" width="24" role="presentation"><use xlink:href="<?php echo MANGOPEAR_SPRITE; ?>#add"/></svg>
							<span class="o-button__text">Add a Review</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>
			</header>





			<section class="c-comments__form-wrap  js-comments__reveal-form  is-hidden">
				<?php

					$comment_form__args = array(
						'fields'				=> 	array(
														'author'	=>	'<div class="o-field  o-field--inline  o-field--name">' .
																			'<label for="author" class="o-field__label  js-o-field__label">Your name: ' . ($req ? '<span class="required">*</span>' : '') . '</label>' .
																			'<div class="o-field__input  js-o-field__input"><input type="text" id="author" name="author" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $html_req . '></div>' .
																		'</div>',
														'email'		=>	'<div class="o-field  o-field--inline  o-field--email">' .
																			'<label for="email" class="o-field__label  js-o-field__label">Your email address: ' . ($req ? '<span class="required">*</span>' : '') . '</label>' .
																			'<div class="o-field__input  js-o-field__input"><input type="email" id="email" name="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $html_req . '></div>' .
																		'</div>',
														'url'		=>	'<div class="o-field  o-field--inline  o-field--url">' .
																			'<label for="url" class="o-field__label  js-o-field__label">Your website: </label>' .
																			'<div class="o-field__input  js-o-field__input"><input type="url" id="url" name="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200"></div>' .
																		'</div>',
													),
						'comment_field'			=> 	'<div class="o-field  o-field--comment">' .
														'<label for="comment" class="o-field__label  js-o-field__label">Your review: ' . ($req ? '<span class="required">*</span>' : '') . '</label>' .
														'<div class="o-field__input  js-o-field__input"><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></div>' .
													'</div>',
						'title_reply'			=> 	'Leave a review',
						'title_reply_to'		=> 	'Reply to %s',
						'class_form'			=> 	'c-comments__form',
						'submit_button'			=> 	'<button class="o-button  o-button--primary  c-comments__header__action  js-comments__action--reveal-form">' .
														'<span class="o-button__text">Post review</span>' .
														'<svg class="o-button__icon  o-button__icon--right" height="24" width="24" role="presentation"><use xlink:href="' . MANGOPEAR_SPRITE . '#arrow--right"/></svg>' .
													'</button>',
						'submit_field'			=> 	'<div class="o-form__submit">' .
														'<div class="o-form__button">%1$s %2$s' .
														'</div>' .
													'</div>',
						'format'				=> 	'html5',
					);


					comment_form($comment_form__args);

				?>
			</section>





			<?php if (! $comments) : ?>
				<?php if ($post->comment_status == 'open') : ?>
					<section class="c-comments__comments  c-comments__comments--empty">
						<div class="c-comments__state-message">
							<p>
								<strong>Start the conversation.</strong>
								<br>Be the first to review this route.
							</p>
						</div>
					</section>


				<?php else : ?>
					<section class="c-comments__comments  c-comments__comments--empty">
						<div class="c-comments__state-message">
							<p>
								<strong>Reviews are closed.</strong>
								<br>You will not be able to post a review.
							</p>
						</div>
					</section>
				<?php endif; ?>





			<?php else : ?>
				<section class="c-comments__comments">
					<ul class="c-comments__list">
						<?php foreach ($comments as $comment) : ?>
							<?php $comment_rating = get_field('comments__rating', $comment); ?>
							<li class="c-comments__item" id="comment-<?php comment_ID(); ?>">
								<article class="c-comments__comment">
									<div class="c-comments__comment__content">
										<?php if (get_field('comments__title', $comment) OR get_field('comments__rating', $comment)) : ?>
											<h3 class="c-comment__title">
												<?php if ($comment_rating) : ?>
													<span class="c-comment__title__stars" data-rating="<?php echo round($comment_rating['value'], 0); ?>">
														<?php echo $comment_rating['label']; ?>
													</span>
												<?php endif; ?>


												<?php if (get_field('comments__title', $comment)) : the_field('comments__title', $comment); endif; ?>
											</h3>
										<?php endif; ?>


										<?php

											if ($comment->comment_approved == '0') : echo '<p>Your comment is awaiting moderation.</p>';
											else                                   : comment_text();
											endif;

										?>
									</div>


									<footer class="c-comments__comment__footer">
										<div class="c-comments__comment__author">
											<div class="c-comments__comment__author__avatar"><?php echo get_avatar($comment, '96'); ?></div>


											<p class="c-comments__comment__author__name">
												<span class="c-comments__comment__author__name-link"><?php comment_author_link() ?></span>
												<br>
												<a href="#comment-<?php comment_ID() ?>" class="c-comments__comment__date" title="Link directly to this comment">
													<time datetime="" class="c-comment__date"><?php comment_date('F jS, Y') ?> at <?php comment_time() ?></time>
												</a>
											</p>
										</div>
									</footer>
								</article>
							</li>
						<?php endforeach; ?>
					</ul>
				</section>


			<?php endif; ?>
		</div><!-- /.o-container -->
	</section>