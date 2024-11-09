<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\RecuperacionContraseñaController;
use App\Http\Controllers\Api\NotificacionesController;
use App\Http\Controllers\Api\ConfiguracionesController;
use App\Http\Controllers\Api\EvaluacionesController;
use App\Http\Controllers\Api\ObjetivosController;
use App\Http\Controllers\Api\ProgresoController;
use App\Http\Controllers\Api\EjercicioController;
use App\Http\Controllers\Api\RegistroActividadController;
use App\Http\Controllers\Api\RecetasController;
use App\Http\Controllers\Api\RecetasPersonalizadasController;
use App\Http\Controllers\Api\AlimentosController;
use App\Http\Controllers\Api\EscaneoController;
use App\Http\Controllers\Api\RegistroAlimentosController;
use App\Http\Controllers\Api\DietaController;
use App\Http\Controllers\Api\HistorialIMCController;
use App\Http\Controllers\Api\HistorialRitmoCardiacoController;
use App\Http\Controllers\Api\MonitoreosController;
use App\Http\Controllers\Api\AmigosController;
use App\Http\Controllers\Api\ForoController;


// Rutas para la tabla Usuario
Route::get('/usuario', [UsuarioController::class, 'index']);
Route::get('/usuario/{id}', [UsuarioController::class, 'show']);
Route::post('/usuario', [UsuarioController::class, 'store']);
Route::put('/usuario/{id}', [UsuarioController::class, 'update']);
Route::patch('/usuario/{id}', [UsuarioController::class, 'updatePartial']);
Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy']);

// Rutas para la tabla RecuperaciónContraseña
Route::get('/recuperaciones', [RecuperacionContraseñaController::class, 'index']);
Route::get('/recuperaciones/{id}', [RecuperacionContraseñaController::class, 'show']);
Route::post('/recuperaciones', [RecuperacionContraseñaController::class, 'store']);
Route::put('/recuperaciones/{id}', [RecuperacionContraseñaController::class, 'update']);
Route::patch('/recuperaciones/{id}', [RecuperacionContraseñaController::class, 'updatePartial']);
Route::delete('/recuperaciones/{id}', [RecuperacionContraseñaController::class, 'destroy']);

// Rutas para la tabla Notificaciones
Route::get('/notificaciones', [NotificacionesController::class, 'index']);
Route::get('/notificaciones/{id}', [NotificacionesController::class, 'show']);
Route::post('/notificaciones', [NotificacionesController::class, 'store']);
Route::put('/notificaciones/{id}', [NotificacionesController::class, 'update']);
Route::patch('/notificaciones/{id}', [NotificacionesController::class, 'updatePartial']);
Route::delete('/notificaciones/{id}', [NotificacionesController::class, 'destroy']);

// Rutas para la tabla Configuraciones
Route::get('/configuraciones', [ConfiguracionesController::class, 'index']);
Route::get('/configuraciones/{id}', [ConfiguracionesController::class, 'show']);
Route::post('/configuraciones', [ConfiguracionesController::class, 'store']);
Route::put('/configuraciones/{id}', [ConfiguracionesController::class, 'update']);
Route::patch('/configuraciones/{id}', [ConfiguracionesController::class, 'updatePartial']);
Route::delete('/configuraciones/{id}', [ConfiguracionesController::class, 'destroy']);

// Rutas para la tabla Evaluaciones
Route::get('/evaluaciones', [EvaluacionesController::class, 'index']);
Route::get('/evaluaciones/{id}', [EvaluacionesController::class, 'fin']);
Route::get('/evaluaciones/all/{id}', [EvaluacionesController::class, 'show']);
Route::post('/evaluaciones', [EvaluacionesController::class, 'store']);
Route::put('/evaluaciones/{id}', [EvaluacionesController::class, 'update']);
Route::patch('/evaluaciones/{id}', [EvaluacionesController::class, 'updatePartial']);
Route::delete('/evaluaciones/{id}', [EvaluacionesController::class, 'destroy']);

