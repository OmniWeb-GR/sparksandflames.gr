<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2014 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$params    = $displayData['params'];
$item      = $displayData['item'];
$direction = Factory::getLanguage()->isRtl() ? 'left' : 'right';
$app = Factory::getApplication();
$menu = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';
?>

<p class="readmore">
	<?php if (!$params->get('access-view') && ($pageclass != 'home')) : ?>
		<a class="btn btn-light text-black" href="<?php echo $displayData['link']; ?>" aria-label="<?php echo Text::_('JGLOBAL_REGISTER_TO_READ_MORE') . ' ' . $this->escape($item->title); ?>">
			<?php echo Text::_('JGLOBAL_REGISTER_TO_READ_MORE'); ?>
		</a>
	<?php elseif (($readmore = $item->alternative_readmore) && ($pageclass != 'home')) : ?>
		<a class="btn btn-light text-black" href="<?php echo $displayData['link']; ?>" aria-label="<?php echo $this->escape($readmore . ' ' . $item->title); ?>">
			<?php echo $readmore; ?>
			<?php if ($params->get('show_readmore_title', 0) != 0) : ?>
				<?php echo HTMLHelper::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
			<?php endif; ?>
		</a>
	<?php elseif (($params->get('show_readmore_title', 0)) || ($pageclass == 'home')) : ?>
		<a class="btn btn-light text-black" href="<?php echo $displayData['link']; ?>" aria-label="<?php echo Text::sprintf('JGLOBAL_READ_MORE_TITLE', $this->escape($item->title)); ?>">
			<?php echo Text::_('JGLOBAL_READ_MORE'); ?>
		</a>
	<?php else : ?>
		<a class="btn btn-light text-black" href="<?php echo $displayData['link']; ?>" aria-label="<?php echo Text::sprintf('JGLOBAL_READ_MORE_TITLE', $this->escape($item->title)); ?>">
			<?php echo Text::_('JGLOBAL_READ_MORE'); ?>
		</a>
	<?php endif; ?>
</p>
