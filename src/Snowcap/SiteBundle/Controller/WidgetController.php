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
     * @Template()
     */
    public function tweetsAction()
    {
        $twitter = $this->get('twitter');
        $content = $twitter->get("statuses/user_timeline", array('count' => 3));
        $tweets = array();
        foreach($content as $tweet) {
            $tweets[] = array(
                'date' => new \DateTime($tweet->created_at),
                'text' => $tweet->text,
            );
        }
        return array('tweets' => $tweets);
    }
}
