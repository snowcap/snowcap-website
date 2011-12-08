<?php
namespace Snowcap\SiteBundle\Twig\Extension;

use Twig_Environment;

class CoreExtension extends \Twig_Extension
{

    /** @var $app \Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables */
    private $app;

    public function initRuntime(Twig_Environment $environment)
    {
        $globals = $environment->getGlobals();
        if(isset($globals['app'])) {
            $this->app = $globals['app'];
        }
    }


    /**
     * Get all available functions
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'is_menu_active' => new \Twig_Function_Method($this, 'isMenuActive'),
        );
    }

    /**
     * Get all available filters
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'time_ago' => new \Twig_Filter_Method($this, 'timeAgo'),
            'age' => new \Twig_Filter_Method($this, 'age'),
            'safe_truncate' => new \Twig_Filter_Method($this, 'safeTruncate', array('is_safe' => array('html'))),
            'parse_tweet' => new \Twig_Filter_Method($this, 'parseTweet', array('is_safe' => array('html'))),
            'hr_columns' => new \Twig_Filter_Method($this, 'hrColumns', array('is_safe' => array('html'))),
        );
    }

    /**
     * Filter used to get a date interval between a date and now
     *
     * @param string|DateTime $datetime
     * @return \DateInterval
     */
    public function relativeTime($datetime = null, $format = 'ago')
    {
        if ($datetime === null) {
            return "";
        }

        if (is_string($datetime)) {
            $datetime = new \DateTime($datetime);
        }

        $current_date = new \DateTime();

        $interval = $current_date->diff($datetime);

        return $interval;

    }

    /**
     * Filter used to display the time ago for a specific date
     *
     * @param \Datetime|string $datetime
     * @return string
     */
    public function timeAgo($datetime) {
        $interval = $this->relativeTime($datetime);

        $years = $interval->format('%y');
        $months = $interval->format('%m');
        $days = $interval->format('%d');
        if ($years != 0) {
            $ago = $years . ' year(s) ago';
        } else {
            $ago = ($months == 0 ? $days . ' day(s) ago' : $months . ' month(s) ago');
        }

        return $ago;
    }

    /**
     * @param \Datetime|string $datetime
     * @return string
     */
    public function age($datetime) {
        $interval = $this->relativeTime($datetime);

        return $interval->format('%y');
    }

    /**
     * Filter used to safely truncate a string with html
     * @param string $value
     * @param int $length
     * @param bool $preserve
     * @param string $separator
     * @return string
     */
    public function safeTruncate($value, $length = 30, $preserve = true, $separator = ' ...')
    {
        if (strlen($value) > $length) {
            if ($preserve) {
                if (false !== ($breakpoint = strpos($value, ' ', $length))) {
                    $length = $breakpoint;
                }
            }

            return $this->closetags(substr($value, 0, $length) . $separator);
        }

        return $value;
    }

    /**
     * Helper used to close html tags
     *
     * @param string $html
     * @return string
     */
    private function closetags($html)
    {
        preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1]; #put all closed tags into an array

        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];

        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened) {
            return $html;
        }

        $openedtags = array_reverse($openedtags);
        for ($i = 0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</' . $openedtags[$i] . '>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }

        }
        return $html;
    }

    /**
     * Return true if the menu should be active
     * @param string $activeRoue
     * @param string $route
     * @return bool
     */
    public function isMenuActive($activeRoute, $route)
    {
        switch($activeRoute) {
            case 'snwcp_site_post_list':
            case 'snwcp_site_post_show':
                return $route === 'snwcp_site_post_list';
                break;
            case 'snwcp_site_project_index':
            case 'snwcp_site_project_show':
                return $route === 'snwcp_site_project_index';
                break;
            default:
                return $activeRoute === $route;
                break;
        }
    }

    /**
     * Parses tweets to make links to URL's, people and hashtags
     * @param string $tweet
     * @return string
     */
    public function parseTweet($tweet)
    {
        // links
        $tweet = preg_replace_callback(
            '/[a-z]+:\/\/[a-z0-9-_]+\.[a-z0-9-_:~%&\?\+#\/.=]+[^:\.,\)\s*$]/i',
            function($tweet) { return '<a href="'.$tweet[0].'">'.((strlen($tweet[0]) > 25) ? substr($tweet[0], 0, 24).'...' : $tweet[0]).'</a>'; },
            $tweet);

        // people
        $tweet = preg_replace_callback(
            '/(^|[^\w]+)\@([a-zA-Z0-9_]{1,15}(\/[a-zA-Z0-9-_]+)*)/',
            function($tweet) { return $tweet[1].'<a href="http://twitter.com/'.$tweet[2].'">@'.$tweet[2].'</a>'; },
            $tweet);

        // hashtags
        $tweet = preg_replace_callback(
            "/(^|[^&\w'\"]+)\#([a-zA-Z0-9_]+)/",
            function($tweet) { return $tweet[1].'#<a href="http://search.twitter.com/search?q=%23'.$tweet[2].'">'.$tweet[2].'</a>'; },
            $tweet);

        return $tweet;
    }

    /**
     * Converts <hr> tag to <div> column style
     *
     * @param string $content
     * @return string
     */
    public function hrColumns($content)
    {
        $content = '<div class="column">' .
            str_replace(array('<hr>', '<hr/>', '<hr />'), '</div><div class="column">', $content) .
            '</div>';
        return $content;
    }

    /**
     * Return the name of the extension
     *
     * @return string
     */
    public function getName()
    {
        return 'SnowcapSiteBundle';
    }
}



