<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Auteur, Categorie, Livre, Adherent, Emprunt};

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // NOTE : Le compte Admin se crée uniquement via /register dans le navigateur.
        // Pas de seeding automatique pour l'admin.

        $cats = collect([
            ['nom'=>'Roman','description'=>'Fiction littéraire'],
            ['nom'=>'Science-Fiction','description'=>'Voyages dans le futur'],
            ['nom'=>'Histoire','description'=>'Livres historiques'],
            ['nom'=>'Sciences','description'=>'Sciences naturelles'],
            ['nom'=>'Philosophie','description'=>'Œuvres philosophiques'],
            ['nom'=>'Jeunesse','description'=>'Livres pour enfants'],
        ])->map(fn($d)=>Categorie::create($d));

        $auteurs = collect([
            ['prenom'=>'Victor','nom'=>'Hugo','nationalite'=>'Française','bio'=>'Romancier du XIXe siècle.'],
            ['prenom'=>'Albert','nom'=>'Camus','nationalite'=>'Française','bio'=>'Écrivain et philosophe.'],
            ['prenom'=>'Isaac','nom'=>'Asimov','nationalite'=>'Américaine','bio'=>'Maître de la science-fiction.'],
            ['prenom'=>'Marguerite','nom'=>'Yourcenar','nationalite'=>'Française','bio'=>'Première femme à l\'Académie française.'],
            ['prenom'=>'Gabriel','nom'=>'Garcia Marquez','nationalite'=>'Colombienne','bio'=>'Prix Nobel 1982.'],
        ])->map(fn($d)=>Auteur::create($d));

        $livres = collect([
            ['titre'=>'Les Misérables','a'=>0,'c'=>0,'isbn'=>'978-2-07-036024-5','y'=>1862,'q'=>3],
            ['titre'=>'Notre-Dame de Paris','a'=>0,'c'=>0,'isbn'=>'978-2-07-040870-8','y'=>1831,'q'=>2],
            ['titre'=>'L\'Étranger','a'=>1,'c'=>0,'isbn'=>'978-2-07-036024-6','y'=>1942,'q'=>4],
            ['titre'=>'La Peste','a'=>1,'c'=>0,'isbn'=>'978-2-07-036058-0','y'=>1947,'q'=>3],
            ['titre'=>'Fondation','a'=>2,'c'=>1,'isbn'=>'978-2-07-040815-9','y'=>1951,'q'=>2],
            ['titre'=>'Mémoires d\'Hadrien','a'=>3,'c'=>2,'isbn'=>'978-2-07-036327-7','y'=>1951,'q'=>2],
            ['titre'=>'Cent ans de solitude','a'=>4,'c'=>0,'isbn'=>'978-2-07-036822-7','y'=>1967,'q'=>3],
        ])->map(fn($d)=>Livre::create(['titre'=>$d['titre'],'auteur_id'=>$auteurs[$d['a']]->id,'categorie_id'=>$cats[$d['c']]->id,'isbn'=>$d['isbn'],'annee_publication'=>$d['y'],'quantite'=>$d['q']]));

        $adherents = collect([
            ['prenom'=>'Marie','nom'=>'Dubois','email'=>'marie.dubois@email.com','telephone'=>'06 12 34 56 78','statut'=>'actif'],
            ['prenom'=>'Jean','nom'=>'Martin','email'=>'jean.martin@email.com','telephone'=>'07 98 76 54 32','statut'=>'actif'],
            ['prenom'=>'Sophie','nom'=>'Bernard','email'=>'sophie.b@email.com','telephone'=>'06 55 44 33 22','statut'=>'actif'],
            ['prenom'=>'Pierre','nom'=>'Leroy','email'=>'p.leroy@email.com','telephone'=>'07 11 22 33 44','statut'=>'suspendu'],
            ['prenom'=>'Camille','nom'=>'Moreau','email'=>'c.moreau@email.com','telephone'=>'06 77 88 99 00','statut'=>'actif'],
        ])->map(fn($d)=>Adherent::create($d+['date_adhesion'=>now()->subMonths(rand(1,24))]));

        Emprunt::create(['livre_id'=>$livres[0]->id,'adherent_id'=>$adherents[0]->id,'date_emprunt'=>now()->subDays(20),'date_retour_prevue'=>now()->subDays(6),'statut'=>'en_cours']);
        Emprunt::create(['livre_id'=>$livres[2]->id,'adherent_id'=>$adherents[1]->id,'date_emprunt'=>now()->subDays(5),'date_retour_prevue'=>now()->addDays(9),'statut'=>'en_cours']);
        Emprunt::create(['livre_id'=>$livres[1]->id,'adherent_id'=>$adherents[0]->id,'date_emprunt'=>now()->subDays(30),'date_retour_prevue'=>now()->subDays(16),'statut'=>'retourne','date_retour_effective'=>now()->subDays(17)]);
        Emprunt::create(['livre_id'=>$livres[5]->id,'adherent_id'=>$adherents[4]->id,'date_emprunt'=>now()->subDays(18),'date_retour_prevue'=>now()->subDays(4),'statut'=>'en_cours']);
    }
}
