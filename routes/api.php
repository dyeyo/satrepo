<?php

use App\Http\Controllers\EmpresaSedeController;
use App\Http\Controllers\InscripcionesController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\parametros\FormaPagoController;
use App\Http\Controllers\parametros\CategoriasController;
use App\Http\Controllers\parametros\DepartamentoController;
use App\Http\Controllers\parametros\EmpresasController;
use App\Http\Controllers\parametros\EstadoController;
use App\Http\Controllers\parametros\EstratoController;
use App\Http\Controllers\parametros\ModuloController;
use App\Http\Controllers\parametros\MunicipioController;
use App\Http\Controllers\parametros\PaisController;
use App\Http\Controllers\parametros\PerfilController;
use App\Http\Controllers\parametros\PeriodoController;
use App\Http\Controllers\parametros\SedesController;
use App\Http\Controllers\parametros\TipoDocumentoController;
use App\Http\Controllers\parametros\TipoEntregaController;
use App\Http\Controllers\parametros\TipoPersonaController;
use App\Http\Controllers\parametros\TipoPlanController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\VinculacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::group(['middleware' => ['cors']], function () {
//**** PARAMETROS *****/ 

//-PAIS
Route::get('/paises', [PaisController::class, 'index'])->name('paise.index');
Route::post('/paises', [PaisController::class, 'store'])->name('paise.store');
Route::get('/paises/{id}', [PaisController::class, 'edit'])->name('paise.edit');
Route::put('/paises/editar/{id}', [PaisController::class, 'update'])->name('paise.update');
Route::put('/paises/elimnar/{id}', [PaisController::class, 'destroy'])->name('paise.delete');

//-DEPARTAMENTO
Route::get('/departamentos', [DepartamentoController::class, 'index'])->name('departamento.index');
Route::get('/departamentos/pais/{id}', [DepartamentoController::class, 'getDepartamentosByPais'])->name('departamento.pais');
Route::post('/departamentos', [DepartamentoController::class, 'store'])->name('departamento.store');
Route::get('/departamentos/{id}', [DepartamentoController::class, 'edit'])->name('departamento.edit');
Route::put('/departamentos/editar/{id}', [DepartamentoController::class, 'update'])->name('departamento.update');
Route::delete('/departamentos/{id}', [DepartamentoController::class, 'destroy'])->name('departamento.delete');

//-MUNICIPIO
Route::get('/municipios', [MunicipioController::class, 'index'])->name('municipio.index');
Route::get('/municipios/departamento/{id}', [MunicipioController::class, 'getMuniByDepar'])->name('municipio.departamentos');
Route::post('/municipios', [MunicipioController::class, 'store'])->name('municipio.store');
Route::get('/municipios/{id}', [MunicipioController::class, 'edit'])->name('municipio.edit');
Route::put('/municipios/editar/{id}', [MunicipioController::class, 'update'])->name('municipio.update');
Route::delete('/municipios/{id}', [MunicipioController::class, 'destroy'])->name('municipio.delete');

//-CATEGORIA
Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id}', [CategoriasController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/editar/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{id}', [CategoriasController::class, 'destroy'])->name('categorias.delete');

//-EMPERSA
Route::get('/empresa', [EmpresasController::class, 'index'])->name('empresa.index');
Route::post('/empresa', [EmpresasController::class, 'store'])->name('empresa.store');
Route::get('/empresa/{id}', [EmpresasController::class, 'edit'])->name('empresa.edit');
Route::put('/empresa/editar/{id}', [EmpresasController::class, 'update'])->name('empresa.update');
Route::delete('/empresa/{id}', [EmpresasController::class, 'destroy'])->name('empresa.delete');

//-ESTADO
Route::get('/estados', [EstadoController::class, 'index'])->name('estados.index');
Route::post('/estados', [EstadoController::class, 'store'])->name('estados.store');
Route::get('/estados/{id}', [EstadoController::class, 'edit'])->name('estados.edit');
Route::put('/estados/editar/{id}', [EstadoController::class, 'update'])->name('estados.update');
Route::delete('/estados/{id}', [EstadoController::class, 'destroy'])->name('estados.delete');

