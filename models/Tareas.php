<?php

namespace Model;

class Tareas extends ActiveRecord {
    protected static $tabla = 'tareas';
    protected static $columnasDB = ['id', 'nombre', 'estado', 'proyectoId'];

    public $id;
    public $nombre;
    public $estado;
    public $proyectoId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->estado = $args['estado'] ?? 0;
        $this->proyectoId = $args['proyectoId'] ?? '';
    }
}