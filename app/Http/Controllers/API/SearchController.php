<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //
    public function index(Request $request)
    {

        $products = [];
        $vendors = [];
        $services = [];
        $searchResult = null;

        //
        $tags = [];
        if ($request->tags) {
            if (!is_array($request->tags)) {
                $tags = json_decode($request->tags, true) ?? [];
            } else {
                $tags = $request->tags;
            }

            //
            if (!is_array($tags)) {
                $tags = [$tags];
            }
        }

        //
        if (empty($request->type) || $request->type == "product") {

            $products = $searchResult = Product::active()

                ->when($request->latitude && empty($request->vendor_type_id), function ($query) use ($request) {
                    return $query->where(function ($query) use ($request) {
                        return $this->filterByVendorLocation($query, $request);
                    });
                })
                ->when($request->latitude && $request->vendor_type_id, function ($query) use ($request) {
                    return $query->where(function ($query) use ($request) {
                        return $this->filterByVendorChecks($query, $request);
                    });
                })
            //tag search
                ->when(!empty($tags), function ($query) use ($tags) {
                    return $query->whereHas('tags', function ($query) use ($tags) {
                        return $query->whereIn('id', $tags);
                    });
                })
                ->when($request->category_id, function ($query) use ($request) {
                    return $query->whereHas("categories", function ($query) use ($request) {
                        return $query->where('category_id', "=", $request->category_id);
                    });
                })
                ->when($request->vendor_id, function ($query) use ($request) {
                    return $query->where('vendor_id', $request->vendor_id);
                })

            //
                ->when($request->vendor_type_id && empty($request->latitude), function ($query) use ($request) {
                    return $this->filterByVendorTypeId($query, $request);
                })

                ->when($request->filter == "best", function ($query) {
                    return $query->withCount('sales')->orderBy('sales_count', 'DESC');
                })
                ->when($request->filter == "you", function ($query) {

                    if (auth('sanctum')->user()) {
                        return $query->whereHas('purchases')->withCount('purchases')->orderBy('purchases_count', 'DESC');
                    } else {
                        return $query->inRandomOrder();
                    }
                })
                ->when($request->min_price, function ($query) use ($request) {
                    return $query->where('price', ">=", $request->min_price);
                })
                ->when($request->max_price, function ($query) use ($request) {
                    return $query->where('price', "<=", $request->max_price);
                })
                ->when($request->sort, function ($query) use ($request) {
                    return $query->orderBy('name', $request->sort);
                })
                ->when($request->keyword, function ($query) use ($request) {
                    return $query->where('name', "like", "%" . $request->keyword . "%");
                })
            /*
            ->when($request->vendor_type_id, function ($query) use ($request) {
            return $this->filterByVendorTypeId($query, $request);
            })
            ->when($request->latitude, function ($query) use ($request) {
            return $this->filterByVendorLocation($query, $request);
            })
             */

                ->paginate();

            //
        } else if ($request->type == "service") {

            $services = $searchResult = Service::active()
                ->when($request->latitude, function ($query) use ($request) {
                    return $query->whereHas('vendor', function ($query) use ($request) {
                        return $query->active()->within($request->latitude, $request->longitude);
                    })->orWhereHas('vendor', function ($query) use ($request) {
                        return $query->active()->withinrange($request->latitude, $request->longitude);
                    });
                })
                ->when($request->type == "best", function ($query) {
                    return $query->withCount('sales')->orderBy('sales_count', 'DESC');
                })
                ->when($request->keyword, function ($query) use ($request) {
                    return $query->where('name', "like", "%" . $request->keyword . "%");
                })
                ->when($request->category_id, function ($query) use ($request) {
                    return $query->where('category_id', "=", $request->category_id);
                })
                ->when($request->is_open, function ($query) use ($request) {
                    return $query->where('is_open', "=", $request->is_open);
                })
                ->when($request->vendor_type_id, function ($query) use ($request) {
                    return $query->whereHas('vendor', function ($query) use ($request) {
                        return $query->active()->where('vendor_type_id', $request->vendor_type_id);
                    });
                })
                ->when($request->vendor_id, function ($query) use ($request) {
                    return $query->where('vendor_id', $request->vendor_id);
                })
                ->when($request->sort, function ($query) use ($request) {
                    return $query->orderBy('name', $request->sort);
                })
                ->when($request->min_price, function ($query) use ($request) {
                    return $query->where('price', ">=", $request->min_price);
                })
                ->when($request->max_price, function ($query) use ($request) {
                    return $query->where('price', "<=", $request->max_price);
                })
                ->paginate();
        } else {
            //
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            if (empty($request->vendor_type_id)) {
                $filter = Vendor::select("*"
                    , DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                * cos(radians(latitude))
                * cos(radians(longitude) - radians(" . $longitude . "))
                + sin(radians(" . $latitude . "))
                * sin(radians(latitude))) AS distance"))
                    ->groupBy("id")
                    ->orderBy("distance", 'asc')
                    ->get();
            } else {
                $filter = Vendor::select("*"
                    , DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                * cos(radians(latitude))
                * cos(radians(longitude) - radians(" . $longitude . "))
                + sin(radians(" . $latitude . "))
                * sin(radians(latitude))) AS distance"))
                    ->where("vendor_type_id", $request->vendor_type_id)
                    ->groupBy("id")
                    ->orderBy("distance", 'asc')
                    ->get();
            }

            // if (!empty($request->check) ) {


            // } else {
                $vendors = $searchResult = Vendor::active()
                    ->when($request->latitude, function ($query) use ($request) {
                        return $query->where(function ($query) use ($request) {
                            return $query->within($request->latitude, $request->longitude);
                        })->orwhere(function ($query) use ($request) {
                            return $query->withinrange($request->latitude, $request->longitude);
                        });
                    })
                    ->when($request->keyword, function ($query) use ($request) {
                        return $query->where('name', "like", "%" . $request->keyword . "%");
                    })
                    ->when($request->is_open, function ($query) use ($request) {
                        return $query->where('is_open', "=", $request->is_open);
                    })
                    ->when($request->category_id, function ($query) use ($request) {
                        return $query->whereHas("categories", function ($query) use ($request) {
                            return $query->where('category_id', "=", $request->category_id);
                        });
                    })
                    ->when($request->vendor_type_id, function ($query) use ($request) {
                        return $query->where('vendor_type_id', "=", $request->vendor_type_id);
                    })
                    ->when($request->sort, function ($query) use ($request) {
                        return $query->orderBy('name', $request->sort);
                    })
                    ->paginate();
            // }

        }

        if (!empty($vendors)) {

            $result = $vendors->items();
            $unsortedVendors = collect($result);
            $sortedVendors = $unsortedVendors->sortBy([
                ['is_open', 'desc'],
            ]);

            $result = $vendors->setCollection($sortedVendors);
            $vendors = $result;
        }

        //
        if (!$request->has('merge')) {
            return response()->json([
                "products" => $products,
                "vendors" =>  $vendors ,
                // "filter" => $filter ?? null,
                "services" => $services,
            ], 200);
        } else {
            return response()->json($searchResult, 200);
            // if($request->type == "product"){
            //     return response()->json($searchResult, 200);
            // }
            // // elseif(!empty($request->check)){
            // //     return response()->json([
            // //         "data" =>  $filter ?? null,
            // //     ] );
            // // }
            // else{
            //     return response()->json($searchResult, 200);
            // }

        }

    }

    public function filterByVendorTypeId($query, $request)
    {
        return $query->whereHas("vendor", function ($query) use ($request) {
            return $query->where('vendor_type_id', $request->vendor_type_id);
        });
    }

    public function filterByVendorLocation($query, $request)
    {
        return $query->whereHas('vendor', function ($query) use ($request) {
            return $query->active()->within($request->latitude, $request->longitude);
        })->orWhereHas('vendor', function ($query) use ($request) {
            return $query->active()->withinrange($request->latitude, $request->longitude);
        });
    }

    public function filterByVendorChecks($query, $request)
    {
        return $query->whereHas('vendor', function ($query) use ($request) {
            return $query->active()
                ->within($request->latitude, $request->longitude)
                ->where('vendor_type_id', $request->vendor_type_id);
        })->orWhereHas('vendor', function ($query) use ($request) {
            return $query->active()
                ->withinrange($request->latitude, $request->longitude)
                ->where('vendor_type_id', $request->vendor_type_id);
        });
    }
}
