<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Trick;
use App\Entity\Comment;
use App\Entity\Media;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //User
        $pegase = new User();
        $pegase->setPseudo('Seiya')
                ->setEmail('seiya@mail.com')
                ->setToken(null)
                ->setActivate(true)
                ->setCreatedAte(new \DateTime())
                ->setPassword('mdpachanger')
                ->setAvatar('pegase.jpg');
        $manager->persist($pegase);

        $dragon = new User();
        $dragon->setPseudo('Shiryu')
                ->setEmail('shiryu@mail.com')
                ->setToken(null)
                ->setActivate(true)
                ->setCreatedAte(new \DateTime())
                ->setPassword('mdpachanger')
                ->setAvatar('dragon.jpg');
        $manager->persist($dragon);

        $cygne = new User();
        $cygne->setPseudo('Hyoga')
                ->setEmail('Hyoga@mail.com')
                ->setToken(null)
                ->setActivate(true)
                ->setCreatedAte(new \DateTime())
                ->setPassword('mdpachanger')
                ->setAvatar('cygne.jpg');
        $manager->persist($cygne);

        $andromede = new User();
        $andromede->setPseudo('Shun')
                ->setEmail('shun@mail.com')
                ->setToken(null)
                ->setActivate(true)
                ->setCreatedAte(new \DateTime())
                ->setPassword('mdpachanger')
                ->setAvatar('shun.jpg');
        $manager->persist($andromede);


        $trick1 = new Trick();
        $trick1->setName('Mute')
        ->setSlug('mute')
        ->setContent('Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut praepotens acueret in fiduciam exitiosa coeptantem. verum navata est opera diligens hocque dilato Eusebius praepositus cubiculi missus est Cabillona aurum secum perferens, quo per turbulentos seditionum concitores occultius distributo et tumor consenuit militum et salus est in tuto locata praefecti. deinde cibo abunde perlato castra die praedicto sunt mota. Quibus occurrere bene pertinax miles explicatis ordinibus parans hastisque feriens scuta qui habitus iram pugnantium concitat et dolorem proximos iam gestu terrebat sed eum in certamen alacriter consurgentem revocavere ductores rati intempestivum anceps subire certamen cum haut longe muri distarent, quorum tutela securitas poterat in solido locari cunctorum. Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.')
        ->setCreatedAte(new \DateTime())
        ->setCreatedUser($andromede)
        ->setCategory(1)
        ->setUpDating(new \DateTime());
        //->setUpUser(null); 
        $manager->persist($trick1);  

        $trick2 = new Trick();
        $trick2->setName('Melancholie')
        ->setSlug('melancholie')
        ->setContent('Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut praepotens acueret in fiduciam exitiosa coeptantem. verum navata est opera diligens hocque dilato Eusebius praepositus cubiculi missus est Cabillona aurum secum perferens, quo per turbulentos seditionum concitores occultius distributo et tumor consenuit militum et salus est in tuto locata praefecti. deinde cibo abunde perlato castra die praedicto sunt mota. Quibus occurrere bene pertinax miles explicatis ordinibus parans hastisque feriens scuta qui habitus iram pugnantium concitat et dolorem proximos iam gestu terrebat sed eum in certamen alacriter consurgentem revocavere ductores rati intempestivum anceps subire certamen cum haut longe muri distarent, quorum tutela securitas poterat in solido locari cunctorum. Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.')
        ->setCreatedAte(new \DateTime())
        ->setCreatedUser($andromede)
        ->setCategory(2)
        ->setUpDating(new \DateTime())
        ->setUpUser($cygne); 
        $manager->persist($trick2);  

        $trick3 = new Trick();
        $trick3->setName('Indy')
        ->setSlug('indy')
        ->setContent('Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut praepotens acueret in fiduciam exitiosa coeptantem. verum navata est opera diligens hocque dilato Eusebius praepositus cubiculi missus est Cabillona aurum secum perferens, quo per turbulentos seditionum concitores occultius distributo et tumor consenuit militum et salus est in tuto locata praefecti. deinde cibo abunde perlato castra die praedicto sunt mota. Quibus occurrere bene pertinax miles explicatis ordinibus parans hastisque feriens scuta qui habitus iram pugnantium concitat et dolorem proximos iam gestu terrebat sed eum in certamen alacriter consurgentem revocavere ductores rati intempestivum anceps subire certamen cum haut longe muri distarent, quorum tutela securitas poterat in solido locari cunctorum. Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.')
        ->setCreatedAte(new \DateTime())
        ->setCreatedUser($andromede)
        ->setCategory(3)
        ->setUpDating(new \DateTime());
        //->setUpUser(null); 
        $manager->persist($trick3);  

        $trick4 = new Trick();
        $trick4->setName('Stalefish')
        ->setSlug('stalefish')
        ->setContent('Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut praepotens acueret in fiduciam exitiosa coeptantem. verum navata est opera diligens hocque dilato Eusebius praepositus cubiculi missus est Cabillona aurum secum perferens, quo per turbulentos seditionum concitores occultius distributo et tumor consenuit militum et salus est in tuto locata praefecti. deinde cibo abunde perlato castra die praedicto sunt mota. Quibus occurrere bene pertinax miles explicatis ordinibus parans hastisque feriens scuta qui habitus iram pugnantium concitat et dolorem proximos iam gestu terrebat sed eum in certamen alacriter consurgentem revocavere ductores rati intempestivum anceps subire certamen cum haut longe muri distarent, quorum tutela securitas poterat in solido locari cunctorum. Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.')
        ->setCreatedAte(new \DateTime())
        ->setCreatedUser($andromede)
        ->setCategory(4)
        ->setUpDating(new \DateTime());
        //->setUpUser(null); 
        $manager->persist($trick4);  

        $trick5 = new Trick();
        $trick5->setName('Tail Grab')
        ->setSlug('tailgrab')
        ->setContent('Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut praepotens acueret in fiduciam exitiosa coeptantem. verum navata est opera diligens hocque dilato Eusebius praepositus cubiculi missus est Cabillona aurum secum perferens, quo per turbulentos seditionum concitores occultius distributo et tumor consenuit militum et salus est in tuto locata praefecti. deinde cibo abunde perlato castra die praedicto sunt mota. Quibus occurrere bene pertinax miles explicatis ordinibus parans hastisque feriens scuta qui habitus iram pugnantium concitat et dolorem proximos iam gestu terrebat sed eum in certamen alacriter consurgentem revocavere ductores rati intempestivum anceps subire certamen cum haut longe muri distarent, quorum tutela securitas poterat in solido locari cunctorum. Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.')
        ->setCreatedAte(new \DateTime())
        ->setCreatedUser($andromede)
        ->setCategory(1)
        ->setUpDating(new \DateTime())
        ->setUpUser($cygne); 
        $manager->persist($trick5);  

        $trick6 = new Trick();
        $trick6->setName('Nose Grab')
        ->setSlug('nosegrab')
        ->setContent('Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut praepotens acueret in fiduciam exitiosa coeptantem. verum navata est opera diligens hocque dilato Eusebius praepositus cubiculi missus est Cabillona aurum secum perferens, quo per turbulentos seditionum concitores occultius distributo et tumor consenuit militum et salus est in tuto locata praefecti. deinde cibo abunde perlato castra die praedicto sunt mota. Quibus occurrere bene pertinax miles explicatis ordinibus parans hastisque feriens scuta qui habitus iram pugnantium concitat et dolorem proximos iam gestu terrebat sed eum in certamen alacriter consurgentem revocavere ductores rati intempestivum anceps subire certamen cum haut longe muri distarent, quorum tutela securitas poterat in solido locari cunctorum. Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.')
        ->setCreatedAte(new \DateTime())
        ->setCreatedUser($andromede)
        ->setCategory(2)
        ->setUpDating(new \DateTime());
        //->setUpUser(null); 
        $manager->persist($trick6);  

        $trick7 = new Trick();
        $trick7->setName('Japan Air')
        ->setSlug('japanair')
        ->setContent('Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut praepotens acueret in fiduciam exitiosa coeptantem. verum navata est opera diligens hocque dilato Eusebius praepositus cubiculi missus est Cabillona aurum secum perferens, quo per turbulentos seditionum concitores occultius distributo et tumor consenuit militum et salus est in tuto locata praefecti. deinde cibo abunde perlato castra die praedicto sunt mota. Quibus occurrere bene pertinax miles explicatis ordinibus parans hastisque feriens scuta qui habitus iram pugnantium concitat et dolorem proximos iam gestu terrebat sed eum in certamen alacriter consurgentem revocavere ductores rati intempestivum anceps subire certamen cum haut longe muri distarent, quorum tutela securitas poterat in solido locari cunctorum. Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.')
        ->setCreatedAte(new \DateTime())
        ->setCreatedUser($andromede)
        ->setCategory(3)
        ->setUpDating(new \DateTime());
        //->setUpUser(null); 
        $manager->persist($trick7);  

        $trick8 = new Trick();
        $trick8->setName('Seat Belt')
        ->setSlug('seatbelt')
        ->setContent('Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut praepotens acueret in fiduciam exitiosa coeptantem. verum navata est opera diligens hocque dilato Eusebius praepositus cubiculi missus est Cabillona aurum secum perferens, quo per turbulentos seditionum concitores occultius distributo et tumor consenuit militum et salus est in tuto locata praefecti. deinde cibo abunde perlato castra die praedicto sunt mota. Quibus occurrere bene pertinax miles explicatis ordinibus parans hastisque feriens scuta qui habitus iram pugnantium concitat et dolorem proximos iam gestu terrebat sed eum in certamen alacriter consurgentem revocavere ductores rati intempestivum anceps subire certamen cum haut longe muri distarent, quorum tutela securitas poterat in solido locari cunctorum. Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.')
        ->setCreatedAte(new \DateTime())
        ->setCreatedUser($andromede)
        ->setCategory(4)
        ->setUpDating(new \DateTime());
        //->setUpUser(null); 
        $manager->persist($trick8);  

        $trick9 = new Trick();
        $trick9->setName('Truck Driver')
        ->setSlug('truckdriver')
        ->setContent('Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut praepotens acueret in fiduciam exitiosa coeptantem. verum navata est opera diligens hocque dilato Eusebius praepositus cubiculi missus est Cabillona aurum secum perferens, quo per turbulentos seditionum concitores occultius distributo et tumor consenuit militum et salus est in tuto locata praefecti. deinde cibo abunde perlato castra die praedicto sunt mota. Quibus occurrere bene pertinax miles explicatis ordinibus parans hastisque feriens scuta qui habitus iram pugnantium concitat et dolorem proximos iam gestu terrebat sed eum in certamen alacriter consurgentem revocavere ductores rati intempestivum anceps subire certamen cum haut longe muri distarent, quorum tutela securitas poterat in solido locari cunctorum. Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.')
        ->setCreatedAte(new \DateTime())
        ->setCreatedUser($andromede)
        ->setCategory(1)
        ->setUpDating(new \DateTime());
        //->setUpUser(null); 
        $manager->persist($trick9);   
        
        for($i = 1; $i <= 15; $i++){
        $comment1 = new Comment();
        $comment1->setContent('Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut frugi parens et prudens et dives Caesaribus tamquam liberis suis regenda patrimonii iura permisit.')
        ->setCreatedAte(new \DateTime())
        ->setTrickRelation($trick1);
            if($i % 2 == 0){
                $comment1->setCreatedUser($pegase);
            } else {
                $comment1->setCreatedUser($dragon);
            }
        $manager->persist($comment1);   
        }

        for($y = 1; $y <= 5; $y++){
            $comment2 = new Comment();
            $comment2->setContent('Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut frugi parens et prudens et dives Caesaribus tamquam liberis suis regenda patrimonii iura permisit.')
            ->setCreatedAte(new \DateTime())
            ->setTrickRelation($trick2);
                if($y % 2 == 0){
                    $comment2->setCreatedUser($pegase);
                } else {
                    $comment2->setCreatedUser($dragon);
                }
            $manager->persist($comment2);   
        }

        $photo1 = new Media();         
        $photo1->setUrl(0)
            ->setImageName('mute.jpg');
        $photo1->setType(1)
            ->setCreatedAte(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setTrickRelation($trick1);
        $manager->persist($photo1); 

        $photo2 = new Media();         
        $photo2->setUrl(0)
            ->setImageName('melancholie1.jpg');
        $photo2->setType(1)
            ->setCreatedAte(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setTrickRelation($trick2);
        $manager->persist($photo2); 

        $photo3 = new Media();         
        $photo3->setUrl(0)
            ->setImageName('melancholie2.jpeg');
        $photo3->setType(1)
            ->setCreatedAte(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setTrickRelation($trick2);
        $manager->persist($photo3); 

        $photo4 = new Media();         
        $photo4->setUrl(0)
            ->setImageName('stalefish.jpg');
        $photo4->setType(1)
            ->setCreatedAte(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setTrickRelation($trick4);
        $manager->persist($photo4); 

        $video1 = new Media();         
        $video1->setUrl('-u_OGubYzaU')
            ->setImageName(0);
        $video1->setType(2)
            ->setCreatedAte(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setTrickRelation($trick1);
            
        $manager->persist($video1); 

        /*   $photo = new Media();

        $manager->persist($photo);  


        $Video = new Media();

        $manager->persist($video); */

        $manager->flush();
    }
}
