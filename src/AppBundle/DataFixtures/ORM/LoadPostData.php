<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GuzzleHttp;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $client = new GuzzleHttp\Client();
        $response = $client->request('GET', 'http://api.giphy.com/v1/gifs/search?q=funny+cat&api_key=dc6zaTOxFJmzC');

        $result = json_decode($response->getBody(), true);

        foreach ($result['data'] as $gif) {
            $post = new Post();

            $post->setIsPublished(true);
            $post->setCreatedAt(new \DateTime());
            $post->setTitle($gif['slug']);
            $post->setUrl($gif['images']['fixed_width']['url']);

            $manager->persist($post);
            $manager->flush();
        }
    }
}
