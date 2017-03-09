<?php
namespace GAQuizGenerator;

/**
 * Question class
 *
 * @author Rian Fakhrusy
 */

class Quiz {
	public static $nQuestion;
    public static $sumScore;
    public static $types = [];
    public static $avgDiff;
    public static $chapter = [];
    public static $avgDist;
    public static $sumTime;
    public static $quest = [];

    public function load($filename){
    	$handle = fopen($filename, "r");
		fscanf($handle, "%d", $T);

		for ($t = 1; $t <= $T; $t++)
		{
			fscanf($handle, "%[^\n]", $S);
			#print($S);
			$a = explode(' ', $S);
			#var_dump($a);

			self::$quest[] = new Question(
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