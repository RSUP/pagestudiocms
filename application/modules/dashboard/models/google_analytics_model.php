<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * PageStudio
 *
 * @author      Cosmo Mathieu
 * @copyright   Copyright (c) 2015
 * @license     MIT License
 * @link        http://pagestudioapp.com
 */

// -------------------------------------------------------------------

/**
 * Google Analytics Accessor
 *
 * @author      Mark Price <http://cmscanvas.com>
 * @author      Cosmo Mathieu
 */
class Google_analytics_model extends CI_Model
{	
    public function __construct()
    {
        parent::__construct();
        
        $this->clientId = '601667939223-sid4ss85hs21947ntrj6vm68468k5oqi.apps.googleusercontent.com';
        $this->clientEmail = 'account-1@pagestudio-1127.iam.gserviceaccount.com';
        $this->keyFileLocation = BASEPATH . '../application/third_party/Google/PageStudio-20c49edcceae.p12';
        
        $this->load->library('ga_api', [
            'username' => $this->settings->ga_email, 
            'password' => $this->settings->ga_password,
            'clientId' => $this->clientId,
            'clientEmail' => $this->clientEmail,
            'key' => $this->keyFileLocation
        ]);
        $this->ga_api->setProfileById('ga:' . $this->settings->ga_profile_id);
        $this->set_month(time());
    }

    public function get_by_type($type = 'overview')
    {
        try
        {
            switch($type)
            {
                case "overview":
                    return $this->_overview();
                    break;
                case "referrers":
                    return $this->_referrers();
                    break;
                case "keywords":
                    return $this->_keywords();
                    break;
                case "top_content":
                    return $this->_top_content();
                    break;
                case "visits_by_country":
                    return $this->_visits_by_country();
                    break;
                case "browsers":
                    return $this->_browsers();
                    break;
                case "screen_resolutions":
                    return $this->_screen_resolutions();
                    break;
            }
        }
        catch(Exception $e) 
        {
            return '<p class="error">Unable to connect to Google Analytics. Please ensure your <a href="' . site_url(ADMIN_PATH . '/settings/general-settings') . '">analytic settings</a> are correct.</p>';
        }
    }

    public function set_month($unix_month)
    {
        // Onfy fetch date up to todays date if current month/year selected
        if (date('m', $unix_month) == date('m') && date('Y', $unix_month) == date('Y'))
        {
            $start_date = date('Y-m-d', strtotime(date('m') . '/01/' . date('Y')));
            $end_date = date('Y-m-d');

            $this->ga_api->setDateRange($start_date, $end_date);
        }
        else
        {
            $this->ga_api->setMonth(date('m', $unix_month), date('Y', $unix_month));
        }
    }

    private function _overview()
    {
        $data = array();

        $ga_data = $this->ga_api->getData([
			'metrics' => 'ga:visits,ga:pageviews,ga:sessionDuration',
            'optParams' => [
                'dimensions' => 'ga:date',
                'sort' => '-ga:date'
            ]
        ]);

        // Merge array values in associative array 
        if( ! empty($ga_data)) {
            $ga_data_to_assoc = [];
            foreach ($ga_data->getRows() as $row) {
                $ga_data_to_assoc[$row[0]] = array(
                    'visits' => $row[1],
                    'pageviews' => $row[2],
                    'sessionDuration' => $row[3]
                ); 
            }
        }
        $data['ga_data'] = $ga_data_to_assoc;

        $ga_visitor_type = $this->ga_api->getData([
			'metrics' => 'ga:visits',
            'optParams' => [
                'dimensions' => 'ga:visitorType',
            ]
        ]);

        $data['ga_visitor_type'] = $this->_new_vs_return_percent($ga_visitor_type);

        return $this->load->view('admin/analytics/overview', $data, TRUE);
    }

    private function _referrers()
    {
        $data = array();
        $data['table_cells'] = ['Refferer', 'Visits'];

        $data['ga_data'] = $this->ga_api->getReferrers();

        return $this->load->view('admin/analytics/generic_table', $data, TRUE);
    }

    private function _keywords()
    {
        $data = array();
        $data['table_cells'] = ['Keyword', 'Visits'];

        $data['ga_data'] = $this->ga_api->getSearchWords();

        return $this->load->view('admin/analytics/generic_table', $data, TRUE);
    }

