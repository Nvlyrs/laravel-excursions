<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Excursion;
use Illuminate\Database\Eloquent\Builder;

class CatalogController extends Controller
{
    /**
     * Display the catalog page.
     */
    public function display(Request $request): Response
    {
        $excursionsQuery = Excursion::orderBy('id');

        if ($request->method() == "POST") {

            $sortingCriteria = '';


            // if($validatedData['show_favorites']){
            //     $excursionsQuery = $excursionsQuery->where('type_id', $validatedData['type']);
            // }

            if ($request->filled('city')) {
                $excursionsQuery->where('city_id', $request->get('city'));
            }

            if ($request->filled('type')) {
                $excursionsQuery->where('type_id', $request->get('type'));
            }

            if ($request->get('type_individual') == true && $request->get('type_group') == true) {
                $excursionsQuery->where(function (Builder $query) {
                    $query->where('type_id', 1)
                        ->orWhere('type_id', 2);
                });
            } else if ($request->get('type_individual') == true && !($request->get('type_group') == true)) {
                $excursionsQuery->where('type_id', 1);
            } else if (!($request->get('type_individual') == true) && $request->get('type_group') == true) {
                $excursionsQuery->where('type_id', 2);
            }

            if ($request->filled('first_price') && $request->filled('last_price')) {
                $excursionsQuery->whereBetween('price', [$request->get('first_price'), $request->get('last_price')]);
            }


            if ($request->filled('start_date') && $request->filled('end_date')) {
                $excursionsQuery->whereHas('dateFrames', function ($query) use ($request) {
                    $query->where('start_date', '<=', $request->get('start_date'))
                        ->where('end_date', '>=', $request->get('end_date'));
                    $query->orWhere(function (Builder $query) use ($request) {
                        $query->whereBetween('start_date', [$request->get('start_date'), $request->get('end_date')])
                            ->orWhereBetween('end_date', [$request->get('start_date'), $request->get('end_date')]);
                    });
                });
            }

            if ($request->filled('sorting_criteria')) {
                switch ($request->get('sorting_criteria')) {
                    case 1:
                        $sortingCriteria = 'hits';
                        break;
                    case 2:
                        $sortingCriteria = 'price';
                        break;
                    case 3:
                        $sortingCriteria = 'rating';
                        break;

                    default:
                        $sortingCriteria = 'hits';
                        break;
                }
            }

            if ($request->filled('sorting_type')) {
                switch ($request->get('sorting_type')) {
                    case 1:
                        $excursionsQuery->orderBy($sortingCriteria, 'asc');
                        break;
                    case 2:
                        $excursionsQuery->orderBy($sortingCriteria, 'desc');
                        break;

                    default:
                        $excursionsQuery->orderBy($sortingCriteria, 'asc');
                        break;
                }
            }

            // $excursionsQuery = $excursionsQuery->where('city_id', $validatedData['city'])
            // ->where('type_id', $validatedData['type']);
        }

        $excursionsQuery->paginate(10);

        // $excursionsQuery->whereHas('favorites', function ($query) use ($request) {
        //     $query->where('user_id', '=', 1);
        // });

        $excursions = $excursionsQuery->with(['user', 'type', 'dateFrames', 'favorites'])
            ->get();


        return Inertia::render('Catalog/Display', [
            'auth_user' => Auth::user(),
            'status' => session('status'),
            'excursions' => $excursions,
        ]);
    }
}
