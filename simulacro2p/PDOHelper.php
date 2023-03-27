<?php
/*
Simulacro 1er Parcial - 2da parte
Alumno: Geisser, Damian
*/

class PDOHelper
{
    //El acceso de estas propiedades impiden que la clase pueda ser instanciada fuera de la misma.
    private static $ObjetoPDOHelper;
    private $objetoPDO;

    private function __construct()
    {
        try { 
            $this->objetoPDO = new PDO('mysql:host=localhost;dbname=simulacro1p;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
            } 
        catch (PDOException $e) { 
            print "Error!: " . $e->getMessage(); 
            die();
        }
    }

    public function PrepararConsulta($sql)
    { 
        return $this->objetoPDO->prepare($sql); 
    }

    //Método disponible para la obtención de la instancia, que será siempre la única (singleton).
    public static function ObtenerObjetoPDOHelper()
    { 
        if (!isset(self::$ObjetoPDOHelper)) {          
            self::$ObjetoPDOHelper = new PDOHelper(); 
        } 
        return self::$ObjetoPDOHelper;        
    }

    public function RetornarUltimoIdInsertado()
    { 
        return $this->objetoPDO->lastInsertId(); 
    }
}

?>