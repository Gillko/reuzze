<?php
/**
 * Created by PhpStorm.
 * User: gillesvanpeteghem
 * Date: 4/12/13
 * Time: 15:49
 */

use Reuzze\ReuzzeBundle\Entity\Users;
use Reuzze\ReuzzeBundle\Entity\Persons;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends WebTestCase {

    private $doctrine;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->doctrine = static::$kernel->getContainer()->get('doctrine');;
        // $em = $this->doctrine->getManager();
        // $em->getConnection()->beginTransaction(); // Suspend auto-commit.
    }

    /**
     * Test for the Entities User
     */
    public function testUsers()
    {
        $unique = md5(microtime());

        $user = new User();
        $user->setGivenname('John');
        $user->setFamilyname('Doe');
        $user->setUsername('johndoe' . $unique);
        $user->setEmail('john.doe.' . $unique . '@arteveldehs.be');

        /*$personA = new Person();
        $personA->setGivenname('Jane');
        $personA->setFamilyname('Doe');*/

        /*$userB = new User();
        $userB->setGivenname('Jack');
        $userB->setFamilyname('Doe');
        $userB->setUsername('jackdoe' . $unique);
        $userB->setEmail('jack.doe.' . $unique . '@arteveldehs.be');

        $memberA = new Member();
        $memberA->setGivenname('Jill');
        $memberA->setFamilyname('Doe');
        $memberA->setUsername('jilldoe' . $unique);
        $memberA->setEmail('jill.doe.' . $unique . '@arteveldehs.be');
        $memberA->setPassword(crypt('jilldoe'));
        $memberA->setSalt(crypt('jilldoe'));*/


        $em = $this->doctrine->getManager();
        $em->persist($user);   // Manage the User object for persistence.
        //$em->persist($personA); // Manage the Person object for persistence.
        //$em->persist($userB);   // Manage the User object for persistence.
        //$em->persist($memberA); // Manage the User object for persistence.
        $em->flush();           // Actually persist all objects that need to be persisted.

        $this->assertGreaterThanOrEqual(1, $user->getId());
    }

    public function testReadEntity()
    {
        $em = $this->doctrine->getManager();

        $userRepository = $this->doctrine->getRepository('AhsBlogBundle:User');
        $userC = $userRepository->find(2);
        //$userC->setGivenname($userC->getGivenname() . '_' . microtime());
        //$userC->setDeleted(new \DateTime());

        var_export($userC);

        //$em->persist($userC);
        $em->flush();
    }

    public function testMemberEntity()
    {
        $em = $this->doctrine->getManager();

        $memberRepository = $this->doctrine->getRepository('AhsBlogBundle:Member');
        $memberB = $memberRepository->findOneBy([
            'givenname'  => 'Jill',
            'familyname' => 'Doe',
        ]);
        //$memberB->setGivenname($memberB->getGivenname() . '_' . microtime());

        var_export($memberB);

        //$em->persist($memberB);
        $em->flush();
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $em = $this->doctrine->getManager();
        // $em->getConnection()->rollback(); // Rollback all database changes, but auto_increment max will remain.
        $em->close();
    }
}






