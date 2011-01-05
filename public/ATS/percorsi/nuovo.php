<?php
require_once 'config.php';
$pageTitle = "Inserisci nuovo percorso";
require_once 'DB.php';

$db = DB::getInstance();


$queryStr = "SELECT codicePC, indirizzo, latitudine, longitudine FROM PuntiDiControllo";
$result = $db->query($queryStr);
$pdc = array();
while ($row = $result->fetch_assoc()) {
    $pdc[] = $row;
}

$aggiungiUrl = ACTION_URL . '/percorso/aggiungi.php';
?>
<?php include HELPERS_DIR . '/testata.php'; ?>

<h1><?php echo $pageTitle ?></h1>

<div id="info"></div>
<div id="map"></div>
<div id="pdc">
    <select id="luoghi" size="10">
        <?php foreach ($pdc as $luogo): ?>
            <option value="<?php echo $luogo['latitudine'] . ',' . $luogo['longitudine'] . ',' . $luogo['codicePC']; ?>"><?php
            echo trim($luogo['indirizzo']);
        ?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div id="percorsoWrap">
        <table id="percorso">
            <thead>
                <tr>
                    <th>Indirizzo</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <form id="salvaPercorso" action="<?php echo $aggiungiUrl; ?>" method="post">
            <p><input type="submit" value="Salva Percorso" name="salvaPercorso" /></p>
        </form>

    </div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="marker.js"></script> 
<?php include HELPERS_DIR . '/piepagina.php'; ?>