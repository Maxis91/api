# Application ToDoList : API & View
<b>Synopsis</b>
<br>
Le projet est une TodoList	en Full-Stack. Une partie front-end avec du ReactJs qui gère l’appel de l’API qui est le back-end fait avec NodeJS : 
- API Todo APP ;
- Ecrire un ReadMe ;
- Formulaire pour écrire la tâche ;
- Création, mise à jour, suppression et lecture ;
- Minimum 5 tests unitaires de l'application ;
<br>
<b>Installation</b>
<br>
Pour installer le projet, il suffit de faire un « npm install » et enfin de lancer chaque dossier (le front et le back) avec « npm run dev ».
Toutes les bibliothèques ont été installées avec un « npm install bibliotheque –S –save ».
<br><br>
<b>Process of use</b>
On arrive sur la page des tâches à faire (ToDo List). Il y a déjà une liste en locale (d’initialisation non entrée dans la base). Il suffit de cliquer sur le bouton « Realod » pour accéder aux tâches présentes dans la base de données. Dans cette liste il y a la possibilité de supprimer les tâches à l’évènement clique « Delete » qui rafraichira aussi la page. 
Afin de créer sa propre tâche il faut se rendre « Create ToDo ». Il suffit de rentrer sa tâche et de cliquer sur le bouton « Submit », un message s’affichera « Tâche créée » si la tâche est bien prise en compte sinon un message d’erreur « Failed ! » sera affiché.
<br>
Il n'y a pas besoin de base de données à récupérer car elle sera directement en ligne avec mlab.
<br><br>
<b>API Reference</b>
<br>
API est le fichier « api todo »
Pour faire les tests dans Postman les commandes sont les suivantes :
-	Post : localhost:8081/apiTodo/v1/todos { « name » : « Un tâche à faire » }
-	Get :  localhost:8081/apiTodo/v1/todos
-	GetOne : localhost:8081/apiTodo/v1/todo/ :id
-	Put : localhost:8081/apiTodo/v1/todo/ :id
-	Delete : localhost:8081/apiTodo/v1/todo/ :id
<br><br>
<b>Tests</b>
<br>
Pour voir les tests il faut arrêter le serveur s’il est démarré et faire un « npm run test » :
-	6 tests en back
<br><br>
<b>Contributors</b>
<br>
Mehmet AKSOY : Tech Lead ReactJs
Maxime RIESCO : Tech Lead NodeJs
Baltazar TORRES : ReactJs et Test NodeJs
Volkan AKYEL : ReactJs
Thierry SUY : Test NodeJs
