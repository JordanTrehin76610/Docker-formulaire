<?php 
// var_dump($_POST);

// session_start();
//  /*On utilise session_id() pour récupérer l'id de session s'il existe.
//      *Si l'id de session n'existe  pas, session_id() rnevoie une chaine
//      *de caractères vide*/
// $id_session = session_id();
// $_SESSION['email'] = $_POST['email'];

$nom = "/^[a-z.-]+$/i";
$valeursCGU = ['oui'];
$bonGenre = ['homme', 'femme', 'autre'];

$erreur = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["prenom"])) {
        if (empty($_POST["prenom"])) {
            $erreur["prenom"] = "Veuillez inscrire votre prenom";
        } else if (!preg_match($nom, $_POST["prenom"])) {
            $erreur["prenom"] = "Charactère non valide";
        }
    }

    if(isset($_POST["nom"])) {
        if (empty($_POST["nom"])) {
            $erreur["nom"] = "Veuillez inscrire votre nom";
        } else if (!preg_match($nom, $_POST["nom"])) {
            $erreur["nom"] = "Charactère non valide";
        }
    }

    if(isset($_POST["email"])) {
        if (empty($_POST["email"])) {
            $erreur["email"] = "Veuillez inscrire votre email";
        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $erreur["email"] = "Mail non valide";
        }
    }

    if(isset($_POST["genre"])) {
        if (!in_array($_POST["genre"], $bonGenre)) {
            $erreur["genre"] = "Veuillez inscrire votre genre";
        }
    }

    if(isset($_POST["CGU"])) {
        if (!in_array($_POST["CGU"], $valeursCGU)) {
            $erreur["CGU"] = "Veuillez accepter les CGU";
        }
    }

    if(isset($_POST["pays"])) {
        if ($_POST["pays"] == "Selectionnez un pays") {
            $erreur["pays"] = "Veuillez selectionnez un pays";
        }
    }

    if(empty($erreur)){
        $mail = $_POST['email'];
        header("Location: pages/confirmation.php?email=$mail");
    }

}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>


