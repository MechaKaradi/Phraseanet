<?php

/*
 * This file is part of Phraseanet
 *
 * (c) 2005-2013 Alchemy
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alchemy\Phrasea\Controller\Prod;

use Alchemy\Phrasea\Controller\RecordsRequest;
use Alchemy\Phrasea\Feed\Aggregate;
use Alchemy\Phrasea\Feed\Link\AggregateLinkGenerator;
use Alchemy\Phrasea\Feed\Link\FeedLinkGenerator;
use Entities\FeedEntry;
use Entities\FeedItem;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 *
 * @license     http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link        www.phraseanet.com
 */
class Feed implements ControllerProviderInterface
{

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->before(function(Request $request) use ($app) {
            $app['firewall']->requireAuthentication();
        });

        /**
         * I got a selection of docs, which publications are available forthese docs ?
         */
        $controllers->post('/requestavailable/', function(Application $app, Request $request) {
            $feeds = $app['EM']->getRepository('Entities\Feed')->getAllForUser($app['authentication']->getUser());
            $publishing = RecordsRequest::fromRequest($app, $request, true, array(), array('bas_chupub'));

            return $app['twig']->render('prod/actions/publish/publish.html.twig', array('publishing' => $publishing, 'feeds' => $feeds));
        });

        /**
         * I've selected a publication for my docs, let's publish them
         */
        $controllers->post('/entry/create/', function(Application $app, Request $request) {
            try {
                $feed = $app['EM']->getRepository('Entities\Feed')->find($request->request->get('feed_id'));
                $publisher = $app['EM']->getRepository('Entities\FeedPublisher')->findByUser($feed, $app['authentication']->getUser());
                $title = $request->request->get('title');
                $subtitle = $request->request->get('subtitle');
                $author_name = $request->request->get('author_name');
                $author_email = $request->request->get('author_mail');

                $entry = new FeedEntry();
                $entry->setFeed($feed);
                $entry->setPublisher($publisher);
                $entry->setTitle($title);
                $entry->setSubtitle($subtitle);
                $entry->setAuthorName($author_name);
                $entry->setAuthorEmail($author_email);

                $feed->addEntry($entry);

                $publishing = RecordsRequest::fromRequest($app, $request, true, array(), array('bas_chupub'));
                foreach ($publishing as $record) {
                    $item = new FeedItem();
                    $item->setEntry($entry);
                    $item->setRecordId($record->get_record_id());
                    $item->setSbasId($record->get_sbas_id());
                    $item->setLastInFeedItem();
                    $entry->addItem($item);
                    $app['EM']->persist($item);
                }

                $app['EM']->persist($entry);
                $app['EM']->persist($feed);
                $app['EM']->flush();

                $app['events-manager']->trigger('__FEED_ENTRY_CREATE__', array('entry_id' => $entry->getId()), $entry);

                $datas = array('error' => false, 'message' => false);
            } catch (\Exception $e) {
                $datas = array('error' => true, 'message' => _('An error occured'), 'details' => $e->getMessage());
            }

            return $app->json($datas);
        })
            ->bind('prod_feeds_entry_create')
            ->before(function(Request $request) use ($app) {
                $app['firewall']->requireRight('bas_chupub');
            });

        $controllers->get('/entry/{id}/edit/', function(Application $app, Request $request, $id) {
            $entry = $app['EM']->getRepository('Entities\FeedEntry')->find($id);

            if (!$entry->isPublisher($app['authentication']->getUser())) {
                throw new AccessDeniedHttpException();
            }

            $feeds = $app['EM']->getRepository('Entities\Feed')->findAll();

            $datas = $app['twig']->render('prod/actions/publish/publish_edit.html.twig', array('entry' => $entry, 'feeds' => $feeds));

            return new Response($datas);
        })
            ->bind('feed_entry_edit')
            ->assert('id', '\d+')
            ->before(function(Request $request) use ($app) {
                $app['firewall']->requireRight('bas_chupub');
            });

        $controllers->post('/entry/{id}/update/', function(Application $app, Request $request, $id) {
            $datas = array('error' => true, 'message' => '', 'datas' => '');
            $entry = $app['EM']->getRepository('Entities\FeedEntry')->find($id);

            if (null === $entry) {
                $app->abort(404, 'Entry not found');
            }
            if (!$entry->isPublisher($app['authentication']->getUser())) {
                $app->abort(403, 'Unathorized action');
            }

            $title = $request->request->get('title');
            $subtitle = $request->request->get('subtitle');
            $author_name = $request->request->get('author_name');
            $author_mail = $request->request->get('author_mail');

            $entry->setAuthorEmail($author_mail)
                ->setAuthorName($author_name)
                ->setTitle($title)
                ->setSubtitle($subtitle);

            $current_feed_id = $entry->getFeed()->getId();
            $new_feed_id = $request->request->get('feed_id', $current_feed_id);
            if ($current_feed_id != $new_feed_id) {

                $new_feed = $app['EM']->getRepository('Entities\Feed')->find($new_feed_id);

                if ($new_feed === null) {
                    $app->abort(404, 'Feed not found');
                }

                if (!$new_feed->isPublisher($app['authentication']->getUser())) {
                    $app->abort(403, 'You are not publisher of this feed');
                }
                $entry->setFeed($new_feed);
            }

            $items = explode(';', $request->request->get('sorted_lst'));

            foreach ($items as $item_sort) {
                $item_sort_datas = explode('_', $item_sort);
                if (count($item_sort_datas) != 2) {
                    continue;
                }

                $item = new FeedItem();
                $item->setEntry($entry);
                $entry->addItem($item);
                $item->setOrd($item_sort_datas[1]);
                $app['EM']->persist($item);
            }

            $app['EM']->persist($entry);
            $app['EM']->flush();

            $entry = $app['twig']->render('prod/feeds/entry.html.twig', array('entry' => $entry));

            $datas = array('error' => false, 'message' => 'succes', 'datas' => $entry);

            return $app->json($datas);
        })
            ->bind('prod_feeds_entry_update')
            ->assert('id', '\d+')->before(function(Request $request) use ($app) {
                $app['firewall']->requireRight('bas_chupub');
            });

