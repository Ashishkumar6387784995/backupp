<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Category;
use App\Models\Speciality;
use App\Models\SeoPage;
use DB;
use Validator;

class CommonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getStates($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }

    // Fetch cities based on selected state
    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }
    public function getAjaxCities($stateId = null)
    {
        if ($stateId) {
            return City::where('state_id', $stateId)->where('status', 1)->get();
        }
    }
    public function getAjaxSubCategories()
    {
        $categoryId = request('categoryId');
        if ($categoryId) {
            $categoryId = explode(',', $categoryId);
            return Category::whereIn('parent_id', $categoryId)->orderBy('category_name', 'asc')->get();
        }
    }
    public function getAjaxSpecilities()
    {
        $departmentId = request('departmentId');
        if ($departmentId) {
            $departmentId = explode(',', $departmentId);
            return Speciality::whereIn('department_id', $departmentId)->orderBy('speciality_name', 'asc')->get();
        }
    }
    public function checkSeoSlug()
    {
        $slug = request('slug');
        $id = request('id');
        if ($slug) {
            $data = SeoPage::where('slug', $slug)->when($id, function ($data) use ($id) {
                if ($id) {
                    $data->where('id', '<>', $id);
                }
            })->first();
            if ($data) {
                return [
                    'Success' => true,
                    'Data' => $data,
                    'Message' => 'Slug already exist.',
                ];
            } else {
                return [
                    'Success' => false,
                    'Data' => '',
                    'Message' => 'Slug available.',
                ];
            }
        } else {
            return [
                'Success' => false,
                'Data' => '',
                'Message' => 'Slug available.',
            ];
        }
    }
    
     public function getJobTypeNameById(Request $request) {
        $id = $request->id;
        if ($id) {
            $data = getJobTypeNameById($id);
            if (!$data) {
                return response()->json([
                    'message' => 'Job type not found',
                    'data' => [],
                    'status_code' => 404
                ], 404);
            }
            return response()->json([
                'message' => 'Job type',
                'data' => $data,
                'status_code' => 200 
            ], 200);
        } else {
            return response()->json([
                'message' => 'Id must be required',
                'data' => [],
                'status_code' => 404
            ], 404);
        }
    }

    public function getJobCategoryNameById(Request $request) {
        $id = $request->id;
        if ($id) {
            $data = getJobCategoryNameById($id);
            if (!$data) {
                return response()->json([
                    'message' => 'Job Category not found',
                    'data' => [],
                    'status_code' => 404
                ], 404);
            }
            return response()->json([
                'message' => 'Job Category',
                'data' => $data,
                'status_code' => 200 
            ], 200);
        } else {
            return response()->json([
                'message' => 'Id must be required',
                'data' => [],
                'status_code' => 404
            ], 404);
        }
    }

    public function getjobExperienceNameById(Request $request) {
        $id = $request->id;
        if ($id) {
            $data = getjobExperienceNameById($id);
            if (!$data) {
                return response()->json([
                    'message' => 'Job Experience not found',
                    'data' => [],
                    'status_code' => 404
                ], 404);
            }
            return response()->json([
                'message' => 'Job Experience',
                'data' => $data,
                'status_code' => 200 
            ], 200);
        } else {
            return response()->json([
                'message' => 'Id must be required',
                'data' => [],
                'status_code' => 404
            ], 404);
        }
    }

    public function getLicenseCertificateNameById(Request $request) {
        $id = $request->id;
        if ($id) {
            $data = getLicenseCertificateNameById($id);
            if (!$data) {
                return response()->json([
                    'message' => 'Job Certificate not found',
                    'data' => [],
                    'status_code' => 404
                ], 404);
            }
            return response()->json([
                'message' => 'Job Certificate',
                'data' => $data,
                'status_code' => 200 
            ], 200);
        } else {
            return response()->json([
                'message' => 'Id must be required',
                'data' => [],
                'status_code' => 404
            ], 404);
        }
    }

    public function getCompanyLocationNameById(Request $request) {
        $id = $request->id;
        if ($id) {
            $data = getCompanyLocationNameById($id);
            if (!$data) {
                return response()->json([
                    'message' => 'Company Location not found',
                    'data' => [],
                    'status_code' => 404
                ], 404);
            }
            return response()->json([
                'message' => 'Company Location',
                'data' => $data,
                'status_code' => 200 
            ], 200);
        } else {
            return response()->json([
                'message' => 'Id must be required',
                'data' => [],
                'status_code' => 404
            ], 404);
        }
    }
}
