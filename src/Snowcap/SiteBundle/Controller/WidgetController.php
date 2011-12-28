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
        $tweets = array();
        try {
            $relative_filename = __DIR__ . '/../../../../web/uploads/twitter.json';
            $filename = realpath($relative_filename);
            if (!$filename) {
                touch($relative_filename);
                $filename = realpath($relative_filename);
            }
            $twitter = $this->get('twitter');
            //$result = $twitter->get('search.json?q=snwcp&rpp='.  $this->container->getParameter('twitter_limit') .'&');
            $result = $twitter->get('statuses/mentions');

            if (count($result) > 0) {
                foreach ($result as $tweet) {
                    //$this->get('logger')->info(var_export($tweet, true));
                    $date = new \DateTime($tweet->created_at);
                    $this->get('logger')->info(var_export($result, true));
                    $tweets[] = array(
                        'date' => $date->format('U'),
                        'text' => $tweet->text,
                        'from_user' => $tweet->user->name,
                    );
                }
                file_put_contents($filename, json_encode($tweets));
            } else {
                $tweets = json_decode(file_get_contents($filename), false);
            }
        } catch(\Exception $e) {
            error_log($e);
        }
        return array('tweets' => $tweets);
    }

}
