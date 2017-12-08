<?php namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\TotalRating;
use GuzzleHttp\Client;
use Request;
use Auth;

class RatingController extends Controller
{
    public static function getRatingsViewData($itemId) {
        $totalCount = TotalRating::where('item_id', $itemId)->first();

        if($totalCount == NULL) {
            $totalCount = new TotalRating;
            $totalCount->item_id = $itemId;
            $totalCount->total_sell = 0;
            $totalCount->total_hold = 0;
            $totalCount->total_buy = 0;

            $totalCount->save();
        }
        $yourVote = 0;
        if (Auth::check()) {
            $checkYourRating = Rating::where([
                'user_id' => Auth::user()->id,
                'comment_id' => $itemId
            ])->first();
            if ($checkYourRating != NULL) {
                $yourVote = $checkYourRating->value;
            }
        }
        $ratingDisabled = "";
        if (!Auth::check()) {
            $ratingDisabled = "disabled";
        }
        if(!empty($yourVote)){
            $buyIconOutlined = $yourVote == 1 ? "" : "outline";
            $holdIconOutlined = $yourVote == 2 ? "" : "outline";
            $sellIconOutlined = $yourVote == 3 ? "" : "outline";
        }
        else {
            $buyIconOutlined = "";
            $holdIconOutlined = "";
            $sellIconOutlined = "";
        }
        return [
            $itemId . 'ratingDisabled' => $ratingDisabled,
            $itemId . 'buyIconOutlined' => $buyIconOutlined,
            $itemId . 'holdIconOutlined' => $holdIconOutlined,
            $itemId . 'sellIconOutlined' => $sellIconOutlined,
            $itemId . 'total_buy' => $totalCount->total_buy,
            $itemId . 'total_hold' => $totalCount->total_hold,
            $itemId . 'total_sell' => $totalCount->total_sell,
        ];
    }

    public function vote(Request $request)
    {
        /* Check if user is loged in*/
        if (!Auth::check()) {
            return response()->json(['flag' => 0]);
        }

        /* Prepare data */
        $userId = Auth::user()->id;
        $itemId = !empty($_GET['item_id']) ? $_GET['item_id'] : '';
        $vote = !empty($_GET['vote']) ? $_GET['vote'] : '';

        $totalLike = TotalRating::where('item_id', $itemId)->first();

        /* Get user's rate on this item */
        $rate = Rating::where(['user_id' => $userId, 'comment_id' => $itemId])->first();
        /* Check if users rate on this item exists */
        if ($rate != null) {
            if ($rate->value == 0) {
                $rate->value = $vote;
                if($vote == 1) {
                    $totalLike->total_buy++;
                } elseif ($vote == 2) {
                    $totalLike->total_hold++;
                } elseif ($vote == 3) {
                    $totalLike->total_sell++;
                }
            } else {


                if ($vote == 1) {
                    if ($vote == $rate->value) {
                        $totalLike->total_buy--;
                        $rate->value = 0;
                    } elseif ($vote != $rate->value) {
                        if ($rate->value == 2) {
                            $totalLike->total_hold--;
                            $totalLike->total_buy++;
                        } elseif ($rate->value == 3) {
                            $totalLike->total_sell--;
                            $totalLike->total_buy++;
                        }
                        $rate->value = 1;
                    }
                } elseif ($vote == 2) {
                    if ($vote == $rate->value) {
                        $totalLike->total_hold--;
                        $rate->value = 0;
                    } elseif ($vote != $rate->value) {
                        if ($rate->value == 1) {
                            $totalLike->total_buy--;
                            $totalLike->total_hold++;
                        } elseif ($rate->value == 3) {
                            $totalLike->total_sell--;
                            $totalLike->total_hold++;
                        }
                        $rate->value = 2;
                    }
                } elseif ($vote == 3) {
                    if ($vote == $rate->value) {
                        $totalLike->total_sell--;
                        $rate->value = 0;
                    } elseif ($vote != $rate->value) {
                        if ($rate->value == 1) {
                            $totalLike->total_buy--;
                            $totalLike->total_sell++;
                        } elseif ($rate->value == 2) {
                            $totalLike->total_hold--;
                            $totalLike->total_sell++;
                        }
                        $rate->value = 3;
                    }
                }
            }
        } else {
            $rate = new Rating();	// create new like object if previous vote not exists
            $rate->value = $vote;
            if($vote == 1) {
                $totalLike->total_buy++;
            } elseif ($vote == 2) {
                $totalLike->total_hold++;
            } elseif ($vote == 3) {
                $totalLike->total_sell++;
            }
        }

        /* Update vote data */
        $rate->user_id = $userId;
        $rate->comment_id = $itemId;
        $rate->com_id = preg_replace('/\D/', '', $itemId);
        $rate->save();		// save like
        $totalLike->save();	//save total like,dislike

        return response()->json(['flag' => 1, 'vote' => $vote, 'totalBuy' => $totalLike->total_buy,  'totalHold' => $totalLike->total_hold, 'totalSell' => $totalLike->total_sell]);
    }

}
