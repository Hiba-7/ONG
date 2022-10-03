<?php

use App\Models\User;
use App\Models\Module;
use App\Models\Wilaya;
use App\Models\Commune;
use App\Models\Planning;
use App\Models\Cotisation;
use App\Enums\UserRoleEnum;
use App\Http\Livewire\Pages\Faq;
use App\Enums\TypeCotisationEnum;
use App\Enums\UserEtatProfileEnum;
use App\Http\Livewire\Pages\Accueil;
use App\Http\Livewire\Pages\Adresse;
use App\Http\Livewire\Pages\Instance;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Pages\AdminRoute;
use App\Http\Livewire\Pages\Parametres;
use App\Http\Controllers\QueryController;
use SebastianBergmann\Comparator\TypeComparator;
use App\Http\Livewire\Pages\Formation as PagesFormation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // redirect to the login route
    return redirect()->route('login');
});

Route::get('/get-all-enums', function () {
    dd(UserEtatProfileEnum::getValues());
});


Route::get('tw', function () {
    // select the commune where id is equal to the max id of the commune table
    $planning = Planning::first();
    // $module=$planning->module;
    // $formation = join('formations', 'modules');
    // dd($planning->module->formation->id);

    //  $commune = Commune::where('id', '<', (Commune::max('id')))->pluck('id', 'nom_commune');

    return view('tw');
});
Route::middleware('auth')->group(function () {

    Route::middleware('role:' . UserRoleEnum::getAdminRolesAsPipelinedString())->group(function () {
        Route::get('/choice', AdminRoute::class)->name('choice');
    });


    Route::get('accueil', Accueil::class)->name("accueil");
    Route::get('formation', PagesFormation::class)->name("formation");
    Route::get('instances', Adresse::class)->name("instances");
    Route::get('faq', Faq::class)->name("faq");
    Route::get('parametres', Parametres::class)->name("parametres");
    Route::prefix('adresse')->group(function () {

        Route::get('', Adresse::class)->name("adresse");
        Route::prefix('{instance_id}/{instance_nom}')->group(function () {
            Route::get('', Instance::class)->name("adresse.instance");
        });
    });
});



Route::get('adminize', function () {
    $user = auth()->user();
    $user->assignRole(UserRoleEnum::getAdminRoles());
    dd($user->getRoleNames());
});

Route::get('unadminize', function () {
    $user = User::find(1);
    $user->removeRole(UserRoleEnum::getAdminRoles());
});

Route::get('mehdi', [QueryController::class, 'mehdi']);

Route::get('nassim', [QueryController::class, 'nassim']);

Route::get('hiba', [QueryController::class, 'hiba']);

Route::get('taha', [QueryController::class, 'taha']);

require __DIR__ . '/auth.php';
