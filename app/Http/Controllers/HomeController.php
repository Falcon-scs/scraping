<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('auth');
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function searchPage(Request $request) {
        error_reporting(E_ALL);
        $client = new Client(['cookies' => true]);
        $response = $client->get('https://login.hepl.idm.oclc.org/login?url=http://www.referenceusa.com/');
        $response = $client->request('POST', 'https://login.hepl.idm.oclc.org/login', [
            'form_params' => [
                'url' => 'http://www.referenceusa.com/',
                'user' => '40508002352213',
                'pass' => '1867'
            ],
            'allow_redirects' => false
        ]);   ///login

        $cookieJar = $client->getConfig('cookies');
        $cookie_array = $cookieJar->toArray();
        $cookie_value = $cookie_array[0]['Value'];

        $headers_get = [
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Encoding' => 'gzip, deflate',
                'Accept-Language' => 'en-US,en;q=0.91',
                'Cache-Control' => 'no-cache',
                'Connection' => 'keep-alive',
                'Cookie' => 'ezproxy='.$cookie_value,
                // 'Host' => 'www.referenceusa.com.hepl.idm.oclc.org',
                'Pragma' => 'no-cache',
                'Upgrade-Insecure-Requests' => 1,
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'
            ];
        $response = $client->get('http://www.referenceusa.com.hepl.idm.oclc.org/UsBusiness/Search/Quick/', [
            'headers' => $headers_get,
            'allow_redirects' => false
        ]);

        // echo $response->getBody();exit();
        $redirect_url = $response->getHeaderLine('Location');
        $response = $client->get($redirect_url, [
            'headers' => $headers_get,
            'allow_redirects' => false
        ]);
        // echo $response->getBody(); exit();  //search page
        $request_array = explode('/', $redirect_url);
        $request_key = $request_array[count($request_array) - 1];

        
        $headers_post = [
                'Accept' => 'application/json, text/javascript, */*',
                'Accept-Encoding' => 'gzip, deflate',
                'Accept-Language' => 'en-US,en;q=0.9',
                'Cache-Control' => 'no-cache',
                'Connection' => 'keep-alive',
                'Content-Length' => '81',
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Cookie' => 'ezproxy='.$cookie_value,
                'Host' => 'www.referenceusa.com.hepl.idm.oclc.org',
                'Origin' => 'http://www.referenceusa.com.hepl.idm.oclc.org',
                'Pragma' => 'no-cache',
                'Referer' => 'http://www.referenceusa.com.hepl.idm.oclc.org/UsBusiness/Search/Quick/'.$request_key,
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36',
                'x-ms-request-id' => 'NzWoZ',
                'x-ms-request-root-id' => 'KlugV',
                'X-Requested-With' => 'XMLHttpRequest'
        ];

        $sharedata = ['request_key' => $request_key, 'cookie_value' => $cookie_value, 'headers_get' => $headers_get, 'headers_post' => $headers_post];
        $request->session()->push('sharedata', $sharedata);
        $request->session()->put('sharedata', $sharedata);
        
        return view('home');
    }


    public function search(Request $request) {
        ini_set('max_execution_time', 18000000000);
        $data_session =  $request->session()->get('sharedata');
        $data = $request->input();
        
        $start_pageIndex = $data['start_pageIndex'];
        $end_pageIndex = $data['end_pageIndex'];

        $request_key = $data_session['request_key'];
        $cookie_value = $data_session['cookie_value'];
        $headers_post = $data_session['headers_post'];
        $headers_get = $data_session['headers_get'];

        $web_address = '';
        if(isset($data['web_address'])) {
            $i = 0;
            foreach ($data['web_address'] as $key => $item) {
                if($i == 0) {
                    $web_address = $item;
                } else {
                    $web_address = $web_address.','.$item;
                }
                $i++;
            }
        }
        $social_site_links = '';
        if(isset($data['social_site_links'])) {
            $i = 0;
            foreach ($data['social_site_links'] as $key => $item) {
                if($i == 0) {
                    $social_site_links = $item;
                } else {
                    $social_site_links = $social_site_links.','.$item;
                }
                $i++;
            }
        }

        $sales_volumn = '';
        if(isset($data['sales_volumn'])) {
            $i = 0;
            foreach ($data['sales_volumn'] as $key => $item) {
                if($i == 0) {
                    $sales_volumn = $item;
                } else {
                    $sales_volumn = $sales_volumn.','.$item;
                }
                $i++;
            }
        }

        $getKeywordSIC = '';
        if(isset($data['getKeywordSIC'])) {
            $i = 0;
            foreach ($data['getKeywordSIC'] as $key => $item) {
                if($i == 0) {
                    $getKeywordSIC = $item;
                } else {
                    $getKeywordSIC = $getKeywordSIC.','.$item;
                }
                $i++;
            }
        }

        $getKeywordNAICS = '';
        if(isset($data['getKeywordNAICS'])) {
            $i = 0;
            foreach ($data['getKeywordNAICS'] as $key => $item) {
                if($i == 0) {
                    $getKeywordNAICS = $item;
                } else {
                    $getKeywordNAICS = $getKeywordNAICS.','.$item;
                }
                $i++;
            }
        }

        $MajorIndustryGroup = '';
        if(isset($data['MajorIndustryGroup'])) {
            $i = 0;
            foreach ($data['MajorIndustryGroup'] as $key => $item) {
                if($i == 0) {
                    $MajorIndustryGroup = $item;
                } else {
                    $MajorIndustryGroup = $MajorIndustryGroup.','.$item;
                }
                $i++;
            }
        }

        $form_params = [
                'VerifiedRecord' => 'V',
                'BusinessName' => '',//$data['businessName'],
                'FirstName' => '',//$data['firstName'],
                'LastName' => '',//$data['lastName'],
                'MajorIndustryGroup' => $MajorIndustryGroup,
                'MinorIndustryGroup' => '',
                'Naics' => '',
                'NaicsLookup' => $getKeywordNAICS,
                'PrimaryNaicsLookup' => '',
                'MigSic' => $getKeywordSIC,
                'MajorIndustryPrimarySicLookup' => 'F',
                'StateProvince' => $data['stateProvince'],
                'CitiesByState' => $data['city'],
                'streetSearchType' => 'Partial',
                'streetAddress' => '',
                'streetNumber' => '',
                'streetPreDirectional' => '',
                'streetName' => '',
                'streetSuffix' => '',
                'streetPostDirectional' => '',
                'streetCity' => '',
                'streetStateProvince' => '',
                'streetPostalCode' => '',
                'LocationSalesVolumeRange' => '',
                'CombinedSalesVolumeActual' => '',
                'CoporateSalesVolumeRange' => '',
                'CorporateSalesVolumeActual' => '',
                'CombinedSalesVolumeRange' => $sales_volumn,
                'LocationSalesVolumeActual' => '',
                'HasWebAddress' => $web_address,
                'SocialSiteLinks' => $social_site_links,
                'postbackType'=> 'viewresults'
            ];
        $client = new Client(['cookies' => true]);


        $result_url = 'http://www.referenceusa.com.hepl.idm.oclc.org/UsBusiness/Search/NewCustomSearchRequest/'.$request_key;
        $response = $client->post($result_url, [
            'headers' => $headers_post,
            'form_params' => $form_params,
            'allow_redirects' => false
        ]);
        // if($end_pageIndex=='') $end_pageIndex = 1000;
        $result_data = array();
        for ($i=$start_pageIndex; $i <= $end_pageIndex; $i++) { 
            $client = new Client(['cookies' => true]);
            $url = "http://www.referenceusa.com.hepl.idm.oclc.org/UsBusiness/Result/Page";
            $response = $client->post($url, [
                'headers' => $headers_post,
                'form_params' => [
                    'requestKey' => $request_key,
                    'sort' => '',
                    'direction' => 'Ascending',
                    'pageIndex' => $i,
                    'optionalColumn' => ''
                ],
                'allow_redirects' => false
            ]);
            $page_html = $response->getBody();
            
            $page_data = $this->getData($page_html);
               
            foreach ($page_data as $key => $row) {
                array_push($result_data, $row);
            }
        }

        // var_dump($result_data);exit();
        $final_out = array();
        foreach ($result_data as $key => $row) {
            $link = $row[0];
            $response = $client->get($link, [
                'headers' => $headers_get,
                'allow_redirects' => false
            ]);
            $detail_html = $response->getBody();
            $new_row = $this->getDepthDetail($row, $detail_html);
            array_push($final_out, $new_row);
        }
        $data = $final_out;
        return view('result', compact('data'));
    }

    function test(Request $request) {
        $data = $request->input();
        $MajorIndustryGroup = '';
        if(isset($data['MajorIndustryGroup'])) {
            $i = 0;
            foreach ($data['MajorIndustryGroup'] as $key => $item) {
                if($i == 0) {
                    $MajorIndustryGroup = $item;
                } else {
                    $MajorIndustryGroup = $MajorIndustryGroup.','.$item;
                }
                $i++;
            }
        }
        var_dump($MajorIndustryGroup);exit();
    }

    function getData($content) {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(TRUE);
        $doc->loadHTML($content);
        $dxp = new \DOMXpath($doc);
        $result = array();
        @$table_child = $doc->getElementById("searchResultsPage");
        if($table_child) {
            $tmp = new \DOMDocument();
            $tmp->appendChild($tmp->importNode($table_child,true));   
            $items_tr = $tmp->getElementsByTagName("tr");
            foreach ($items_tr as $key => $tr) {
                $tmp2 = new \DOMDocument();
                $tmp2->appendChild($tmp2->importNode($tr,true));

                $items_td = $tmp2->getElementsByTagName("td");
                $array_row = array();
                foreach ($items_td as $key => $td) {
                    array_push($array_row, $td->textContent);
                }
                $items_link = $tmp2->getElementsByTagName("a")[0]->getAttribute('data-tagged-url');
                $array_row[0] = 'http://www.referenceusa.com.hepl.idm.oclc.org'.$items_link;
                array_push($result, $array_row);
                // break;
            }
                
        }
        return $result;
    }

    function getDepthDetail($row, $content) {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(TRUE);
        $doc->loadHTML($content);
        $LocationInfo = $doc->getElementById("LocationInfo");
        $LocationInfo_node = new \DOMDocument();
        $LocationInfo_node->appendChild($LocationInfo_node->importNode($LocationInfo,true)); 
        $tables = $LocationInfo_node->getElementsByTagName("table");
        $target_table = $tables[2];
        $target_table_content = $target_table->textContent;
        $sites_array = array('', '');
        if($target_table_content != '') {
            $sites = new \DOMDocument();
            $sites->appendChild($sites->importNode($target_table,true));
            $site_urls = $sites->getElementsByTagName("a");
            $temp_site_array = array();
            foreach ($site_urls as $key => $a_link) {
                $url = $a_link->getAttribute('href');
                array_push($temp_site_array, $url);
            }
            @$sites_array[0] = $temp_site_array[0];
            if(count($temp_site_array)==1) array_push($temp_site_array, '');
            if(strpos($temp_site_array[1], 'facebook') == false) $temp_site_array[1] = '';
            @$sites_array[1] = $temp_site_array[1];
        } else {

        }
        array_push($row, $sites_array[0]);
        array_push($row, $sites_array[1]);
        //advertising
        $advertising = $doc->getElementById("BusinessExpenditures");
        $advertising_node = new \DOMDocument();
        $advertising_node->appendChild($advertising_node->importNode($advertising,true));
        $dxp_tmp = new \DOMXpath($advertising_node);
        $advertising_td = $dxp_tmp->query('//td[@headers="advertising"]');
        $advertising_text = $advertising_td[0]->textContent;
        array_push($row, $advertising_text);
        return $row;

    }

    function export(Request $request) {
        $data = $request->input();
        $count = $data['count'];
        $array_data = array();
        $array_title = array("Company Name", "Executive Name", "Street Address", "City, State", "Zip", "Phone", "Website", "Facebook", "Advertising Expenses");
        array_push($array_data, $array_title);
        for ($i=0; $i < $count ; $i++) { 
            $array_row = array($data['companyName'][$i],$data['excutiveName'][$i],$data['address'][$i],$data['city'][$i], $data['zip'][$i], $data['phone'][$i], $data['website'][$i], $data['facebook'][$i], $data['advertising'][$i]);
            array_push($array_data, $array_row);
        }
        $this->array_to_csv_download(
                    $array_data,
                    "referenceUSA.csv"
                );
        exit();
    }

    function array_to_csv_download($array, $filename = "referenceUSA.csv", $delimiter=";") {
        header('Content-Type: application/download');
        header('Content-Disposition: attachment; filename="'.$filename.'";');

        // open the "output" stream
        // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
        $f = fopen('php://output', 'w');

        foreach ($array as $line) {
            fputcsv($f, $line);
        }

    }

    function MajorIndustryGroup(Request $request) {

        $data_session =  $request->session()->get('sharedata');

        $request_key = $data_session['request_key'];
        $cookie_value = $data_session['cookie_value'];
        $headers_post = $data_session['headers_post'];
        $headers_get = $data_session['headers_get'];
        $client = new Client(['cookies' => true]);
        //post call
        $url = "http://www.referenceusa.com.hepl.idm.oclc.org/UsBusiness/Search/CustomSearchCriteria/MajorIndustryGroup";
        $response = $client->post($url, [
            'headers' => $headers_post,
            'form_params' => [
                'requestKey' => $request_key
            ],
            'allow_redirects' => false
        ]);
        $requestId = $this->getRequestId($response->getBody());
        $url = "http://www.referenceusa.com.hepl.idm.oclc.org/UsBusiness/Data/MajorIndustryGroupTreeView";
        $response = $client->post($url, [
            'headers' => $headers_post,
            'form_params' => [
                'requestId' => $requestId
            ],
            'allow_redirects' => false
        ]);
        $html_data_tree = $response->getBody();
        $result = $this->getTreesFromHTML($html_data_tree);
        return json_encode($result);
    }
    function getTreesFromHTML($content) {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(TRUE);
        $doc->loadHTML($content);
        // $dxp = new \DOMXpath($doc);
        $items_label = $doc->getElementsByTagName("label");
        $array_description = array();
        foreach ($items_label as $key => $item) {
            array_push($array_description, $item->textContent);
        }
        $items_input = $doc->getElementsByTagName("input");
        $array_value = array();
        foreach ($items_input as $key => $item) {
            array_push($array_value, $item->getAttribute('value'));
        }
        $i = 0;
        $array_data = array();
        foreach ($array_description as $key => $item) {
            array_push($array_data, array('value' => $array_value[$i], 'description' => str_replace('0 selected', '', $item)));
            $i++;
        }
        return $array_data;
    }
    function getRequestId($content) {
        $pos = strpos($content, 'requestId');
        $substrafter = substr($content, $pos);
        $array_requestid = explode("'", $substrafter);
        $requestId = $array_requestid[1];
        return $requestId;
    }

    function getSalesVolumn(Request $request) {
        $data_session =  $request->session()->get('sharedata');

        $request_key = $data_session['request_key'];
        $cookie_value = $data_session['cookie_value'];
        $headers_post = $data_session['headers_post'];
        $headers_get = $data_session['headers_get'];
        $client = new Client(['cookies' => true]);
        //post call
        $url = "http://www.referenceusa.com.hepl.idm.oclc.org/UsBusiness/Search/CustomSearchCriteria/SalesVolume";
        $response = $client->post($url, [
            'headers' => $headers_post,
            'form_params' => [
                'requestKey' => $request_key
            ],
            'allow_redirects' => false
        ]);
        //get call
        $url = 'http://www.referenceusa.com.hepl.idm.oclc.org/UsBusiness/Data/Get/SalesVolume';
            $response = $client->get($url, [
                'headers' => $headers_get,
                'allow_redirects' => false
            ]);
        return $response->getBody();
    }

    function getKeywordSICs(Request $request) {
        $data = $request->input();
        $data_session =  $request->session()->get('sharedata');

        $request_key = $data_session['request_key'];
        $cookie_value = $data_session['cookie_value'];
        $headers_post = $data_session['headers_post'];
        $headers_get = $data_session['headers_get'];
        

        $client = new Client(['cookies' => true]);
        //post call
        $url = "http://www.referenceusa.com.hepl.idm.oclc.org/UsBusiness/Data/TryHarderSicLookup";
        $response = $client->post($url, [
            'headers' => $headers_post,
            'form_params' => [
                'keyword' => $data['keyword']
            ],
            'allow_redirects' => false
        ]);
        return $response->getBody();
    }

}
