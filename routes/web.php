<?php

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
    return redirect('/login');
});

Auth::routes();


//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cargar','AdminController@form')->middleware('auth');
Route::post('/guardarpaciente','AdminController@store')->middleware('auth');
//tipo pacientes
Route::get('/pacientes','AdminController@listadoPacientesActivos')->middleware('admin');
Route::get('/pacientes/provisorios','AdminController@listadoPacientesProvisorios')->middleware('admin');
Route::post('pacientes/generarnoingreso','NoIncomeController@store')->middleware('admin');
Route::get('/pacientes/noingresados','AdminController@PacientesNoingresados')->middleware('admin');
Route::get('/pacientes/epicrisis','AdminController@pacientesEpicrisis')->middleware('admin');
Route::post('/pacientes/daralta','HighMedicalController@store')->middleware('admin');
Route::get('/pacientes/alta','AdminController@pacientesAlta')->middleware('admin');

Route::get('generarepicrisis/{idepisode}','EpicrisisController@show');
Route::get('guardarepicrisis','EpicrisisController@store')->name('store.epicrisis');
Route::get('/pdf/epicrisis/{idepicrisis}','EpicrisisController@pdfShow')->name('epicrisis.pdf');


Route::get('/evoluciones/{idepisodio}','AdminController@evoluciones')->middleware('auth');
Route::get('/pdf/informes/{idInforme}','AdminController@pdfMedicalReport')->middleware('auth')->name('pdf.informe');
Route::get('/pdf/evolucionmedica/{idEvo}','AdminController@pdfMedicalEvolution')->middleware('auth')->name('pdf.evolucionmedica');
Route::get('/pdf/evolucionesenfermeria/{idEvo}','NurseEvolutionController@pdfEvolucion')->middleware('auth');
Route::get('/asignados','DoctorController@asignados')->middleware('auth');
Route::get('/activarepisodio','AdminController@activarEpi')->middleware('admin');
Route::post('activarepi','AdminController@storeActivarEpi')->middleware('admin');
//doctor

Route::get('/cronogramamedico','DoctorController@cronograma')->middleware('auth');
Route::get('/ingresomedico/{id}','MedicalReportController@showOpcionesMedicalReport')->middleware('auth');
Route::get('cargaringresomedico/{id}','MedicalReportController@show')->middleware('medicalIncomeExist','auth')->name('ingresomedico.cargar');

//busqueda tiempo real medicamento
Route::get('/search','MedicalReportController@searchmedicacion');
Route::get('/medicacioningreso/agregarmedi','MedicalReportController@agregar')->middleware('auth')->name('ingresomedico.agrega');
Route::get('/medicacioningreso/quitarmedi/{medicine}','MedicalReportController@quitar')->middleware('auth')->name('ingresomedico.quita');
Route::get('/indicacioningresomedico/agregarindi','MedicalReportController@agregarIndi')->middleware('auth')->name('ingresomedico.indi.agrega');
Route::get('indicacioningresomedico/quitarindi/{indicacion}','MedicalReportController@quitarIndi')->middleware('auth')->name('ingresomedico.indi.quita');
Route::post('/ingresomedico/store','MedicalReportController@store')->middleware('auth');


Route::get('/cronogramaenfermeria','NurseController@cronograma')->middleware('auth');
Route::get('cronomedico','AdminController@cronomedico')->middleware('auth');
Route::post('/cargarcronomedico','AdminController@cargarcronomedico')->middleware('auth');
Route::get('/citas','AdminController@citas')->middleware('auth');
Route::post('/tipocita','AdminController@tipocita')->middleware('auth');
Route::post('/guardarcita','AdminController@storecita')->middleware('auth');
Route::post('/guardarcitaenfermeria','AdminController@storecitaenfermeria')->middleware('auth');
Route::get('/citas/{cita}','CitaController@cargar')->middleware('auth');
//este es el metodo que busca el medicamento en tiempo real de la evolucion medica
Route::get('searchmedievo','MedicalEvolutionController@livesearchmedi')->middleware('auth');
Route::get('evolucionmedica/{cita}','MedicalEvolutionController@cargarEvo')->name('citamedica.evolution')->middleware('medicalEvolutionExist');

