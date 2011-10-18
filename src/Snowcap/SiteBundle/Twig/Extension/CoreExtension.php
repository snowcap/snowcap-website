<?php
namespace Snowcap\SiteBundle\Twig\Extension;

class CoreExtension extends \Twig_Extension
{

    /**
     * Get all available filters
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'relativeTime' => new \Twig_Filter_Method($this, 'relativeTime'),
            'safeTruncate' => new \Twig_Filter_Method($this, 'safeTruncate', array('is_safe' => array('html'))),
        );
    }

    /**
     * Filter used to display a datetime as a relative time
     *
     * @param DateTime $datetime
     * @return string
     */
    public function relativeTime($datetime = null)
    {

        if ($datetime === null) {
            return "";
        }

        $difference = time() - $datetime->getTimestamp();
        $periods = array("sec", "min", "hour", "day", "week", "month", "years", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        if ($difference > 0) { // this was in the past
            $ending = "ago";
        } else { // this was in the future
            $difference = -$difference;
            $ending = "to go";
        }
        for ($j = 0; $difference >= $lengths[$j]; $j++)
            $difference /= $lengths[$j];
        $difference = round($difference);
        if ($difference != 1)
            $periods[$j] .= "s";
        $text = "$difference $periods[$j] $ending";
        return $text;

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
     * Return the name of the extension
     * 
     * @return string
     */
    public function getName()
    {
        return 'SnowcapSiteBundle';
    }
}



