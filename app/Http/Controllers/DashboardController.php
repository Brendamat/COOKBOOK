<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tasting;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userName = Auth::user()->name;
        $userRole = Auth::user()->role->name;

        $adminCount = User::where('role_id', 1)->count();
        $userCount = User::where('role_id', 2)->count();
        $chefCount = User::where('role_id', 3)->count();
        $hrCount = User::where('role_id', 4)->count();
        $tasterCount = User::where('role_id', 5)->count();
        $publisherCount = User::where('role_id', 6)->count();

        $usersCount = User::count();

        $recentRecipes = Recipe::orderBy('created_at', 'desc')->take(5)->get();
        $recipesCount = Recipe::count();
        $booksCount = Book::count();

        $tastingsCount = Tasting::count();
        $recentTastings = Tasting::orderBy('created_at', 'desc')->take(5)->get();


        $userRecipes = 0;
        $userBooks = 0;
        if(isset(Auth::user()->employee) && (Auth::user()->role->name == 'chef' || Auth::user()->role->name == 'admin')){
            $userRecipesCount = Recipe::where('employee_id', Auth::user()->employee->id)->count();
        } else if (isset(Auth::user()->employee) && (Auth::user()->role->name == 'publisher' || Auth::user()->role->name == 'admin')){
            $userBooksCount = Book::where('employee_id', Auth::user()->employee->id)->count();
        }

        return view('home',
            compact('userName', 'userRole', 'adminCount', 'userCount', 'chefCount', 'hrCount', 'tasterCount', 'publisherCount', 'usersCount', 'recentRecipes', 'recipesCount', 'booksCount', 'tastingsCount', 'recentTastings', 'userBooksCount', 'userRecipesCount')
        );
    }
}
