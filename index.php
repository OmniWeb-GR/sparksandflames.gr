<?php
    defined('_JEXEC') or die;
    use Joomla\CMS\Factory;
    $app = Factory::getApplication();
    $option = $app->input->getCmd('option', '');
    $view = $app->input->getCmd('view', '');
    $layout = $app->input->getCmd('layout', '');
    $task = $app->input->getCmd('task', '');
    $itemid = $app->input->getCmd('Itemid', '');
    $sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
    $menu = $app->getMenu()->getActive();
    $pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';
	$lang = explode('-', $this->language);
	$containerclass = $this->params->get('container-class');
	$version = $this->params->get('version');
	if ($this->params->get('sticky-header') == 1) {
		$respstickyheader = $this->params->get('responsive-sticky-header');
		$headerclass = '';
		if ($respstickyheader == 1) {
			$headerclass = 'sticky-top';
		}
		elseif ($respstickyheader == 2) {
			$headerclass = 'sticky-sm-top';
		}
		elseif ($respstickyheader == 3) {
			$headerclass = 'sticky-md-top';
		}
		elseif ($respstickyheader == 4) {
			$headerclass = 'sticky-lg-top';
		}
		elseif ($respstickyheader == 5) {
			$headerclass = 'sticky-xl-top';
		}
	}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang[0]; ?>" dir="<?php echo $this->direction; ?>">
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <jdoc:include type="metas"/>
		<style>
			/* critical CSS */
		</style>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css?v=<?php echo $version; ?>" media="print" onload="this.media='all'">>
    </head>
    <body class="<?php echo $option . ' ' . $view . ($layout ? ' layout-' . $layout : ' no-layout') . ($task ? ' task-' . $task : ' no-task') . ($itemid ? ' itemid-' . $itemid : '') . ($pageclass ? ' ' . $pageclass : '') . ($this->direction == 'rtl' ? ' rtl' : ''); ?>">
		<?php if ($this->countModules('header')): ?>
			<header class="header <?php echo $headerclass; ?>">
                <div class="<?php echo $containerclass; ?>">
                    <div class="row">
                        <jdoc:include type="modules" name="header" style="html5"/>
                    </div>
                </div>
            </header>
		<?php endif; ?>
        <?php if ($this->countModules('below-header')): ?>
			<div class="<?php echo $containerclass; ?>">
                <div class="row">
                    <jdoc:include type="modules" name="below-header" style="html5"/>
                </div>
            </div>
		<?php endif; ?>
        <?php if (($this->countModules('left-sidebar')) && ($this->countModules('right-sidebar'))): ?>
			<div class="<?php echo $containerclass; ?>">
				<div class="row">
					<aside class="col-auto">
						<jdoc:include type="modules" name="left-sidebar" style="html5"/>
					</aside>
					<div class="col">
						<jdoc:include type="modules" name="above-main" style="html5"/>
						<main>
							<?php if ($this->countModules('content')): ?>
								<jdoc:include type="modules" name="content" style="html5"/>
							<?php else: ?>
								<jdoc:include type="component"/>
							<?php endif; ?>
						</main>
						<jdoc:include type="modules" name="below-main" style="html5"/>
					</div>
					<aside class="col-auto">
						<jdoc:include type="modules" name="right-sidebar" style="html5"/>
					</aside>
				</div>
			</div>
		<?php elseif ($this->countModules('left-sidebar')): ?>
			<div class="<?php echo $containerclass; ?>">
				<div class="row">
					<aside class="col-auto">
						<jdoc:include type="modules" name="left-sidebar" style="html5"/>
					</aside>
					<div class="col">
						<jdoc:include type="modules" name="above-main" style="html5"/>
						<main>
							<?php if ($this->countModules('content')): ?>
								<jdoc:include type="modules" name="content" style="html5"/>
							<?php else: ?>
								<jdoc:include type="component"/>
							<?php endif; ?>
						</main>
						<jdoc:include type="modules" name="below-main" style="html5"/>
					</div>
				</div>
			</div>
		<?php elseif ($this->countModules('right-sidebar')): ?>
			<div class="<?php echo $containerclass; ?>">
				<div class="row">
					<div class="col">
						<jdoc:include type="modules" name="above-main" style="html5"/>
						<main>
							<?php if ($this->countModules('content')): ?>
								<jdoc:include type="modules" name="content" style="html5"/>
							<?php else: ?>
								<jdoc:include type="component"/>
							<?php endif; ?>
						</main>
						<jdoc:include type="modules" name="below-main" style="html5"/>
					</div>
					<aside class="col-auto">
						<jdoc:include type="modules" name="right-sidebar" style="html5"/>
					</aside>
				</div>
			</div>
        <?php else: ?>
			<jdoc:include type="modules" name="above-main" style="html5"/>
			<div class="<?php echo $containerclass; ?>">
				<main>
					<?php if ($this->countModules('content')): ?>
						<jdoc:include type="modules" name="content" style="html5"/>
					<?php else: ?>
						<jdoc:include type="component"/>
					<?php endif; ?>
				</main>
			</div>
			<jdoc:include type="modules" name="below-main" style="html5"/>
        <?php endif; ?>
        <?php if ($this->countModules('above-footer')): ?>
			<div class="<?php echo $containerclass; ?>">
                <div class="row">
                    <jdoc:include type="modules" name="above-footer" style="html5"/>
                </div>
            </div>
		<?php endif; ?>
        <?php if ($this->countModules('footer')): ?>
			<footer class="footer">
                <div class="<?php echo $containerclass; ?>">
                    <div class="row">
                        <jdoc:include type="modules" name="footer" style="html5"/>
                    </div>
                </div>
            </footer>
		<?php endif; ?>
		<?php if ($this->countModules('fixed-bottom')): ?>
			<div class="fixed-bottom">
				<jdoc:include type="modules" name="fixed-bottom" style="html5"/>
			</div>
		<?php endif; ?>
		<?php if (($this->countModules('offcanvas-header')) || ($this->countModules('offcanvas-body'))): ?>
			<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" aria-label="Label"></button>
			<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
				<?php if ($this->countModules('offcanvas-header')): ?>
					<div class="offcanvas-header">
						<jdoc:include type="modules" name="offcanvas-header" style="html5"/>
						<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
				<?php endif; ?>
				<?php if ($this->countModules('offcanvas-body')): ?>
					<div class="offcanvas-body">
						<jdoc:include type="modules" name="offcanvas-body" style="html5"/>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/template.js?v=<?php echo $version; ?>"></script>
    </body>
</html>