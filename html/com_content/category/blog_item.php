<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

// Create a shortcut for params.
$params = $this->item->params;
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (Associations::isEnabled() && $params->get('show_associations'));

$currentDate   = Factory::getDate()->format('Y-m-d H:i:s');
$isUnpublished = ($this->item->state == ContentComponent::CONDITION_UNPUBLISHED || $this->item->publish_up > $currentDate)
	|| ($this->item->publish_down < $currentDate && $this->item->publish_down !== null);

?>

<div class="item-content row g-0">
	<?php if ($isUnpublished) : ?>
		<div class="system-unpublished">
	<?php endif; ?>

	<div class="col-lg-6 order-lg-last">
		<div class="ratio ratio-4x3">
			<?php if (LayoutHelper::render('joomla.content.intro_image', $this->item)) : ?>
				<?php echo LayoutHelper::render('joomla.content.intro_image', $this->item); ?>
			<?php else : ?>
				<?php if (LayoutHelper::render('joomla.content.full_image', $this->item)) : ?>
					<?php if ($params->get('link_intro_image') && ($params->get('access-view') || $params->get('show_noauth', '0') == '1')) : ?>
						<a class="bg-light rounded text-center" href="<?php echo Route::_(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)); ?>">
							<?php echo LayoutHelper::render('joomla.content.full_image', $this->item); ?>
						</a>
					<?php else : ?>
						<?php echo LayoutHelper::render('joomla.content.full_image', $this->item); ?>
					<?php endif; ?>
				<?php else : ?>
					<?php if ($params->get('link_intro_image') && ($params->get('access-view') || $params->get('show_noauth', '0') == '1')) : ?>
						<a class="bg-light rounded text-center" href="<?php echo Route::_(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)); ?>">
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
	</div>

	<div class="col-lg-6 d-flex align-items-center text-center text-lg-start order-lg-first">
		<div class="p-3 pb-0">
			<?php echo LayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>

			<?php if ($canEdit) : ?>
				<?php echo LayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item)); ?>
			<?php endif; ?>

			<?php // Todo Not that elegant would be nice to group the params ?>
			<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
				|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

			<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
				<?php // echo LayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
				<dl class="article-info">
				<?php if ($params->get('show_category')) : ?>
					<dd class="category-name">
						<?php $title = $this->escape($this->item->category_title); ?>
						<?php if ($params->get('link_category') && $this->item->catid) : ?>
							<?php $url = '<a href="' . Route::_(
								RouteHelper::getCategoryRoute($this->item->catid, $this->item->category_language)
								)
								. '" itemprop="genre">' . $title . '</a>'; ?>
							<?php echo Text::sprintf('COM_CONTENT_CATEGORY', $url); ?>
						<?php else : ?>
							<?php echo Text::sprintf('COM_CONTENT_CATEGORY', '<span itemprop="genre">' . $title . '</span>'); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_publish_date')) : ?>
					<dd class="published">
						<time datetime="<?php echo HTMLHelper::_('date', $displayData['item']->publish_up, 'c'); ?>" itemprop="datePublished">
							<?php echo Text::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', HTMLHelper::_('date', $displayData['item']->publish_up, Text::_('DATE_FORMAT_LC3'))); ?>
						</time>
					</dd>
				<?php endif; ?>
				</dl>
			<?php endif; ?>
			<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
				<?php // echo LayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
			<?php endif; ?>

			<?php if (!$params->get('show_intro')) : ?>
				<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
				<?php echo $this->item->event->afterDisplayTitle; ?>
			<?php endif; ?>

			<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
			<?php echo $this->item->event->beforeDisplayContent; ?>

			<?php echo $this->item->introtext; ?>

			<?php if ($info == 1 || $info == 2) : ?>
				<?php if ($useDefList) : ?>
					<?php // echo LayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
				<?php endif; ?>
				<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
					<?php // echo LayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ($params->get('show_readmore') && $this->item->readmore) :
				if ($params->get('access-view')) :
					$link = Route::_(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
				else :
					$menu = Factory::getApplication()->getMenu();
					$active = $menu->getActive();
					$itemId = $active->id;
					$link = new Uri(Route::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false));
					$link->setVar('return', base64_encode(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)));
				endif; ?>

				<?php echo LayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>

			<?php endif; ?>
		</div>
	</div>

	<?php if ($isUnpublished) : ?>
		</div>
	<?php endif; ?>

	<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
	<?php echo $this->item->event->afterDisplayContent; ?>
</div>