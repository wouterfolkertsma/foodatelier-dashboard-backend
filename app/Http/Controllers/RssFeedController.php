<?php

namespace App\Http\Controllers;

use App\Http\Repositories\RssFeedRepository;
use App\Http\Requests\StoreRssFeed;
use App\Models\Category;
use App\Models\Dashboard;
use App\Models\Data\RssFeed;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Throwable;

class RssFeedController extends Controller
{
    /** @var RssFeedRepository */
    private $rssFeedRepository;

    /**
     * RssFeedController constructor.
     *
     * @param RssFeedRepository $rssFeedRepository
     */
    public function __construct(
        RssFeedRepository $rssFeedRepository
    ) {
        $this->rssFeedRepository = $rssFeedRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.rss.rss-feeds', [
            'data' => RssFeed::all(),
            'dashboards' =>$dashboards = Dashboard::pluck( 'name', 'id')
        ]);
    }

    /**
     * @param $categoryId
     * @return Application|Factory|View
     */
    public function categoryIndex($categoryId)
    {
        $rssFeeds = RssFeed::where('category_id', $categoryId)
            ->get();
        return view('admin.rss.rss-feeds', [
            'data' => $rssFeeds,
            'dashboards' =>$dashboards = Dashboard::pluck( 'name', 'id')
        ]);
    }

    /**
     * @param StoreRssFeed $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function saveNewRssFeed(StoreRssFeed $request): RedirectResponse
    {
        try {
            $this->rssFeedRepository->save($request->all());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong, please try again later');
        }

        return redirect()->back()->with('success', "Feed " . $request->input('name') . " Successfully added");
    }

    /**
     * @param Request $request
     * @param RssFeed $rssFeed
     * @return RedirectResponse
     * @throws Throwable
     */
    public function updateRssFeed(Request $request, RssFeed $rssFeed): RedirectResponse
    {
        try {
            $this->rssFeedRepository->save($request->all(), $rssFeed);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong, please try again later');
        }

        return redirect()->route('rss.index')->with('success', "Feed " . $request->input('name') . " Successfully updated");
    }

    /**
    /**
     * @return Application|Factory|View
     */
    public function new()
    {
        return view('admin.rss.new-rss', [
            'data' => RssFeed::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * @param Request $request
     * @param RssFeed $rssFeed
     * @return RedirectResponse
     * @throws Throwable
     */
    public function delete(Request $request, RssFeed $rssFeed): RedirectResponse
    {
        try {
            $this->rssFeedRepository->delete($rssFeed);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong, please try again later');
        }

        return redirect()->route('rss.index')->with('success', 'RSS Feed deleted successfully!');
    }

    /**
     * @param Request $request
     * @param RssFeed $rssFeed
     * @return Application|Factory|View
     */
    public function edit(Request $request, RssFeed $rssFeed)
    {
        return view('admin.rss.edit-rss', [
            'rssFeed' => $rssFeed
        ]);
    }

    /**
     * @param Request $request
     * @param RssFeed $rssFeed
     * @return JsonResponse
     */
    public function previewExisting(Request $request, RssFeed $rssFeed): JsonResponse
    {
        $rss = simplexml_load_file($rssFeed->url)->channel;
        $html = Cache::store('redis')->get('rss_'. $rssFeed->name);

        if ($html) {
            return new JsonResponse([
                'html' => $html
            ]);
        }

        foreach ($rss->item as $item) {
            $metaTags = get_meta_tags($item->link);
            if (isset($metaTags['image'])) {
                $item->image = $metaTags['image'];
            } else if (isset($metaTags['twitter:image:src'])) {
                $item->image = $metaTags['twitter:image:src'];
            } else if (isset($metaTags['twitter:image'])) {
                $item->image = $metaTags['twitter:image'];
            }
        }

        $html = \Illuminate\Support\Facades\View::make('admin.rss.rss-preview', [
            'data' => $rss
        ])->render();

        Cache::store('redis')->put('rss_'. $rssFeed->name, $html, 60 * 60 * 12);

        return new JsonResponse([
            'html' => $html
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function preview(Request $request): JsonResponse
    {
        $rss = simplexml_load_file($request->url)->channel;

        $html = \Illuminate\Support\Facades\View::make('admin.rss.rss-preview', [
            'data' => $rss
        ])->render();

        return new JsonResponse([
            'html' => $html
        ]);
    }
}