// Rutas para la tabla Objetivos
Route::get('/objetivos', [ObjetivosController::class, 'index']);
Route::get('/objetivos/{id}', [ObjetivosController::class, 'show']);
Route::post('/objetivos', [ObjetivosController::class, 'store']);
Route::put('/objetivos/{id}', [ObjetivosController::class, 'update']);
Route::patch('/objetivos/{id}', [ObjetivosController::class, 'updatePartial']);
Route::delete('/objetivos/{id}', [ObjetivosController::class, 'destroy']);

// Rutas para la tabla Progreso
Route::get('/progreso', [ProgresoController::class, 'index']);
Route::get('/progreso/{id}', [ProgresoController::class, 'show']);
Route::post('/progreso', [ProgresoController::class, 'store']);
Route::put('/progreso/{id}', [ProgresoController::class, 'update']);
Route::patch('/progreso/{id}', [ProgresoController::class, 'updatePartial']);
Route::delete('/progreso/{id}', [ProgresoController::class, 'destroy']);

// Rutas para la tabla Ejercicio
Route::get('/ejercicios', [EjercicioController::class, 'index']);
Route::get('/ejercicios/{id}', [EjercicioController::class, 'show']);
Route::post('/ejercicios', [EjercicioController::class, 'store']);
Route::put('/ejercicios/{id}', [EjercicioController::class, 'update']);
Route::patch('/ejercicios/{id}', [EjercicioController::class, 'updatePartial']);
Route::delete('/ejercicios/{id}', [EjercicioController::class, 'destroy']);

// Rutas para la tabla RegistroActividad
Route::get('/registroActividades', [RegistroActividadController::class, 'index']);
Route::get('/registroActividades/{id}', [RegistroActividadController::class, 'show']);
Route::post('/registroActividades', [RegistroActividadController::class, 'store']);
Route::put('/registroActividades/{id}', [RegistroActividadController::class, 'update']);
Route::patch('/registroActividades/{id}', [RegistroActividadController::class, 'updatePartial']);
Route::delete('/registroActividades/{id}', [RegistroActividadController::class, 'destroy']);

// Rutas para la tabla Recetas
Route::get('/recetas', [RecetasController::class, 'index']);
Route::get('/recetas/{id}', [RecetasController::class, 'show']);
Route::post('/recetas', [RecetasController::class, 'store']);
Route::put('/recetas/{id}', [RecetasController::class, 'update']);
Route::patch('/recetas/{id}', [RecetasController::class, 'updatePartial']);
Route::delete('/recetas/{id}', [RecetasController::class, 'destroy']);

// Rutas para la tabla RecetasPersonalizadas
Route::get('/recetasPersonalizadas', [RecetasPersonalizadasController::class, 'index']);
Route::get('/recetasPersonalizadas/{id}', [RecetasPersonalizadasController::class, 'show']);
Route::post('/recetasPersonalizadas', [RecetasPersonalizadasController::class, 'store']);
Route::put('/recetasPersonalizadas/{id}', [RecetasPersonalizadasController::class, 'update']);
Route::patch('/recetasPersonalizadas/{id}', [RecetasPersonalizadasController::class, 'updatePartial']);
Route::delete('/recetasPersonalizadas/{id}', [RecetasPersonalizadasController::class, 'destroy']);

// Rutas para la tabla Alimentos
Route::get('/alimentos', [AlimentosController::class, 'index']);
Route::get('/alimentos/{id}', [AlimentosController::class, 'show']);
Route::post('/alimentos', [AlimentosController::class, 'store']);
Route::put('/alimentos/{id}', [AlimentosController::class, 'update']);
Route::patch('/alimentos/{id}', [AlimentosController::class, 'updatePartial']);
Route::delete('/alimentos/{id}', [AlimentosController::class, 'destroy']);

// Rutas para la tabla Escaneo
Route::get('/escaneos', [EscaneoController::class, 'index']);
Route::get('/escaneos/{id}', [EscaneoController::class, 'show']);
Route::post('/escaneos', [EscaneoController::class, 'store']);
Route::put('/escaneos/{id}', [EscaneoController::class, 'update']);
Route::patch('/escaneos/{id}', [EscaneoController::class, 'updatePartial']);
Route::delete('/escaneos/{id}', [EscaneoController::class, 'destroy']);

