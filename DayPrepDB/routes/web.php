<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     $html = "
//     <h1>ALLE ROUTES<h1>
//     <div>
//         <a href='" . route('overzicht.index') . "'> Overzicht</a>
//         <a href='" . route('taak.create') . "'> Taak toevoegen</a>
//         <a href='" . route('agenda.index', 1) . "'> Agenda</a>
//         <a href='" . route('punten.index', 'Jannes') . "'> Pounten</a>
//         <a href='" . route('viewIntroduction.index') . "'> VIEW INTRO ZOOI</a>
//     <div>
//     ";

//     return $html;
// });


Route::get('/viewIntroduction', function (){
    return view('welcome');
})->name('viewIntroduction.index');




Route::get('/overzicht', function ()  {

   return "<h1> 16 taken gepland en 12 afgerond<h1>"; 

})->name('overzicht.index');



 Route::get('/agenda/{userid}', function ($userid)  {

    return "<h1>Hier alle geplande taken van mr/mevrouw <h1>". $userid; 

 })->name('agenda.index')->whereAlphaNumeric('userid');



// DE '?' ACHTER DE 'userid' GEEFT AAN DAT DE PARAMETER NIET VERPLICHT IS. 
 Route::get('/punten/{gebruikerid?}', function ($gebruikerid = null)  {

    if ($gebruikerid){

        return "<h1>" . $gebruikerid . " Heeft 15 PUNTEN<h1>"; 

    } else {

        return"<h1>ALLE GEBRUIKERS HALLOOO<h1>";

    }
 }) ->name('punten.index')-> whereAlpha('gebruikerid');

// DE whereAlpha(); ZORGT ERVOOR DAT JE ALLEEN LETTERS KAN GEBRUIKEN ALS WAARDES VOOR 'gebruikerid' IN DE URL.
// DE whereNumber(); ZORGT ERVOOR DAT JE ALLEEN NUMMERS KAN GEBRUIKEN ALS WAARDES VOOR 'userid' IN DE URL
// BIJ whereAlphaNumeric(); KAN JE ZOWEL LETTERS ALS NUMMERS GEBRUIKEN IN ALS WAARDES




// DE FALLBACK IS ZORGT ERVOOR DAT JE GEEN 404 ERROR TE ZIEN KRIJGT, MAAR DAT JE JE EIGEN TEXT OF IETS KAN ZIEN DAARIN
Route::fallback(function(){
    return "<h1> DIT BESTAAT NIET JANNES, TACKLE DE SCHEIDS NOU NIET<h1>";
});