<?php
namespace Sitemap\View;

use Cake\Network\Exception\NotFoundException;
use Cake\View\View;
use Sitemap\Controller\Component\SitemapComponent;

class SitemapXmlView extends View
{
    public function render($view = null, $layout = null)
    {
        $this->viewPath = 'Sitemap';
        $this->subDir = 'xml';

        $type = $layout;
        $view = 'Sitemap.' . $type;
        if ($view === null || $layout === 'googlesitemap') {
            $type = $this->get('type', SitemapComponent::TYPE_SITEMAP);
            $type = 'googlesitemap';
            $view = 'Sitemap.' . $type;
        }

        return parent::render($view, false);
    }
} 