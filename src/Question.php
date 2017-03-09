<?php
namespace GAQuizGenerator;

/**
 * Class to store question attributes
 *
 * @author Rian Fakhrusy
 */

class Question {
    private $id;
    private $score;
    private $type;
    private $difficulty; 
    private $chapterCovered; 
    private $distinguishingDegree; 
    private $solutionTime; 


	/**
	 * Class Constructor
	 * @param    $id   
	 * @param    $score   
	 * @param    $type   
	 * @param    $difficulty   
	 * @param    $chapterCovered   
	 * @param    $distinguishingDegree   
	 * @param    $solutionTime   
	 * @param    $abilityLevel   
	 */
	public function __construct($id, $score, $type, $difficulty, $chapterCovered, $distinguishingDegree, $solutionTime)
	{
		$this->id = $id;
		$this->score = $score;
		$this->type = $type;
		$this->difficulty = $difficulty;
		$this->chapterCovered = $chapterCovered;
		$this->distinguishingDegree = $distinguishingDegree;
		$this->solutionTime = $solutionTime;
	}

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    private function _setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of score.
     *
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Sets the value of score.
     *
     * @param mixed $score the score
     *
     * @return self
     */
    private function _setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Gets the value of type.
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the value of type.
     *
     * @param mixed $type the type
     *
     * @return self
     */
    private function _setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Gets the value of difficulty.
     *
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Sets the value of difficulty.
     *
     * @param mixed $difficulty the difficulty
     *
     * @return self
     */
    private function _setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Gets the value of chapterCovered.
     *
     * @return mixed
     */
    public function getChapterCovered()
    {
        return $this->chapterCovered;
    }

    /**
     * Sets the value of chapterCovered.
     *
     * @param mixed $chapterCovered the knowledge point
     *
     * @return self
     */
    private function _setChapterCovered($chapterCovered)
    {
        $this->chapterCovered = $chapterCovered;

        return $this;
    }

    /**
     * Gets the value of distinguishingDegree.
     *
     * @return mixed
     */
    public function getDistinguishingDegree()
    {
        return $this->distinguishingDegree;
    }

    /**
     * Sets the value of distinguishingDegree.
     *
     * @param mixed $distinguishingDegree the distinguishing degree
     *
     * @return self
     */
    private function _setDistinguishingDegree($distinguishingDegree)
    {
        $this->distinguishingDegree = $distinguishingDegree;

        return $this;
    }

    /**
     * Gets the value of solutionTime.
     *
     * @return mixed
     */
    public function getSolutionTime()
    {
        return $this->solutionTime;
    }

    /**
     * Sets the value of solutionTime.
     *
     * @param mixed $solutionTime the solution time
     *
     * @return self
     */
    private function _setSolutionTime($solutionTime)
    {
        $this->solutionTime = $solutionTime;

        return $this;
    }
    
}