<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    protected $passwordEncoder;

    /**
     * UserFixture constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User('admin');
        $user->setPlainPassword('');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'admin123'));
        $user->setAdditionalRoles('ROLE_ADMIN,ROLE_CONTROLLERS_MANAGER');
        $manager->persist($user);

        $manager->flush();
    }
}
