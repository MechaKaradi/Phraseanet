<?php

/*
 * This file is part of Phraseanet
 *
 * (c) 2005-2013 Alchemy
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Alchemy\Phrasea\Application;

class patch_380alpha2a implements patchInterface
{
    /** @var string */
    private $release = '3.8.0-alpha.2';

    /** @var array */
    private $concern = [base::APPLICATION_BOX];

    /**
     * {@inheritdoc}
     */
    public function get_release()
    {
        return $this->release;
    }

    /**
     * {@inheritdoc}
     */
    public function require_all_upgrades()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getDoctrineMigrations()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function concern()
    {
        return $this->concern;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(base $databox, Application $app)
    {
        $config = $app['configuration']->getConfig();

        if (isset($config['main']['database-test'])) {
            $config['main']['database-test']['path'] = '/tmp/db.sqlite';
        }

        $app['configuration']->setConfig($config);

        return true;
    }
}
