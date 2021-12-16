<?php

/**
 *
 * @package    safeContainer
 * @version    Release: 1.0.0
 * @license    GPL3
 * @author     Ali YILMAZ <aliyilmaz.work@gmail.com>
 * @category   Safe content area.
 * @link       https://github.com/aliyilmaz/safeContainer
 *
 */
class safeContainer extends Mind
{

    /**
     * safeContainer
     * 
     * @param string $str
     * @param string|array|null $rule
     * @return string
     */
    public function safeContainer($str, $rule=null){

        if(self::aliyilmaz('is_htmlspecialchars')->is_htmlspecialchars($str)){
            $str = htmlspecialchars_decode($str);
        }

        $rules = array('inlinejs', 'inlinecss', 'tagjs', 'tagcss', 'iframe');
        
        if(!is_null($rule) AND !is_array($rule) AND in_array($rule, $rules)){
            $rules = array($rule);
        }

        $rules = (!is_null($rule) AND !is_array($rule) AND in_array($rule, $rules)) ? array($rule) : $rules;
        
        if(is_array($rule)) { $newRules = [];
            foreach ($rule as $r) { if(in_array($r, $rules)) $newRules[] = $r; } $rules = $newRules;
        }

        if(!in_array('inlinejs', $rules)){
            $str = preg_replace('/(<.+?)(?<=\s)on[a-z]+\s*=\s*(?:([\'"])(?!\2).+?\2|(?:\S+?\(.*?\)(?=[\s>])))(.*?>)/i', "$1$3", $str);
        }

        if(!in_array('inlinecss', $rules)){
            $str = preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $str);
        }

        if(!in_array('tagjs', $rules)){
            $str = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $str);
        }

        if(!in_array('tagcss', $rules)){
            $str = preg_replace('/<\s*style.+?<\s*\/\s*style.*?>/si', '', $str);
        }

        if(!in_array('iframe', $rules)){
            $str = preg_replace('/<iframe.*?\/iframe>/i','', $str);
        }

        return $str;
    }

}
