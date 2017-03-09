<?php
namespace GAQuizGenerator;

/**
 * Class to store critical information about a quiz that is useful in genetic algorithm process.
 *
 * @author Rian Fakhrusy
 */

class Quiz {
	public static $nQuestion;
    public static $sumScore;
    public static $types = [];
    public static $avgDiff;
    public static $chapters = [];
    public static $avgDist;
    public static $sumTime;
    public static $question = [];

    public function load($filename){
    	$handle = fopen($filename, "r");
		fscanf($handle, "%d", $T);

		for ($t = 1; $t <= $T; $t++)
		{
			fscanf($handle, "%[^\n]", $S);
			#print($S);
			$a = explode(' ', $S);
			#var_dump($a);

			self::$question[] = new Question(
				array_shift($a),
				array_shift($a),
				array_shift($a),
				array_shift($a),
				array_shift($a),
				array_shift($a),
				array_shift($a)
			);
		}
		#var_dump(self::$quest);
    }
}