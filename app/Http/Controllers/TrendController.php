<?php


namespace App\Http\Controllers;

use App\Http\Repositories\FilterRepository;

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
use Illuminate\Support\Facades\Request;
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


    public function trendsManager(Request $request){

        $filters = TrendFilter::all();
        $countries = Country::all();
        foreach ($filters as &$filter) {
            $filter->search_term = unserialize($filter->search_term);
        }


        return view('admin.trends-management', [
            'filters' => $filters,
            'countries' => $countries
        ]);
    }
    public function editFilter(Request $request, int  $trendFilterId){
        $countries = Country::all();
        $trendFilter = TrendFilter::where('id', $trendFilterId)
            ->firstOrFail();

        $trendFilter->search_term = unserialize($trendFilter->search_term);


        return view('admin.trends-editor', [
            'filter' => $trendFilter,
            'terms' => $trendFilter->search_term,
            'countries' => $countries
        ]);
    }

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
    public function getRelatedTerms(Request $request, int $filterId){
        $filter = TrendFilter::where('id', $filterId)
            ->firstOrFail();

        $location = $filter->country->alpha_2_code;
        $location = str_replace(' ', '', $location);

        $searchTerms = unserialize($filter->search_term);

        $allResultsRQS = array();
        for($i = 0; $i < count((array)$searchTerms);$i++) {

            $searchFilter = (new SearchFilter())
                ->withCategory(0) //All categories
                ->withSearchTerm($searchTerms[$i])
                ->withLocation($location)
                ->withinInterval(
                    new DateTimeImmutable('now -7 days'),
                    new DateTimeImmutable('now')
                )
                ->withLanguage('en-US')
                ->considerWebSearch()
                # ->considerImageSearch() // Consider only image search
                # ->considerNewsSearch() // Consider only news search
                # ->considerYoutubeSearch() // Consider only youtube search
                # ->considerGoogleShoppingSearch() // Consider only Google Shopping search
                ->withTopMetrics()
                ->withRisingMetrics();

            $resultRQS = (new RelatedQueriesSearch())
                ->search($searchFilter)
                ->jsonSerialize();
            array_push($allResultsRQS, $resultRQS);
        }

        return response(['allResults' => $allResultsRQS, 'searchTerms' =>$searchTerms]);
    }


    public function getTrend(Request $request, int $filterId){
        $filter = TrendFilter::where('id', $filterId)
            ->firstOrFail();

        $location = $filter->country->alpha_2_code;
        $location = str_replace(' ', '', $location);

        $searchTerms = unserialize($filter->search_term);



        $allResultsIOTS = array();
        for($i = 0; $i < count((array)$searchTerms);$i++) {





        $searchFilter = (new SearchFilter())
            ->withCategory(0) //All categories
            ->withSearchTerm($searchTerms[$i])
            ->withLocation($location)
            ->withinInterval(
                new DateTimeImmutable('now -30 days'),
                new DateTimeImmutable('now')
            )
            ->withLanguage('en-US')
            ->considerWebSearch()
            # ->considerImageSearch() // Consider only image search
            # ->considerNewsSearch() // Consider only news search
            # ->considerYoutubeSearch() // Consider only youtube search
            # ->considerGoogleShoppingSearch() // Consider only Google Shopping search
            ->withTopMetrics()
            ->withRisingMetrics();

        $resultRQS = (new RelatedQueriesSearch())
            ->search($searchFilter)
            ->jsonSerialize();
        $resultIOTS = (new InterestOverTimeSearch())
            ->search($searchFilter)
            ->jsonSerialize();
            array_push($allResultsIOTS, $resultIOTS);
        $resultIBRS = (new InterestByRegionSearch())
            ->search($searchFilter)
            ->jsonSerialize();
        }

        return response(['RelatedQueries' => $resultRQS, 'InterestOverTime' => $resultIOTS, 'InterestByRegion' => $resultIBRS, 'all' => $allResultsIOTS, 'terms' =>$searchTerms]);

    }
}
