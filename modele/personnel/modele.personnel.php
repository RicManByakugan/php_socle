<?php
class Personnel
{
    private $bdd;

    public function __construct()
    {
        $co = new Connexion();
        $this->bdd = $co->connectBD();
    }

    public function getPersonneBySomething($champs, $valeur)
    {
        try {
            $sql = "SELECT * FROM personnel WHERE $champs = :valeur";
            $stmt = $this->bdd->prepare($sql);
            $stmt->bindParam(':valeur', $valeur, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des données : " . $e->getMessage();
            return false;
        }
    }

    public function changeStatusConnexion($idPerso, $value)
    {
        try {
            $now = time();
            $status = ($value === "ok") ? "OK" : "KO";

            $sql = "UPDATE personnel SET status = :status, dernierCo = :dernierCo WHERE idPerso = :idPerso";
            $stmt = $this->bdd->prepare($sql);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':dernierCo', $now, PDO::PARAM_INT);
            $stmt->bindParam(':idPerso', $idPerso, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du statut : " . $e->getMessage();
        }
    }

    public function updateAdminMdp($idPerso, $mdp)
    {
        try {
            $hashedMdp = password_hash($mdp, PASSWORD_DEFAULT); // Hasher le mot de passe
            $sql = "UPDATE personnel SET mdp = :mdp WHERE idPerso = :idPerso";
            $stmt = $this->bdd->prepare($sql);
            $stmt->bindParam(':mdp', $hashedMdp, PDO::PARAM_STR);
            $stmt->bindParam(':idPerso', $idPerso, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du mot de passe : " . $e->getMessage();
        }
    }
}
?>
