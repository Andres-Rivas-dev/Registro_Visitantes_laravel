<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function getMenu(){

        $grupos = Menu::get();

        $gruposArray = json_decode($grupos, true);

        // Inicializar un "diccionario" para almacenar los grupos por su ID de padre
        $diccionario = [];
    
        // Organizar los grupos por su ID de padre
        foreach ($gruposArray as $grupo) {
            $diccionario[$grupo['id_padre']][] = $grupo;
        }
    
        // Función recursiva para construir la estructura jerárquica
        $construirJerarquia = function ($idPadre) use (&$construirJerarquia, &$diccionario) {
            // Inicializar el array para los subgrupos
            $subgrupos = [];
    
            // Verificar si hay subgrupos para el ID de padre dado
            if (isset($diccionario[$idPadre])) {
                // Recorrer los subgrupos y construir la estructura jerárquica
                foreach ($diccionario[$idPadre] as $grupo) {
                    // Verificar si el campo "url" es diferente de "null"
                    if ($grupo['url'] !== null) {
                        $grupo['subgrupo'] = $construirJerarquia($grupo['id']);
                        $subgrupos[] = $grupo;
                    } else {
                        // Si el campo "url" es "null", omitirlo de la respuesta
                        unset($grupo['url']);
                        $grupo['subgrupo'] = $construirJerarquia($grupo['id']);
                        $subgrupos[] = $grupo;
                    }
                    
                }
            }
    
            return $subgrupos;
        };
    
        // Construir la estructura jerárquica para los grupos raíz (ID de padre = 0)
        return $construirJerarquia(0);
    }
  
}
