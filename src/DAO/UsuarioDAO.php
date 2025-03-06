<?php

class UsuarioDAO {

    private PDO $bd;

    public function __construct(PDO $bd) {
        $this->bd = $bd;
    }

    public function crea(Usuario $usuario): string {
        
    }

    public function modifica(Usuario$usuario): void {
        
    }

    public function elimina(string $nombre): void {
        
    }

    public function recuperaPorCredencial(string $nombre, string $pwd): ?Usuario {
        $pwdHashed = hash('sha256', $pwd);
        $sql = 'select * from usuarios where usuario=:nombre and pass=:pwdHashed';
        $sth = $this->bd->prepare($sql);
        $sth->execute([":nombre" => $nombre, ":pwdHashed" => $pwdHashed]);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $usuario = $sth->fetch();
        return ($usuario ?: null);
    }

}
