<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\CommissionLog;
use App\Models\ReferralSetting;
use App\Models\GenerationTransaction;
use Artisan;
use Cache;
use CoreComponentRepository;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard(Request $request)
    {
        CoreComponentRepository::initializeCache();
        $root_categories = Category::where('level', 0)->get();

        $cached_graph_data = Cache::remember('cached_graph_data', 86400, function () use ($root_categories) {
            $num_of_sale_data = null;
            $qty_data = null;
            foreach ($root_categories as $key => $category) {
                $category_ids = \App\Utility\CategoryUtility::children_ids($category->id);
                $category_ids[] = $category->id;

                $products = Product::with('stocks')->whereIn('category_id', $category_ids)->get();
                $qty = 0;
                $sale = 0;
                foreach ($products as $key => $product) {
                    $sale += $product->num_of_sale;
                    foreach ($product->stocks as $key => $stock) {
                        $qty += $stock->qty;
                    }
                }
                $qty_data .= $qty . ',';
                $num_of_sale_data .= $sale . ',';
            }
            $item['num_of_sale_data'] = $num_of_sale_data;
            $item['qty_data'] = $qty_data;

            return $item;
        });

        return view('backend.dashboard', compact('root_categories', 'cached_graph_data'));
    }

    function clearCache(Request $request)
    {
        Artisan::call('cache:clear');
        flash(translate('Cache cleared successfully'))->success();
        return back();
    }

    public function levelInformation()
    {
        $pageTitle = "Generation Setting";
        $refs = ReferralSetting::all();
        $level = ReferralSetting::all()->count();
        $levels = $level + 1;
        return view('admin.generation.index', compact('pageTitle', 'refs', 'levels'));
    }

    public function levelSet(Request $request)
    {
        $level = new ReferralSetting();

        $level->commission_type = $request->commission_type;
        $level->level = $request->level;
        $level->percent = $request->percent;
        $level->save();
        return back();
    }
    function refDelete()
    {
        ReferralSetting::orderBy('id', 'desc')->limit(1)->delete();
        return back();
    }
    function refEdit($id)
    {
        $pageTitle = 'Referral Edit';
        $ref = ReferralSetting::findOrFail($id);
        return view('admin.generation.referral_edit', compact('ref', 'pageTitle'));
    }
    function levelUpdate(Request $request)
    {
        $ref = ReferralSetting::findOrFail($request->id);
        $ref->id = $request->id;
        $ref->commission_type = $request->commission_type;
        $ref->level = $request->level;
        $ref->percent = $request->percent;
        $ref->save();
        $notify[] = ['success', 'refferal setting updated successfully'];
        return redirect()->route('generation.setting')->withNotify($notify);
    }
    function commissionList()
    {
        $pageTitle = "Generation Commission";
        $commissions = CommissionLog::with('toUser','fromUser')->paginate(getPaginate());
        return view('admin.generation.commission_list', compact('pageTitle', 'commissions'));
    }
    function generationTransaction(){
        $pageTitle = "Generation Transaction History";
        $generations = GenerationTransaction::with('user')->paginate(getPaginate());
        return view('admin.generation.transaction',compact('pageTitle','generations'));
    }
}
