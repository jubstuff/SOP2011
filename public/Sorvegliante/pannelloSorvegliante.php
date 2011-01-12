<?php
require_once 'config.php';
require_once 'DB.php';
require_once 'Sorvegliante.php';
require_once 'Validator.php';

$v = new Validator($_GET);
$v->isNotEmpty('matricola');
$v->isNumeric('matricola');

$e = $v->getError();
if (!empty($e)) {
    //@todo creare la pagina di errore generale
    $r = new Redirect('error.php');
    $r->doRedirect();
}

$clean = $v->getClean();
$clean['matricola'] = urldecode($clean['matricola']);
$sorvegliante = Sorvegliante::find_by_id($clean['matricola']);

$db = DB::getInstance();
$queryStr = "SELECT data, codiceTurno ";
$queryStr .= "FROM Turni T JOIN Sorveglianti S ON(T.codiceSquadra = S.codiceSquadra) ";
$queryStr .= "WHERE S.matricola=".$sorvegliante->getMatricola();

try {
    $result = $db->query($queryStr);
    $myTurni = array();
    while($row = $result->fetch_assoc()) {
        $myTurni[] = $row;
    }
} catch (DatabaseErrorException $e) {
    echo __FILE__ . "Impossibile eseguire la query";
}

$pageTitle = 'Pannello Sorveglianti';
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $sorvegliante->getCognome().' '. $sorvegliante->getNome(); ?></h1>
<h5><?php echo 'Matricola: '. $sorvegliante->getMatricola();?></h5>

<?php if (is_array($myTurni)) : ?>
<table>
    <tr>
        <th>Data</th>
        <th>Turno</th>
    </tr>
        <?php
        foreach ($myTurni as $mt) :
            $codiceTurno = $mt['codiceTurno'];
            ?>
    <tr>
        <td><?php echo $mt['data']; ?></td>
        <td><?php echo $codiceTurno; ?></td>
        <td><a href="dettagliTurno.php?codiceTurno=<?php echo $codiceTurno; ?>">Visualizza turno</a></td>
    </tr>
        <?php
        endforeach;
    else: ?>
    <p>Non ci sono turni</p>
    <?php endif; ?>
</table>
<?php include HELPERS_DIR . '/piepagina.php'; ?>