<body class="background">
    <h1 class="text-center mt-3">Formulaire d'inscription</h1>


    <div class="w-75 text-center mx-auto mt-5">
        <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam dolorem iste vel, corporis repellat
            impedit
            laborum voluptatum aliquam cumque dolor reiciendis, rem nihil voluptatem voluptates asperiores libero
            dignissimos molestias. A.
            Ut, vero accusantium officia quod quis assumenda ad. Voluptate laboriosam quis provident, aliquam quisquam
            repellendus modi delectus soluta neque adipisci quas totam architecto rerum nam voluptates voluptatum
            suscipit. Tempore, repellendus!
            Quam molestias ut placeat impedit earum neque pariatur et deserunt facere a cum, repudiandae sit natus omnis
            non maiores itaque ipsam minus nulla delectus id iste odit laborum reprehenderit. Tenetur!
            Nostrum esse earum error nisi cumque maxime impedit aperiam dicta culpa fugit aspernatur ipsum incidunt
            omnis, quas qui reiciendis. Neque voluptas earum ipsum at debitis impedit ex beatae repellat delectus.
            Harum vel nostrum voluptatum quis, nemo perferendis id ullam similique aliquid tenetur nesciunt, fugiat
            eveniet magni, animi eius. Aut facilis saepe quaerat. Vero libero dignissimos sapiente pariatur culpa sit
            itaque.</p>

        <div class="container w-75">

            <form method="post" action="" novalidate>
                <span style="color: red !important; display: inline; float: none;">*</span>
                <span>Champ obligatoire à remplir</span>
                <div class="row mt-3">
                    <div class="col">
                        <div class="mb-3 text-start">
                            <label for="exampleFormControlInput1" class="form-label">Prenom</label><span
                                style="color: red !important; display: inline; float: none;">*</span><span
                                class="ms-2 text-danger fst-italic fw-light"><?= $erreur["prenom"] ?? '' ?></span>
                            <input type="text" class="form-control" id="prenom" name="prenom"
                                placeholder="Exemple: Theodule" value="<?= $_POST["prenom"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 text-start">
                            <label for="exampleFormControlInput1" class="form-label">Nom</label><span
                                style="color: red !important; display: inline; float: none;">*</span><span
                                class="ms-2 text-danger fst-italic fw-light"><?= $erreur["nom"] ?? '' ?></span>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Exemple: Labit"
                                value="<?= $_POST["nom"] ?? "" ?>">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="mb-3 text-start">
                            <label for="exampleFormControlInput1" class="form-label">Email</label><span
                                style="color: red !important; display: inline; float: none;">*</span><span
                                class="ms-2 text-danger fst-italic fw-light"><?= $erreur["email"] ?? '' ?></span>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Exemple: TheoduleLabit@email.com" value="<?= $_POST["email"] ?? "" ?>">
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-start">
                            <label for="pays">Pays</label><span
                                style="color: red !important; display: inline; float: none;">*</span><span
                                class="ms-2 text-danger fst-italic fw-light"><?= $erreur["pays"] ?? '' ?></span>
                            <select id="pays" name="pays" class="form-control mt-2">
                                <option value="Selectionnez un pays"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Selectionnez un pays') ? 'selected' : '' ?>>
                                    -----Selectionnez un pays-----</option>
                                <option value="Afghanistan"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Afghanistan') ? 'selected' : '' ?>>
                                    Afghanistan</option>
                                <option value="Albanie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Albanie') ? 'selected' : '' ?>>
                                    Albanie</option>
                                <option value="Algérie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Algérie') ? 'selected' : '' ?>>
                                    Algérie</option>
                                <option value="Allemagne"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Allemagne') ? 'selected' : '' ?>>
                                    Allemagne</option>
                                <option value="Andorre"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Andorre') ? 'selected' : '' ?>>
                                    Andorre</option>
                                <option value="Angola"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Angola') ? 'selected' : '' ?>>
                                    Angola</option>
                                <option value="Anguilla"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Anguilla') ? 'selected' : '' ?>>
                                    Anguilla</option>
                                <option value="Antarctique"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Antarctique') ? 'selected' : '' ?>>
                                    Antarctique</option>
                                <option value="Argentine"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Argentine') ? 'selected' : '' ?>>
                                    Argentine</option>
                                <option value="Arménie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Arménie') ? 'selected' : '' ?>>
                                    Arménie</option>
                                <option value="Aruba"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Aruba') ? 'selected' : '' ?>>Aruba
                                </option>
                                <option value="Australie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Australie') ? 'selected' : '' ?>>
                                    Australie</option>
                                <option value="Autriche"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Autriche') ? 'selected' : '' ?>>
                                    Autriche</option>
                                <option value="Azerbaïdjan"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Azerbaïdjan') ? 'selected' : '' ?>>
                                    Azerbaïdjan</option>
                                <option value="Bahamas"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Bahamas') ? 'selected' : '' ?>>
                                    Bahamas</option>
                                <option value="Bahreïn"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Bahreïn') ? 'selected' : '' ?>>
                                    Bahreïn</option>
                                <option value="Bangladesh"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Bangladesh') ? 'selected' : '' ?>>
                                    Bangladesh</option>
                                <option value="Barbade"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Barbade') ? 'selected' : '' ?>>
                                    Barbade</option>
                                <option value="Belgique"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Belgique') ? 'selected' : '' ?>>
                                    Belgique</option>
                                <option value="Belize"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Belize') ? 'selected' : '' ?>>
                                    Belize</option>
                                <option value="Bénin"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Bénin') ? 'selected' : '' ?>>Bénin
                                </option>
                                <option value="Bermudes"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Bermudes') ? 'selected' : '' ?>>
                                    Bermudes</option>
                                <option value="Bhoutan"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Bhoutan') ? 'selected' : '' ?>>
                                    Bhoutan</option>
                                <option value="Biélorussie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Biélorussie') ? 'selected' : '' ?>>
                                    Biélorussie</option>
                                <option value="Bolivie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Bolivie') ? 'selected' : '' ?>>
                                    Bolivie</option>
                                <option value="Botswana"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Botswana') ? 'selected' : '' ?>>
                                    Botswana</option>
                                <option value="Brésil"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Brésil') ? 'selected' : '' ?>>
                                    Brésil</option>
                                <option value="Brunei"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Brunei') ? 'selected' : '' ?>>
                                    Brunei</option>
                                <option value="Bulgarie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Bulgarie') ? 'selected' : '' ?>>
                                    Bulgarie</option>
                                <option value="Burundi"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Burundi') ? 'selected' : '' ?>>
                                    Burundi</option>
                                <option value="Cambodge"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Cambodge') ? 'selected' : '' ?>>
                                    Cambodge</option>
                                <option value="Cameroun"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Cameroun') ? 'selected' : '' ?>>
                                    Cameroun</option>
                                <option value="Canada"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Canada') ? 'selected' : '' ?>>
                                    Canada</option>
                                <option value="Cap-Vert"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Cap-Vert') ? 'selected' : '' ?>>
                                    Cap-Vert</option>
                                <option value="Chili"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Chili') ? 'selected' : '' ?>>Chili
                                </option>
                                <option value="Chine"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Chine') ? 'selected' : '' ?>>Chine
                                </option>
                                <option value="Chypre"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Chypre') ? 'selected' : '' ?>>
                                    Chypre</option>
                                <option value="Colombie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Colombie') ? 'selected' : '' ?>>
                                    Colombie</option>
                                <option value="Comores"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Comores') ? 'selected' : '' ?>>
                                    Comores</option>
                                <option value="Congo"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Congo') ? 'selected' : '' ?>>Congo
                                </option>
                                <option value="Costa Rica"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Costa Rica') ? 'selected' : '' ?>>
                                    Costa Rica</option>
                                <option value="Croatie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Croatie') ? 'selected' : '' ?>>
                                    Croatie</option>
                                <option value="Cuba"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Cuba') ? 'selected' : '' ?>>Cuba
                                </option>
                                <option value="Danemark"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Danemark') ? 'selected' : '' ?>>
                                    Danemark</option>
                                <option value="Djibouti"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Djibouti') ? 'selected' : '' ?>>
                                    Djibouti</option>
                                <option value="Dominique"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Dominique') ? 'selected' : '' ?>>
                                    Dominique</option>
                                <option value="Égypte"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Égypte') ? 'selected' : '' ?>>
                                    Égypte</option>
                                <option value="Équateur"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Équateur') ? 'selected' : '' ?>>
                                    Équateur</option>
                                <option value="Érythrée"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Érythrée') ? 'selected' : '' ?>>
                                    Érythrée</option>
                                <option value="Espagne"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Espagne') ? 'selected' : '' ?>>
                                    Espagne</option>
                                <option value="Estonie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Estonie') ? 'selected' : '' ?>>
                                    Estonie</option>
                                <option value="Eswatini"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Eswatini') ? 'selected' : '' ?>>
                                    Eswatini</option>
                                <option value="Éthiopie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Éthiopie') ? 'selected' : '' ?>>
                                    Éthiopie</option>
                                <option value="Fidji"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Fidji') ? 'selected' : '' ?>>Fidji
                                </option>
                                <option value="Finlande"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Finlande') ? 'selected' : '' ?>>
                                    Finlande</option>
                                <option value="France"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'France') ? 'selected' : '' ?>>
                                    France</option>
                                <option value="Gabon"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Gabon') ? 'selected' : '' ?>>Gabon
                                </option>
                                <option value="Gambie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Gambie') ? 'selected' : '' ?>>
                                    Gambie</option>
                                <option value="Géorgie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Géorgie') ? 'selected' : '' ?>>
                                    Géorgie</option>
                                <option value="Ghana"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Ghana') ? 'selected' : '' ?>>Ghana
                                </option>
                                <option value="Gibraltar"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Gibraltar') ? 'selected' : '' ?>>
                                    Gibraltar</option>
                                <option value="Grèce"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Grèce') ? 'selected' : '' ?>>Grèce
                                </option>
                                <option value="Grenade"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Grenade') ? 'selected' : '' ?>>
                                    Grenade</option>
                                <option value="Groenland"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Groenland') ? 'selected' : '' ?>>
                                    Groenland</option>
                                <option value="Guadeloupe"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Guadeloupe') ? 'selected' : '' ?>>
                                    Guadeloupe</option>
                                <option value="Guam"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Guam') ? 'selected' : '' ?>>Guam
                                </option>
                                <option value="Guatemala"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Guatemala') ? 'selected' : '' ?>>
                                    Guatemala</option>
                                <option value="Guernesey"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Guernesey') ? 'selected' : '' ?>>
                                    Guernesey</option>
                                <option value="Guinée"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Guinée') ? 'selected' : '' ?>>
                                    Guinée</option>
                                <option value="Guyana"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Guyana') ? 'selected' : '' ?>>
                                    Guyana</option>
                                <option value="Haïti"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Haïti') ? 'selected' : '' ?>>Haïti
                                </option>
                                <option value="Honduras"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Honduras') ? 'selected' : '' ?>>
                                    Honduras</option>
                                <option value="Hong Kong"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Hong Kong') ? 'selected' : '' ?>>
                                    Hong Kong</option>
                                <option value="Hongrie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Hongrie') ? 'selected' : '' ?>>
                                    Hongrie</option>
                                <option value="Île Bouvet"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Île Bouvet') ? 'selected' : '' ?>>
                                    Île Bouvet</option>
                                <option value="Inde"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Inde') ? 'selected' : '' ?>>Inde
                                </option>
                                <option value="Indonésie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Indonésie') ? 'selected' : '' ?>>
                                    Indonésie</option>
                                <option value="Iran"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Iran') ? 'selected' : '' ?>>Iran
                                </option>
                                <option value="Irak"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Irak') ? 'selected' : '' ?>>Irak
                                </option>
                                <option value="Irlande"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Irlande') ? 'selected' : '' ?>>
                                    Irlande</option>
                                <option value="Islande"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Islande') ? 'selected' : '' ?>>
                                    Islande</option>
                                <option value="Israël"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Israël') ? 'selected' : '' ?>>
                                    Israël</option>
                                <option value="Italie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Italie') ? 'selected' : '' ?>>
                                    Italie</option>
                                <option value="Jamaïque"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Jamaïque') ? 'selected' : '' ?>>
                                    Jamaïque</option>
                                <option value="Japon"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Japon') ? 'selected' : '' ?>>Japon
                                </option>
                                <option value="Jersey"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Jersey') ? 'selected' : '' ?>>
                                    Jersey</option>
                                <option value="Jordanie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Jordanie') ? 'selected' : '' ?>>
                                    Jordanie</option>
                                <option value="Kazakhstan"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Kazakhstan') ? 'selected' : '' ?>>
                                    Kazakhstan</option>
                                <option value="Kenya"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Kenya') ? 'selected' : '' ?>>Kenya
                                </option>
                                <option value="Kiribati"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Kiribati') ? 'selected' : '' ?>>
                                    Kiribati</option>
                                <option value="Koweït"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Koweït') ? 'selected' : '' ?>>
                                    Koweït</option>
                                <option value="Lettonie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Lettonie') ? 'selected' : '' ?>>
                                    Lettonie</option>
                                <option value="Liban"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Liban') ? 'selected' : '' ?>>Liban
                                </option>
                                <option value="Lesotho"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Lesotho') ? 'selected' : '' ?>>
                                    Lesotho</option>
                                <option value="Libéria"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Libéria') ? 'selected' : '' ?>>
                                    Libéria</option>
                                <option value="Liechtenstein"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Liechtenstein') ? 'selected' : '' ?>>
                                    Liechtenstein</option>
                                <option value="Lituanie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Lituanie') ? 'selected' : '' ?>>
                                    Lituanie</option>
                                <option value="Luxembourg"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Luxembourg') ? 'selected' : '' ?>>
                                    Luxembourg</option>
                                <option value="Macao"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Macao') ? 'selected' : '' ?>>Macao
                                </option>
                                <option value="Madagascar"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Madagascar') ? 'selected' : '' ?>>
                                    Madagascar</option>
                                <option value="Malaisie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Malaisie') ? 'selected' : '' ?>>
                                    Malaisie</option>
                                <option value="Malawi"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Malawi') ? 'selected' : '' ?>>
                                    Malawi</option>
                                <option value="Maldives"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Maldives') ? 'selected' : '' ?>>
                                    Maldives</option>
                                <option value="Mali"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Mali') ? 'selected' : '' ?>>Mali
                                </option>
                                <option value="Malte"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Malte') ? 'selected' : '' ?>>Malte
                                </option>
                                <option value="Maroc"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Maroc') ? 'selected' : '' ?>>Maroc
                                </option>
                                <option value="Martinique"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Martinique') ? 'selected' : '' ?>>
                                    Martinique</option>
                                <option value="Maurice"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Maurice') ? 'selected' : '' ?>>
                                    Maurice</option>
                                <option value="Mauritanie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Mauritanie') ? 'selected' : '' ?>>
                                    Mauritanie</option>
                                <option value="Mayotte"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Mayotte') ? 'selected' : '' ?>>
                                    Mayotte</option>
                                <option value="Mexique"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Mexique') ? 'selected' : '' ?>>
                                    Mexique</option>
                                <option value="Monaco"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Monaco') ? 'selected' : '' ?>>
                                    Monaco</option>
                                <option value="Mongolie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Mongolie') ? 'selected' : '' ?>>
                                    Mongolie</option>
                                <option value="Monténégro"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Monténégro') ? 'selected' : '' ?>>
                                    Monténégro</option>
                                <option value="Montserrat"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Montserrat') ? 'selected' : '' ?>>
                                    Montserrat</option>
                                <option value="Mozambique"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Mozambique') ? 'selected' : '' ?>>
                                    Mozambique</option>
                                <option value="Namibie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Namibie') ? 'selected' : '' ?>>
                                    Namibie</option>
                                <option value="Nauru"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Nauru') ? 'selected' : '' ?>>Nauru
                                </option>
                                <option value="Népal"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Népal') ? 'selected' : '' ?>>Népal
                                </option>
                                <option value="Nicaragua"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Nicaragua') ? 'selected' : '' ?>>
                                    Nicaragua</option>
                                <option value="Niger"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Niger') ? 'selected' : '' ?>>Niger
                                </option>
                                <option value="Nigeria"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Nigeria') ? 'selected' : '' ?>>
                                    Nigeria</option>
                                <option value="Niue"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Niue') ? 'selected' : '' ?>>Niue
                                </option>
                                <option value="Norvège"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Norvège') ? 'selected' : '' ?>>
                                    Norvège</option>
                                <option value="Oman"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Oman') ? 'selected' : '' ?>>Oman
                                </option>
                                <option value="Ouganda"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Ouganda') ? 'selected' : '' ?>>
                                    Ouganda</option>
                                <option value="Ouzbékistan"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Ouzbékistan') ? 'selected' : '' ?>>
                                    Ouzbékistan</option>
                                <option value="Pakistan"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Pakistan') ? 'selected' : '' ?>>
                                    Pakistan</option>
                                <option value="Palaos"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Palaos') ? 'selected' : '' ?>>
                                    Palaos</option>
                                <option value="Panama"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Panama') ? 'selected' : '' ?>>
                                    Panama</option>
                                <option value="Paraguay"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Paraguay') ? 'selected' : '' ?>>
                                    Paraguay</option>
                                <option value="Pays-Bas"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Pays-Bas') ? 'selected' : '' ?>>
                                    Pays-Bas</option>
                                <option value="Pérou"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Pérou') ? 'selected' : '' ?>>Pérou
                                </option>
                                <option value="Philippines"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Philippines') ? 'selected' : '' ?>>
                                    Philippines</option>
                                <option value="Pitcairn"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Pitcairn') ? 'selected' : '' ?>>
                                    Pitcairn</option>
                                <option value="Pologne"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Pologne') ? 'selected' : '' ?>>
                                    Pologne</option>
                                <option value="Portugal"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Portugal') ? 'selected' : '' ?>>
                                    Portugal</option>
                                <option value="Porto Rico"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Porto Rico') ? 'selected' : '' ?>>
                                    Porto Rico</option>
                                <option value="Qatar"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Qatar') ? 'selected' : '' ?>>Qatar
                                </option>
                                <option value="Réunion"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Réunion') ? 'selected' : '' ?>>
                                    Réunion</option>
                                <option value="Roumanie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Roumanie') ? 'selected' : '' ?>>
                                    Roumanie</option>
                                <option value="Russie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Russie') ? 'selected' : '' ?>>
                                    Russie</option>
                                <option value="Rwanda"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Rwanda') ? 'selected' : '' ?>>
                                    Rwanda</option>
                                <option value="Saint-Marin"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Saint-Marin') ? 'selected' : '' ?>>
                                    Saint-Marin</option>
                                <option value="Samoa"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Samoa') ? 'selected' : '' ?>>Samoa
                                </option>
                                <option value="Samoa américaines"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Samoa américaines') ? 'selected' : '' ?>>
                                    Samoa américaines</option>
                                <option value="Sénégal"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Sénégal') ? 'selected' : '' ?>>
                                    Sénégal</option>
                                <option value="Serbie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Serbie') ? 'selected' : '' ?>>
                                    Serbie</option>
                                <option value="Seychelles"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Seychelles') ? 'selected' : '' ?>>
                                    Seychelles</option>
                                <option value="Singapour"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Singapour') ? 'selected' : '' ?>>
                                    Singapour</option>
                                <option value="Slovaquie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Slovaquie') ? 'selected' : '' ?>>
                                    Slovaquie</option>
                                <option value="Slovénie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Slovénie') ? 'selected' : '' ?>>
                                    Slovénie</option>
                                <option value="Somalie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Somalie') ? 'selected' : '' ?>>
                                    Somalie</option>
                                <option value="Soudan"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Soudan') ? 'selected' : '' ?>>
                                    Soudan</option>
                                <option value="Suède"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Suède') ? 'selected' : '' ?>>Suède
                                </option>
                                <option value="Suisse"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Suisse') ? 'selected' : '' ?>>
                                    Suisse</option>
                                <option value="Suriname"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Suriname') ? 'selected' : '' ?>>
                                    Suriname</option>
                                <option value="Syrie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Syrie') ? 'selected' : '' ?>>Syrie
                                </option>
                                <option value="Taïwan"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Taïwan') ? 'selected' : '' ?>>
                                    Taïwan</option>
                                <option value="Tadjikistan"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Tadjikistan') ? 'selected' : '' ?>>
                                    Tadjikistan</option>
                                <option value="Tchad"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Tchad') ? 'selected' : '' ?>>Tchad
                                </option>
                                <option value="Tchéquie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Tchéquie') ? 'selected' : '' ?>>
                                    Tchéquie</option>
                                <option value="Thaïlande"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Thaïlande') ? 'selected' : '' ?>>
                                    Thaïlande</option>
                                <option value="Togo"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Togo') ? 'selected' : '' ?>>Togo
                                </option>
                                <option value="Tonga"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Tonga') ? 'selected' : '' ?>>Tonga
                                </option>
                                <option value="Tunisie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Tunisie') ? 'selected' : '' ?>>
                                    Tunisie</option>
                                <option value="Turkménistan"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Turkménistan') ? 'selected' : '' ?>>
                                    Turkménistan</option>
                                <option value="Turquie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Turquie') ? 'selected' : '' ?>>
                                    Turquie</option>
                                <option value="Tuvalu"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Tuvalu') ? 'selected' : '' ?>>
                                    Tuvalu</option>
                                <option value="Ukraine"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Ukraine') ? 'selected' : '' ?>>
                                    Ukraine</option>
                                <option value="Uruguay"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Uruguay') ? 'selected' : '' ?>>
                                    Uruguay</option>
                                <option value="Vanuatu"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Vanuatu') ? 'selected' : '' ?>>
                                    Vanuatu</option>
                                <option value="Venezuela"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Venezuela') ? 'selected' : '' ?>>
                                    Venezuela</option>
                                <option value="Vietnam"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Vietnam') ? 'selected' : '' ?>>
                                    Vietnam</option>
                                <option value="Yémen"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Yémen') ? 'selected' : '' ?>>Yémen
                                </option>
                                <option value="Zambie"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Zambie') ? 'selected' : '' ?>>
                                    Zambie</option>
                                <option value="Zimbabwe"
                                    <?= (isset($_POST['pays']) && $_POST['pays'] == 'Zimbabwe') ? 'selected' : '' ?>>
                                    Zimbabwe</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 w-25 mx-auto">
                    <div style="display: flex" class="genre">
                        <p>Genre</p>
                        <p style="color: red !important; display: inline; float: none;">*</p>
                        <p class="ms-2 text-danger fst-italic fw-light" style="display: bloc;">
                            <?= $erreur["genre"] ?? '' ?></p>
                    </div>
                    <div class="form-check" required="required">
                        <input class="form-check-input" type="hidden" name="genre" value="non" id="radioDefault0">
                    </div>
                    <div class="form-check" required="required">
                        <input class="form-check-input" type="radio" name="genre" value="homme" id="radioDefault1"
                            <?= (isset($_POST['genre']) && $_POST['genre'] == 'homme') ? 'checked="checked"' : '';  ?>>
                        <label class="form-check-label" for="radioDefault1">
                            Homme
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="genre" value="femme" id="radioDefault2"
                            <?= (isset($_POST['genre']) && $_POST['genre'] == 'femme') ? 'checked="checked"' : '';  ?>>
                        <label class="form-check-label" for="radioDefault2">
                            Femme
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="genre" value="autre" id="radioDefault3"
                            <?= (isset($_POST['genre']) && $_POST['genre'] == 'autre') ? 'checked="checked"' : '';  ?>>
                        <label class="form-check-label" for="radioDefault3">
                            Autre
                        </label>
                    </div>
                </div>
                <div class="row mt-3 mx-auto">
                    <label for="exampleFormControlInput1" class="form-label">Message falcultatif</label>
                    <textarea type="text" class="form-control pb-3" id="message" name="message"
                        placeholder="Ecrivez votre message ici"><?= (isset($_POST['message'])) ? $_POST['message'] : ''; ?></textarea>
                </div>
                <div class="row mt-3">
                    <div class="form-check" style="display: flex">
                        <input class="form-check-input" type="hidden" value="non" id="CGU" name="CGU">
                        <input class="form-check-input" type="checkbox" value="oui" id="CGU" name="CGU"
                            <?= (empty($erreur['CGU'])?'checked':'') ?>>
                        <label class="form-check-label ms-2" for="checkDefault">
                            En poursuivant, vous reconnaissez avoir lu et accepté les Conditions Générales
                            d'Utilisation.
                        </label>
                        <p style="color: red !important; display: inline; float: none;">*</p><span
                            class="ms-2 text-danger fst-italic fw-light"><?= $erreur["CGU"] ?? '' ?></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">S'inscrire</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>


</html>