<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Data\Data;
use Grav\Common\Page\Page;
use Grav\Common\GPM\Response;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class FeedUsPlugin
 * @package Grav\Plugin
 */
class FeedUsPlugin extends Plugin
{

    private $template_html = 'partials/feedus.html.twig';
    private $template_vars = [];

    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main event we are interested in
        $this->enable([
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onTwigInitialized' => ['onTwigInitialized', 0],
#            'onPageContentRaw' => ['onPageContentRaw', 0]
        ]);
    }

    /**
     * Add Twig Extensions.
     */
    public function onTwigInitialized()
    {
        $this->grav['twig']->twig->addFunction(new \Twig_SimpleFunction('feedus_rss', [$this, 'getRss']));
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Do some work for this event, full details of events can be found
     * on the learn site: http://learn.getgrav.org/plugins/event-hooks
     *
     * @param Event $e
     */
    public function onPageContentRaw(Event $e)
    {
        // Get a variable from the plugin configuration
        $text = $this->grav['config']->get('plugins.feed-us.feed_url');

        // Get the current raw content
        $content = $e['page']->getRawContent();

        // Prepend the output with the custom text and set back on the page
        $e['page']->setRawContent($text . "\n\n" . $content);
    }

    public function getRss($params = [])
    {
        /** @var Page $page */
        $page = $this->grav['page'];
        /** @var Twig $twig */
        $twig = $this->grav['twig'];
        /** @var Data $config */
        $config = $this->mergeConfig($page, TRUE);

        $url = $this->grav['config']->get('plugins.feed-us.feed_url');

        $results = Response::get($url);

        $this->parseResponse($results);

        $this->template_vars = [
            'feed' => $this->feeds
        ];

        $output = $this->grav['twig']->twig()->render($this->template_html, $this->template_vars);

        return $output;
    }

    private function addFeed($result) {
        foreach ($result as $key => $val) {
            if (!isset($this->feeds[$key])) {
                $this->feeds[$key] = $val;
            }
        }
        krsort($this->feeds);
    }

    private function parseResponse($xmlstr) {
        $ns = array(
            'content' => 'http://purl.org/rss/1.0/modules/content/',
            'wfw' => 'http://wellformedweb.org/CommentAPI/',
            'dc' => 'http://purl.org/dc/elements/1.1/'
        );
        $r = array();
        $content = new \SimpleXMLElement($xmlstr);
        if (!empty($content->channel->item)){ $items=$content->channel->item; }
        if (!empty($content->entry)){ $items=$content->entry; }
        if (empty($items)){ return false; }
        foreach ($items as $item) {
            //$content = $item->children($ns['content']);
            if(!empty($item->pubDate)){ $timestamp = strtotime($item->pubDate); }
            if(!empty($item->published)){ $timestamp = strtotime($item->published); }
            if(!empty($item->title)){ $r[$timestamp]['title'] = $item->title; }
            if(!empty($item->link['href'])){ $r[$timestamp]['link'] = $item->link['href']; }
            if(!empty($item->link)){ $r[$timestamp]['link'] = $item->link; }
            if(!empty($item->description)){	$r[$timestamp]['description'] = $item->description; }
            //$r[$timestamp]['content'] = (string)trim($content->encoded);
        }
        $this->addFeed($r);
    }
}
