<?php

/**
 * Clase FamiliaDAO
 */

class FamiliaDAO {

    private PDO $bd;

    public function __construct(PDO $bd) {
        $this->bd = $bd;
    }

    public function crea(Familia $familia): void {
        
    }

    public function modifica(Familia $familia): void {
        
    }

    public function elimina(int $id): void {
        
    }

    public function recuperaPorId(int $id): Familia {
        
    }
    
    /**
     * Recupera todas las familias de la base de datos
     * @return array
     */

    public function recuperaTodo(): array {
        $sql = "select * from familias order by nombre";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Familia');
        $familias = $stmt->fetchAll();
        $stmt->closeCursor();
        return $familias;
    }

}