        $controllers->post('/entry/{id}/delete/', function(Application $app, Request $request, $id) {
            $datas = array('error' => true, 'message' => '');

            $entry = $app['EM']->getRepository('Entities\FeedEntry')->find($id);

            if (null === $entry) {
                $app->abort(404, 'Entry not found');
            }
            if (!$entry->isPublisher($app['authentication']->getUser()) && $entry->getFeed()->isOwner($app['authentication']->getUser()) === false) {
                $app->abort(403, _('Action Forbidden : You are not the publisher'));
            }

            $app['EM']->remove($entry);
            $app['EM']->flush();

            $datas = array('error' => false, 'message' => 'succes');

            return $app->json($datas);
        })
            ->bind('feed_entry_delete')
            ->assert('id', '\d+')->before(function(Request $request) use ($app) {
                $app['firewall']->requireRight('bas_chupub');
            });

        $controllers->get('/', function(Application $app, Request $request) {
            $request = $app['request'];
            $page = (int) $request->query->get('page');
            $page = $page > 0 ? $page : 1;

            $feeds = $app['EM']->getRepository('Entities\Feed')->findAll();

            $datas = $app['twig']->render('prod/feeds/feeds.html.twig'
                , array(
                'feeds' => $feeds
                , 'feed' => new Aggregate($app['EM'], $feeds)
                , 'page' => $page
                )
            );

            return new Response($datas);
        })->bind('prod_feeds');

        $controllers->get('/feed/{id}/', function(Application $app, Request $request, $id) {
            $page = (int) $request->query->get('page');
            $page = $page > 0 ? $page : 1;

            $feed = $app['EM']->getRepository('Entities\Feed')->loadWithUser($app, $app['authentication']->getUser(), $id);
            $feeds = $app['EM']->getRepository('Entities\Feed')->findAll();

            $datas = $app['twig']->render('prod/feeds/feeds.html.twig', array('feed' => $feed, 'feeds' => $feeds, 'page' => $page));

            return new Response($datas);
        })
            ->bind('prod_feeds_feed')
            ->assert('id', '\d+');

        $controllers->get('/subscribe/aggregated/', function(Application $app, Request $request) {
            $renew = ($request->query->get('renew') === 'true');

            $feeds = $app['EM']->getRepository('Entities\Feed')->findAll();

            $aggregate = new Aggregate($app['EM'], $feeds);

            $link = $app['feed.aggregate-link-generator']->generate($aggregate, $app['authentication']->getUser(), AggregateLinkGenerator::FORMAT_RSS, null, $renew);

            $output = array(
                'texte' => '<p>' . _('publication::Voici votre fil RSS personnel. Il vous permettra d\'etre tenu au courrant des publications.')
                . '</p><p>' . _('publications::Ne le partagez pas, il est strictement confidentiel') . '</p>
            <div><input type="text" readonly="readonly" class="input_select_copy" value="' . $link->getURI() . '"/></div>',
                'titre' => _('publications::votre rss personnel')
            );

            return $app->json($output);
        })->bind('prod_feeds_subscribe_aggregated');

        $controllers->get('/subscribe/{id}/', function(Application $app, Request $request, $id) {
            $renew = ($request->query->get('renew') === 'true');

            $feed = $app['EM']->getRepository('Entities\Feed')->loadWithUser($app, $app['authentication']->getUser(), $id);

            $link = $app['feed.user-link-generator']->generate($feed, $app['authentication']->getUser(), FeedLinkGenerator::FORMAT_RSS, null, $renew);

            $output = array(
                'texte' => '<p>' . _('publication::Voici votre fil RSS personnel. Il vous permettra d\'etre tenu au courrant des publications.')
                . '</p><p>' . _('publications::Ne le partagez pas, il est strictement confidentiel') . '</p>
            <div><input type="text" style="width:100%" value="' . $link->getURI() . '"/></div>',
                'titre' => _('publications::votre rss personnel')
            );

            return $app->json($output);
        })
            ->bind('prod_feeds_subscribe_feed')
            ->assert('id', '\d+');

        return $controllers;
    }
}
