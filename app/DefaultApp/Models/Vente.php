<?php


namespace app\DefaultApp\Models;


use systeme\Model\Model;

class Vente extends Model
{

    private $id,$numero,$date,$id_client,$payer,$date_paiement,$taxe,$deduction;

    /**
     * @return mixed
     */
    public function getTaxe()
    {
        return $this->taxe;
    }

    /**
     * @param mixed $taxe
     */
    public function setTaxe($taxe)
    {
        $this->taxe = $taxe;
    }

    /**
     * @return mixed
     */
    public function getDeduction()
    {
        return $this->deduction;
    }

    /**
     * @param mixed $deduction
     */
    public function setDeduction($deduction)
    {
        $this->deduction = $deduction;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * @param mixed $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }

    /**
     * @return mixed
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param mixed $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

    /**
     * @return mixed
     */
    public function getDatePaiement()
    {
        return $this->date_paiement;
    }

    /**
     * @param mixed $date_paiement
     */
    public function setDatePaiement($date_paiement)
    {
        $this->date_paiement = $date_paiement;
    }

    public static function dernierId($id_client)
    {
        $con=self::connection();
        $req = "SELECT id FROM vente where id_client='{$id_client}' ORDER BY id DESC LIMIT 1";
        $rs = $con->query($req);
        $da = $rs->fetch();
        return $da['id'];
    }

    public static function existe($client, $date)
    {
        $con=self::connection();
        $req = "SELECT *FROM vente WHERE id_client='" . $client . "' AND date='" . $date. "' and payer='non'";
        $rs = $con->query($req);
        if ($rs->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function rechercherParClientNonPayer($client, $date)
    {
        $con=self::connection();
        $req = "SELECT *FROM vente WHERE id_client='" . $client . "' AND date='" . $date. "' and payer='non'";
        $stmt=$con->prepare($req);
        $stmt->execute();
        $res=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\DefaultApp\Models\Vente");
        if(count($res)>0){
            return $res[0];
        }else{
            return null;
        }
    }

    public static function listeNonPayer()
    {
        $con=self::connection();
        $req = "SELECT *FROM vente WHERE payer='non'";
        $stmt=$con->prepare($req);
        $stmt->execute();
        $res=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\DefaultApp\Models\Vente");
        return $res;
    }
    public static function listePayer()
    {
        $con=self::connection();
        $req = "SELECT *FROM vente WHERE payer='oui'";
        $stmt=$con->prepare($req);
        $stmt->execute();
        $res=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\DefaultApp\Models\Vente");
        return $res;
    }

}