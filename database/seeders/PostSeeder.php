<?php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@edl.bj')->first();

        $solaire    = Category::where('name', 'Solaire')->first();
        $payg       = Category::where('name', 'PAYG')->first();
        $iot        = Category::where('name', 'IoT & Smart')->first();
        $subvention = Category::where('name', 'Subventions')->first();
        $temoignage = Category::where('name', 'Témoignages')->first();
        $innovation = Category::where('name', 'Innovations')->first();

        $posts = [

            // ── ARTICLE 1 ──────────────────────────────────────────
            [
                'title'       => 'La révolution solaire au Bénin : pourquoi maintenant ?',
                'excerpt'     => 'Avec 5,5 kWh/m²/jour d\'ensoleillement et des coûts du solaire en chute libre, le Bénin est au seuil d\'une révolution énergétique sans précédent.',
                'content'     => "Le Bénin bénéficie d'un des meilleurs potentiels solaires d'Afrique de l'Ouest avec en moyenne 5,5 kWh par mètre carré par jour. Ce chiffre, souvent cité mais peu compris, signifie concrètement que chaque toit béninois reçoit quotidiennement suffisamment d'énergie solaire pour alimenter plusieurs foyers.

Pendant des décennies, exploiter cette ressource semblait inaccessible pour le citoyen ordinaire. Un kit solaire coûtait l'équivalent de six mois de salaire minimum. Mais en dix ans, les prix des panneaux photovoltaïques ont chuté de plus de 80%, rendant cette technologie non seulement viable, mais économiquement avantageuse.

## Pourquoi maintenant ?

Trois facteurs convergent aujourd'hui pour créer une opportunité historique :

Premièrement, la baisse des coûts. Un kit solaire domestique de base capable d'alimenter l'éclairage, un ventilateur et la recharge des téléphones coûte désormais entre 50 000 et 150 000 FCFA, contre 400 000 FCFA il y a dix ans.

Deuxièmement, la maturité du paiement mobile. Avec Flooz, MTN Money et Celtis couvrant plus de 60% de la population béninoise, il est désormais possible de payer son énergie solaire par tranches mensuelles directement depuis son téléphone, sans compte bancaire.

Troisièmement, la pression de la demande. Les délestages fréquents de la SBEE poussent ménages et entreprises à chercher des alternatives. Un générateur diesel coûte en moyenne 50 000 FCFA par mois en carburant. Le solaire, une fois installé, coûte zéro.

## Les chiffres qui parlent

Taux d'électrification en zones rurales : moins de 40%. Nombre de ménages béninois sans accès fiable à l'électricité : plus de 3 millions. Potentiel de réduction des émissions CO2 si 10% des ménages passaient au solaire : équivalent à retirer 50 000 voitures de la circulation.

## Ce que cela signifie pour vous

Si vous êtes un ménage urbain affecté par les délestages, un kit solaire de complément peut vous libérer de ces interruptions. Si vous êtes en zone rurale sans raccordement SBEE, une solution solaire autonome peut transformer votre quotidien : réfrigération alimentaire, éclairage nocturne pour les enfants, recharge des équipements de travail.

La révolution solaire n'est plus une promesse. Elle est en cours. La question n'est plus de savoir si vous pouvez vous le permettre, mais de savoir combien vous perdez chaque jour sans elle.",
                'category_id' => $solaire->id,
                'user_id'     => $admin->id,
                'status'      => 'published',
                'views'       => 342,
                'video_url'   => 'https://www.youtube.com/watch?v=nhyUMhKOKKE',
            ],

            // ── ARTICLE 2 ──────────────────────────────────────────
            [
                'title'       => 'PAYG : payer son énergie solaire comme une recharge téléphone',
                'excerpt'     => 'Le modèle Pay-As-You-Go révolutionne l\'accès à l\'énergie en Afrique. Au Bénin, il permet aux ménages les plus modestes de s\'équiper sans apport initial.',
                'content'     => "Imaginez acheter votre système solaire comme vous rechargez votre téléphone : par petites tranches, quand vous pouvez, sans contrat de banque, sans garant, sans paperasse. C'est exactement ce que propose le modèle Pay-As-You-Go, ou PAYG.

## Qu'est-ce que le PAYG exactement ?

Le Pay-As-You-Go est un modèle de financement où vous payez votre équipement solaire par petites tranches régulières via mobile money. Chaque paiement déverrouille votre système pour une période déterminée. Si vous ne payez pas, le système se met en veille automatiquement. Une fois le coût total remboursé, l'équipement vous appartient définitivement.

## Comment ça fonctionne concrètement ?

Prenons l'exemple d'un kit solaire à 200 000 FCFA. Avec le PAYG sur 24 mois, vous payez environ 9 000 à 10 000 FCFA par mois via Flooz ou MTN Money. C'est moins qu'un générateur en carburant pour une semaine.

Le processus est simple. Vous choisissez votre kit et votre durée de remboursement. Vous versez un premier acompte symbolique, parfois même zéro. Vous recevez et installez votre équipement. Chaque mois, vous payez via mobile money. Après la dernière mensualité, le système est entièrement à vous.

## Pourquoi c'est révolutionnaire pour le Bénin ?

La barrière principale à l'adoption du solaire n'est pas le manque d'intérêt mais le coût initial. La majorité des ménages béninois ne peut pas débourser 200 000 FCFA d'un coup, même si cet investissement serait rentabilisé en moins de deux ans.

Le PAYG élimine cette barrière. Il transforme un investissement inaccessible en une dépense mensuelle gérable, comparable à ce que ces ménages dépensent déjà en bougies, piles, carburant pour groupe électrogène ou factures SBEE.

## Les acteurs du PAYG au Bénin

Plusieurs entreprises opèrent déjà ce modèle en Afrique de l'Ouest et commencent à s'implanter au Bénin. Les paiements s'effectuent via les opérateurs de mobile money locaux : Moov Africa avec Flooz, MTN avec MTN Money, et Celtis.

## À qui s'adresse le PAYG ?

Ce modèle est particulièrement adapté aux ménages ruraux sans accès SBEE, aux petits commerçants et artisans, aux agriculteurs ayant besoin d'énergie pour la conservation ou le pompage, et à toute personne disposant d'un revenu régulier mais sans capital initial.

Le PAYG n'est pas une aide sociale. C'est un modèle économique viable qui aligne les intérêts du fournisseur et de l'utilisateur. Plus vous payez, plus vous avancez vers la propriété complète de votre système. C'est l'énergie solaire rendue accessible à tous.",
                'category_id' => $payg->id,
                'user_id'     => $admin->id,
                'status'      => 'published',
                'views'       => 289,
            ],

            // ── ARTICLE 3 ──────────────────────────────────────────
            [
                'title'       => 'IoT et énergie intelligente : le futur arrive au Bénin',
                'excerpt'     => 'Les compteurs intelligents et les maisons connectées ne sont plus réservés aux pays développés. Des solutions IoT adaptées au contexte béninois émergent.',
                'content'     => "L'Internet des Objets, ou IoT, désigne la connexion d'appareils physiques à internet pour collecter et échanger des données. Appliqué à l'énergie, il permet de surveiller, contrôler et optimiser sa consommation électrique en temps réel depuis un simple smartphone.

## Pourquoi l'IoT est pertinent pour le contexte béninois ?

Dans un pays où l'électricité est rare et coûteuse, gaspiller de l'énergie est un luxe que personne ne peut se permettre. L'IoT permet précisément d'éliminer ce gaspillage.

Un compteur intelligent installé sur votre système solaire vous indique en temps réel combien d'énergie vous produisez, combien vous consommez et combien il vous reste dans votre batterie. Vous pouvez couper à distance des appareils qui consomment inutilement, recevoir une alerte quand votre batterie est basse, ou programmer vos équipements pour fonctionner uniquement quand l'énergie produite est abondante.

## Des applications concrètes pour le Bénin

Pour les ménages équipés de panneaux solaires, un contrôleur IoT optimise automatiquement la charge des batteries et prolonge leur durée de vie de plusieurs années.

Pour les agriculteurs, des pompes solaires intelligentes s'activent automatiquement selon les besoins des cultures et les conditions météo, sans intervention humaine.

Pour les commerçants, un système de gestion énergétique IoT permet de savoir exactement combien coûte en énergie chaque appareil de votre boutique, et d'optimiser vos dépenses.

## L'IoT dans le modèle PAYG

L'IoT est en réalité au cœur du modèle PAYG. Le verrouillage à distance du système en cas de non-paiement est une fonctionnalité IoT. Sans cette technologie, le PAYG ne serait pas possible, car le fournisseur n'aurait aucun moyen de sécuriser son investissement sur des équipements installés à des centaines de kilomètres.

## Les défis à relever

La connectivité reste le principal défi. L'IoT nécessite une connexion réseau, et certaines zones rurales béninoises ne bénéficient pas encore d'une couverture suffisante. Des solutions utilisant les réseaux GSM plutôt que le WiFi contournent partiellement ce problème.

Le coût des capteurs et modules IoT a cependant considérablement baissé. Des systèmes de surveillance énergétique de base sont aujourd'hui disponibles pour moins de 20 000 FCFA.

L'énergie intelligente n'est plus une vision futuriste pour le Bénin. C'est une réalité en cours de déploiement qui transformera profondément la manière dont les Béninois produisent, consomment et paient leur énergie.",
                'category_id' => $iot->id,
                'user_id'     => $admin->id,
                'status'      => 'published',
                'views'       => 198,
            ],

            // ── ARTICLE 4 ──────────────────────────────────────────
            [
                'title'       => 'Subventions énergie au Bénin : ce que vous pouvez obtenir en 2026',
                'excerpt'     => 'Le gouvernement béninois et plusieurs organisations internationales proposent des aides financières pour l\'accès à l\'énergie solaire. Voici comment en bénéficier.',
                'content'     => "L'accès à une énergie propre et abordable est reconnu comme un droit fondamental et un levier de développement. C'est pourquoi plusieurs programmes de subventions et d'appuis financiers existent pour aider les Béninois à s'équiper en solutions solaires. Beaucoup de ces aides sont méconnues du grand public.

## Les programmes gouvernementaux

Le gouvernement béninois, dans le cadre de sa politique d'accès universel à l'électricité, a mis en place plusieurs mécanismes d'appui. L'Agence Béninoise d'Électrification Rurale et de Maîtrise d'Énergie, l'ABERME, coordonne ces programmes et peut orienter les demandeurs vers les dispositifs adaptés à leur situation.

Des projets financés par la Banque Mondiale et la Banque Africaine de Développement permettent également des installations à coûts réduits dans certaines zones rurales prioritaires.

## Les organisations internationales actives au Bénin

Plusieurs organisations sont actives sur le terrain. L'USAID soutient des programmes d'accès à l'énergie en zones rurales. L'Union Européenne finance des projets d'électrification via ses programmes de développement. La GIZ allemande accompagne le développement des énergies renouvelables au Bénin.

## Comment bénéficier de ces aides ?

Les démarches varient selon le programme, mais quelques étapes sont communes. Il faut d'abord identifier le programme adapté à votre situation géographique et à vos besoins. Ensuite, se rapprocher de l'ABERME ou des mairies locales qui servent souvent de relais. Préparer un dossier simple comprenant votre identité, votre localisation et une description de vos besoins énergétiques.

## Les aides des entreprises privées

Certaines entreprises du secteur solaire proposent leurs propres programmes d'appui en partenariat avec des ONG ou des bailleurs de fonds. Ces programmes peuvent prendre la forme de kits offerts, de formations gratuites à l'installation et à la maintenance, ou de prix préférentiels pour certaines catégories de bénéficiaires.

## Vigilance contre les arnaques

La popularité croissante des subventions énergétiques a malheureusement attiré des personnes mal intentionnées. Méfiez-vous de toute personne vous demandant de payer pour accéder à une subvention. Les vraies aides ne nécessitent jamais de paiement préalable. Vérifiez toujours l'identité des interlocuteurs et passez par les canaux officiels.

Rester informé est la première étape pour bénéficier de ces opportunités. Notre blog vous alertera de tout nouveau programme disponible au Bénin.",
                'category_id' => $subvention->id,
                'user_id'     => $admin->id,
                'status'      => 'published',
                'views'       => 421,
            ],

            // ── ARTICLE 5 ──────────────────────────────────────────
            [
                'title'       => 'Témoignage : comment le solaire a transformé ma boutique à Parakou',
                'excerpt'     => 'Mère de trois enfants et gérante d\'une boutique à Parakou, Adjoua raconte comment l\'installation d\'un kit solaire a doublé ses revenus et changé sa vie.',
                'content'     => "Adjoua Mensah, 34 ans, gère une petite boutique d'alimentation dans le quartier Zongo à Parakou depuis sept ans. Comme des milliers de commerçants béninois, elle subissait les délestages de la SBEE comme une fatalité. Jusqu'au jour où elle a décidé d'agir.

## La vie avant le solaire

Avant l'installation de son kit solaire, Adjoua fermait systématiquement sa boutique à la tombée de la nuit. Sans éclairage, impossible de servir les clients. Son réfrigérateur, alimenté par un groupe électrogène, lui coûtait 35 000 FCFA par mois en carburant, sans compter les pannes fréquentes et les réparations.

Les délestages de journée lui faisaient perdre des heures de réfrigération, obligeant parfois à vendre à perte des produits risquant de se gâter. Elle estimait perdre entre 15 000 et 20 000 FCFA par mois à cause de ces contraintes énergétiques.

## La décision

C'est lors d'une réunion de son groupement de femmes commerçantes qu'Adjoua a entendu parler pour la première fois d'un programme de kits solaires avec paiement échelonné. Son premier réflexe a été la méfiance. Comment une technologie qu'elle associait aux grands bâtiments et aux riches pouvait-elle s'adapter à sa petite boutique ?

Une visite chez une commerçante voisine qui avait déjà fait l'installation l'a convaincue. Elle a vu de ses propres yeux un réfrigérateur fonctionner silencieusement, des lumières tenir toute la nuit, et une boutique ouverte bien après 21 heures.

## L'installation

Le kit installé chez Adjoua comprend deux panneaux solaires de 150 watts chacun, une batterie de 200 ampères-heures, un onduleur, et un contrôleur de charge intelligent. L'installation a pris une journée complète réalisée par un technicien certifié.

Le coût total était de 280 000 FCFA. Grâce au programme PAYG, elle paie 12 000 FCFA par mois pendant 24 mois via Flooz.

## La vie après le solaire

Six mois après l'installation, les chiffres parlent d'eux-mêmes. Ses dépenses énergétiques mensuelles sont passées de 35 000 FCFA en carburant à 12 000 FCFA en mensualité PAYG. Elle économise donc 23 000 FCFA par mois dès aujourd'hui, et zéro dépense énergétique dans 18 mois quand le kit sera totalement remboursé.

Sa boutique est désormais ouverte jusqu'à 22 heures. Ce seul changement a augmenté son chiffre d'affaires de 40%. Elle peut recharger les téléphones de ses clients, un service très demandé dans son quartier.

## Son message

Adjoua conclut avec un message simple pour ses consœurs commerçantes : le solaire n'est pas un luxe. C'est un investissement qui se rembourse de lui-même. Le plus difficile a été de franchir le premier pas et de faire confiance à la technologie. Aujourd'hui elle ne reviendrait en arrière pour rien au monde.",
                'category_id' => $temoignage->id,
                'user_id'     => $admin->id,
                'status'      => 'published',
                'views'       => 534,
            ],

            // ── ARTICLE 6 ──────────────────────────────────────────
            [
                'title'       => 'Mini-réseaux solaires : électrifier les villages isolés du Bénin',
                'excerpt'     => 'Les mini-réseaux solaires représentent la solution la plus adaptée pour électrifier les communautés rurales éloignées des lignes SBEE. Comment fonctionnent-ils ?',
                'content'     => "Un mini-réseau solaire est une infrastructure électrique locale autonome, alimentée par des panneaux solaires et des batteries, capable de desservir un village ou un quartier entier. C'est l'alternative aux longues et coûteuses lignes de distribution de la SBEE pour les zones rurales isolées.

## Pourquoi les lignes classiques ne suffisent pas

Étendre le réseau SBEE vers une communauté rurale de 200 foyers à 50 kilomètres de la ligne existante peut coûter plusieurs centaines de millions de FCFA. Ce coût est rarement justifié économiquement par la faible consommation initiale de ces communautés. Résultat : ces villages attendent depuis des décennies un raccordement qui ne vient pas.

## Comment fonctionne un mini-réseau solaire

Un mini-réseau comprend une centrale de production composée de panneaux solaires et de batteries, un système de distribution local avec des câbles et des compteurs pour chaque abonné, et un système de gestion intelligent qui équilibre production et consommation.

Chaque foyer raccordé dispose d'un compteur prépayé. Il achète des unités d'énergie via mobile money, exactement comme une recharge téléphonique. Cette approche prépayée élimine les problèmes de recouvrement et rend le système financièrement viable.

## Les avantages pour les communautés

L'impact d'un mini-réseau sur une communauté rurale est immédiat et profond. Les enfants peuvent étudier le soir à la lumière électrique. Les centres de santé peuvent conserver les vaccins au réfrigérateur. Les commerçants peuvent prolonger leurs horaires. Les artisans peuvent utiliser des outils électriques.

Des études menées en Afrique de l'Ouest montrent qu'une communauté rurale électrifiée via mini-réseau voit ses revenus augmenter en moyenne de 25 à 35% dans les deux ans suivant l'installation.

## Les défis techniques et économiques

La taille du mini-réseau doit être soigneusement dimensionnée selon les besoins actuels et futurs de la communauté. Un sous-dimensionnement entraîne des coupures fréquentes, un surdimensionnement gaspille des ressources.

La maintenance est un autre défi. Des techniciens locaux formés sont indispensables pour assurer la pérennité du système. C'est pourquoi les meilleurs projets de mini-réseaux incluent systématiquement un volet formation.

## L'avenir des mini-réseaux au Bénin

Le gouvernement béninois a identifié les mini-réseaux comme une composante essentielle de sa stratégie d'accès universel à l'électricité. Plusieurs dizaines de communautés sont en cours d'identification pour bénéficier de ces installations dans les prochaines années.

Les mini-réseaux solaires ne sont pas une solution de second rang. Dans de nombreux cas, ils offrent une qualité de service supérieure au réseau classique : moins de coupures, tension plus stable, et coût à terme plus bas.",
                'category_id' => $innovation->id,
                'user_id'     => $admin->id,
                'status'      => 'published',
                'views'       => 267,
            ],

        ];

        foreach ($posts as $postData) {
            Post::create($postData);
        }
    }
}