//-ESTRATO
Route::get('/estrato', [EstratoController::class, 'index'])->name('estrato.index');
Route::post('/estrato', [EstratoController::class, 'store'])->name('estrato.store');
Route::get('/estrato/{id}', [EstratoController::class, 'edit'])->name('estrato.edit');
Route::put('/estrato/editar/{id}', [EstratoController::class, 'update'])->name('estrato.update');
Route::delete('/estrato/{id}', [EstratoController::class, 'destroy'])->name('estrato.delete');


//-MODULO
Route::get('/modulo', [ModuloController::class, 'index'])->name('modulo.index');
Route::post('/modulo', [ModuloController::class, 'store'])->name('modulo.store');
Route::get('/modulo/{id}', [ModuloController::class, 'edit'])->name('modulo.edit');
Route::put('/modulo/editar/{id}', [ModuloController::class, 'update'])->name('modulo.update');
Route::delete('/modulo/{id}', [ModuloController::class, 'destroy'])->name('modulo.delete');

//-FORMA DE PAGO
Route::get('/formapago', [FormaPagoController::class, 'index'])->name('formapago.index');
Route::post('/formapago', [FormaPagoController::class, 'store'])->name('formapago.store');
Route::get('/formapago/{id}', [FormaPagoController::class, 'edit'])->name('formapago.edit');
Route::put('/formapago/editar/{id}', [FormaPagoController::class, 'update'])->name('formapago.update');
Route::delete('/formapago/{id}', [FormaPagoController::class, 'destroy'])->name('formapago.delete');

//-PERFIL
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/perfil', [PerfilController::class, 'store'])->name('perfil.store');
Route::get('/perfil/{id}', [PerfilController::class, 'edit'])->name('perfil.edit');
Route::put('/perfil/editar/{id}', [PerfilController::class, 'update'])->name('perfil.update');
Route::delete('/perfil/{id}', [PerfilController::class, 'destroy'])->name('perfil.delete');

//-PERIODO
Route::get('/periodo', [PeriodoController::class, 'index'])->name('periodo.index');
Route::post('/periodo', [PeriodoController::class, 'store'])->name('periodo.store');
Route::get('/periodo/{id}', [PeriodoController::class, 'edit'])->name('periodo.edit');
Route::put('/periodo/editar/{id}', [PeriodoController::class, 'update'])->name('periodo.update');
Route::delete('/periodo/{id}', [PeriodoController::class, 'destroy'])->name('periodo.delete');

//-SEDES
Route::get('/sedes', [SedesController::class, 'index'])->name('sede.index');
Route::post('/sedes', [SedesController::class, 'store'])->name('sede.store');
Route::get('/sedes/{id}', [SedesController::class, 'edit'])->name('sede.edit');
Route::put('/sedes/editar/{id}', [SedesController::class, 'update'])->name('sede.update');
Route::delete('/sedes/{id}', [SedesController::class, 'destroy'])->name('sede.delete');

//-TIPO DOCUMENTO
Route::get('/tipo_documento', [TipoDocumentoController::class, 'index'])->name('tipo_documento.index');
Route::post('/tipo_documento', [TipoDocumentoController::class, 'store'])->name('tipo_documento.store');
Route::get('/tipo_documento/{id}', [TipoDocumentoController::class, 'edit'])->name('tipo_documento.edit');
Route::put('/tipo_documento/editar/{id}', [TipoDocumentoController::class, 'update'])->name('tipo_documento.update');
Route::delete('/tipo_documento/{id}', [TipoDocumentoController::class, 'destroy'])->name('tipo_documento.delete');

//-TIPO ENTREGAS
Route::get('/tipo_entrega', [TipoEntregaController::class, 'index'])->name('tipo_entrega.index');
Route::post('/tipo_entrega', [TipoEntregaController::class, 'store'])->name('tipo_entrega.store');
Route::get('/tipo_entrega/{id}', [TipoEntregaController::class, 'edit'])->name('tipo_entrega.edit');
Route::put('/tipo_entrega/editar/{id}', [TipoEntregaController::class, 'update'])->name('tipo_entrega.update');
Route::delete('/tipo_entrega/{id}', [TipoEntregaController::class, 'destroy'])->name('tipo_entrega.delete');

