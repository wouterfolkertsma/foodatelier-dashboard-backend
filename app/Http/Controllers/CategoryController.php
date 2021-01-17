<?php


namespace App\Http\Controllers;


use App\Http\Repositories\CategoryRepository;

use App\Http\Requests\StoreCategory;
use App\Http\Requests\StoreEmployee;
use App\Models\Category;

use App\Models\Employee;

use http\Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;

use Throwable;

class CategoryController extends Controller
{

    /** @var CategoryRepository */
    private $categoryRepository;



    /**
     * EmployeeController constructor.
     *
     * @param CategoryRepository $categoryRepository

     */
    public function __construct(
        CategoryRepository $categoryRepository

    ) {
        $this->categoryRepository = $categoryRepository;

    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function categoryManager(Request $request)
    {
        $categories = Category::all();

        return view('admin.category-management',['categories' => $categories]);
    }



    /**
     * @param Request $request
     * @param int $categoryId
     * @return RedirectResponse
     * @throws Throwable
     */
    public function deleteCategory(
        Request $request,
        int $categoryId
    ) {
        $category = Category::where('id', $categoryId)
            ->with('user')
            ->firstOrFail();

        try {
            $this->categoryRepository->delete($category);
        } catch (Exception $exception) {
            redirect()->back()->with('error', 'Something went wrong');
            dd($exception);
        }

        return redirect()->route('category-manager')->with('success', 'Category deleted');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $categoryId
     * @return Application|Factory|View
     */
    public function editCategory(Request $request, int $categoryId)
    {
        $category = Employee::where('id', $categoryId)
            ->firstOrFail();

        return view('admin.edit-employee', [
            'employee' => $category,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $categoryId
     * @return RedirectResponse
     * @throws Throwable
     */
    public function updateCategory(\Illuminate\Http\Request $request, int $categoryId)
    {
        $category = Employee::where('id', $categoryId)
            ->firstOrFail();


        $this->categoryRepository->save($request->all(), $category);

        return redirect()->route('category.edit', ['id' => $category->id])->with('success', 'Category updated');
    }

    /**
     * @param StoreEmployee $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function saveCategory(StoreCategory $request)
    {
        try {
            $success = $this->categoryRepository->save($request->all());
        } catch (Exception $exception) {
            redirect()->back()->with('error', 'Something went wrong');
        }

        if ($success) {
            return redirect()->route('category-manager')->with('success', 'Category created');
        }
    }

}
