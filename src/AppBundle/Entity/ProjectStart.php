<?php
//
//namespace AppBundle\Entity;
//
//use Doctrine\ORM\Mapping as ORM;
//use Doctrine\ORM\Mapping\Column;
//use Symfony\Component\Validator\Constraints as Assert;
//use Doctrine\Common\Collections\ArrayCollection;
//
//
///**
// * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectStartRepository")
// * @ORM\Table(name="projects")
// */
//class ProjectStart extends AbstractAuditable
//{
//    /**
//     * @var int
//     *
//     * @ORM\Id
//     * @ORM\Column(type="integer")
//     * @ORM\GeneratedValue(strategy="AUTO")
//     */
//    protected $id;
//
//    /**
//     * @ORM\ManyToOne(
//     *      targetEntity="User"
//     * )
//     */
//    protected $user;
//
//    /**
//     * @ORM\ManyToOne(
//     *      targetEntity="ProjectProgramme"
//     * )
//     */
//    protected $programmes;
//
//    /**
//     * @ORM\ManyToOne(
//     *      targetEntity="ProjectKeyAction"
//     * )
//     */
//    protected $keyActions;
//
//    /**
//     * @ORM\ManyToOne(
//     *      targetEntity="ProjectAction"
//     * )
//     */
//    protected $actions;
//
//    /**
//     * @ORM\ManyToOne(
//     *      targetEntity="ProjectCall"
//     * )
//     */
//    protected $calls;
//
//    /**
//     * @ORM\ManyToOne(
//     *      targetEntity="ProjectRound"
//     * )
//     */
//    protected $rounds;
//
//    public function __construct()
//    {
//        parent::__construct();
//    }
//
//    /**
//     * @return int
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getUser()
//    {
//        return $this->user;
//    }
//
//    /**
//     * @param mixed $user
//     */
//    public function setUser($user)
//    {
//        $this->user = $user;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getProgrammes()
//    {
//        return $this->programmes;
//    }
//
//    /**
//     * @param mixed $programmes
//     */
//    public function setProgrammes($programmes)
//    {
//        $this->programmes = $programmes;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getKeyActions()
//    {
//        return $this->keyActions;
//    }
//
//    /**
//     * @param mixed $keyActions
//     */
//    public function setKeyActions($keyActions)
//    {
//        $this->keyActions = $keyActions;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getActions()
//    {
//        return $this->actions;
//    }
//
//    /**
//     * @param mixed $actions
//     */
//    public function setActions($actions)
//    {
//        $this->actions = $actions;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getCalls()
//    {
//        return $this->calls;
//    }
//
//    /**
//     * @param mixed $calls
//     */
//    public function setCalls($calls)
//    {
//        $this->calls = $calls;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getRounds()
//    {
//        return $this->rounds;
//    }
//
//    /**
//     * @param mixed $rounds
//     */
//    public function setRounds($rounds)
//    {
//        $this->rounds = $rounds;
//    }
//
//}
//
