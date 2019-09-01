<?php

    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2012 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    /**
    * Helper Location
    * @package Osclass
    * @subpackage Helpers
    * @author Osclass
    */

    /**
     * Gets current country
     *
     * @return array
     */
    function osc_country() {
        if (View::newInstance()->_exists('countries')) {
            return View::newInstance()->_current('countries');
        } else {
            return null;
        }
    }

    /**
     * Gets current region
     *
     * @return array
     */
    function osc_region() {
        if (View::newInstance()->_exists('regions')) {
            return View::newInstance()->_current('regions');
        } else {
            return null;
        }
    }

    /**
     * Gets current city
     *
     * @return array
     */
    function osc_city() {
        if (View::newInstance()->_exists('cities')) {
            return View::newInstance()->_current('cities');
        } else {
            return null;
        }
    }

    /**
     * Gets current city area
     *
     * @return array
     */
    function osc_city_area() {
        if (View::newInstance()->_exists('city_areas')) {
            return View::newInstance()->_current('city_areas');
        } else {
            return null;
        }
    }

    /**
     * Iterator for countries, return null if there's no more countries
     *
     * @return array
     */
    function osc_has_countries() {
        if ( !View::newInstance()->_exists('countries') ) {
            View::newInstance()->_exportVariableToView('countries', Search::newInstance()->listCountries( ">=", "country_name ASC") );
        }
        return View::newInstance()->_next('countries');
    }

    /**
     * Iterator for regions, return null if there's no more regions
     *
     * @return array
     */
    function osc_has_regions($country = '%%%%') {
        if ( !View::newInstance()->_exists('regions') ) {
            View::newInstance()->_exportVariableToView('regions', Search::newInstance()->listRegions($country, ">=", "region_name ASC" ) );
        }
        return View::newInstance()->_next('regions');
    }

    /**
     * Iterator for cities, return null if there's no more cities
     *
     * @return array
     */
    function osc_has_cities($region = '%%%%') {
        if ( !View::newInstance()->_exists('cities') ) {
            View::newInstance()->_exportVariableToView('cities', Search::newInstance()->listCities($region, ">=", "city_name ASC" ) );
        }
        $result = View::newInstance()->_next('cities');

        if (!$result) View::newInstance()->_erase('cities');
        return $result;
    }

    /**
     * Iterator for city areas, return null if there's no more city areas
     *
     * @return array
     */
    function osc_has_city_areas($city = '%%%%') {
        if ( !View::newInstance()->_exists('city_areas') ) {
            View::newInstance()->_exportVariableToView('city_areas', Search::newInstance()->listCityAreas($city, ">=", "city_area_name ASC" ) );
        }
        $result = View::newInstance()->_next('city_areas');

        if (!$result) View::newInstance()->_erase('city_areas');
        return $result;
    }

    /**
     * Gets number of countries
     *
     * @return int
     */
    function osc_count_countries() {
        if ( !View::newInstance()->_exists('contries') ) {
            View::newInstance()->_exportVariableToView('countries', Search::newInstance()->listCountries( ">=", "country_name ASC" ) );
        }
        return View::newInstance()->_count('countries');
    }

    /**
     * Gets number of regions
     *
     * @return int
     */
    function osc_count_regions($country = '%%%%') {
        if ( !View::newInstance()->_exists('regions') ) {
            View::newInstance()->_exportVariableToView('regions', Search::newInstance()->listRegions($country,  ">=", "region_name ASC" ) );
        }
        return View::newInstance()->_count('regions');
    }

    /**
     * Gets number of cities
     *
     * @return int
     */
    function osc_count_cities($region = '%%%%') {
        if ( !View::newInstance()->_exists('cities') ) {
            View::newInstance()->_exportVariableToView('cities', Search::newInstance()->listCities($region, ">=", "city_name ASC" ) );
        }
        return View::newInstance()->_count('cities');
    }

    /**
     * Gets number of city areas
     *
     * @return int
     */
    function osc_count_city_areas($city = '%%%%') {
        if ( !View::newInstance()->_exists('city_areas') ) {
            View::newInstance()->_exportVariableToView('city_areas', Search::newInstance()->listCityAreas($city, ">=", "city_area_name ASC" ) );
        }
        return View::newInstance()->_count('city_areas');
    }

    /**
     * Gets country's name
     *
     * @return string
     */
    function osc_country_name() {
        return osc_field(osc_country(), 'country_name', '');
    }

    /**
     * Gets country's items
     *
     * @return int
     */
    function osc_country_items() {
        return osc_field(osc_country(), 'items', '');
    }

    /**
     * Gets region's name
     *
     * @return string
     */
    function osc_region_name() {
        return osc_field(osc_region(), 'region_name', '');
    }

    /**
     * Gets region's items
     *
     * @return int
     */
    function osc_region_items() {
        return osc_field(osc_region(), 'items', '');
    }

    /**
     * Gets city's name
     *
     * @return string
     */
    function osc_city_name() {
        return osc_field(osc_city(), 'city_name', '');
    }

    /**
     * Gets city's items
     *
     * @return int
     */
    function osc_city_items() {
        return osc_field(osc_city(), 'items', '');
    }

    /**
     * Gets city area's name
     *
     * @return string
     */
    function osc_city_area_name() {
        return osc_field(osc_city_area(), 'city_area_name', '');
    }

    /**
     * Gets city area's items
     *
     * @return int
     */
    function osc_city_area_items() {
        return osc_field(osc_city_area(), 'items', '');
    }

    /**
     * Gets country's url
     *
     * @return string
     */
    function osc_country_url() {
        return osc_search_url(array('sCountry' => osc_country_name()));
    }

    /**
     * Gets region's url
     *
     * @return string
     */
    function osc_region_url() {
        return osc_search_url(array('sRegion' => osc_region_name()));
    }

    /**
     * Gets city's url
     *
     * @return string
     */
    function osc_city_url() {
        return osc_search_url(array('sCity' => osc_city_name()));
    }

    /**
     * Gets city area's url
     *
     * @return string
     */
    function osc_city_area_url() {
        return osc_search_url(array('sCityArea' => osc_city_area_name()));
    }

?>