//admin//prestadores
Route::get('/prestadores','AdminController@prestadores')->middleware('admin');
Route::get('/prestadores/alta','AdminController@Prestadoresalta')->middleware('admin');
Route::post('/prestadores/store','AdminController@PrestadoresStore')->middleware('admin');
Route::post('/prestadores/habilitar','UserController@habilitar')->middleware('admin');
Route::post('prestadores/deshabilitar','UserController@deshabilitar')->middleware('admin');
Route::post('/prestadores/update','UserController@update')->middleware('admin');

Route::get('/ingresosmedicos','MedicalIncomeController@ingresosMedicos')->middleware('admin');
Route::post('/ingresosmedicos/update','MedicalIncomeController@update')->middleware('admin');

//obra social
Route::get('obrasocial/alta','SocialWorkController@form')->middleware('admin');
Route::post('/obrasocial/store','SocialWorkController@store')->middleware('admin');




Route::get('/pdf/enfermeros','NurseController@listadoEnfermeros')->middleware('admin');
Route::get('/pdf/medicos','DoctorController@listadoDoctores')->middleware('admin');
Route::get('/pdf/kinesiologos','KinesiologistController@listadoKine')->middleware('admin');
Route::get('/pdf/psicologos','PsychologistController@listadoPsi')->middleware('admin');
Route::get('/pdf/administracion','AdminController@listadoAdmin')->middleware('admin');
Route::get('/pdf/asistentessocial','SocialAssistantController@listadoAsistentes')->middleware('admin');

//cama virtua
Route::get('/camavirtual','AdminController@camavirtual')->middleware('auth');

//control pacientes
Route::get('/home','AdminController@index')->middleware('admin');
Route::get('/general','AdminController@homeGeneral');

//citas medicas
Route::post('/agregarcitamedicaevo','CitaEvolutionMedicalController@store')->middleware('admin');
Route::post('/modificarcitamedicaevo','CitaEvolutionMedicalController@update')->middleware('admin');
Route::post('/eliminarcitamedicaevo','CitaEvolutionMedicalController@delete')->middleware('admin');
Route::post('/eliminardiagramamedi','MedicalDiagramController@delete')->middleware('admin');
Route::post('/agregardiagrama','MedicalDiagramController@store')->middleware('admin');

//enfermeria
Route::get('/citasenfermeria/{id}','CitaEnfermeriaController@cargar')->middleware('auth')->middleware('NurseEvolutionExist');
Route::post('/evolucionesenfermeria','NurseEvolutionController@show')->middleware('auth');
Route::post('/cargarevolucionenfermeria','NurseEvolutionController@store')->middleware('auth')->name('enfermeria.store');
Route::get('diagramaenfermeria','NurseController@diagramaEnfPrueba')->middleware('admin');
Route::get('agregarcitamasivaenf','NurseController@citasMasiva')->middleware('admin');
Route::get('diagramadorenfermeria','NurseController@diagramadorEnf')->middleware('admin');
Route::get('agregarturnoenfermeriaepiosdio','NurseController@agregarturnoEpi')->middleware('admin');
Route::post('agregarturnomañanaenfermeria','NurseController@agregarturnomanianaEpi')->middleware('admin');
Route::post('agregarturnotardeenfermeria','NurseController@agregarturnotardeEpi')->middleware('admin');
Route::post('editarcitaenfermeria','NurseController@editarCitaEnf')->middleware('admin');
Route::post('agregarcitaenfermeria','NurseController@agregarCitaUnitaria')->middleware('admin');
Route::post('eliminarcitaenf','CitaEnfermeriaController@delete')->middleware('admin');
Route::post('/eliminardiagramaenf','NursingDiagramController@delete')->middleware('admin');