//-TIPO PERSONA
Route::get('/tipo_persona', [TipoPersonaController::class, 'index'])->name('tipo_persona.index');
Route::post('/tipo_persona', [TipoPersonaController::class, 'store'])->name('tipo_persona.store');
Route::get('/tipo_persona/{id}', [TipoPersonaController::class, 'edit'])->name('tipo_persona.edit');
Route::put('/tipo_persona/editar/{id}', [TipoPersonaController::class, 'update'])->name('tipo_persona.update');
Route::delete('/tipo_persona/{id}', [TipoPersonaController::class, 'destroy'])->name('tipo_persona.delete');

//-TIPO PLANES
Route::get('/tipo_planes', [TipoPlanController::class, 'index'])->name('tipo_planes.index');
Route::post('/tipo_planes', [TipoPlanController::class, 'store'])->name('tipo_planes.store');
Route::get('/tipo_planes/{id}', [TipoPlanController::class, 'edit'])->name('tipo_planes.edit');
Route::put('/tipo_planes/editar/{id}', [TipoPlanController::class, 'update'])->name('tipo_planes.update');
Route::delete('/tipo_planes/{id}', [TipoPlanController::class, 'destroy'])->name('tipo_planes.delete');

//**** FIN PARAMETROS *****/ 

//-EMPRESA SEDE
Route::get('/empresa_sede/{id}', [EmpresaSedeController::class, 'index'])->name('empresa_sede.index');
Route::post('/empresa_sede', [EmpresaSedeController::class, 'store'])->name('empresa_sede.store');
Route::put('/empresa_sede/editar/{id}', [EmpresaSedeController::class, 'update'])->name('empresa_sede.update');
Route::delete('/empresa_sede/{id}', [EmpresaSedeController::class, 'destroy'])->name('empresa_sede.delete');

//-PLAN
Route::get('/plan', [PlanController::class, 'index'])->name('plan.index');
Route::post('/plan', [PlanController::class, 'store'])->name('plan.store');
Route::get('/plan/{id}', [PlanController::class, 'edit'])->name('plan.edit');
Route::put('/plan/editar/{id}', [PlanController::class, 'update'])->name('plan.update');
Route::delete('/plan/{id}', [PlanController::class, 'destroy'])->name('plan.delete');

//-PERSONA
Route::get('/persona', [PersonaController::class, 'index'])->name('persona.index');
Route::post('/persona', [PersonaController::class, 'store'])->name('persona.store');
Route::get('/persona/{id}', [PersonaController::class, 'edit'])->name('persona.edit');
Route::put('/persona/editar/{id}', [PersonaController::class, 'update'])->name('persona.update');
Route::delete('/persona/{id}', [PersonaController::class, 'destroy'])->name('persona.delete');

//-USUARIOS
Route::get('/usuarios', [PersonaController::class, 'getUsuario'])->name('persona.usuarios');
// });

//-VINCUALCION
Route::get('/vinculacion/{id}', [VinculacionController::class, 'index'])->name('vinculacion.index');
Route::post('/vinculacion', [VinculacionController::class, 'store'])->name('vinculacion.store');
Route::put('/vinculacion/editar/{id}', [VinculacionController::class, 'update'])->name('vinculacion.update');
Route::delete('/vinculacion/{id}', [VinculacionController::class, 'destroy'])->name('vinculacion.delete');

//-OFERTA
Route::get('/oferta', [OfertaController::class, 'index'])->name('oferta.index');
Route::post('/oferta', [OfertaController::class, 'store'])->name('oferta.store');
Route::get('/oferta/{id}', [OfertaController::class, 'edit'])->name('oferta.edit');
Route::put('/oferta/editar/{id}', [OfertaController::class, 'update'])->name('oferta.update');
Route::delete('/oferta/{id}', [OfertaController::class, 'destroy'])->name('oferta.delete');

//-INSCRIPIONES
Route::get('/inscripcion', [InscripcionesController::class, 'index'])->name('inscripcion.index');
Route::post('/inscripcion', [InscripcionesController::class, 'store'])->name('inscripcion.store');
Route::get('/inscripcion/{id}', [InscripcionesController::class, 'edit'])->name('inscripcion.edit');
Route::put('/inscripcion/editar/{id}', [InscripcionesController::class, 'update'])->name('inscripcion.update');
Route::delete('/inscripcion/{id}', [InscripcionesController::class, 'destroy'])->name('inscripcion.delete');
