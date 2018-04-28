<?php
/**
 * Created by PhpStorm.
 * User: Devin
 * Date: 4/17/2018
 * Time: 6:25 PM
 */

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\User;
use App\Entity\UserStat;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

// Controller for Battle popup
class BattlePopup extends Controller
{
    /**
     * @Route("/battle/popup",name="app_my-battle-popup")
     */
    public function battlePopup(ObjectManager $manager)
    {
        $avatarDirectory = $this->getParameter('avatar_directory');

        $userName = $_POST["name"];

        $user = $manager->getRepository(User::class)->findOneBy(["username" => $userName]);

        $userStat = $manager->getRepository(UserStat::class)->findOneBy(["user" => $user]);

        // User Profile Avatar
        $userAvatar = $manager
            ->getRepository(Avatar::class)
            ->find($user->getAvatar());

        $profilePicturePath = $avatarDirectory.'/'.$userAvatar->getImagePath();

        $total = $userStat->getMatchesLost() + $userStat->getMatchesWon();

        $userRank = ProfileController::getRankName($userStat->getUserRank());

        return $this->render('battle/battle_popup.html.twig', [
            "total_matches" => $total,
            "user_stat" => $userStat,
            "profile_img" => $profilePicturePath,
            "user_rank" => $userRank
        ]);
    }

    /**
     * @Route("/battle/leaderboard-popup",name="app_my-battle-leaderboard-popup")
     */
    public function leaderboardPopup(ObjectManager $manager)
    {

        $userName = $_POST["name"];

        $user = $manager->getRepository(User::class)->findOneBy(["username" => $userName]);

        $userStat = $manager->getRepository(UserStat::class)->findOneBy(["user" => $user]);

        // User Profile Avatar
        $userAvatar = $this->getDoctrine()
            ->getRepository(Avatar::class)
            ->find($user->getAvatar());

        $profilePicturePath = $userAvatar->getImagePath();

        $total = $userStat->getMatchesLost() + $userStat->getMatchesWon();

        return $this->render('battle/battle_leaderboard_popup.html.twig', ["total_matches" => $total, "user_stat" => $userStat, "profile_img" => $profilePicturePath]);
    }

}