    private function _top_content()
    {
        $data = array();
        $data['table_cells'] = array('pagePath' => 'Page', 'pageviews' => 'Page Views', 'uniquePageviews' => 'Unique Page Views', 'timeOnPage' => 'Time On Page', 'bounces' => 'Bounces', 'entrances' => 'Entrances', 'exits' => 'Exits');

        $ga_data = $this->ga_api->getData([
			'metrics' => 'ga:pageviews,ga:uniquePageviews,ga:visitors,ga:timeOnPage,ga:bounces,ga:entrances,ga:exits',
            'optParams' => [
                'dimensions' => 'ga:pagePath',
                'sort' => '-ga:pageviews',
            ]
        ]);        

        $ga_data_to_assoc = [];
        foreach ($ga_data->getRows() as $row) {
            $ga_data_to_assoc[$row[0]] = array(
                'pageviews' => $row[0],
                'uniquePageviews' => $row[1],
                'visitors' => $row[2],
                'pageviews' => $row[3],
                'timeOnPage' => $row[4],
                'bounces' => $row[5],
                'entrances' =>  $row[6],
                'exits' => $row[7],
            ); 
        }
        // var_dump($ga_data_to_assoc);

        $data['ga_data'] = $ga_data_to_assoc;

        return $this->load->view('admin/analytics/top_content', $data, TRUE);
    }

    private function _visits_by_country()
    {
        $data = array();
        $data['table_cells'] = array('country' => 'Country', 'visits' => 'Visits');

        $ga_data = $this->ga_api->getData([
			'metrics' => 'ga:visits',
            'optParams' => [
                'dimensions' => 'ga:country',
                'sort' => 'ga:visits'
            ]
        ]);
        
        // Merge array values into an associative array 
        $aData = [];
        foreach ($ga_data->rows as $row) {
            $key = $row[0];
            $aData[$key] = $row[1];
        }

		// sort descending by number of visits
		arsort($aData);
		$data['ga_data'] = $aData;

        return $this->load->view('admin/analytics/generic_table', $data, TRUE);
    }

    private function _browsers()
    {
        $data = array();
        $data['table_cells'] = array('browser' => 'Browser', 'visits' => 'Visits');

        $data['ga_data'] = $this->ga_api->getBrowsers();

        return $this->load->view('admin/analytics/generic_table', $data, TRUE);
    }

    private function _screen_resolutions()
    {
        $data = array();
        $data['table_cells'] = array('screen_resolution' => 'Screen Resolution', 'visits' => 'Visits');

        $data['ga_data'] = $this->ga_api->getScreenResolution();

        return $this->load->view('admin/analytics/generic_table', $data, TRUE);
    }
    
    /**
     * @return      array $data
     * @access      private
     */
    private function _new_vs_return_percent($visitors = [])
    {
        // Merge array values in associative array 
        if( ! empty($visitors)) {            
            $ga_visitor_type = [];        
            foreach($visitors->rows as $key) {
                foreach ($key as $value) {
                    $ga_visitor_type[$key[0]] = $value;
                }
            }
        }
        
        $data['new_visitor'] = 0;
        $data['returning_visitor'] = 0;

        if ( ! isset($ga_visitor_type['New Visitor']) && ! isset($ga_visitor_type['Returning Visitor']))
        {
            return $data;
        }
        else if ( ! isset($ga_visitor_type['New Visitor']) && isset($ga_visitor_type['Returning Visitor']))
        {
            $data['returning_visitor'] = 100;
            return $data;
        }
        else if (isset($ga_visitor_type['New Visitor']) && ! isset($ga_visitor_type['Returning Visitor']))
        {
            $data['new_visitor'] = 100;
            return $data;
        }

        $visitor_total = $ga_visitor_type['New Visitor'] + $ga_visitor_type['Returning Visitor'];
        $data['new_visitor'] = round(($ga_visitor_type['New Visitor'] / $visitor_total) * 100, 2);
        $data['returning_visitor'] = round(($ga_visitor_type['Returning Visitor'] / $visitor_total) * 100, 2);

        return $data;
    }

    public function calc_percent($numerator, $denominator)
    {
        if ($denominator <= 0) {
            return 0;
        }

        return round(($numerator / $denominator) * 100, 2);
    }
    
    // -----------------------------------------------------------------
    
    /**
     * Calculates average time on page 
     *
     * Formula: 
     * Total of time on page (in seconds) / (the total number of pageviews - the total number of exits)
     *
     * @return  string 
     */
    public function avg_time_on_site($time, $visits, $padHours = TRUE)
    {
        $sec = ($visits != 0) ? $time / $visits : 0;
        $sec = ($sec <= 0) ? 0 : $sec;

        // start with a blank string
        $hms = "";
        
        // do the hours first: there are 3600 seconds in an hour, so if we divide
        // the total number of seconds by 3600 and throw away the remainder, we're
        // left with the number of hours in those seconds
        $hours = intval(intval($sec) / 3600); 

        // add hours to $hms (with a leading 0 if asked for)
        $hms .= ($padHours) 
              ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":"
              : $hours. ":";
        
        // dividing the total seconds by 60 will give us the number of minutes
        // in total, but we're interested in *minutes past the hour* and to get
        // this, we have to divide by 60 again and then use the remainder
        $minutes = intval(($sec / 60) % 60); 

        // add minutes to $hms (with a leading 0 if needed)
        $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";

        // seconds past the minute are found by dividing the total number of seconds
        // by 60 and using the remainder
        $seconds = intval($sec % 60); 

        // add seconds to $hms (with a leading 0 if needed)
        $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

        // done!
        return $hms;
    }
}
