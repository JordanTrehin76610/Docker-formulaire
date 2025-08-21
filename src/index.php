<?php 
//var_dump($_POST);

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

    if(empty($erreur)){
        header("Location: pages/confirmation.php");
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
                                style="color: red !important; display: inline; float: none;">*</span>
                            <select id="pays" name="pays" class="form-control mt-2">
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Îles Åland">Îles Åland</option>
                                <option value="Albanie">Albanie</option>
                                <option value="Algérie">Algérie</option>
                                <option value="Samoa américaines">Samoa américaines</option>
                                <option value="Andorre">Andorre</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctique">Antarctique</option>
                                <option value="Argentine">Argentine</option>
                                <option value="Arménie">Arménie</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australie">Australie</option>
                                <option value="Autriche">Autriche</option>
                                <option value="Azerbaïdjan">Azerbaïdjan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahreïn">Bahreïn</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbade">Barbade</option>
                                <option value="Biélorussie">Biélorussie</option>
                                <option value="Belgique">Belgique</option>
                                <option value="Belize">Belize</option>
                                <option value="Bénin">Bénin</option>
                                <option value="Bermudes">Bermudes</option>
                                <option value="Bhoutan">Bhoutan</option>
                                <option value="Bolivie">Bolivie</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Île Bouvet">Île Bouvet</option>
                                <option value="Brésil">Brésil</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgarie">Bulgarie</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodge">Cambodge</option>
                                <option value="Cameroun">Cameroun</option>
                                <option value="Canada">Canada</option>
                                <option value="Cap-Vert">Cap-Vert</option>
                                <option value="Tchad">Tchad</option>
                                <option value="Chili">Chili</option>
                                <option value="Chine">Chine</option>
                                <option value="Colombie">Colombie</option>
                                <option value="Comores">Comores</option>
                                <option value="Congo">Congo</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Croatie">Croatie</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Chypre">Chypre</option>
                                <option value="Tchéquie">Tchéquie</option>
                                <option value="Danemark">Danemark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominique">Dominique</option>
                                <option value="Équateur">Équateur</option>
                                <option value="Égypte">Égypte</option>
                                <option value="Salvador">Salvador</option>
                                <option value="Érythrée">Érythrée</option>
                                <option value="Estonie">Estonie</option>
                                <option value="Éthiopie">Éthiopie</option>
                                <option value="Fidji">Fidji</option>
                                <option value="Finlande">Finlande</option>
                                <option value="France">France</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambie">Gambie</option>
                                <option value="Géorgie">Géorgie</option>
                                <option value="Allemagne">Allemagne</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Grèce">Grèce</option>
                                <option value="Groenland">Groenland</option>
                                <option value="Grenade">Grenade</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernesey">Guernesey</option>
                                <option value="Guinée">Guinée</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haïti">Haïti</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hongrie">Hongrie</option>
                                <option value="Islande">Islande</option>
                                <option value="Inde">Inde</option>
                                <option value="Indonésie">Indonésie</option>
                                <option value="Iran">Iran</option>
                                <option value="Irak">Irak</option>
                                <option value="Irlande">Irlande</option>
                                <option value="Israël">Israël</option>
                                <option value="Italie">Italie</option>
                                <option value="Jamaïque">Jamaïque</option>
                                <option value="Japon">Japon</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Jordanie">Jordanie</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Koweït">Koweït</option>
                                <option value="Lettonie">Lettonie</option>
                                <option value="Liban">Liban</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Libéria">Libéria</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lituanie">Lituanie</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaisie">Malaisie</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malte">Malte</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritanie">Mauritanie</option>
                                <option value="Maurice">Maurice</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexique">Mexique</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolie">Mongolie</option>
                                <option value="Monténégro">Monténégro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Maroc">Maroc</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Namibie">Namibie</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Népal">Népal</option>
                                <option value="Pays-Bas">Pays-Bas</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norvège">Norvège</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palaos">Palaos</option>
                                <option value="Panama">Panama</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Pérou">Pérou</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Pologne">Pologne</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Porto Rico">Porto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Réunion">Réunion</option>
                                <option value="Roumanie">Roumanie</option>
                                <option value="Russie">Russie</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Samoa">Samoa</option>
                                <option value="Saint-Marin">Saint-Marin</option>
                                <option value="Sénégal">Sénégal</option>
                                <option value="Serbie">Serbie</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Singapour">Singapour</option>
                                <option value="Slovaquie">Slovaquie</option>
                                <option value="Slovénie">Slovénie</option>
                                <option value="Somalie">Somalie</option>
                                <option value="Espagne">Espagne</option>
                                <option value="Soudan">Soudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Eswatini">Eswatini</option>
                                <option value="Suède">Suède</option>
                                <option value="Suisse">Suisse</option>
                                <option value="Syrie">Syrie</option>
                                <option value="Taïwan">Taïwan</option>
                                <option value="Tadjikistan">Tadjikistan</option>
                                <option value="Thaïlande">Thaïlande</option>
                                <option value="Togo">Togo</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Tunisie">Tunisie</option>
                                <option value="Turquie">Turquie</option>
                                <option value="Turkménistan">Turkménistan</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Ouganda">Ouganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Ouzbékistan">Ouzbékistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Yémen">Yémen</option>
                                <option value="Zambie">Zambie</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 w-25 mx-auto">
                    <div style="display: flex" class="genre">
                        <p>Genre</p>
                        <p style="color: red !important; display: inline; float: none;">*</p><p
                                class="ms-2 text-danger fst-italic fw-light" style="display: bloc;"><?= $erreur["genre"] ?? '' ?></p>
                    </div>
                    <div class="form-check" required="required">
                        <input class="form-check-input" type="hidden" name="genre" value="non" id="radioDefault0">
                    </div>
                    <div class="form-check" required="required">
                        <input class="form-check-input" type="radio" name="genre" value="homme" id="radioDefault1" >
                        <label class="form-check-label" for="radioDefault1">
                            Homme
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="genre" value="femme" id="radioDefault2">
                        <label class="form-check-label" for="radioDefault2">
                            Femme
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="genre" value="autre" id="radioDefault3">
                        <label class="form-check-label" for="radioDefault3">
                            Autre
                        </label>
                    </div>
                </div>
                <div class="row mt-3 mx-auto">
                    <label for="exampleFormControlInput1" class="form-label">Message falcultatif</label>
                    <textarea type="text" class="form-control pb-3" id="message" name="message"
                        placeholder="Ecrivez votre message ici" value="<?= $_POST["message"] ?? "" ?>"></textarea>
                </div>
                <div class="row mt-3">
                    <div class="form-check" style="display: flex">
                        <input class="form-check-input" type="hidden" value="non" id="CGU" name="CGU">
                        <input class="form-check-input" type="checkbox" value="oui" id="CGU" name="CGU">
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