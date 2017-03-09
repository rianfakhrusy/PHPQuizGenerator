<?php
# The MIT License
#
# Copyright (c) 2017 Rian Fakhrusy
# Extended from Carlos André Ferrari's code (2011).
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
# THE SOFTWARE.

namespace GAQuizGenerator;

/**
 * A php script that demonstrates a simple "Hello, world!" application using
 * genetic algorithms.
 * Extended from Carlos André Ferrari's code.
 *
 * @author Rian Fakhrusy
 */
class Chromosome {

    public $fitness;
    public $gene = [];
    #public $population;
    public static $targetGene = "Hello, World!";

    /*
     * This class is used to define a chromosome for the gentic algorithm
     * simulation.

     * This class is essentially nothing more than a container for the details
     * of the chromosome, namely the gene (the string that represents our
     * target string) and the fitness (how close the gene is to the target
     * string).

     * Note that this class is immutable.  Calling mate() or mutate() will
     * result in a new chromosome instance being created.

     */
    public function __construct($gene)
    {
        $this->gene = $gene;
        $this->fitness = $this->calculateFitness($gene);
    }

    /*
     * Method used to mate the chromosome with another chromosome,
     * resulting in a new chromosome being returned.
     */
    public function mate(Chromosome $mate)
    {
        // Convert the genes to arrays to make thing easier.
        $arr1  = $this->gene;
        $arr2  = $mate->gene;

        // Select a random pivot point for the mating
        $pivot = rand(0, count($this->gene)-2);

        $length = count($mate->gene);

        // Copy the data from each gene to the first child.
        $child1 = array_merge(
            array_slice($arr1,0,$pivot), 
            array_slice($arr2,-$length+$pivot)
        );

        // Repeat for the second child, but in reverse order.
        $child2 = array_merge(
            array_slice($arr2,0,$pivot), 
            array_slice($arr1,-$length+$pivot)
        );

        return array(
            new self($child1),
            new self($child2)
        );
    }

    /*
     * Method used to generate a new chromosome based on a change in a
     * random character in the gene of this chromosome.  A new chromosome
     * will be created, but this original will not be affected.
     */
    public function mutate()
    {
        $quizIds = array_map(function($o) { return $o->getId(); }, Quiz::$quest); #get array of all question id
        $gene = $this->gene;
        $unusedGene = array_diff($quizIds, $gene); #get all question id that has not been in the quiz

        #replace a random gene with a random new question
        shuffle($unusedGene);
        $gene{rand(0, count($gene)-1)} = $unusedGene[0];

        return new self($gene);
    }

    /*
     * Helper method used to return the fitness for the chromosome based
     * on its gene.
     */
    public function calculateFitness($gene)
    {
        $tempScore = 0;
        $tempTypes = [];
        $tempDiff = 0;
        $tempChapter = [];
        $tempDist = 0;
        $tempTime = 0;

        #var_dump(Quiz::$quest);
        #var_dump($gene);

        foreach($gene as $key => $value)
        {
            $tempScore += Quiz::$quest[$value-1]->getScore();
            $tempDiff += Quiz::$quest[$value-1]->getDifficulty();
            $tempDist += Quiz::$quest[$value-1]->getDistinguishingDegree();
            $tempTime += Quiz::$quest[$value-1]->getSolutionTime();
        }
/*
        for ($i = 0; $i <= count($gene); $i++)
        {
            $temp = Quiz::$quest;
            $temp15 = $gene[(int)$i]-1;
            $temp2 = $temp[$temp15];
            $tempScore += $temp2->getScore();
            $tempDiff += Quiz::$quest[$gene[$i]-1]->getDifficulty();
            $tempDist += Quiz::$quest[$gene[$i]-1]->getDistinguishingDegree();
            $tempTime += Quiz::$quest[$gene[$i]-1]->getSolutionTime();

        }*/

        $tempDiff /= count($gene);
        $tempDist /= count($gene);

        $NRE = 0;
        $NRE += abs(Quiz::$sumScore - $tempScore)/ Quiz::$sumScore;
        $NRE += abs(Quiz::$avgDiff - $tempDiff)/ Quiz::$avgDiff;
        $NRE += abs(Quiz::$avgDist - $tempDist)/ Quiz::$avgDist;
        $NRE += abs(Quiz::$sumTime - $tempTime)/ Quiz::$sumTime;

        $fitness = 1/(1+$NRE);


        #foreach (str_split($gene) as $k => $ch)
        #    $fitness += abs( ord($ch) - ord(Chromosome::$targetGene{$k}) );
        
        return $fitness;
    }

    /*
     * A convenience method for generating a random chromosome with a random
     * gene.
     */
    public static function genRandom()
    {
        $quizIds = array_map(function($o) { return $o->getId(); }, Quiz::$quest); #get array of all question id
        shuffle($quizIds);
        $newgene = array_slice($quizIds, 0, Quiz::$nQuestion);

        #var_dump($newgene);

        $chromosome = new self($newgene);
        return $chromosome;
    }

    /*
     * return the fitness of the gene,
     * its uset to sort the population
     */
    public function __toString(){
        return (string)$this->fitness;
    }
    
}