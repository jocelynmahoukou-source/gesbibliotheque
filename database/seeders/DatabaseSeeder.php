<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Auteur, Categorie, Livre, Adherent, Emprunt};

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Catégories
        $cats = collect([
            ['nom'=>'Roman','description'=>'Fiction littéraire et romans'],
            ['nom'=>'Science-Fiction','description'=>'Voyages dans le futur et l\'espace'],
            ['nom'=>'Histoire','description'=>'Livres historiques et biographies'],
            ['nom'=>'Sciences','description'=>'Sciences naturelles et exactes'],
            ['nom'=>'Philosophie','description'=>'Œuvres philosophiques'],
            ['nom'=>'Jeunesse','description'=>'Livres pour enfants et adolescents'],
        ])->map(fn($d) => Categorie::create($d));

        // Auteurs
        $auteurs = collect([
            ['prenom'=>'Victor','nom'=>'Hugo','nationalite'=>'Française','bio'=>'Poète, romancier et dramaturge français du XIXe siècle.'],
            ['prenom'=>'Albert','nom'=>'Camus','nationalite'=>'Française','bio'=>'Écrivain, philosophe et journaliste français.'],
            ['prenom'=>'Isaac','nom'=>'Asimov','nationalite'=>'Américaine','bio'=>'Auteur américain de science-fiction et de vulgarisation scientifique.'],
            ['prenom'=>'Marguerite','nom'=>'Yourcenar','nationalite'=>'Française','bio'=>'Romancière et essayiste française.'],
            ['prenom'=>'Gabriel','nom'=>'Garcia Marquez','nationalite'=>'Colombienne','bio'=>'Romancier colombien, prix Nobel de littérature 1982.'],
        ])->map(fn($d) => Auteur::create($d));

        // Livres
        $livresData = [
            ['titre'=>'Les Misérables','auteur'=>0,'cat'=>0,'isbn'=>'978-2-07-036024-5','annee'=>1862,'q'=>3],
            ['titre'=>'Notre-Dame de Paris','auteur'=>0,'cat'=>0,'isbn'=>'978-2-07-040870-8','annee'=>1831,'q'=>2],
            ['titre'=>'L\'Étranger','auteur'=>1,'cat'=>0,'isbn'=>'978-2-07-036024-6','annee'=>1942,'q'=>4],
            ['titre'=>'La Peste','auteur'=>1,'cat'=>0,'isbn'=>'978-2-07-036058-0','annee'=>1947,'q'=>3],
            ['titre'=>'Fondation','auteur'=>2,'cat'=>1,'isbn'=>'978-2-07-040815-9','annee'=>1951,'q'=>2],
            ['titre'=>'Le Cycle des robots','auteur'=>2,'cat'=>1,'isbn'=>'978-2-07-041200-2','annee'=>1950,'q'=>2],
            ['titre'=>'Mémoires d\'Hadrien','auteur'=>3,'cat'=>2,'isbn'=>'978-2-07-036327-7','annee'=>1951,'q'=>2],
            ['titre'=>'Cent ans de solitude','auteur'=>4,'cat'=>0,'isbn'=>'978-2-07-036822-7','annee'=>1967,'q'=>3],
        ];
        $livres = collect($livresData)->map(fn($d) => Livre::create([
            'titre'=>$d['titre'], 'auteur_id'=>$auteurs[$d['auteur']]->id,
            'categorie_id'=>$cats[$d['cat']]->id, 'isbn'=>$d['isbn'],
            'annee_publication'=>$d['annee'], 'quantite'=>$d['q'],
        ]));

        // Adhérents
        $adherentsData = [
            ['prenom'=>'Marie','nom'=>'Dubois','email'=>'marie.dubois@email.com','telephone'=>'06 12 34 56 78','statut'=>'actif'],
            ['prenom'=>'Jean','nom'=>'Martin','email'=>'jean.martin@email.com','telephone'=>'07 98 76 54 32','statut'=>'actif'],
            ['prenom'=>'Sophie','nom'=>'Bernard','email'=>'sophie.b@email.com','telephone'=>'06 55 44 33 22','statut'=>'actif'],
            ['prenom'=>'Pierre','nom'=>'Leroy','email'=>'p.leroy@email.com','telephone'=>'07 11 22 33 44','statut'=>'suspendu'],
            ['prenom'=>'Camille','nom'=>'Moreau','email'=>'c.moreau@email.com','telephone'=>'06 77 88 99 00','statut'=>'actif'],
        ];
        $adherents = collect($adherentsData)->map(fn($d) => Adherent::create($d + ['date_adhesion'=>now()->subMonths(rand(1,24))]));

        // Emprunts
        Emprunt::create(['livre_id'=>$livres[0]->id,'adherent_id'=>$adherents[0]->id,'date_emprunt'=>now()->subDays(20),'date_retour_prevue'=>now()->subDays(6),'statut'=>'en_cours']);
        Emprunt::create(['livre_id'=>$livres[2]->id,'adherent_id'=>$adherents[1]->id,'date_emprunt'=>now()->subDays(5),'date_retour_prevue'=>now()->addDays(9),'statut'=>'en_cours']);
        Emprunt::create(['livre_id'=>$livres[4]->id,'adherent_id'=>$adherents[2]->id,'date_emprunt'=>now()->subDays(3),'date_retour_prevue'=>now()->addDays(11),'statut'=>'en_cours']);
        Emprunt::create(['livre_id'=>$livres[1]->id,'adherent_id'=>$adherents[0]->id,'date_emprunt'=>now()->subDays(30),'date_retour_prevue'=>now()->subDays(16),'statut'=>'retourne','date_retour_effective'=>now()->subDays(17)]);
        Emprunt::create(['livre_id'=>$livres[6]->id,'adherent_id'=>$adherents[4]->id,'date_emprunt'=>now()->subDays(18),'date_retour_prevue'=>now()->subDays(4),'statut'=>'en_cours']);
    }
}
