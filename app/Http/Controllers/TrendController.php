<?php


namespace App\Http\Controllers;

use App\Http\Repositories\FilterRepository;
use App\Models\TrendFilterInterval;
use Illuminate\Http\Request;

use App\Http\Requests\StoreFilter;
use App\Models\Data\TrendFilter;
use GSoares\GoogleTrends\Search\Psr7\Search;
use GSoares\GoogleTrends\Search\SearchFilter;
use GSoares\GoogleTrends\Search\RelatedQueriesSearch;
use GSoares\GoogleTrends\Search\InterestOverTimeSearch;
use GSoares\GoogleTrends\Search\InterestByRegionSearch;
use GuzzleHttp\Psr7\ServerRequest;

use DateTimeImmutable;

use App\Models\Country;
use http\Exception;

use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;


class TrendController extends Controller
{
    /** @var FilterRepository */
    private $filterRepository;


    /**
     * EmployeeController constructor.
     *
     * @param FilterRepository $filterRepository

     */
    public function __construct(
        FilterRepository $filterRepository

    ) {
        $this->filterRepository = $filterRepository;

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function trendsManager(Request $request){

        $filters = TrendFilter::all();
        $countries = Country::all();


        foreach ($filters as $filter) {
            $filter->search_term = unserialize($filter->search_term);
        }


        return view('admin.trends-management', [
            'filters' => $filters,
            'countries' => $countries
        ]);
    }

    /**
     * @param Request $request
     * @param int $categoryId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function categoryTrendsManager(Request $request, int $categoryId){

        $filters = TrendFilter::where('category_id', $categoryId)
            ->get();
        $countries = Country::all();

        foreach ($filters as $filter) {
            $filter->search_term = unserialize($filter->search_term);
        }

        return view('admin.trends-management', [
            'filters' => $filters,
            'countries' => $countries
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function newFilter(Request $request){
        $countries = Country::all();
        $filter_intervals = TrendFilterInterval::all();
        return view('admin.trends-editor', [
            'filter_intervals' => $filter_intervals,
            'countries' => $countries
        ]);
    }

    /**
     * @param Request $request
     * @param int $trendFilterId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editFilter(Request $request, int  $trendFilterId){
        $countries = Country::all();
        $filter_intervals = TrendFilterInterval::all();
        $trendFilter = TrendFilter::where('id', $trendFilterId)
            ->firstOrFail();

        $trendFilter->search_term = unserialize($trendFilter->search_term);


        return view('admin.trends-editor', [
            'filter' => $trendFilter,
            'filter_intervals' => $filter_intervals,
            'terms' => $trendFilter->search_term,
            'countries' => $countries
        ]);
    }

    /**
     * @param Request $request
     * @param int $filterId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function updateFilter(\Illuminate\Http\Request $request, int $filterId)
    {

        $filter = TrendFilter::where('id', $filterId)
            ->firstOrFail();


        try {
            $success = $this->filterRepository->save($request->all(), $filter);
        } catch (Exception $exception) {
            redirect()->back()->with('error', 'Something went wrong');
        }

        if ($success) {
            return redirect()->route('filter.edit', ['id' => $filter->id])->with('success', 'GoogleTrends filter updated');
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \GSoares\GoogleTrends\Error\GoogleTrendsException
     */
    public function getRelatedTermsPreview(Request $request){

        //get Country Alpha 2 Code------------------------------------
        $countryId = $request->input( 'countryId' );
        $country = Country::where('id', $countryId)
            ->firstOrFail();
        $location = $country->alpha_2_code;
        $location = str_replace(' ', '', $location);

        //get SearchTerms---------------------------------------------
        $searchTerms = unserialize($request->input( 'searchTerm' ));
        //get SearchType----------------------------------------------
        $searchType = $request->input( 'searchType' );
        //get TimeInterval----------------------------------------------
        $standardIntervalId = $request->input( 'standardIntervalId' );
        if($standardIntervalId > 0)
        $standardInterval = TrendFilterInterval::where('id', $standardIntervalId)
            ->firstOrFail();
        $from = $standardInterval->from;
        $to = $standardInterval->to;

        //Results (Term by Term)--------------------------------------
        $allResultsRQS = array();
        for($i = 0; $i < count((array)$searchTerms);$i++) {
            //Filter
            $searchFilter = (new SearchFilter())
                ->withCategory(0) //All categories
                ->withSearchTerm($searchTerms[$i])
                ->withLocation($location)
                ->withinInterval(
                    new DateTimeImmutable($from),
                    new DateTimeImmutable($to)
                )
                ->withLanguage('en-US');
            if($searchType=="Image-Search"){
                $searchFilter =  $searchFilter->considerImageSearch();
            }elseif($searchType=="News-Search"){
                $searchFilter =  $searchFilter->considerNewsSearch();
            }elseif($searchType=="Youtube-Search"){
                $searchFilter =  $searchFilter->considerYoutubeSearch();
            }elseif($searchType=="Shopping-Search"){
                $searchFilter =  $searchFilter->considerGoogleShoppingSearch();
            }else{
                $searchFilter =  $searchFilter->considerWebSearch(); //DEFAULT
            }
            #if($filter->with_top_metric==true){
                $searchFilter =  $searchFilter->withTopMetrics();
            #};
            #if($filter->with_rising_metric==true){
                $searchFilter =  $searchFilter->withTopMetrics();
           # };

            //Results--------------------------------------------------------------
            $resultRQS = (new RelatedQueriesSearch())
                ->search($searchFilter)
                ->jsonSerialize();
            array_push($allResultsRQS, $resultRQS);
        }

        return response(['allResults' => $allResultsRQS, 'searchTerms' =>$searchTerms, 'request' =>$standardIntervalId]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \GSoares\GoogleTrends\Error\GoogleTrendsException
     */
    public function getTrendGraphPreview(Request $request){

        //get Country Alpha 2 Code------------------------------------
        $countryId = $request->input( 'countryId' );
        $country = Country::where('id', $countryId)
            ->firstOrFail();
        $location = $country->alpha_2_code;
        $location = str_replace(' ', '', $location);

        //get SearchTerms---------------------------------------------
        $searchTerms = unserialize($request->input( 'searchTerm' ));
        //get SearchType----------------------------------------------
        $searchType = $request->input( 'searchType' );
        //get TimeInterval----------------------------------------------
        $standardIntervalId = $request->input( 'standardIntervalId' );
        if($standardIntervalId > 0)
            $standardInterval = TrendFilterInterval::where('id', $standardIntervalId)
                ->firstOrFail();
        $from = $standardInterval->from;
        $to = $standardInterval->to;

        //Results (Term by Term)--------------------------------------
        $allResultsIOTS = array();
        for($i = 0; $i < count((array)$searchTerms);$i++) {
            //Filter
            $searchFilter = (new SearchFilter())
                ->withCategory(0) //All categories
                ->withSearchTerm($searchTerms[$i])
                ->withLocation($location)
                ->withinInterval(
                    new DateTimeImmutable($from),
                    new DateTimeImmutable($to)
                )
                ->withLanguage('en-US');
            if($searchType=="Image-Search"){
                $searchFilter =  $searchFilter->considerImageSearch();
            }elseif($searchType=="News-Search"){
                $searchFilter =  $searchFilter->considerNewsSearch();
            }elseif($searchType=="Youtube-Search"){
                $searchFilter =  $searchFilter->considerYoutubeSearch();
            }elseif($searchType=="Shopping-Search"){
                $searchFilter =  $searchFilter->considerGoogleShoppingSearch();
            }else{
                $searchFilter =  $searchFilter->considerWebSearch(); //DEFAULT
            }
            #if($filter->with_top_metric==true){
            $searchFilter =  $searchFilter->withTopMetrics();
            #};
            #if($filter->with_rising_metric==true){
            $searchFilter =  $searchFilter->withTopMetrics();
            # };

            //Results--------------------------------------------------------------
            $resultIOTS = (new InterestOverTimeSearch())
                ->search($searchFilter)
                ->jsonSerialize();
            array_push($allResultsIOTS, $resultIOTS);
        }

        return response(['allResults' => $allResultsIOTS, 'searchTerms' =>$searchTerms, 'request' =>$location]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \GSoares\GoogleTrends\Error\GoogleTrendsException
     */
    public function getTrendGraph(Request $request){
        $filterId = $request->input( 'filterId' );
        $filter = TrendFilter::where('id', $filterId)
            ->firstOrFail();

        $location = $filter->country->alpha_2_code;
        $location = str_replace(' ', '', $location);

        $searchTerms = unserialize($filter->search_term);
        //get SearchType----------------------------------------------
        $searchType = $filter->search_type;
        //get TimeInterval----------------------------------------------
        $standardIntervalId = $filter->standard_interval_id;
        if($standardIntervalId > 0)
            $standardInterval = TrendFilterInterval::where('id', $standardIntervalId)
                ->firstOrFail();
        $from = $standardInterval->from;
        $to = $standardInterval->to;

        //Results
        $allResultsIOTS = array();
        for($i = 0; $i < count((array)$searchTerms);$i++) {

        $searchFilter = (new SearchFilter())
            ->withCategory(0) //All categories
            ->withSearchTerm($searchTerms[$i])
            ->withLocation($location)
            ->withinInterval(
                new DateTimeImmutable($from),
                new DateTimeImmutable($to)
            )
            ->withLanguage('en-US');
            if($searchType=="Image-Search"){
                $searchFilter =  $searchFilter->considerImageSearch();
            }elseif($searchType=="News-Search"){
                $searchFilter =  $searchFilter->considerNewsSearch();
            }elseif($searchType=="Youtube-Search"){
                $searchFilter =  $searchFilter->considerYoutubeSearch();
            }elseif($searchType=="Shopping-Search"){
                $searchFilter =  $searchFilter->considerGoogleShoppingSearch();
            }else{
                $searchFilter =  $searchFilter->considerWebSearch(); //DEFAULT
            }
            #if($filter->with_top_metric==true){
            $searchFilter =  $searchFilter->withTopMetrics();
            #};
            #if($filter->with_rising_metric==true){
            $searchFilter =  $searchFilter->withTopMetrics();
            # };


            //Results--------------------------------------------------------------
            $resultIOTS = (new InterestOverTimeSearch())
                ->search($searchFilter)
                ->jsonSerialize();
            array_push($allResultsIOTS, $resultIOTS);
        }

        return response(['allResults' => $allResultsIOTS, 'searchTerms' =>$searchTerms]);

    }

    /**
     * @param StoreFilter $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function saveFilter(StoreFilter $request)
    {
        try {
            $success = $this->filterRepository->save($request->all());
        } catch (Exception $exception) {
            redirect()->back()->with('error', 'Something went wrong');
        }

        if ($success) {
            return redirect()->route('trends-manager')->with('success', 'Google-Trend-Filter created');
        }
    }
}
