<?php namespace App\Http\Controllers\Site;
	
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminItemRequest;
use App\Models\Coin;
use App\Models\IcoItems;
use Illuminate\Support\Facades\Session;
use Request;
use View;

class ItemController extends Controller {

	/*==================ICO-ITEMS===================*/


	public function getItems() {
		return view('admin.items', [
			'items' => IcoItems::all()
		]);
	}

    public function getItem($slug) {
        $item = IcoItems::where(['slug' => $slug])->first();
        return view('site.ico_item', [
            'item' => $item
        ]);
    }

    public function getItemSave(AdminItemRequest $request, $id = 0) {
        $id = IcoItems::save_data($id, $request);
        $html = View::make('includes.success')->render();
        if($id) {
            return response()->json(['status' => 'success', 'html' => $html]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function getItemsAjax() {
	    $items = IcoItems::where(['published' => 1])->with('rating')->get();
        $sort = [];
        foreach ($items as $key=>$item){
            $sort[$key] = $item;
            $sort[$key]['likes'] = $item->likes();
        }
        usort($sort, function ($a, $b)
        {
            if ($a['likes'] == $b['likes']) {
                return 0;
            }
            return ($a['likes'] > $b['likes']) ? -1 : 1;
        });
	    $ico = View::make('includes.ico_partials', ['items' => $sort])->render();
	    return $ico;
    }

    public function getCoinsAjaxAll() {
	    $term = $_GET['term'] ? $_GET['term'] : '';
	    if ($term) {
            $all = Coin::where('name', 'like', '%'.$term.'%')->orWhere('value', 'like', '%'.$term.'%')->get();
        } else {
            $all = Coin::all();
        }
	    return response()->json($all);
    }

    public function getFinished() {
        $res = json_decode(file_get_contents('https://api.icowatchlist.com/public/v1/finished'), true);
        dump($res);
    }
}
