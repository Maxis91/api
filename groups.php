<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\InclusionIn;
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use Phalcon\Http\Response;


class Users extends Model
{
    public function validation()
    {
        $this->validate(
            new InclusionIn(
                array(
                    "domain" => array(
                        "id",
                        "nom"
                    )
                )
            )
        );
    }
}

$loader = new Loader();
$loader->registerDirs(
    array(
        __DIR__ . '/models/'
    )
)->register();
$di = new FactoryDefault();
$di->set('db', function () {
    return new PdoMysql(
        array(
            "host"     => "localhost",
            "username" => "root",
            "password" => "root",
            "dbname"   => "api"
        )
    );
});

$app = new Micro($di);

// Récupères la liste des groupes
$app->get('/api/groups', function () use ($app) {
    $phql = "SELECT * FROM groups ORDER BY nom";
    $groups = $app->modelsManager->executeQuery($phql);
    $data = array();
    foreach ($groups as $group) {
        $data[] = array(
            'id'   => $group->id,
            'nom' => $group->nom
        );
    }
    echo json_encode($data);
});

// Créer un nouveau groupe
$app->post('/api/groupe', function () use ($app) {
    $groups = $app->request->getJsonRawBody();
    $phql = "INSERT INTO group (nom) VALUES (:nom:)";
    $status = $app->modelsManager->executeQuery($phql, array(
        'nom' => $group->nom
    ));
    // Créer une réponse du serveur
    $response = new Response();
    // Vérifie que l'insertion est faite
    if ($status->success() == true) {
        $response->setStatusCode(201, "Créer");
        $group->nom = $status->getModel()->emaom;
        $response->setJsonContent(
            array(
                'status' => 'OK',
                'data'   => $group
            )
        );
    } else {
        $response->setStatusCode(409, "Conflit");
        // Retourne un message d'erreur
        $errors = array();
        foreach ($status->getMessages() as $message) {
            $errors[] = $message->getMessage();
        }
        $response->setJsonContent(
            array(
                'status'   => 'Erreur lors de la modification',
                'messages' => $errors
            )
        );
    }
    return $response;
});
?>
