<?php
header('Content-Type: application/json');

try {

    if (!isset($_POST['search_param'])) {
        throw new Exception('Parámetro search_param no proporcionado.');
    }

    $search_param = htmlspecialchars($_POST['search_param'], ENT_QUOTES, 'UTF-8');
    $search_param = '%' . str_replace(' ', '%', $search_param) . '%';

    require_once 'database.php';
    $database = new Database();
    $pdo = $database->getConnection();
    
    $sql = "SELECT  p.nombre AS provincia,
                    l.nombre AS localidad,
                    cp.codigo_postal cp
            FROM  provincias p
            JOIN localidades l ON (p.id = l.provincia_id)
            JOIN codigos_postales cp ON (l.id = cp.localidad_id)
            WHERE  CONCAT_WS(' ', p.nombre, l.nombre, l.partido, cp.codigo_postal) LIKE :search_param
            ORDER BY provincia,localidad,cp
            LIMIT 20";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':search_param', $search_param, PDO::PARAM_STR);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($resultados);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
