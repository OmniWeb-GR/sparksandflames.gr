<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;

if (!$list)
{
	return;
}

?>
<div class="mod-articleslatest latestnews mod-list row g-3">
<?php foreach ($list as $item) : ?>
	<div class="col-md-4" itemscope itemtype="https://schema.org/Article">
		<div class="card bg-transparent border-light h-100 text-center">
			<div class="ratio ratio-4x3">
				<?php if (LayoutHelper::render('joomla.content.intro_image', $item)) : ?>
					<?php echo LayoutHelper::render('joomla.content.intro_image', $item); ?>
				<?php else : ?>
					<?php if (LayoutHelper::render('joomla.content.full_image', $item)) : ?>
						<?php if ($params->get('link_intro_image') && ($params->get('access-view') || $params->get('show_noauth', '0') == '1')) : ?>
							<a class="bg-light rounded text-center" href="<?php echo Route::_(RouteHelper::getArticleRoute($item->slug, $item->catid, $item->language)); ?>">
								<?php echo LayoutHelper::render('joomla.content.full_image', $item); ?>
							</a>
						<?php else : ?>
							<?php echo LayoutHelper::render('joomla.content.full_image', $item); ?>
						<?php endif; ?>
					<?php else : ?>
						<?php if ($params->get('link_intro_image') && ($params->get('access-view') || $params->get('show_noauth', '0') == '1')) : ?>
							<a class="bg-light rounded text-center" href="<?php echo Route::_(RouteHelper::getArticleRoute($item->slug, $item->catid, $item->language)); ?>">
								<figure class="figure mb-0 h-100">
									<img class="figure-img img-fluid rounded mb-0" src="/images/logo.webp" alt="Sparks & Drops" itemprop="image" width="500" height="500" loading="lazy">
								</figure>
							</a>
						<?php else : ?>
							<figure class="figure mb-0 h-100">
								<img class="figure-img img-fluid rounded mb-0" src="/images/logo.webp" alt="Sparks & Drops" itemprop="image" width="500" height="500" loading="lazy">
							</figure>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<div class="card-body">
				<a href="<?php echo $item->link; ?>" class="text-decoration-none" itemprop="url">
					<h3 class="card-title mb-0" itemprop="name">
						<?php echo $item->title; ?>
					</h3>
				</a>
			</div>
			<div class="card-footer bg-transparent border-0 pt-0 pb-3">
				<?php echo LayoutHelper::render('joomla.content.readmore', array('item' => $item, 'params' => $params, 'link' => $item->link)); ?>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>





