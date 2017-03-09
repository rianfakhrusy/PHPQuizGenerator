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

require_once('src/Chromosome.php');
require_once('src/Population.php');
require_once('src/Question.php');
require_once('src/Quiz.php');

$filename = "input.txt";
$exam = new Quiz();
$exam->load($filename);

#input
Quiz::$nQuestion = 0;
Quiz::$sumScore = 100;
Quiz::$types = array("multichoice"=>5,"essay"=>5);
#var_dump(Quiz::$types);
foreach (Quiz::$types as $key => $value){
	Quiz::$nQuestion += $value;
}
#print(Quiz::$nQuestion);
#print("<br>");
Quiz::$avgDiff = 0.5;
Quiz::$chapter = array(
	"Induksi"=>1,
	"Fungsi"=>1,
	"Kombinatorial"=>2,
	"Rekurensi"=>1,
	"Graf"=>1,
	"Pohon"=>1,
	"Kompleksitas"=>2,
	"Boolean"=>1
);
Quiz::$avgDist = 0.5;
Quiz::$sumTime = 120;


$p = new Population();

for ($x=1; $x<=1024; $x++){
    $best = reset($p->population);
    printf("Generation %d: %s<br>", $x, $best->fitness);

    if ($best->fitness == 0) exit("Best match found");
    $p->evolve();
}

exit("Unable to find the best match");