Route::post('/evolucionesmedicas','MedicalEvolutionController@cargar')->middleware('auth');
Route::get('/quitarmedicacion/{medicine}','MedicalEvolutionController@remove')->middleware('auth');
Route::get('/medicacion/reset','MedicalEvolutionController@resetMedicacion')->middleware('auth');
Route::get('indicacion/reset','MedicalEvolutionController@resetIndicacion')->middleware('auth');
Route::get('/agregarmedicacionevomedi','MedicalEvolutionController@agregar')->middleware('auth');
Route::get('agregarindicacion','MedicalEvolutionController@agregarIndi')->middleware('auth')->name('evolucionmedica.indi.agrega');
Route::get('quitarindicacion/{indicacion}','MedicalEvolutionController@removeIndi')->middleware('auth')->name('evolucionmedica.indi.quita');
Route::get('/storeevolucion','MedicalEvolutionController@storeEvolucion')->middleware('auth');


//Cargar de tratamientos
Route::get('cargartratamiento','DoctorController@cargarTratamiento');
Route::post('cargartratamiento','DoctorController@postcargarTratamiento');

//Carga de medicacion
Route::Get('cargarmedicacion','DoctorController@cargarmedicacion');
Route::post('cargarmedicacion','DoctorController@postcargarMedicacion');

//observaciones
Route::post('/agregarobservacion','ObservationController@store');
Route::get('/episodio/{idepisodio}/observaciones/','ObservationController@observations');

//prorrogas
Route::get('/asignarprorroga','ExtensionController@asignar');
Route::post('/guardarprorroga','ExtensionController@store');
Route::get('/prorrogas','ExtensionController@showprorogas');
Route::get('prorroga/{idprorroga}','ExtensionController@showOpciones');
Route::get('cargarprorroga/{prorroga}','ExtensionController@show')->middleware('auth')->name('prorroga.cargar')->middleware('ExtensionExist');
Route::post('/prorroga/store','ExtensionController@storeExtension');
Route::get('/agregarmedicacionprorroga','ExtensionController@agregarMediPr')->middleware('auth');
Route::get('/prorroga/quitarindicacion/{indicacion}','ExtensionController@removeIndiPr')->middleware('auth');
Route::get('/prorroga/indicacion/reset','ExtensionController@resetIndicacionPr')->middleware('auth');

Route::get('/prorroga/quitarmedicacion/{medicine}','ExtensionController@removeMedPr')->middleware('auth');
Route::get('/prorroga/medicacion/reset','ExtensionController@resetMedicacionPr')->middleware('auth');
Route::get('/agregarindicacionprorroga','ExtensionController@agregarIndiPr')->middleware('auth')->name('prorroga.indi.agrega');
Route::get('pdf/prorroga/{idprorroga}','ExtensionController@pdfProrroga')->middleware('auth');
Route::post('/autorizarprorroga','ExtensionController@postAutorizarProrroga');

//kinesiologia
Route::get('calendariokinesiologia','KinesiologistController@calendario')->middleware('auth');
Route::get('citaskinesiologia/{idCita}','KinesiologistController@cargarCita')->middleware('auth')->middleware('KinesiologyEvolutionExist');
Route::post('evolucioneskinesiologia','KinesiologistEvolutionController@show');
Route::post('cargarevolucionkinesiologia','KinesiologistEvolutionController@store');
Route::get('/pdf/evolucioneskinesiologia/{idEvo}','KinesiologistEvolutionController@pdfEvolucion')->middleware('auth');
Route::get('diagramakinesiologia','KinesiologistController@diagramaKine')->middleware('auth');
//Route::post('/editarcitakine','CitaKinesiologiaController@edit')->middleware('admin');
//Route::post('/agregarcitakine','CitaKinesiologiaController@agregar')->middleware('admin');
Route::post('agregarcitakinesiologiaevo','CitaKinesiologiaController@store')->middleware('admin');
Route::post('modificarcitakine','CitaKinesiologiaController@update')->middleware('admin');
Route::post('/eliminarcitakine','CitaKinesiologiaController@delete')->middleware('admin');
Route::post('/eliminardiagramakine','KinesiologyDiagramController@delete')->middleware('admin');
Route::post('agregardiagramakine','KinesiologyDiagramController@store')->middleware('admin');

//diagrama medico
Route::get('/diagramamedico','DoctorController@diagramaMed')->middleware('admin');


