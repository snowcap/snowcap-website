<?php
namespace Snowcap\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\SiteBundle\Entity\Post;

class WidgetController extends Controller
{
    /**
     * Action used to render the 3 last tweets of Snowcap
     * 
     * @Template()
     */
    public function tweetsAction()
    {
        $ch = curl_init("http://api.twitter.com/1/statuses/user_timeline.json?screen_name=snwcp&count=3");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($result);
        $tweets = array();
        if (is_array($json)) {
            foreach ($json as $tweet) {
                $tweets[] = array(
                    'date' => new \DateTime($tweet->created_at),
                    'text' => $tweet->text,
                );

            }
        }

        return array('tweets' => $tweets);
    }

}
