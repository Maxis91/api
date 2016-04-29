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
                    "field"  => "type",
                    "domain" => array(
                        "id",
                        "email",
                        "nom",
                        "prenom",
                        "actif",
                        "date création"
                    )
                )
            )
        );
        $this->validate(
            new Uniqueness(
                array(
                    "field"   => "id",
                    "message" => "user"
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

// Récupères la liste des utilisateurs
$app->get('/api/users', function () use ($app) {
    $phql = "SELECT * FROM users ORDER BY nom";
    $users = $app->modelsManager->executeQuery($phql);
    $data = array();
    foreach ($users as $users) {
        $data[] = array(
            'id'   => $user->id,
            'nom' => $user->nom
        );
    }
    echo json_encode($data);
});

// Créer un nouvel utilisateur
$app->post('/api/users', function () use ($app) {
    $users = $app->request->getJsonRawBody();
    $phql = "INSERT INTO users (email, nom, prenom) VALUES (:email:, :nom:, :prenom:)";
    $status = $app->modelsManager->executeQuery($phql, array(
        'email' => $user->email,
        'nom' => $user->nom,
        'prenom' => $user->prenom
    ));
    // Créer une réponse du serveur
    $response = new Response();
    // Vérifie que l'insertion est faite
    if ($status->success() == true) {
        $response->setStatusCode(201, "Créer");
        $user->email = $status->getModel()->emaom;
        $response->setJsonContent(
            array(
                'status' => 'OK',
                'data'   => $user
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
