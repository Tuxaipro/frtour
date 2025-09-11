<?php

namespace App\Helpers;

class MathCaptcha
{
    public static function generate($type = 'default')
    {
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $operation = rand(0, 1) ? '+' : '-';
        
        if ($operation === '+') {
            $answer = $num1 + $num2;
            $question = "$num1 + $num2 = ?";
        } else {
            // Ensure positive result
            if ($num1 < $num2) {
                $temp = $num1;
                $num1 = $num2;
                $num2 = $temp;
            }
            $answer = $num1 - $num2;
            $question = "$num1 - $num2 = ?";
        }
        
        // Store in session with type-specific key
        session(["math_captcha_answer_{$type}" => $answer]);
        
        return [
            'question' => $question,
            'answer' => $answer
        ];
    }
    
    public static function verify($userAnswer, $type = 'default')
    {
        $correctAnswer = session("math_captcha_answer_{$type}");
        return $correctAnswer && (int)$userAnswer === (int)$correctAnswer;
    }
    
    public static function clear($type = 'default')
    {
        session()->forget("math_captcha_answer_{$type}");
    }
}