//Psicologia
Route::get('calendariopsicologia','PsychologistController@calendario')->middleware('auth');
Route::get('citaspsicologia/{idCita}','PsychologistController@cargarCita')->middleware('auth')->middleware('PsycholoyEvolutionExist');
Route::post('evolucionespsicologia','PsychologistEvolutionController@show')->middleware('auth');
Route::post('cargarevolucionpsicologia','PsychologistEvolutionController@store')->middleware('auth');
Route::get('/pdf/evolucionespsicologia/{idEvo}','PsychologistEvolutionController@pdfEvolucion')->middleware('auth')->name('pdf.PsychoEvo');
Route::get('/diagramapsicologia','PsychologistController@diagrama')->middleware('admin');
Route::post('/agregarcitapsicologiaevo','CitaPsicologiaController@store')->middleware('admin');
Route::post('/modificarcitamedicapsi','CitaPsicologiaController@update')->middleware('admin');
Route::post('/eliminarcitapsi','CitaPsicologiaController@delete')->middleware('admin');
Route::post('agregardiagramapsi','PsychologyDiagramController@store')->middleware('admin');
Route::post('eliminardiagramapsi','PsychologyDiagramController@delete')->middleware('admin');



//asistente social
Route::get('calendarioasistentesocial','SocialAssistantController@calendario')->middleware('auth');
Route::get('ingresoasistentesocial/{id}','PsychoSocialIncomeController@cargar')->middleware('auth');
Route::post('ingresopsicosocial','SocialContextController@cargarform')->middleware('auth');
Route::post('guardaringresopsicosocial','SocialContextController@store')->middleware('auth');
Route::get('/diagramaasistentesocial','SocialAssistantController@diagrama')->middleware('auth');
Route::post('/agregarcitaasistentesocialaevo','CitasAsistenteSocialController@store')->middleware('auth');
Route::post('/modificarcitamedicaasis','CitasAsistenteSocialController@update')->middleware('auth');
Route::post('/eliminarcitaasis','CitasAsistenteSocialController@delete')->middleware('auth');
Route::post('agregardiagramaasis','SocialAssistantDiagramController@store')->middleware('auth');
Route::post('eliminardiagramaasis','SocialAssistantDiagramController@delete')->middleware('auth');
Route::get('citasasistesocial/{idCita}','CitasAsistenteSocialController@cargarCita')->middleware('auth')->middleware('SocialAssistantEvolutionExist');
Route::post('evolucionesasistentesocial','SocialAssistantEvolutionController@show')->middleware('auth');
Route::post('/cargarevolucionasistentesocial','SocialAssistantEvolutionController@store')->middleware('auth');
Route::get('/pdf/evolucionasistentesocial/{idEvo}','SocialAssistantEvolutionController@pdfEvolucion')->middleware('auth');
Route::get('/pdf/informepsicosocial/{idingreso}','PsychoSocialIncomeController@pdfIngreso')->middleware('auth');
//perfil coordinador
Route::get('/indicacionesmedicas','CoordinatorController@indicaciones')->middleware('auth');
Route::post('/autocomplete/fetch', 'CoordinatorController@fetch')->name('autocomplete.fetch');
Route::get('/medicacion','CoordinatorController@medicacion')->middleware('auth');
Route::get('medicacion/{id}','CoordinatorController@showmedicamento')->middleware('auth');
Route::post('/medicacion/store','MedicineController@store')->middleware('auth');
Route::get('modal/contenido/{id}','MedicineController@contenido')->name('modal.contenido');
//contenido modal editar datos ingreso
//Route::get('/pacientes/episodio/modificaringresos/{idepisodio}','AdminController@editarIngresos')->middleware('auth');
Route::get('episodio/modificar/{idepisodio}','AdminController@editarIngresos')->middleware('admin')->name('episodio.modificar');
Route::post('episodio/modificar/store','AdminController@updateIngresos')->middleware('admin')->name('episodio.update');

Route::post('medicacion/editar','MedicineController@edit')->middleware('auth')->name('medicine.editar');



Route::get('/autoomplete','CoordinatorController@autocomplete')->name('autocomplete');
Route::get('//farmacia/buscamedicacion','CoordinatorController@buscaMedicacion');
Route::get('/evoluciones','CoordinatorController@evoluciones');
Route::post('/evoluciones/search','CoordinatorController@evolucionesSearch')->name('evoluciones.search')->middleware('auth');
