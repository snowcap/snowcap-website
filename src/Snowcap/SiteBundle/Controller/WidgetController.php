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
     * @Route("/tweets", name="snwcp_widget_tweets")
     * @Template()
     */
    public function tweetsAction()
    {
        $tweets = array();
        try {
            $relative_filename = __DIR__ . '/../../../../web/uploads/twitter.json';
            $filename = realpath($relative_filename);
            if (!$filename) {
                touch($relative_filename);
                $filename = realpath($relative_filename);
            }
            /*if (!$this->getRequest()->isXmlHttpRequest()) {
                $tweets = json_decode(file_get_contents($filename), true);
            } else {*/
                $twitter = $this->get('twitter');
                //$result = $twitter->get('search.json?q=snwcp&rpp='.  $this->container->getParameter('twitter_limit') .'&');
                $mentions = $twitter->get('statuses/mentions_timeline');

                if (count($mentions) > 0) {
                    foreach ($mentions as $tweet) {
                        $date = new \DateTime($tweet->created_at);
                        $tweets[$date->format('U')] = array(
                            'date' => $date->format('U'),
                            'text' => $tweet->text,
                            'from_user' => $tweet->user->name,
                            'from_username' => $tweet->user->screen_name,
                        );
                    }
                }

                $timeline = $twitter->get('statuses/user_timeline');
                if (count($timeline) > 0) {
                    foreach ($timeline as $tweet) {
                        $date = new \DateTime($tweet->created_at);
                        $tweets[$date->format('U')] = array(
                            'date' => $date->format('U'),
                            'text' => $tweet->text,
                            'from_user' => $tweet->user->name,
                            'from_username' => $tweet->user->screen_name,
                        );
                    }
                }


                if (count($tweets) > 0) {
                    krsort($tweets);
                    file_put_contents($filename, json_encode($tweets));
                } else {
                    $tweets = json_decode(file_get_contents($filename), true);
                }
            //}
        } catch(\Exception $e) {
            error_log($e);
        }

        return array('tweets' => $tweets);
    }

}
