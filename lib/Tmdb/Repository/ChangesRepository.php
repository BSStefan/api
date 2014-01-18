<?php
/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 * @version 0.0.1
 */
namespace Tmdb\Repository;

use Tmdb\Factory\MovieFactory;
use Tmdb\Factory\People\PeopleFactory;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Company;
use Tmdb\Model\Movie;

class ChangesRepository extends AbstractRepository {
    /**
     * Get a list of movie ids that have been edited.
     *
     * By default we show the last 24 hours and only 100 items per page.
     * The maximum number of days that can be returned in a single request is 14.
     *
     * You can then use the movie changes API to get the actual data that has been changed.
     * Please note that the change log system to support this was changed on October 5, 2012
     * and will only show movies that have been edited since.
     *
     * @param array $parameters
     * @param array $headers
     * @return GenericCollection
     */
    public function getMovieChanges(array $parameters = array(), array $headers = array()) {
        $data = $this->getApi()->getMovieChanges($this->parseQueryParameters($parameters), $this->parseHeaders($headers));

        return MovieFactory::createCollection($data);
    }

    /**
     * Get a list of people ids that have been edited.
     *
     * By default we show the last 24 hours and only 100 items per page.
     * The maximum number of days that can be returned in a single request is 14.
     *
     * You can then use the person changes API to get the actual data that has been changed.
     * Please note that the change log system to support this was changed on October 5, 2012
     * and will only show people that have been edited since.
     *
     * @param array $parameters
     * @param array $headers
     * @return GenericCollection
     */
    public function getPeopleChanges(array $parameters = array(), array $headers = array()) {
        $data = $this->getApi()->getPeopleChanges($this->parseQueryParameters($parameters), $this->parseHeaders($headers));

        return PeopleFactory::createCollection($data);
    }

    /**
     * Return the related API class
     *
     * @return \Tmdb\Api\Changes
     */
    public function getApi()
    {
        return $this->getClient()->getChangesApi();
    }
}