// Rutas para la tabla RegistroAlimentos
Route::get('/registroAlimentos', [RegistroAlimentosController::class, 'index']);
Route::get('/registroAlimentos/{id}', [RegistroAlimentosController::class, 'show']);
Route::post('/registroAlimentos', [RegistroAlimentosController::class, 'store']);
Route::put('/registroAlimentos/{id}', [RegistroAlimentosController::class, 'update']);
Route::patch('/registroAlimentos/{id}', [RegistroAlimentosController::class, 'updatePartial']);
Route::delete('/registroAlimentos/{id}', [RegistroAlimentosController::class, 'destroy']);

// Rutas para la tabla Dieta
Route::get('/dietas', [DietaController::class, 'index']);
Route::get('/dietas/{id}', [DietaController::class, 'show']);
Route::post('/dietas', [DietaController::class, 'store']);
Route::put('/dietas/{id}', [DietaController::class, 'update']);
Route::patch('/dietas/{id}', [DietaController::class, 'updatePartial']);
Route::delete('/dietas/{id}', [DietaController::class, 'destroy']);

// Rutas para la tabla HistorialIMC
Route::get('/historialIMC', [HistorialIMCController::class, 'index']);
Route::get('/historialIMC/{id}', [HistorialIMCController::class, 'fin']);
Route::get('/historialIMC/all/{id}', [HistorialIMCController::class, 'show']);
Route::post('/historialIMC', [HistorialIMCController::class, 'store']);
Route::put('/historialIMC/{id}', [HistorialIMCController::class, 'update']);
Route::patch('/historialIMC/{id}', [HistorialIMCController::class, 'updatePartial']);
Route::delete('/historialIMC/{id}', [HistorialIMCController::class, 'destroy']);

// Rutas para la tabla HistorialRitmoCardiaco
Route::get('/historialRitmoCardiaco', [HistorialRitmoCardiacoController::class, 'index']);
Route::get('/historialRitmoCardiaco/{id}', [HistorialRitmoCardiacoController::class, 'fin']);
Route::get('/historialRitmoCardiaco/all/{id}', [HistorialRitmoCardiacoController::class, 'show']);
Route::post('/historialRitmoCardiaco', [HistorialRitmoCardiacoController::class, 'store']);
Route::put('/historialRitmoCardiaco/{id}', [HistorialRitmoCardiacoController::class, 'update']);
Route::patch('/historialRitmoCardiaco/{id}', [HistorialRitmoCardiacoController::class, 'updatePartial']);
Route::delete('/historialRitmoCardiaco/{id}', [HistorialRitmoCardiacoController::class, 'destroy']);

// Rutas para la tabla Monitoreos
Route::get('/monitoreos', [MonitoreosController::class, 'index']);
Route::get('/monitoreos/{id}', [MonitoreosController::class, 'show']);
Route::post('/monitoreos', [MonitoreosController::class, 'store']);
Route::put('/monitoreos/{id}', [MonitoreosController::class, 'update']);
Route::patch('/monitoreos/{id}', [MonitoreosController::class, 'updatePartial']);
Route::delete('/monitoreos/{id}', [MonitoreosController::class, 'destroy']);

// Rutas para la tabla Amigos
Route::get('/amigos', [AmigosController::class, 'index']);
Route::get('/amigos/{id}', [AmigosController::class, 'show']);
Route::post('/amigos', [AmigosController::class, 'store']);
Route::put('/amigos/{id}', [AmigosController::class, 'update']);
Route::patch('/amigos/{id}', [AmigosController::class, 'updatePartial']);
Route::delete('/amigos/{id}', [AmigosController::class, 'destroy']);

// Rutas para la tabla Foro
Route::get('/foros', [ForoController::class, 'index']);
Route::get('/foros/{id}', [ForoController::class, 'show']);
Route::post('/foros', [ForoController::class, 'store']);
Route::put('/foros/{id}', [ForoController::class, 'update']);
Route::patch('/foros/{id}', [ForoController::class, 'updatePartial']);
Route::delete('/foros/{id}', [ForoController::class, 'destroy']);
